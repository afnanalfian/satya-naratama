<?php

namespace App\Livewire\Bank;

use App\Livewire\Concerns\Toasts;
use App\Models\QuestionCategory;
use App\Models\QuestionMaterial;
use Livewire\Component;
use Livewire\WithPagination;

class Materials extends Component
{
    use Toasts, WithPagination;

    public QuestionCategory $category;
    public ?int $editingId = null;
    public string $name = '';
    public string $q = '';

    public function mount(?QuestionCategory $category = null, ?QuestionMaterial $material = null)
    {
        if ($material?->exists) {
            $this->category = $material->category()->withTrashed()->firstOrFail();
            $this->edit($material->id);
        } else {
            $this->category = $category;
            if (request()->routeIs('bank.category.materials.create')) {
                $this->dispatch('open-modal', 'material');
            }
        }
    }

    public function new()
    {
        $this->reset('editingId', 'name');
        $this->resetValidation();
        $this->dispatch('open-modal', 'material');
    }

    public function edit(int $id)
    {
        $m = $this->category->materials()->findOrFail($id);
        $this->editingId = $m->id;
        $this->name = $m->name;
        $this->dispatch('open-modal', 'material');
    }

    public function save()
    {
        $this->validate(['name' => 'required|max:255'], [], ['name' => 'nama materi']);
        $slug = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $this->name));
        if ($this->editingId) {
            $m = $this->category->materials()->findOrFail($this->editingId);
            $m->update(['name' => $this->name] + ($m->name !== $this->name ? ['slug' => $slug] : []));
            $this->notify('success', 'Materi berhasil diperbarui.');
        } else {
            QuestionMaterial::create(['category_id' => $this->category->id, 'name' => $this->name, 'slug' => $slug]);
            $this->notify('success', 'Materi berhasil ditambahkan.');
        }
        $this->dispatch('close-modal', 'material');
        $this->reset('editingId', 'name');
    }

    public function remove(int $id)
    {
        $m = $this->category->materials()->findOrFail($id);
        if ($m->questions()->exists()) {
            return $this->notify('error', 'Materi tidak bisa dihapus, masih ada soal.');
        }
        $m->delete();
        $this->notify('warning', 'Materi berhasil dihapus.');
    }

    public function render()
    {
        $materials = $this->category->materials()->withCount('questions')
            ->when(trim($this->q), fn ($q) => $q->where('name', 'like', '%'.trim($this->q).'%'))
            ->orderBy('name')->paginate(20);

        return view('livewire.bank.materials', compact('materials'))->title('Materi · '.$this->category->name);
    }
}
