<?php

namespace App\Livewire\Users;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use Livewire\Component;

class TentorForm extends Component
{
    public ?Teacher $teacher = null;
    public $user_id = '';
    public string $bio = '';
    public array $course_ids = [];
    public string $search = '';

    public function mount($id = null)
    {
        if ($id) {
            $this->teacher = Teacher::with('user', 'courses')->findOrFail($id);
            $this->bio = (string) $this->teacher->bio;
            $this->course_ids = $this->teacher->courses->pluck('id')->map(fn ($i) => (string) $i)->all();
        }
    }

    public function save()
    {
        $this->validate([
            'user_id' => $this->teacher ? 'nullable' : 'required|exists:users,id',
            'bio' => 'nullable|string|max:2000',
            'course_ids' => 'array',
        ], ['user_id.required' => 'Pilih akun yang akan dijadikan tentor.']);

        if ($this->teacher) {
            $this->teacher->update(['bio' => $this->bio ?: null]);
            $this->teacher->courses()->sync($this->course_ids);
            toast('success', 'Tentor berhasil diperbarui.');
            return $this->redirectRoute('tentor.show', $this->teacher->id);
        }

        $user = User::findOrFail($this->user_id);
        $user->syncRoles('tentor');
        $teacher = Teacher::firstOrCreate(['user_id' => $user->id], ['bio' => $this->bio ?: null]);
        $teacher->courses()->sync($this->course_ids);
        toast('success', 'Tentor berhasil ditambahkan.');
        return $this->redirectRoute('tentor.index');
    }

    public function render()
    {
        $s = trim($this->search);
        return view('livewire.users.tentor-form', [
            'users' => $this->teacher ? collect() : User::role('siswa')->where('is_active', true)
                ->when($s, fn ($q) => $q->where(fn ($w) => $w->where('name', 'like', "%$s%")->orWhere('email', 'like', "%$s%")))
                ->orderBy('name')->limit(30)->get(['id', 'name', 'email', 'avatar']),
            'courses' => Course::orderBy('name')->get(['id', 'name', 'type']),
            'selectedUser' => $this->user_id ? User::find($this->user_id) : null,
        ])->title($this->teacher ? 'Ubah Tentor' : 'Tambah Tentor');
    }
}
