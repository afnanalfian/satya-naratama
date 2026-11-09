<?php

namespace App\Livewire\Exams;

use App\Livewire\Concerns\Toasts;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use Toasts, WithPagination;

    public string $type = 'tryout';
    #[Url] public string $q = '';
    #[Url] public string $date = '';
    #[Url] public string $status = '';

    // form buat ujian
    public string $title = '';
    public string $test_type = 'skd';
    public string $exam_date = '';

    public const TEST_TYPES = ['skd' => 'SKD', 'tpa' => 'TPA', 'tbi' => 'TBI', 'mtk_stis' => 'Matematika STIS', 'mtk_tka' => 'Matematika TKA', 'general' => 'General'];

    public function mount()
    {
        $this->type = request()->routeIs('quizzes.*') ? 'quiz' : 'tryout';
        $this->exam_date = now()->format('Y-m-d\TH:i');
        $this->test_type = $this->type === 'quiz' ? 'general' : 'skd';
    }

    public function updating($n) { if (in_array($n, ['q', 'date', 'status'])) $this->resetPage(); }

    protected function staff(): void
    {
        abort_unless(auth()->user()->hasAnyRole(['admin', 'tentor']), 403);
    }

    public function create()
    {
        $this->staff();
        $data = $this->validate([
            'title' => 'required|string|max:255',
            'test_type' => 'required|in:'.implode(',', array_keys(self::TEST_TYPES)),
            'exam_date' => 'required|date',
        ], [], ['title' => 'judul', 'exam_date' => 'tanggal']);

        $exam = Exam::create($data + ['type' => $this->type, 'status' => 'inactive', 'created_by' => auth()->id()]);
        toast('success', ucfirst($this->type).' berhasil dibuat. Silakan tambahkan soal.');

        return $this->redirectRoute('exams.edit', $exam);
    }

    public function activate(int $id)
    {
        $this->staff();
        $exam = Exam::findOrFail($id);
        $exam->update(['status' => 'active']);
        $users = User::whereHas('entitlements', fn ($q) => $q->where('entitlement_type', $exam->type))->get();
        foreach ($users as $u) {
            notify_user($u, "Ujian '{$exam->title}' telah dibuka. Silakan dikerjakan.", false, route('exams.show', $exam));
        }
        $this->notify('success', 'Ujian diaktifkan'.($users->count() ? " & {$users->count()} siswa diberi notifikasi" : '').'.');
    }

    public function close(int $id)
    {
        $this->staff();
        Exam::findOrFail($id)->update(['status' => 'closed']);
        $this->notify('success', 'Ujian ditutup.');
    }

    public function remove(int $id)
    {
        $this->staff();
        $exam = Exam::findOrFail($id);
        if ($exam->status === 'active') return $this->notify('error', 'Ujian sedang berlangsung dan tidak dapat dihapus.');
        if ($exam->attempts()->exists()) return $this->notify('error', 'Ujian sudah dikerjakan, tidak dapat dihapus.');
        $exam->delete();
        $this->notify('success', 'Ujian berhasil dihapus.');
    }

    public function render()
    {
        $user = auth()->user();
        $isStaff = $user->hasAnyRole(['admin', 'tentor']);

        $exams = Exam::where('type', $this->type)
            ->withCount('questions')
            ->withCount(['attempts as submitted_count' => fn ($q) => $q->where('is_submitted', true)])
            ->when(trim($this->q), fn ($q) => $q->where('title', 'like', '%'.trim($this->q).'%'))
            ->when($this->date, fn ($q) => $q->whereDate('exam_date', $this->date))
            ->when($this->status, fn ($q) => $q->where('status', $this->status))
            ->when(! $isStaff, fn ($q) => $q->where('status', '!=', 'inactive'))
            ->latest('exam_date')
            ->paginate(12);

        $myAttempts = $isStaff ? collect() : ExamAttempt::where('user_id', $user->id)->whereIn('exam_id', $exams->pluck('id'))->get()->keyBy('exam_id');

        return view('livewire.exams.index', [
            'exams' => $exams, 'isStaff' => $isStaff, 'myAttempts' => $myAttempts, 'testTypes' => self::TEST_TYPES,
        ])->title($this->type === 'quiz' ? 'Kuis' : 'Tryout');
    }
}
