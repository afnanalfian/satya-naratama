<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\Toasts;
use App\Models\PaymentSetting;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Pengaturan Pembayaran')]
class PaymentSettings extends Component
{
    use Toasts, WithFileUploads;

    public $qris;
    public string $instruction = '';
    public string $method = 'manual_qris';

    public function mount()
    {
        $s = PaymentSetting::pluck('value', 'key');
        $this->instruction = (string) ($s['payment_instruction'] ?? '');
        $this->method = (string) ($s['active_payment_method'] ?? 'manual_qris');
    }

    public function save()
    {
        $this->validate(['qris' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096', 'instruction' => 'nullable|string|max:5000', 'method' => 'required|in:manual_qris,midtrans']);
        if ($this->qris) {
            PaymentSetting::updateOrCreate(['key' => 'qris_image'], ['value' => $this->qris->store('payment/qris', 'public')]);
            $this->qris = null;
        }
        PaymentSetting::updateOrCreate(['key' => 'payment_instruction'], ['value' => $this->instruction]);
        PaymentSetting::updateOrCreate(['key' => 'active_payment_method'], ['value' => $this->method]);
        $this->notify('success', 'Pengaturan pembayaran berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.admin.payment-settings', ['current' => PaymentSetting::where('key', 'qris_image')->value('value')]);
    }
}
