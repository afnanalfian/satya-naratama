<?php

namespace App\Livewire\Daftar;

use App\Models\StudentRegistration;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.public')]
#[Title('Cek Status Pendaftaran')]
class CheckStatus extends Component
{
    public string $email = '';
    public ?int $registrationId = null;

    public function check()
    {
        $this->validate(['email' => 'required|email']);
        $reg = StudentRegistration::where('email', $this->email)->first();
        if (! $reg) {
            $this->registrationId = null;
            $this->addError('email', 'Email tidak ditemukan. Silakan cek kembali atau daftar sekarang.');
            return;
        }
        $this->registrationId = $reg->id;
    }

    public function resetForm()
    {
        $this->reset('email', 'registrationId');
    }

    public function render()
    {
        return view('livewire.daftar.check-status', [
            'registration' => $this->registrationId ? StudentRegistration::with(['kecamatan', 'kelurahan', 'invoice'])->find($this->registrationId) : null,
        ]);
    }
}
