<?php

namespace App\Livewire\Shop\Concerns;

use App\Models\Product;
use App\Services\CartService;

trait AddsToCart
{
    public function addToCart(int $productId)
    {
        $product = Product::where('is_active', true)->findOrFail($productId);
        try {
            $cart = app(CartService::class)->add(auth()->user(), $product);
        } catch (\RuntimeException $e) {
            return $this->notify('error', $e->getMessage());
        }
        $this->dispatch('cart-updated', count: (int) $cart->items()->sum('qty'));
        $this->notify('success', "{$product->name} ditambahkan ke keranjang 🛒");
    }

    protected function cartState(): array
    {
        $cart = auth()->user()->cart;
        if (! $cart) {
            return [[], [], []];
        }
        $items = $cart->items()->with('product.productable.productable', 'product.bonuses')->get();
        $productIds = $items->pluck('product_id')->all();
        $courseIds = $items->filter(fn ($i) => $i->product?->type === 'course_package')->map(fn ($i) => $i->product->productable?->productable?->id)->filter()->unique()->values()->all();
        $bonusTryouts = $items->filter(fn ($i) => $i->product?->type === 'course_package')->flatMap(fn ($i) => $i->product->bonuses->where('bonus_type', 'tryout')->pluck('bonus_id'))->filter()->unique()->values()->all();

        return [$productIds, $courseIds, $bonusTryouts];
    }
}
