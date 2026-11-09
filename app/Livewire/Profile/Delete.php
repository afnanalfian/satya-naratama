<?php

namespace App\Livewire\Profile;

use App\Models\AccountDeletionLog;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Hapus Akun')]
class Delete extends Component
{
    public string $reason_option = '';
    public string $reason_custom = '';

    public const REASONS = ['Sudah lulus / tidak membutuhkan lagi', 'Biaya terlalu mahal', 'Materi kurang sesuai', 'Pindah ke bimbel lain', 'Masalah teknis aplikasi', 'Lainnya'];

    public function deactivate()
    {
        $this->validate([
            'reason_option' => 'required|string',
            'reason_custom' => 'nullable|required_if:reason_option,Lainnya|string|max:1000',
        ], ['reason_custom.required_if' => 'Tuliskan alasanmu.'], ['reason_option' => 'alasan']);

        $user = auth()->user();
        AccountDeletionLog::create([
            'user_id' => $user->id,
            'reason_option' => $this->reason_option,
            'reason_custom' => $this->reason_option === 'Lainnya' ? $this->reason_custom : null,
            'deactivated_at' => now(),
            'deleted_at' => null,
        ]);
        $user->is_active = 0;
        $user->save();

        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        toast('info', 'Akun dinonaktifkan. Anda bisa mengaktifkan kembali dengan login dalam 10 hari.');

        return $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.profile.delete', ['reasons' => self::REASONS]);
    }
}
