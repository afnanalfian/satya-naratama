<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Exam;
use App\Models\Meeting;
use App\Models\Product;
use App\Models\Productable;
use App\Models\User;
use App\Models\UserEntitlement;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * Logika keranjang (dipindah dari CartController agar dipakai ulang oleh komponen Livewire).
 * Aturan bisnis tidak berubah.
 */
class CartService
{
    public function __construct(protected PricingService $pricing)
    {
    }

    public function activeCart(int $userId): Cart
    {
        return Cart::firstOrCreate(['user_id' => $userId, 'status' => 'active']);
    }

    /** @throws RuntimeException dengan pesan untuk pengguna */
    public function add(User $user, Product $product, int $qty = 1): Cart
    {
        $cart = $this->activeCart($user->id);

        if ($this->alreadyOwned($user->id, $product)) {
            throw new RuntimeException('Produk ini sudah kamu miliki');
        }

        if ($product->type === 'tryout') {
            $packages = $cart->items()->whereHas('product', fn ($q) => $q->where('type', 'course_package'))->with('product.bonuses')->get()->pluck('product');
            foreach ($packages as $pkg) {
                if ($pkg->bonuses->where('bonus_type', 'tryout')->where('bonus_id', $product->productable?->productable?->id)->isNotEmpty()) {
                    throw new RuntimeException('Tryout ini sudah termasuk dalam paket course');
                }
            }
        }

        if ($product->type === 'meeting') {
            $courseId = $product->productable?->productable?->course_id;
            // Blok pertemuan satuan jika paket kelas yang sama sudah ada di keranjang.
            // (Versi lama justru menghapus pertemuan lain dari kelas yang sama — sudah diperbaiki.)
            if ($courseId && $this->cartHasCoursePackage($cart, $courseId)) {
                throw new RuntimeException('Pertemuan ini sudah termasuk dalam paket kelas di keranjang');
            }
        }

        try {
            $unitPrice = $product->type === 'meeting'
                ? null
                : $this->pricing->determineUnitPrice($product->type, $qty, $this->pricing->getPriceableForProduct($product));
        } catch (\Exception $e) {
            throw new RuntimeException($e->getMessage());
        }

        DB::transaction(function () use ($product, $cart, $qty, $unitPrice) {
            if ($product->type === 'course_package') {
                $course = $product->productable?->productable;
                if ($course) {
                    $this->removeMeetingProductsOfCourse($cart, $course->id);
                }
                $product->loadMissing('bonuses');
                $bonusExamIds = $product->bonuses->where('bonus_type', 'tryout')->pluck('bonus_id')->filter()->toArray();
                if ($bonusExamIds) {
                    $bonusProductIds = Exam::with('productable.product')->whereIn('id', $bonusExamIds)->get()
                        ->map(fn ($e) => $e->product?->id)->filter()->values()->toArray();
                    if ($bonusProductIds) {
                        $cart->items()->whereIn('product_id', $bonusProductIds)->delete();
                    }
                }
                $cart->items()->whereHas('product', fn ($q) => $q->where('type', 'addon'))->delete();
            }

            CartItem::updateOrCreate(['cart_id' => $cart->id, 'product_id' => $product->id], ['qty' => $qty, 'price_snapshot' => $unitPrice ?? 0]);

            if ($product->type === 'meeting') {
                $this->repriceMeetings($cart);
            }
        });

        return $cart;
    }

    public function updateQty(User $user, CartItem $item, int $qty): void
    {
        abort_if($item->cart->user_id !== $user->id, 403);
        DB::transaction(function () use ($item, $qty) {
            $item->update(['qty' => max(1, $qty)]);
            if ($item->product->type === 'meeting') {
                $this->repriceMeetings($item->cart);
            } else {
                $item->update(['price_snapshot' => $this->pricing->determineUnitPrice($item->product->type, $qty, $this->pricing->getPriceableForProduct($item->product))]);
            }
        });
    }

    public function remove(User $user, CartItem $item): void
    {
        abort_if($item->cart->user_id !== $user->id, 403);
        $cart = $item->cart;
        $wasMeeting = $item->product?->type === 'meeting';
        $item->delete();
        if ($wasMeeting) {
            $this->repriceMeetings($cart);
        }
    }

    public function addAddonQuiz(User $user): void
    {
        $cart = $this->activeCart($user->id)->load('items.product');
        if (UserEntitlement::where('user_id', $user->id)->where('entitlement_type', 'quiz')->exists()) {
            throw new RuntimeException('Kamu sudah memiliki akses Quiz.');
        }
        if ($cart->items->contains(fn ($i) => $i->product->type === 'course_package')) {
            throw new RuntimeException('Quiz sudah termasuk dalam paket Course.');
        }
        if ($cart->items->contains(fn ($i) => $i->product->type === 'addon')) {
            throw new RuntimeException('Addon Quiz sudah ada di keranjang.');
        }
        $addon = Product::where('type', 'addon')->first();
        if (! $addon) {
            throw new RuntimeException('Produk Addon Quiz belum tersedia.');
        }
        $cart->items()->create(['product_id' => $addon->id, 'qty' => 1, 'price_snapshot' => $this->pricing->addonPrice()]);
    }

    public function alreadyOwned(int $userId, Product $product): bool
    {
        if (in_array($product->type, ['meeting', 'tryout'])
            && UserEntitlement::where('user_id', $userId)->where('entitlement_type', 'course')->exists()) {
            return true;
        }
        $ids = $product->productables()->pluck('productable_id');
        if ($ids->isEmpty()) {
            return false;
        }

        return UserEntitlement::where('user_id', $userId)
            ->where('entitlement_type', $this->mapType($product->type))
            ->whereIn('entitlement_id', $ids)
            ->exists();
    }

    public function mapType(string $type): string
    {
        return match ($type) {
            'meeting' => 'meeting',
            'course_package' => 'course',
            'tryout' => 'tryout',
            'addon' => 'quiz',
        };
    }

    public function cartHasCoursePackage(Cart $cart, int $courseId): bool
    {
        return $cart->items()->whereHas('product', fn ($q) => $q->where('type', 'course_package')
            ->whereHas('productables', fn ($p) => $p->where('productable_type', \App\Models\Course::class)->where('productable_id', $courseId)))->exists();
    }

    protected function removeMeetingProductsOfCourse(Cart $cart, int $courseId): void
    {
        $meetingIds = Meeting::where('course_id', $courseId)->pluck('id');
        if ($meetingIds->isEmpty()) {
            return;
        }
        $productIds = Productable::where('productable_type', Meeting::class)->whereIn('productable_id', $meetingIds)->pluck('product_id')->unique();
        if ($productIds->isNotEmpty()) {
            $cart->items()->whereIn('product_id', $productIds)->delete();
        }
    }

    protected function repriceMeetings(Cart $cart): void
    {
        $prices = $this->pricing->meetingUnitPricesPerCourse($cart);
        $cart->load('items.product.productable.productable');
        foreach ($cart->items as $item) {
            if ($item->product->type !== 'meeting') {
                continue;
            }
            $courseId = $item->product->productable?->productable?->course_id ?? 0;
            if ($courseId && isset($prices[$courseId])) {
                $item->update(['price_snapshot' => $prices[$courseId]]);
            }
        }
    }
}
