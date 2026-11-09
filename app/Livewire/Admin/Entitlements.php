<?php

namespace App\Livewire\Admin;

use App\Livewire\Concerns\Toasts;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Meeting;
use App\Models\User;
use App\Models\UserEntitlement;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Hak Akses Siswa')]
class Entitlements extends Component
{
    use Toasts, WithPagination;

    #[Url] public string $q = '';
    public ?int $grantUser = null;
    public string $grantType = 'course';
    public $grantId = '';

    public function updatingQ() { $this->resetPage(); }

    public function openGrant(int $userId)
    {
        $this->grantUser = $userId;
        $this->reset('grantId');
        $this->dispatch('open-modal', 'grant');
    }

    public function grant()
    {
        $this->validate(['grantType' => 'required|in:course,meeting,tryout,quiz', 'grantId' => $this->grantType === 'quiz' ? 'nullable' : 'required|integer']);
        UserEntitlement::firstOrCreate(
            ['user_id' => $this->grantUser, 'entitlement_type' => $this->grantType, 'entitlement_id' => $this->grantType === 'quiz' ? null : (int) $this->grantId],
            ['source' => 'bonus']
        );
        $this->dispatch('close-modal', 'grant');
        $this->notify('success', 'Akses diberikan.');
    }

    public function revoke(int $id)
    {
        UserEntitlement::findOrFail($id)->delete();
        $this->notify('warning', 'Akses dicabut.');
    }

    public function render()
    {
        $q = trim($this->q);
        $users = User::role('siswa')
            ->when($q, fn ($qr) => $qr->where(fn ($w) => $w->where('name', 'like', "%$q%")->orWhere('email', 'like', "%$q%")))
            ->with(['entitlements' => fn ($e) => $e->orderBy('entitlement_type')->orderBy('entitlement_id')])
            ->orderBy('name')->paginate(15);

        $ids = $users->getCollection()->flatMap->entitlements->groupBy('entitlement_type')->map(fn ($g) => $g->pluck('entitlement_id')->filter()->unique());
        $names = [
            'course' => Course::whereIn('id', $ids['course'] ?? [])->pluck('name', 'id'),
            'meeting' => Meeting::whereIn('id', $ids['meeting'] ?? [])->pluck('title', 'id'),
            'tryout' => Exam::whereIn('id', $ids['tryout'] ?? [])->pluck('title', 'id'),
        ];

        return view('livewire.admin.entitlements', [
            'users' => $users, 'names' => $names,
            'options' => [
                'course' => Course::orderBy('name')->pluck('name', 'id'),
                'meeting' => Meeting::orderByDesc('scheduled_at')->limit(300)->pluck('title', 'id'),
                'tryout' => Exam::where('type', 'tryout')->orderBy('title')->pluck('title', 'id'),
            ],
        ]);
    }
}
