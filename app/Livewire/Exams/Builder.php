<?php

namespace App\Livewire\Exams;

use App\Livewire\Concerns\Toasts;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionMaterial;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

/** Penyusun ujian: info ujian, daftar soal terpilih (urut/hapus) & pemilih soal dari bank soal. */
class Builder extends Component
{
    use Toasts, WithPagination;

    public Exam $exam;
    public string $title = '';
    public $duration_minutes = '';
    public string $exam_date = '';
    public array $passing = [];

    public ?int $categoryId = null;
    public ?int $materialId = null;
    public array $picked = [];
    public string $pickSearch = '';
    public int $perPage = 20;

    public function mount(Exam $exam)
    {
        $this->exam = $exam;
        $this->title = (string) $exam->title;
        $this->duration_minutes = $exam->duration_minutes ?? '';
        $this->exam_date = $exam->exam_date?->format('Y-m-d\TH:i') ?? '';
        $this->passing = $exam->passing_rules ?? [];
    }

    protected function editable(): bool
    {
        return $this->exam->status === 'inactive';
    }

    public function saveInfo()
    {
        if (! $this->editable()) return $this->notify('error', 'Ujian sedang berjalan/ditutup, tidak bisa diubah.');
        $this->validate([
            'title' => in_array($this->exam->type, ['quiz', 'tryout']) ? 'required|string|max:255' : 'nullable|string|max:255',
            'duration_minutes' => 'required|integer|min:1|max:600',
            'exam_date' => 'nullable|date',
            'passing.*' => 'nullable|numeric|min:0',
        ], [], ['duration_minutes' => 'durasi']);
        $data = ['title' => $this->title ?: null, 'duration_minutes' => (int) $this->duration_minutes, 'exam_date' => $this->exam_date ?: null];
        if ($this->exam->type === 'tryout' && $this->passing) {
            $data['passing_rules'] = array_map(fn ($v) => (int) $v, $this->passing);
        }
        $this->exam->update($data);
        $this->notify('success', 'Info ujian disimpan.');
    }

    public function selectCategory($id)
    {
        $this->categoryId = $id ? (int) $id : null;
        $this->materialId = null;
        $this->picked = [];
        $this->resetPage('pick');
    }

    public function selectMaterial($id)
    {
        $this->materialId = $id ? (int) $id : null;
        $this->picked = [];
        $this->resetPage('pick');
    }

    protected function availableQuery()
    {
        return Question::query()
            ->where('material_id', $this->materialId)
            ->whereIn('test_type', $this->exam->allowedQuestionTypes())
            ->whereNotIn('id', $this->exam->questions()->pluck('question_id'))
            ->when(trim($this->pickSearch), fn ($q) => $q->where('question_text', 'like', '%'.trim($this->pickSearch).'%'));
    }

    public function pickAll()
    {
        $this->picked = $this->availableQuery()->pluck('id')->map(fn ($i) => (string) $i)->all();
    }

    public function attach()
    {
        if (! $this->picked) return $this->notify('warning', 'Pilih soal terlebih dahulu.');
        $allowed = $this->exam->allowedQuestionTypes();
        $order = $this->exam->questions()->max('order') ?? 0;
        $added = 0;
        DB::transaction(function () use ($allowed, &$order, &$added) {
            foreach (Question::whereIn('id', $this->picked)->orderBy('id')->get() as $q) {
                if (! in_array($q->test_type, $allowed) || $this->exam->questions()->where('question_id', $q->id)->exists()) continue;
                $this->exam->questions()->create(['question_id' => $q->id, 'order' => ++$order]);
                $added++;
            }
        });
        $this->picked = [];
        $this->notify('success', "{$added} soal ditambahkan.");
    }

    public function detach(int $questionId)
    {
        if (! $this->editable()) return $this->notify('error', 'Ujian sudah aktif, soal tidak bisa dilepas.');
        DB::transaction(function () use ($questionId) {
            $eq = $this->exam->questions()->where('question_id', $questionId)->firstOrFail();
            $order = $eq->order;
            $eq->delete();
            $this->exam->questions()->where('order', '>', $order)->decrement('order');
        });
        $this->notify('success', 'Soal dilepas dari ujian.');
    }

    public function move(int $examQuestionId, $to)
    {
        if (! $this->editable()) return;
        $eq = ExamQuestion::where('exam_id', $this->exam->id)->findOrFail($examQuestionId);
        $from = $eq->order;
        $to = max(1, min((int) $to, $this->exam->questions()->count()));
        if ($from === $to) return;
        DB::transaction(function () use ($eq, $from, $to) {
            $from < $to
                ? $this->exam->questions()->whereBetween('order', [$from + 1, $to])->decrement('order')
                : $this->exam->questions()->whereBetween('order', [$to, $from - 1])->increment('order');
            $eq->update(['order' => $to]);
        });
    }

    public function activate()
    {
        if (! $this->exam->duration_minutes) return $this->notify('error', 'Isi durasi ujian terlebih dahulu.');
        if (! $this->exam->questions()->exists()) return $this->notify('error', 'Tambahkan minimal satu soal.');
        return redirect()->route('exams.show', $this->exam);
    }

    public function render()
    {
        $questions = $this->exam->questions()->with(['question.options', 'question.material:id,name'])->orderBy('order')->paginate($this->perPage, ['*'], 'q');
        $bySubtest = Question::whereIn('id', $this->exam->questions()->pluck('question_id'))->selectRaw('test_type, COUNT(*) n')->groupBy('test_type')->pluck('n', 'test_type');

        return view('livewire.exams.builder', [
            'questions' => $questions,
            'bySubtest' => $bySubtest,
            'categories' => QuestionCategory::orderBy('name')->get(['id', 'name']),
            'materials' => $this->categoryId ? QuestionMaterial::where('category_id', $this->categoryId)->withCount(['questions' => fn ($q) => $q->whereIn('test_type', $this->exam->allowedQuestionTypes())])->orderBy('name')->get() : collect(),
            'available' => $this->materialId ? $this->availableQuery()->withCount('examQuestions')->orderBy('id')->paginate(10, ['*'], 'pick') : null,
            'editable' => $this->editable(),
        ])->title('Susun Soal · '.$this->exam->context_title);
    }
}
