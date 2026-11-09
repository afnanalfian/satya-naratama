<?php

namespace App\Livewire\Admin;

use App\Models\StudentRegistration;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Pendaftaran Siswa')]
class Registrations extends Component
{
    use WithPagination;

    #[Url] public string $status = 'all';
    #[Url] public string $search = '';

    public function updating($n) { if (in_array($n, ['status', 'search'])) $this->resetPage(); }

    public function render()
    {
        $s = trim($this->search);
        $registrations = StudentRegistration::with(['kecamatan', 'kelurahan'])
            ->when($this->status !== 'all', fn ($q) => $q->where('registration_status', $this->status))
            ->when($s, fn ($q) => $q->where(fn ($w) => $w->where('full_name', 'like', "%$s%")->orWhere('email', 'like', "%$s%")->orWhere('phone', 'like', "%$s%")->orWhere('school_origin', 'like', "%$s%")))
            ->orderByRaw("CASE WHEN registration_status = 'awaiting_verification' THEN 0 ELSE 1 END")->latest()
            ->paginate(20);

        return view('livewire.admin.registrations', [
            'registrations' => $registrations,
            'stats' => [
                'all' => StudentRegistration::count(),
                'awaiting_verification' => StudentRegistration::awaitingVerification()->count(),
                'pending_payment' => StudentRegistration::pendingPayment()->count(),
                'verified' => StudentRegistration::verified()->count(),
                'rejected' => StudentRegistration::rejected()->count(),
            ],
        ]);
    }
}
