<?php

namespace App\Livewire\Bank;

use App\Livewire\Concerns\Toasts;
use App\Models\QuestionCategory;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Title('Bank Soal')]
class Categories extends Component
{
    use Toasts, WithFileUploads, WithPagination;

    #[Url] public string $q = '';
    public ?int $editingId = null;
    public string $name = '';
    public string $description = '';
    public $thumbnail;

    public function mount(?QuestionCategory $category = null)
    {
        if ($category?->exists) {
            $this->edit($category->id);
        } elseif (request()->routeIs('bank.category.create')) {
            $this->dispatch('open-modal', 'category');
        }
    }

    public function updatingQ() { $this->resetPage(); }

    public function new()
    {
        $this->reset('editingId', 'name', 'description', 'thumbnail');
        $this->resetValidation();
        $this->dispatch('open-modal', 'category');
    }

    public function edit(int $id)
    {
        $c = QuestionCategory::withTrashed()->findOrFail($id);
        $this->editingId = $c->id;
        $this->name = $c->name;
        $this->description = (string) $c->description;
        $this->thumbnail = null;
        $this->resetValidation();
        $this->dispatch('open-modal', 'category');
    }

    public function save()
    {
        $this->validate(['name' => 'required|max:255', 'thumbnail' => 'nullable|image|max:4096', 'description' => 'nullable|string|max:2000'], [], ['name' => 'nama']);
        $slug = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $this->name));
        $data = ['name' => $this->name, 'description' => $this->description ?: null];
        if ($this->thumbnail) {
            $data['thumbnail'] = $this->thumbnail->store('bank/category', 'public');
        }
        if ($this->editingId) {
            $c = QuestionCategory::findOrFail($this->editingId);
            if ($c->name !== $this->name) $data['slug'] = $slug;
            $c->update($data);
            $this->notify('success', 'Kategori berhasil diperbarui.');
        } else {
            QuestionCategory::create($data + ['slug' => $slug]);
            $this->notify('success', 'Kategori berhasil dibuat.');
        }
        $this->dispatch('close-modal', 'category');
        $this->reset('editingId', 'name', 'description', 'thumbnail');
    }

    public function remove(int $id)
    {
        $c = QuestionCategory::findOrFail($id);
        if ($c->materials()->exists()) {
            return $this->notify('error', 'Kategori tidak bisa dihapus, masih ada materi.');
        }
        $c->delete();
        $this->notify('warning', 'Kategori telah dihapus.');
    }

    public function render()
    {
        $categories = QuestionCategory::withCount('materials')
            ->when(trim($this->q), fn ($q) => $q->where('name', 'like', '%'.trim($this->q).'%'))
            ->latest()->paginate(12);
        $qCounts = \App\Models\Question::query()->join('question_materials', 'question_materials.id', '=', 'questions.material_id')
            ->whereIn('question_materials.category_id', $categories->pluck('id'))
            ->selectRaw('question_materials.category_id as cid, COUNT(*) as n')->groupBy('cid')->pluck('n', 'cid');

        return view('livewire.bank.categories', compact('categories', 'qCounts'));
    }
}
