<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public ?Course $course = null;
    public string $name = '', $slug = '', $description = '', $type = 'akademik';
    public bool $is_free = false;
    public bool $slugTouched = false;
    public $thumbnail;

    public function mount($slug = null)
    {
        if ($slug) {
            $this->course = Course::where('slug', $slug)->firstOrFail();
            $this->fill($this->course->only('name', 'slug', 'description', 'type'));
            $this->is_free = (bool) $this->course->is_free;
            $this->slugTouched = true;
        }
    }

    public function updatedName($v)
    {
        if (! $this->slugTouched) {
            $this->slug = Str::slug($v);
        }
    }

    public function updatedSlug()
    {
        $this->slugTouched = true;
        $this->slug = Str::slug($this->slug);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:courses,slug'.($this->course ? ','.$this->course->id : ''),
            'description' => 'required|max:1000',
            'thumbnail' => 'nullable|image|max:4096',
            'type' => 'required|in:akademik,jasmani',
        ], [], ['name' => 'nama kelas', 'description' => 'deskripsi']);

        $data = ['name' => $this->name, 'slug' => $this->slug, 'description' => $this->description, 'type' => $this->type, 'is_free' => $this->is_free];
        if ($this->thumbnail) {
            if ($this->course?->thumbnail) {
                Storage::disk('public')->delete($this->course->thumbnail);
            }
            $data['thumbnail'] = $this->thumbnail->store('courses', 'public');
        }

        if ($this->course) {
            $this->course->update($data);
            toast('info', 'Kelas berhasil diperbarui.');
        } else {
            Course::create($data);
            toast('success', 'Kelas berhasil dibuat.');
        }

        return $this->redirectRoute('course.index');
    }

    public function render()
    {
        return view('livewire.courses.form')->title($this->course ? 'Ubah Kelas' : 'Kelas Baru');
    }
}
