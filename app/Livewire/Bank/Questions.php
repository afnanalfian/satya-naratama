<?php

namespace App\Livewire\Bank;

use App\Livewire\Concerns\Toasts;
use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Questions extends Component
{
    use Toasts, WithPagination;

    public QuestionMaterial $material;
    #[Url] public string $q = '';
    #[Url] public string $type = '';
    #[Url] public string $test_type = '';
    public int $perPage = 10;
    public ?int $openId = null;

    public function mount(QuestionMaterial $material)
    {
        $this->material = $material;
    }

    public function updating($n) { if (in_array($n, ['q', 'type', 'test_type', 'perPage'])) $this->resetPage(); }

    public function remove(int $id)
    {
        $question = Question::where('material_id', $this->material->id)->findOrFail($id);
        if ($question->examQuestions()->exists()) {
            return $this->notify('error', 'Soal sedang dipakai di ujian. Lepaskan dari ujian terlebih dahulu.');
        }
        DB::transaction(function () use ($question) {
            if ($question->image) Storage::disk('public')->delete($question->image);
            $question->subItems()->each(fn ($s) => $s->answers()->delete());
            $question->options()->delete();
            $question->subItems()->delete();
            $question->delete();
        });
        $this->notify('warning', 'Soal dihapus.');
    }

    public function render()
    {
        $questions = Question::with(['options', 'subItems.answers'])
            ->where('material_id', $this->material->id)
            ->when($this->type, fn ($q) => $q->where('type', $this->type))
            ->when($this->test_type, fn ($q) => $q->where('test_type', $this->test_type))
            ->when(trim($this->q), fn ($q) => $q->where('question_text', 'like', '%'.trim($this->q).'%'))
            ->withCount('examQuestions')
            ->orderBy('id')
            ->paginate(in_array($this->perPage, [10, 20, 50, 100]) ? $this->perPage : 10);

        return view('livewire.bank.questions', compact('questions'))->title('Soal · '.$this->material->name);
    }
}
