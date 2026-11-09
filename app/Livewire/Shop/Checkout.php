<?php

namespace App\Livewire\Shop;

use App\Livewire\Concerns\Toasts;
use App\Models\Cart;
use App\Models\Discount;
use App\Services\CheckoutService;
use App\Services\DiscountService;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Checkout')]
class Checkout extends Component
{
    use Toasts;

    public ?int $discountId = null;
    public string $voucher = '';
    public bool $voucherApplied = false;
    public ?array $preview = null;
    public ?string $previewError = null;

    public function mount()
    {
        $cart = $this->cart();
        if (! $cart || $cart->items->isEmpty()) {
            toast('warning', 'Keranjang masih kosong.');
            return $this->redirectRoute('cart.show');
        }
    }

    protected function cart(): ?Cart
    {
        return Cart::where('user_id', auth()->id())->where('status', 'active')
            ->with(['items.product.bonuses.tryout', 'items.product.bonuses.course', 'items.product.productable'])->first();
    }

    protected function subtotal(): float
    {
        return (float) $this->cart()?->items->sum(fn ($i) => $i->price_snapshot * $i->qty);
    }

    public function pickDiscount(?int $id)
    {
        $this->discountId = $this->discountId === $id ? null : $id;
        $this->voucher = '';
        $this->voucherApplied = false;
        $this->runPreview();
    }

    public function applyVoucher()
    {
        $this->validate(['voucher' => 'required|string|max:50'], [], ['voucher' => 'kode voucher']);
        $this->discountId = null;
        $this->voucherApplied = true;
        $this->runPreview();
        if ($this->previewError) $this->voucherApplied = false;
    }

    public function clearVoucher()
    {
        $this->reset('voucher', 'voucherApplied', 'preview', 'previewError');
    }

    protected function runPreview(): void
    {
        $this->previewError = null;
        try {
            $this->preview = app(DiscountService::class)->preview(
                voucherCode: $this->voucherApplied ? trim($this->voucher) : null,
                discountId: $this->discountId,
                subtotal: $this->subtotal(),
                userId: auth()->id(),
            );
        } catch (\Exception $e) {
            $this->preview = null;
            $this->previewError = $e->getMessage();
            if (! $this->voucherApplied) $this->discountId = null;
        }
    }

    public function process()
    {
        $cart = Cart::where('user_id', auth()->id())->where('status', 'active')->with('items')->firstOrFail();
        $discount = null;
        if ($this->voucherApplied && $this->voucher) {
            $discount = Discount::where('code', trim($this->voucher))->first();
        } elseif ($this->discountId) {
            $discount = Discount::find($this->discountId);
        }

        try {
            $order = app(CheckoutService::class)->checkout(cart: $cart, userId: auth()->id(), discount: $discount);
        } catch (\Exception $e) {
            return $this->notify('error', $e->getMessage());
        }
        $this->dispatch('cart-updated', count: 0);

        return $this->redirectRoute('checkout.payment', $order);
    }

    public function render()
    {
        $cart = $this->cart();
        $available = Discount::whereNull('code')->where('is_active', true)
            ->where(fn ($q) => $q->whereNull('starts_at')->orWhere('starts_at', '<=', now()))
            ->where(fn ($q) => $q->whereNull('ends_at')->orWhere('ends_at', '>=', now()))
            ->latest()->get();

        return view('livewire.shop.checkout', ['cart' => $cart, 'subtotal' => $this->subtotal(), 'availableDiscounts' => $available]);
    }
}
