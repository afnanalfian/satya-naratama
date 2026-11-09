<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\Toasts;
use App\Models\Order;
use App\Services\OrderVerificationService;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Pesanan')]
class Orders extends Component
{
    use Toasts, WithPagination;

    #[Url] public string $q = '';
    #[Url] public string $status = '';
    public ?int $previewId = null;

    public function updating($n) { if (in_array($n, ['q', 'status'])) $this->resetPage(); }

    public function preview(int $id)
    {
        $this->previewId = $id;
        $this->dispatch('open-modal', 'order-preview');
    }

    public function approve(int $id)
    {
        try {
            app(OrderVerificationService::class)->approve(Order::findOrFail($id), auth()->user());
        } catch (\RuntimeException $e) {
            return $this->notify('error', $e->getMessage());
        }
        Cache::forget('menu.pending-orders');
        $this->dispatch('close-modal', 'order-preview');
        $this->notify('success', 'Pembayaran diverifikasi & akses diberikan.');
    }

    public function reject(int $id)
    {
        try {
            app(OrderVerificationService::class)->reject(Order::findOrFail($id));
        } catch (\RuntimeException $e) {
            return $this->notify('error', $e->getMessage());
        }
        Cache::forget('menu.pending-orders');
        $this->dispatch('close-modal', 'order-preview');
        $this->notify('info', 'Pembayaran ditolak.');
    }

    public function remove(int $id)
    {
        $o = Order::with('payment')->findOrFail($id);
        if ($o->status === 'verified' || $o->payment?->status === 'verified') {
            return $this->notify('error', 'Order yang sudah diverifikasi tidak dapat dihapus.');
        }
        $o->delete();
        $this->notify('warning', 'Order dihapus.');
    }

    public function render()
    {
        $q = trim($this->q);
        $orders = Order::with(['user:id,name,email,avatar', 'payment', 'discounts', 'items.product:id,name'])
            ->when($q, fn ($qr) => $qr->where(fn ($w) => $w->where('order_code', 'like', "%$q%")->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%$q%")->orWhere('email', 'like', "%$q%"))))
            ->when($this->status, fn ($qr) => $qr->where('status', $this->status))
            ->orderByRaw("CASE WHEN status = 'paid' THEN 0 ELSE 1 END")->latest()
            ->paginate(25);
        $counts = Order::selectRaw('status, COUNT(*) n')->groupBy('status')->pluck('n', 'status');

        return view('livewire.admin.orders', [
            'orders' => $orders, 'counts' => $counts,
            'previewOrder' => $this->previewId ? Order::with(['user', 'items.product', 'payment', 'discounts.discount'])->find($this->previewId) : null,
        ]);
    }
}
