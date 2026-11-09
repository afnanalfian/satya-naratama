<?php

namespace App\Livewire\Auth;

use App\Models\AccountDeletionLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.auth')]
#[Title('Masuk')]
class Login extends Component
{
    public string $email = '';
    public string $password = '';

    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [], ['password' => 'password']);

        $key = 'login:'.Str::lower($this->email).'|'.request()->ip();
        if (RateLimiter::tooManyAttempts($key, 8)) {
            $this->addError('email', 'Terlalu banyak percobaan. Coba lagi dalam '.RateLimiter::availableIn($key).' detik.');
            return;
        }

        // Selalu "ingat saya": sesi tidak berakhir sampai pengguna menekan Keluar.
        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], true)) {
            RateLimiter::hit($key, 60);
            $this->addError('email', 'Email atau password salah.');
            return;
        }

        RateLimiter::clear($key);
        session()->regenerate();

        $user = Auth::user();
        if ($user && ! $user->is_active) {
            $user->is_active = 1;
            $user->save();
            AccountDeletionLog::where('user_id', $user->id)->whereNull('deleted_at')->update(['deleted_at' => now()]);
            toast('success', 'Selamat datang kembali! Akun Anda telah diaktifkan lagi.');
        }

        return $this->redirectIntended(route('dashboard.redirect'));
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
