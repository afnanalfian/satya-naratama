<?php

namespace App\Livewire\Daftar;

use App\Models\StudentRegistration;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.public')]
#[Title('Pembayaran Pendaftaran')]
class Payment extends Component
{
    use WithFileUploads;

    public StudentRegistration $registration;
    public $payment_proof;
    public string $payment_note = '';

    public function mount($registrationId)
    {
        $this->registration = StudentRegistration::with(['kecamatan', 'kelurahan', 'invoice'])->findOrFail($registrationId);

        if ($this->registration->isVerified()) {
            toast('success', 'Pendaftaran Anda sudah diverifikasi. Silakan login.');
            return $this->redirectRoute('daftar.status.form');
        }
        if ($this->registration->isAwaitingVerification()) {
            toast('info', 'Pembayaran Anda sedang diverifikasi oleh admin.');
            return $this->redirectRoute('daftar.status.form');
        }
        if ($this->registration->registration_status !== 'pending_payment') {
            toast('error', 'Status pendaftaran tidak valid untuk pembayaran.');
            return $this->redirectRoute('daftar.status.form');
        }
    }

    public function submitProof()
    {
        $this->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'payment_note' => 'nullable|string|max:255',
        ], [
            'payment_proof.required' => 'Bukti pembayaran wajib diunggah.',
            'payment_proof.image' => 'File harus berupa gambar (JPG/PNG).',
            'payment_proof.max' => 'Ukuran file maksimal 5MB.',
        ]);

        $reg = $this->registration->fresh();
        if (! $reg->canUploadProof()) {
            toast('error', 'Status pendaftaran tidak valid untuk upload bukti.');
            return $this->redirectRoute('daftar.status.form');
        }

        $path = $this->payment_proof->store('payment_proofs', 'public');
        $reg->update(['payment_proof' => $path, 'payment_status' => 'paid', 'registration_status' => 'awaiting_verification']);
        $reg->invoice?->markAsPaid($path);

        foreach (User::role('admin')->get() as $admin) {
            notify_user($admin, "📝 Pendaftaran baru dari {$reg->full_name} menunggu verifikasi pembayaran.", true, route('admin.registrations.show', $reg->id));
        }

        toast('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');

        return $this->redirectRoute('daftar.success', $reg->id);
    }

    public function render()
    {
        return view('livewire.daftar.payment', ['bank' => config('satya.bank')]);
    }
}
