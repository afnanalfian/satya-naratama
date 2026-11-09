<?php

namespace App\Livewire\Monitor;

use App\Livewire\Concerns\Toasts;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Link Pantauan Orang Tua')]
class ParentLinks extends Component
{
    use Toasts, WithPagination;

    #[Url(as: 'q')]
    public string $q = '';

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function regenerate(int $id)
    {
        $user = User::findOrFail($id);
        abort_unless($user->hasRole('siswa'), 404);
        $user->parent_token = User::newParentToken();
        $user->saveQuietly();
        $this->notify('success', "Link pantauan {$user->name} diperbarui. Link lama tidak bisa diakses lagi.");
    }

    public function render()
    {
        $q = trim($this->q);
        $students = User::role('siswa')
            ->with('studentRegistration:id,user_id,full_name,parent_name,parent_phone,class')
            ->when($q, fn ($qr) => $qr->where(fn ($s) => $s->where('name', 'like', "%{$q}%")
                ->orWhereHas('studentRegistration', fn ($r) => $r->where('parent_name', 'like', "%{$q}%"))))
            ->orderByDesc('is_active')->orderBy('name')
            ->paginate(25);
        $students->getCollection()->each->ensureTokens();

        return view('livewire.monitor.parent-links', compact('students'));
    }
}
