<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Exam;
use App\Models\Productable;
use App\Models\Meeting;
use App\Models\UserEntitlement;
use App\Services\PricingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Tampilkan cart aktif user
     */
    public function show(Request $request)
    {
        $cart = $this->getActiveCart($request->user()->id);
        $cart->load('items.product');

        $subtotal = 0;

        foreach ($cart->items as $item) {
            $subtotal += ($item->price_snapshot * $item->qty);
        }

        return view('purchase.cart.show', compact(
            'cart',
            'subtotal'
        ));
    }
    protected function cartHasCourse($cart): bool
    {
        return $cart->items()
            ->whereHas('product', fn ($q) =>
                $q->where('type', 'course_package')
            )
            ->exists();
    }

    /**
     * Add product ke cart - FIXED VERSION
     */
    public function add(Request $request, Product $product, \App\Services\CartService $carts)
    {
        try {
            $cart = $carts->add($request->user(), $product, (int) $request->input('qty', 1));
        } catch (\RuntimeException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json(['cart_count' => $cart->items()->sum('qty')]);
    }

    public function updateQty(Request $request, CartItem $cartItem, \App\Services\CartService $carts)
    {
        $qty = (int) $request->validate(['qty' => 'required|integer|min:1'])['qty'];
        $carts->updateQty($request->user(), $cartItem, $qty);

        return back()->with('success', 'Jumlah item diperbarui');
    }

    public function remove(Request $request, CartItem $cartItem)
    {
        $this->authorizeCartItem($request->user()->id, $cartItem);

        DB::transaction(function () use ($cartItem) {
            $cartItem->delete();
        });

        return back()->with('success', 'Item dihapus dari cart');
    }



    /* =======================================================
       INTERNAL HELPERS
       ======================================================= */

    protected function getActiveCart(int $userId): Cart
    {
        return Cart::firstOrCreate([
            'user_id' => $userId,
            'status'  => 'active',
        ]);
    }


    protected function alreadyOwned(int $userId, Product $product): bool
    {
        // 1. Jika user sudah punya FULL COURSE
        if (in_array($product->type, ['meeting', 'tryout'])) {
            $hasCourse = UserEntitlement::where('user_id', $userId)
                ->where('entitlement_type', 'course')
                ->exists();

            if ($hasCourse) {
                return true;
            }
        }

        // 2. Cek entitlement normal
        $ids = $product->productables()->pluck('productable_id');

        if ($ids->isEmpty()) {
            return false;
        }

        return UserEntitlement::where('user_id', $userId)
            ->where('entitlement_type', $this->mapType($product->type))
            ->whereIn('entitlement_id', $ids)
            ->exists();
    }


    protected function mapType(string $type): string
    {
        return match ($type) {
            'meeting'        => 'meeting',
            'course_package' => 'course',
            'tryout'         => 'tryout',
            'addon'          => 'quiz',
        };
    }


    protected function authorizeCartItem(int $userId, CartItem $cartItem): void
    {
        abort_if(
            $cartItem->cart->user_id !== $userId,
            403
        );
    }
    protected function userHasQuiz(int $userId): bool
    {
        return UserEntitlement::where('user_id', $userId)
            ->where('entitlement_type', 'quiz')
            ->exists();
    }
    protected function cartHasAddonQuiz(Cart $cart): bool
    {
        return $cart->items()
            ->whereHas('product', fn ($q) =>
                $q->where('type', 'addon')
            )
            ->exists();
    }
    public function addAddonQuiz(Request $request, \App\Services\CartService $carts)
    {
        try {
            $carts->addAddonQuiz($request->user());
        } catch (\RuntimeException $e) {
            return back()->withErrors(['addon' => $e->getMessage()]);
        }
        toast('success', 'Addon Quiz berhasil ditambahkan.');

        return back();
    }
}
