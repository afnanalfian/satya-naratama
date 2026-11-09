<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Kelas')]
class Index extends Component
{
    use WithPagination;

    #[Url] public string $q = '';
    #[Url] public string $type = '';

    public function updating($n) { if (in_array($n, ['q', 'type'])) $this->resetPage(); }

    public function render()
    {
        $user = auth()->user();
        $isTentor = $user->hasRole('tentor');
        $type = in_array($this->type, ['akademik', 'jasmani'], true) ? $this->type : null;
        $owned = $user->hasRole('siswa') ? $user->ownedCourseIds() : [];

        $courses = Course::with('teachers.user:id,name,avatar')
            ->withCount('meetings')
            ->withCount(['meetings as live_count' => fn ($q) => $q->where('status', 'live')])
            ->when(trim($this->q), fn ($qr) => $qr->where('name', 'like', '%'.trim($this->q).'%'))
            ->ofType($type)
            ->when($isTentor, fn ($q) => $q->whereHas('teachers', fn ($t) => $t->where('user_id', $user->id)))
            ->orderBy('name')
            ->paginate(12);

        return view('livewire.courses.index', compact('courses', 'isTentor', 'owned'));
    }
}
