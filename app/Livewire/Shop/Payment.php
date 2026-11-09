<?php

namespace App\Livewire\Shop;

use App\Models\Order;
use App\Models\Payment as PaymentModel;
use App\Models\PaymentSetting;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Pembayaran')]
class Payment extends Component
{
    use WithFileUploads;

    public Order $order;
    public $proof;

    public function mount(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);
        if ($order->status !== 'pending') {
            return $this->redirectRoute('checkout.waiting', $order);
        }
        $this->order = $order->load('items.product', 'discounts.discount');
    }

    public function submitProof()
    {
        $this->validate(['proof' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096'], ['proof.required' => 'Unggah bukti pembayaran terlebih dahulu.'], ['proof' => 'bukti pembayaran']);
        $order = $this->order->fresh();
        abort_if($order->status !== 'pending', 403);

        $path = $this->proof->store('payments/proofs', 'public');
        PaymentModel::where('order_id', $order->id)->firstOrFail()->update(['proof_image' => $path, 'paid_at' => now(), 'status' => 'paid']);
        $order->update(['status' => 'paid']);

        foreach (User::role('admin')->get() as $admin) {
            notify_user($admin, "Order #{$order->id} baru masuk dan menunggu konfirmasi pembayaran.", true, route('orders.show', $order));
        }
        toast('success', 'Bukti pembayaran berhasil diunggah.');

        return $this->redirectRoute('checkout.waiting', $order);
    }

    public function render()
    {
        return view('livewire.shop.payment', [
            'qrisImage' => PaymentSetting::where('key', 'qris_image')->value('value'),
            'instruction' => PaymentSetting::where('key', 'payment_instruction')->value('value'),
        ]);
    }
}
