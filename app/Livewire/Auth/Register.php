<?php

namespace App\Livewire\Auth;

use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.auth')]
#[Title('Daftar Akun')]
class Register extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';
    public $province_id = '';
    public $regency_id = '';
    public $avatar;

    public function updatedProvinceId()
    {
        $this->regency_id = '';
    }

    public function register()
    {
        $data = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
            'province_id' => 'required|exists:provinces,id',
            'regency_id' => 'required|exists:regencies,id',
            'avatar' => 'nullable|image|max:2048',
        ], [], ['name' => 'nama', 'province_id' => 'provinsi', 'regency_id' => 'kabupaten/kota', 'phone' => 'nomor HP']);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?: null,
            'province_id' => $data['province_id'],
            'regency_id' => $data['regency_id'],
            'avatar' => $this->avatar ? $this->avatar->store('avatars', 'public') : 'img/user.png',
        ]);
        $user->assignRole('siswa');
        $user->sendEmailVerificationNotification();
        $user->update(['last_verification_sent_at' => now()]);

        auth()->login($user, true);
        session()->regenerate();
        toast('success', 'Akun berhasil dibuat. Silakan verifikasi email Anda.');

        return $this->redirectRoute('verification.notice');
    }

    public function render()
    {
        return view('livewire.auth.register', [
            'provinces' => Province::orderBy('name')->get(['id', 'name']),
            'regencies' => $this->province_id ? Regency::where('province_id', $this->province_id)->orderBy('name')->get(['id', 'name']) : collect(),
        ]);
    }
}
