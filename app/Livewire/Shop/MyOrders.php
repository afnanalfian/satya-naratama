<?php

namespace App\Livewire\Shop;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Pesanan Saya')]
class MyOrders extends Component
{
    use WithPagination;

    #[Url] public string $status = '';

    public function updatingStatus() { $this->resetPage(); }

    public function render()
    {
        return view('livewire.shop.my-orders', [
            'orders' => Order::with(['payment', 'items.product', 'discounts'])->where('user_id', auth()->id())
                ->when($this->status, fn ($q) => $q->where('status', $this->status))
                ->latest()->paginate(10),
        ]);
    }
}
