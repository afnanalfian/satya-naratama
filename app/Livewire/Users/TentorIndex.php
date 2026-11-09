<?php

namespace App\Livewire\Users;

use App\Livewire\Concerns\Toasts;
use App\Models\Teacher;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Tentor')]
class TentorIndex extends Component
{
    use Toasts, WithPagination;

    #[Url] public string $q = '';

    public function updatingQ() { $this->resetPage(); }

    public function toggle(int $id)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);
        $u = Teacher::findOrFail($id)->user;
        $u->is_active = ! $u->is_active;
        $u->save();
        $this->notify('success', 'Status tentor berhasil diubah.');
    }

    public function remove(int $id)
    {
        abort_unless(auth()->user()->hasRole('admin'), 403);
        $t = Teacher::findOrFail($id);
        $t->courses()->detach();
        $t->user?->syncRoles('siswa');
        $t->delete();
        $this->notify('success', 'Tentor dihapus dan dikembalikan menjadi siswa.');
    }

    public function render()
    {
        $q = trim($this->q);
        $isAdmin = auth()->user()->hasRole('admin');
        $tentor = Teacher::with('user', 'courses:id,name,type')
            ->whereHas('user', fn ($u) => $isAdmin ? $u : $u->where('is_active', true))
            ->when($q, fn ($qr) => $qr->where(fn ($w) => $w->whereHas('user', fn ($u) => $u->where('name', 'like', "%{$q}%"))
                ->orWhereHas('courses', fn ($c) => $c->where('name', 'like', "%{$q}%"))))
            ->orderByDesc('id')
            ->paginate(12);

        return view('livewire.users.tentor-index', compact('tentor', 'isAdmin'));
    }
}
