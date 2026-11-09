<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Ganti Password')]
class Password extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function save()
    {
        $this->validate(['current_password' => 'required', 'password' => 'required|min:6|confirmed'], [], ['current_password' => 'password saat ini']);
        $user = auth()->user();
        if (! Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Password saat ini salah.');
            return;
        }
        $user->update(['password' => Hash::make($this->password)]);
        toast('success', 'Password berhasil diubah.');
        return $this->redirectRoute('profile.show');
    }

    public function render()
    {
        return view('livewire.profile.password');
    }
}
