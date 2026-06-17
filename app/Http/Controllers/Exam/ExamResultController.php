<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExamResultController extends Controller
{
    /**
     * ======================================================
     * 1. ADMIN - RESULT EXAM
     * ======================================================
     */
    public function adminResult(Exam $exam, Request $request)
    {
        $perPageQuestions = $request->integer('per_page', 20);
        $perPageRanking   = $request->integer('rank_per_page', 20);

        // ======================================================
        // AGREGASI
        // ======================================================
        $attemptsBase = ExamAttempt::where('exam_id', $exam->id)
            ->where('is_submitted', true);

        $totalParticipants = (clone $attemptsBase)->count();
        $averageScore      = round((clone $attemptsBase)->avg('score'), 2);
        $maxScore          = (clone $attemptsBase)->max('score');
        $minScore          = (clone $attemptsBase)->min('score');

        // ======================================================
        // RANKING (PAGINATED)
        // ======================================================
        $totalQuestions = $exam->questions()->count();
        $rankingQuery = ExamAttempt::with([
                'user',
                'answers.question.options', // untuk hitung subscore SKD
            ])
            ->where('exam_id', $exam->id)
            ->where('is_submitted', true);

        // Sorting
        if (
            $exam->type === 'tryout' &&
            in_array($exam->test_type, ['skd', 'mtk_stis'])
        ) {
            $rankingQuery
                ->orderByDesc('is_passed')
                ->orderByDesc('score');
        } else {
            $rankingQuery->orderByDesc('score');
        }

        $ranking = $rankingQuery->paginate($perPageRanking);
        $ranking->getCollection()->transform(function ($attempt) use ($exam, $totalQuestions) {
            // Default
            $attempt->correct = $attempt->correct_count ?? 0;
            $attempt->wrong   = $attempt->wrong_count ?? 0;

            // Khusus MTK STIS → hitung kosong
            if ($exam->test_type === 'mtk_stis') {
                $attempt->empty = max(
                    0,
                    $totalQuestions - $attempt->correct - $attempt->wrong
                );
            }

            return $attempt;
        });

        // ============================
        // HITUNG SUB SCORE (SKD ONLY)
        // ============================
        if ($exam->type === 'tryout' && $exam->test_type === 'skd') {

            foreach ($ranking as $attempt) {

                $scoreTiu = 0;
                $scoreTwk = 0;
                $scoreTkp = 0;

                foreach ($attempt->answers as $answer) {

                    $question = $answer->question;
                    if (!$question) continue;

                    $subtest = $question->test_type; // tiu | twk | tkp

                    // TIU & TWK → benar × 5
                    if (in_array($subtest, ['tiu', 'twk']) && $answer->is_correct) {
                        $subtest === 'tiu'
                            ? $scoreTiu += 5
                            : $scoreTwk += 5;
                    }

                    // TKP → jumlah bobot
                    if ($subtest === 'tkp' && !empty($answer->selected_ids)) {
                        $scoreTkp += $question->options
                            ->whereIn('id', $answer->selected_ids)
                            ->sum('weight');
                    }
                }

                // virtual attribute
                $attempt->score_tiu = $scoreTiu;
                $attempt->score_twk = $scoreTwk;
                $attempt->score_tkp = $scoreTkp;
            }
        }

        // Tambahin rank global (sesuai pagination)
        $startRank = ($ranking->currentPage() - 1) * $ranking->perPage();
        $ranking->getCollection()->transform(function ($attempt, $index) use ($startRank) {
            $attempt->rank = $startRank + $index + 1;
            return $attempt;
        });

        // ======================================================
        // SOAL + AKURASI
        // ======================================================
        $questions = ExamQuestion::with('question')
            ->where('exam_id', $exam->id)
            ->orderBy('order')
            ->paginate($perPageQuestions);

        $questionStats = [];

        foreach ($questions as $examQuestion) {

            $qid = $examQuestion->question_id;

            $totalAnswered = DB::table('exam_answers')
                ->join('exam_attempts', 'exam_answers.attempt_id', '=', 'exam_attempts.id')
                ->where('exam_attempts.exam_id', $exam->id)
                ->where('exam_answers.question_id', $qid)
                ->whereNotNull('exam_answers.selected_options')
                ->count();

            $totalCorrect = DB::table('exam_answers')
                ->join('exam_attempts', 'exam_answers.attempt_id', '=', 'exam_attempts.id')
                ->where('exam_attempts.exam_id', $exam->id)
                ->where('exam_answers.question_id', $qid)
                ->where('exam_answers.is_correct', true)
                ->count();

            $questionStats[$qid] = [
                'answered' => $totalAnswered,
                'correct'  => $totalCorrect,
                'accuracy' => $totalAnswered > 0
                    ? round(($totalCorrect / $totalAnswered) * 100, 2)
                    : 0,
            ];
        }

        $displayTitle = $exam->title;
        $displaySubtitle = null;

        if (in_array($exam->type, ['blind_test', 'post_test'])) {

            // owner = Meeting
            if ($exam->owner && $exam->owner_type === \App\Models\Meeting::class) {

                $displayTitle = $exam->owner->title;

                $displaySubtitle = $exam->type === 'blind_test'
                    ? 'Blind Test'
                    : 'Post Test';
            }
        }
        // =========================
        // BACK URL
        // =========================
        $backUrl = route('exams.show', $exam);

        if (in_array($exam->type, ['blind_test', 'post_test'])) {

            if ($exam->owner && $exam->owner_type === \App\Models\Meeting::class) {
                $backUrl = route('meeting.show', $exam->owner);
            }
        }
        return view('exams.results.admin', [
            'exam'              => $exam,
            'displayTitle'      => $displayTitle,
            'displaySubtitle'   => $displaySubtitle,
            'totalParticipants' => $totalParticipants,
            'averageScore'      => $averageScore,
            'maxScore'          => $maxScore,
            'minScore'          => $minScore,
            'ranking'           => $ranking,
            'questions'         => $questions,
            'questionStats'     => $questionStats,
            'perPage'           => $perPageQuestions,
            'rankPerPage'       => $perPageRanking,
            'backUrl'           => $backUrl,
        ]);
    }

    /**
     * ======================================================
     * 2. ADMIN - ANALISIS SOAL
     * ======================================================
     */
    public function adminQuestionAnalysis(Exam $exam, ExamQuestion $examQuestion)
    {
        $question = $examQuestion->question->load('options');

        // ============================
        // AMBIL SEMUA ATTEMPT + JAWABAN SOAL INI
        // ============================
        $attempts = ExamAttempt::with([
                'user',
                'answers' => function ($q) use ($question) {
                    $q->where('question_id', $question->id);
                }
            ])
            ->where('exam_id', $exam->id)
            ->where('is_submitted', true)
            ->get();

        // ============================
        // RINGKASAN BENAR / SALAH / KOSONG
        // ============================
        $summary = [
            'correct' => 0,
            'wrong'   => 0,
            'empty'   => 0,
            'answered'=> 0,
        ];

        foreach ($attempts as $attempt) {
            $answer = $attempt->answers->first();

            if (!$answer || empty($answer->selected_options)) {
                $summary['empty']++;
            } elseif ($answer->is_correct) {
                $summary['correct']++;
                $summary['answered']++;
            } else {
                $summary['wrong']++;
                $summary['answered']++;
            }
        }

        // ============================
        // DISTRIBUSI JAWABAN PER OPSI
        // ============================
        $optionStats = [];

        // hitung peserta yang benar-benar menjawab soal ini
        $totalAnswered = 0;

        foreach ($attempts as $attempt) {
            $answer = $attempt->answers->first();
            if ($answer && !$answer->is_empty) {
                $totalAnswered++;
            }
        }

        foreach ($question->options as $option) {

            $count = 0;

            foreach ($attempts as $attempt) {
                $answer = $attempt->answers->first();

                if (
                    $answer &&
                    in_array($answer->answer_type, ['mcq', 'mcma', 'truefalse']) &&
                    in_array($option->id, $answer->selected_ids)
                ) {
                    $count++;
                }
            }

            $optionStats[$option->id] = [
                'count'      => $count,
                'percentage' => $totalAnswered > 0
                    ? round(($count / $totalAnswered) * 100, 2)
                    : 0,
            ];
        }

        // ============================
        // DATA ATTEMPT (UNTUK TABEL)
        // ============================
        $attemptRows = $attempts->map(function ($attempt) {
            $answer = $attempt->answers->first();

            return [
                'user'   => $attempt->user,
                'status' => !$answer || empty($answer->selected_options)
                    ? 'empty'
                    : ($answer->is_correct ? 'correct' : 'wrong'),
            ];
        });

        return view('exams.results.analysis', compact(
            'exam',
            'examQuestion',
            'question',
            'summary',
            'optionStats',
            'totalAnswered',
            'attemptRows'
        ));
    }
    /**
     * ======================================================
     * 3. SISWA - RESULT PRIBADI
     * ======================================================
     */
    public function studentResult(Exam $exam, Request $request)
    {
        $perPage = $request->integer('per_page', 20);

        $attempt = ExamAttempt::with([
                'answers',
                'answers.question',
                'answers.question.options',
            ])
            ->where('exam_id', $exam->id)
            ->where('user_id', auth()->id())
            ->where('is_submitted', true)
            ->firstOrFail();

        // =========================
        // RINGKASAN BENAR / SALAH / KOSONG
        // PAKAI DATA DARI DATABASE (sudah dihitung oleh scoring service)
        // =========================
        $summary = [
            'correct' => $attempt->correct_count ?? 0,
            'wrong'   => $attempt->wrong_count ?? 0,
            'empty'   => 0,
        ];

        // Hitung empty dari database
        $totalQuestions = ExamQuestion::where('exam_id', $exam->id)->count();
        $answered = $summary['correct'] + $summary['wrong'];
        $summary['empty'] = max(0, $totalQuestions - $answered);

        // =========================
        // SOAL + OPTIONS
        // =========================
        $questions = ExamQuestion::with([
                'question.options',
            ])
            ->where('exam_id', $exam->id)
            ->orderBy('order')
            ->paginate($perPage);

        // =========================
        // KHUSUS TRYOUT SKD - SESUAI DENGAN LOGIKA SCORING SERVICE
        // =========================
        $skdSummary = null;

        if ($exam->type === 'tryout' && $exam->test_type === 'skd') {
            // Inisialisasi subtest summary
            $skdSummary = [
                'tiu' => ['correct' => 0, 'wrong' => 0, 'score' => 0, 'total_questions' => 0],
                'twk' => ['correct' => 0, 'wrong' => 0, 'score' => 0, 'total_questions' => 0],
                'tkp' => ['correct' => 0, 'wrong' => 0, 'score' => 0, 'total_questions' => 0],
                'total_score' => $attempt->score,
            ];

            // =========================
            // PERTAMA: Hitung jumlah soal per subtest
            // =========================
            $subtestQuestionCounts = [
                'tiu' => ExamQuestion::where('exam_id', $exam->id)
                    ->whereHas('question', function($q) {
                        $q->where('test_type', 'tiu');
                    })->count(),
                'twk' => ExamQuestion::where('exam_id', $exam->id)
                    ->whereHas('question', function($q) {
                        $q->where('test_type', 'twk');
                    })->count(),
                'tkp' => ExamQuestion::where('exam_id', $exam->id)
                    ->whereHas('question', function($q) {
                        $q->where('test_type', 'tkp');
                    })->count(),
            ];

            $skdSummary['tiu']['total_questions'] = $subtestQuestionCounts['tiu'] ?? 35;
            $skdSummary['twk']['total_questions'] = $subtestQuestionCounts['twk'] ?? 30;
            $skdSummary['tkp']['total_questions'] = $subtestQuestionCounts['tkp'] ?? 45;

            // =========================
            // KEDUA: Hitung correct dan wrong yang sudah dijawab
            // =========================
            foreach ($attempt->answers as $answer) {
                $question = $answer->question;

                if (!$question) continue;

                $subtestType = $question->test_type;

                // Skip jika bukan subtest SKD yang valid
                if (!isset($skdSummary[$subtestType])) continue;

                // =========================
                // LOGIKA TKP (sesuai scoring service)
                // =========================
                if ($subtestType === 'tkp') {
                    if (!$answer || $answer->isEmpty) {
                        // Kosong = wrong (tapi dihitung nanti)
                        continue; // Lewati, akan dihitung sebagai wrong dari soal yang tidak terjawab
                    }

                    // Hitung bobot yang dipilih
                    $selectedWeight = $question->options
                        ->whereIn('id', $answer->selected_ids ?? [])
                        ->sum('weight');

                    $maxWeight = $question->options->max('weight');

                    // Tambah skor
                    $skdSummary['tkp']['score'] += $selectedWeight;

                    // Benar jika dapat bobot maksimum
                    if ($selectedWeight === $maxWeight) {
                        $skdSummary['tkp']['correct']++;
                    } else {
                        $skdSummary['tkp']['wrong']++; // Salah jika dapat bobot < maksimum
                    }

                    continue;
                }

                // =========================
                // LOGIKA TIU & TWK (sesuai scoring service)
                // =========================
                if (!$answer || $answer->isEmpty) {
                    // Kosong = wrong (tapi dihitung nanti)
                    continue; // Lewati, akan dihitung sebagai wrong dari soal yang tidak terjawab
                }

                // Cek apakah jawaban benar
                if ($answer->is_correct === true) {
                    $skdSummary[$subtestType]['score'] += 5;
                    $skdSummary[$subtestType]['correct']++;
                } else {
                    $skdSummary[$subtestType]['wrong']++;
                }
            }

            // =========================
            // KETIGA: Hitung soal yang KOSONG dan masukkan ke WRONG
            // =========================
            foreach (['tiu', 'twk', 'tkp'] as $subtest) {
                $totalQuestions = $skdSummary[$subtest]['total_questions'];
                $answeredQuestions = $skdSummary[$subtest]['correct'] + $skdSummary[$subtest]['wrong'];
                $emptyQuestions = max(0, $totalQuestions - $answeredQuestions);

                // Kosong dianggap sebagai wrong
                $skdSummary[$subtest]['wrong'] += $emptyQuestions;

                // Tambahkan kolom empty untuk informasi
                $skdSummary[$subtest]['empty'] = $emptyQuestions;
            }
        }

        $displayTitle = $exam->title;
        $displaySubtitle = null;

        if (in_array($exam->type, ['blind_test', 'post_test'])) {
            if ($exam->owner && $exam->owner_type === \App\Models\Meeting::class) {
                $displayTitle = $exam->owner->title;
                $displaySubtitle = $exam->type === 'blind_test'
                    ? 'Blind Test'
                    : 'Post Test';
            }
        }

        // =========================
        // BACK URL
        // =========================
        $backUrl = route('exams.show', $exam);

        if (in_array($exam->type, ['blind_test', 'post_test'])) {
            if ($exam->owner && $exam->owner_type === \App\Models\Meeting::class) {
                $backUrl = route('meeting.show', $exam->owner);
            }
        }

        return view('exams.results.student', compact(
            'exam',
            'displayTitle',
            'displaySubtitle',
            'attempt',
            'questions',
            'perPage',
            'skdSummary',
            'summary',
            'backUrl'
        ));
    }

    /**
     * ======================================================
     * 4. SISWA - PERINGKAT
     * ======================================================
     */
    public function studentRanking(Exam $exam, Request $request)
    {
        // ============================
        // BASE QUERY (TANPA SEARCH)
        // ============================
        $query = ExamAttempt::with([
                'user',
                'answers.question.options',
            ])
            ->where('exam_id', $exam->id)
            ->where('is_submitted', true);

        // ============================
        // SORTING LOGIC (GLOBAL)
        // ============================
        if (
            $exam->type === 'tryout' &&
            in_array($exam->test_type, ['skd', 'mtk_stis'])
        ) {
            $query->orderByDesc('is_passed')
                ->orderByDesc('score');
        } else {
            $query->orderByDesc('score');
        }

        // ============================
        // AMBIL SEMUA DATA (GLOBAL)
        // ============================
        $attempts = $query->get();

        $totalParticipants = $attempts->count();
        $totalQuestions = null;

        if ($exam->type === 'tryout' && $exam->test_type === 'mtk_stis') {
            $totalQuestions = ExamQuestion::where('exam_id', $exam->id)->count();
        }

        // ============================
        // HITUNG SUB SCORE (SKD)
        // ============================
        if ($exam->type === 'tryout' && $exam->test_type === 'skd') {

            foreach ($attempts as $attempt) {

                $scoreTiu = 0;
                $scoreTwk = 0;
                $scoreTkp = 0;

                foreach ($attempt->answers as $answer) {

                    $question = $answer->question;
                    if (!$question) continue;

                    $subtest = $question->test_type; // tiu | twk | tkp

                    // TIU & TWK
                    if (in_array($subtest, ['tiu', 'twk'])) {
                        if ($answer->is_correct === true) {
                            $subtest === 'tiu'
                                ? $scoreTiu += 5
                                : $scoreTwk += 5;
                        }
                    }

                    // TKP
                    if ($subtest === 'tkp' && !empty($answer->selected_ids)) {
                        $scoreTkp += $question->options
                            ->whereIn('id', $answer->selected_ids)
                            ->sum('weight');
                    }
                }

                $attempt->score_tiu = $scoreTiu;
                $attempt->score_twk = $scoreTwk;
                $attempt->score_tkp = $scoreTkp;
            }
        }

        // ============================
        // HITUNG BENAR / SALAH / KOSONG
        // ============================
        foreach ($attempts as $attempt) {

            $attempt->correct = $attempt->correct_count ?? 0;
            $attempt->wrong   = $attempt->wrong_count ?? 0;
            $attempt->empty   = 0;

            if (
                $exam->type === 'tryout' &&
                $exam->test_type === 'mtk_stis' &&
                $totalQuestions !== null
            ) {
                $attempt->empty = max(
                    0,
                    $totalQuestions - ($attempt->correct + $attempt->wrong)
                );
            }
        }

        // ============================
        // HITUNG RANK GLOBAL
        // ============================
        $attempts = $attempts
            ->values()
            ->map(function ($attempt, $index) {
                $attempt->rank = $index + 1;
                return $attempt;
            });

        // ============================
        // SIMPAN DATA USER LOGIN
        // ============================
        $myAttempt = $attempts->firstWhere('user_id', auth()->id());

        // ============================
        // FILTER SEARCH (SETELAH RANK)
        // ============================
        if ($request->filled('search')) {
            $search = strtolower($request->search);

            $attempts = $attempts->filter(function ($attempt) use ($search) {
                return str_contains(
                    strtolower($attempt->user->name),
                    $search
                );
            })->values();
        }

        // ============================
        // RETURN VIEW
        // ============================
        return view('exams.results.ranking', [
            'exam'              => $exam,
            'attempts'          => $attempts,
            'totalParticipants' => $totalParticipants, // tetap global
            'myAttemptId'       => optional($myAttempt)->id,
            'myRank'            => optional($myAttempt)->rank,
            'search'            => $request->search ?? '',
        ]);
    }

}
