<?php

namespace App\Livewire\Users;

use App\Livewire\Concerns\Toasts;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Data Siswa')]
class SiswaIndex extends Component
{
    use Toasts, WithPagination;

    #[Url] public string $q = '';
    #[Url] public string $status = '';
    #[Url] public string $view = 'grid';
    public int $perPage = 24;

    public function updating($name)
    {
        if (in_array($name, ['q', 'status', 'perPage'])) {
            $this->resetPage();
        }
    }

    public function toggle(int $id)
    {
        abort_unless(auth()->user()->hasAnyRole(['admin', 'tentor']), 403);
        $user = User::role('siswa')->findOrFail($id);
        $user->is_active = ! $user->is_active;
        $user->save();
        $this->notify($user->is_active ? 'success' : 'warning', "Akun {$user->name} ".($user->is_active ? 'diaktifkan' : 'dinonaktifkan').'.');
    }

    public function render()
    {
        $q = trim($this->q);
        $base = User::role('siswa');
        $siswa = User::role('siswa')
            ->with(['province:id,name', 'regency:id,name', 'studentRegistration:id,user_id,full_name,class,school_origin,gender'])
            ->when($q, fn ($qr) => $qr->where(fn ($s) => $s->where('name', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%")
                ->orWhere('phone', 'like', "%{$q}%")
                ->orWhereHas('province', fn ($p) => $p->where('name', 'like', "%{$q}%"))
                ->orWhereHas('regency', fn ($r) => $r->where('name', 'like', "%{$q}%"))
                ->orWhereHas('studentRegistration', fn ($r) => $r->where('full_name', 'like', "%{$q}%")->orWhere('school_origin', 'like', "%{$q}%"))))
            ->when($this->status === 'active', fn ($qr) => $qr->where('is_active', true))
            ->when($this->status === 'inactive', fn ($qr) => $qr->where('is_active', false))
            ->orderBy('name')
            ->paginate(in_array($this->perPage, [12, 24, 48, 96]) ? $this->perPage : 24);

        return view('livewire.users.siswa-index', [
            'siswa' => $siswa,
            'counts' => ['all' => (clone $base)->count(), 'active' => (clone $base)->where('is_active', true)->count()],
        ]);
    }
}
