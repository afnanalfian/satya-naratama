<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ExamQuestion;

class ExamQuestionController extends Controller
{
    public function byMaterial(
        Exam $exam,
        $materialId
    ) {
        $material = QuestionMaterial::withTrashed()
            ->findOrFail($materialId);

        return Question::query()
            ->where('material_id', $material->id)

            // FILTER OTOMATIS BERDASARKAN EXAM
            ->whereIn(
                'test_type',
                $exam->allowedQuestionTypes()
            )

            // CEGAH DUPLIKASI SOAL
            ->whereNotIn(
                'id',
                $exam->questions()->pluck('question_id')
            )

            ->with([
                'options',
                'subItems.answers'
            ])
            ->withCount('examQuestions')
            ->paginate(10);
    }
    public function idsByMaterial(Exam $exam, $materialId)
    {
        $material = QuestionMaterial::withTrashed()
            ->findOrFail($materialId);

        return Question::query()
            ->where('material_id', $material->id)
            ->whereIn('test_type', $exam->allowedQuestionTypes())
            ->whereNotIn(
                'id',
                $exam->questions()->pluck('question_id')
            )
            ->pluck('id')
            ->values(); // WAJIB
    }

    public function move(
        Request $request,
        Exam $exam,
        ExamQuestion $examQuestion
    ) {
        abort_if($exam->status !== 'inactive', 403);

        $data = $request->validate([
            'to_order' => 'required|integer|min:1',
        ]);

        // Pastikan soal memang milik exam ini
        abort_unless($examQuestion->exam_id === $exam->id, 404);

        $from = $examQuestion->order;
        $to   = min(
            $data['to_order'],
            $exam->questions()->count()
        );

        if ($from === $to) {
            return back();
        }

        DB::transaction(function () use ($exam, $examQuestion, $from, $to) {

            if ($from < $to) {
                // Geser naik (contoh: 2 → 5)
                $exam->questions()
                    ->whereBetween('order', [$from + 1, $to])
                    ->decrement('order');

            } else {
                // Geser turun (contoh: 5 → 2)
                $exam->questions()
                    ->whereBetween('order', [$to, $from - 1])
                    ->increment('order');
            }

            $examQuestion->update(['order' => $to]);
        });

        toast('success', 'Urutan soal berhasil diubah');
        return back();
    }

    public function attach(Request $request, Exam $exam)
    {
        $data = $request->validate([
            'question_ids'   => 'required|array',
            'question_ids.*' => 'exists:questions,id',
        ]);

        $questions = Question::whereIn('id', $data['question_ids'])->get();
        $allowedTypes = $exam->allowedQuestionTypes();

        $order = $exam->questions()->max('order') ?? 0;

        foreach ($questions as $question) {
            abort_unless(
                in_array($question->test_type, $allowedTypes),
                403,
                "Soal dengan tipe {$question->test_type} tidak boleh dimasukkan ke ujian {$exam->test_type}"
            );

            // Cek dulu apakah sudah ter-attach
            $exists = $exam->questions()
                ->where('question_id', $question->id)
                ->exists();

            if ($exists) {
                continue;
            }

            $order++;

            $exam->questions()->create([
                'question_id' => $question->id,
                'order'       => $order,
            ]);
        }

        toast('success', 'Soal berhasil ditambahkan');
        return redirect()->route('exams.edit', $exam);
    }

    public function detach(Request $request, Exam $exam)
    {
        abort_if($exam->status !== 'inactive', 403);

        $data = $request->validate([
            'question_id' => 'required|exists:questions,id',
        ]);

        DB::transaction(function () use ($exam, $data) {

            // Ambil pivot (exam_questions) yang mau dihapus
            $examQuestion = $exam->questions()
                ->where('question_id', $data['question_id'])
                ->firstOrFail();

            $deletedOrder = $examQuestion->order;

            // Hapus soal
            $examQuestion->delete();

            // Geser soal setelahnya
            $exam->questions()
                ->where('order', '>', $deletedOrder)
                ->decrement('order');
        });

        toast('success', 'Soal berhasil dihapus');
        return redirect()->route('exams.edit', $exam);
    }

}
