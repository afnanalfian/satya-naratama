<?php

namespace App\Livewire\Shop;

use App\Livewire\Concerns\Toasts;
use App\Models\CartItem;
use App\Services\CartService;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Keranjang')]
class Cart extends Component
{
    use Toasts;

    public function updateQty(int $itemId, int $qty)
    {
        $item = CartItem::with('cart', 'product')->findOrFail($itemId);
        try {
            app(CartService::class)->updateQty(auth()->user(), $item, max(1, $qty));
        } catch (\Throwable $e) {
            return $this->notify('error', $e->getMessage());
        }
        $this->syncCount();
    }

    public function remove(int $itemId)
    {
        $item = CartItem::with('cart', 'product')->findOrFail($itemId);
        app(CartService::class)->remove(auth()->user(), $item);
        $this->syncCount();
        $this->notify('success', 'Item dihapus dari keranjang.');
    }

    public function addAddon()
    {
        try {
            app(CartService::class)->addAddonQuiz(auth()->user());
        } catch (\RuntimeException $e) {
            return $this->notify('error', $e->getMessage());
        }
        $this->syncCount();
        $this->notify('success', 'Addon Kuis ditambahkan.');
    }

    protected function syncCount(): void
    {
        $this->dispatch('cart-updated', count: (int) auth()->user()->cart?->items()->sum('qty'));
    }

    public function render()
    {
        $cart = app(CartService::class)->activeCart(auth()->id())
            ->load(['items.product.productable.productable', 'items.product.bonuses.tryout:id,title', 'items.product.bonuses.course:id,name']);
        $subtotal = $cart->items->sum(fn ($i) => $i->price_snapshot * $i->qty);
        $hasPackage = $cart->items->contains(fn ($i) => $i->product?->type === 'course_package');
        $hasAddon = $cart->items->contains(fn ($i) => $i->product?->type === 'addon');
        $canAddon = ! $hasPackage && ! $hasAddon && ! auth()->user()->hasEntitlement('quiz') && \App\Models\Product::where('type', 'addon')->where('is_active', true)->exists();

        return view('livewire.shop.cart', compact('cart', 'subtotal', 'canAddon'));
    }
}
