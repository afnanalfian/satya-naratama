<?php

namespace App\Services;

use App\Models\ExamAttempt;
use App\Models\PhysicalEvaluation;
use App\Models\PhysicalEvaluationResult;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * Menyusun rapor lengkap satu siswa:
 * presensi (akademik & jasmani), tryout, evaluasi jasmani, dan data fisik.
 * Dipakai oleh link publik orang tua dan halaman monitoring internal.
 */
class StudentReportService
{
    public const TEST_TYPE_LABELS = [
        'skd'      => 'SKD',
        'mtk_stis' => 'Matematika STIS',
        'mtk_tka'  => 'Matematika TKA',
        'tpa'      => 'TPA',
        'tbi'      => 'TBI',
        'general'  => 'Umum',
    ];

    public function __construct(protected AttendanceService $attendance)
    {
    }

    public function build(User $student): array
    {
        $student->loadMissing('studentRegistration');

        return [
            'student'    => $student,
            'attendance' => $this->attendance($student),
            'tryouts'    => $this->tryouts($student),
            'jasmani'    => $this->jasmani($student),
            'physical'   => $this->physical($student),
        ];
    }

    /* ===================================================== */

    public function attendance(User $student): array
    {
        $done = $this->attendance->doneMeetings();

        return [
            'summary' => $this->attendance->studentSummaries(collect([$student]), $done)[$student->id],
            'weekly'  => $this->attendance->weeklySeries($done, $student->id),
            'history' => $this->attendance->studentHistory($student, $done)->take(12),
        ];
    }

    public function tryouts(User $student): array
    {
        $attempts = ExamAttempt::with('exam')
            ->where('user_id', $student->id)
            ->where('is_submitted', true)
            ->whereHas('exam', fn ($q) => $q->where('type', 'tryout'))
            ->get()
            ->sortBy(fn ($a) => $a->exam->exam_date ?? $a->submitted_at)
            ->values();

        if ($attempts->isEmpty()) {
            return ['rows' => collect(), 'series' => [], 'best' => null, 'avg' => null, 'passed' => 0];
        }

        // Peringkat & jumlah peserta per tryout
        $examIds = $attempts->pluck('exam_id');
        $allScores = ExamAttempt::whereIn('exam_id', $examIds)
            ->where('is_submitted', true)
            ->get(['exam_id', 'score'])
            ->groupBy('exam_id');

        $rows = $attempts->map(function ($a) use ($allScores) {
            $scores = $allScores->get($a->exam_id, collect())->pluck('score')->map(fn ($s) => (float) $s);
            $score = (float) $a->score;

            return (object) [
                'title'        => $a->exam->title ?: $a->exam->exam_code,
                'test_type'    => $a->exam->test_type,
                'type_label'   => self::TEST_TYPE_LABELS[$a->exam->test_type] ?? strtoupper((string) $a->exam->test_type),
                'date'         => $a->exam->exam_date ?? $a->submitted_at,
                'score'        => $score,
                'correct'      => $a->correct_count,
                'wrong'        => $a->wrong_count,
                'is_passed'    => $a->is_passed,
                'rank'         => $scores->filter(fn ($s) => $s > $score)->count() + 1,
                'participants' => $scores->count(),
                'avg'          => $scores->count() ? round($scores->avg(), 1) : null,
            ];
        });

        // Satu grafik per jenis tes (skala nilai berbeda)
        $series = $rows->groupBy('test_type')->map(fn ($g, $type) => [
            'label'  => self::TEST_TYPE_LABELS[$type] ?? strtoupper((string) $type),
            'labels' => $g->map(fn ($r) => \Illuminate\Support\Str::limit($r->title, 18))->values(),
            'titles' => $g->pluck('title')->values(),
            'scores' => $g->pluck('score')->values(),
            'avgs'   => $g->pluck('avg')->values(),
        ])->values()->all();

        return [
            'rows'   => $rows->reverse()->values(),
            'series' => $series,
            'passed' => $rows->where('is_passed', true)->count(),
            'last'   => $rows->last(),
        ];
    }

    public function jasmani(User $student): array
    {
        $results = PhysicalEvaluationResult::with('evaluation')
            ->where('user_id', $student->id)
            ->get()
            ->filter(fn ($r) => $r->evaluation)
            ->sortBy(fn ($r) => [$r->evaluation->period, $r->evaluation->held_on])
            ->values();

        $series = ['labels' => $results->map(fn ($r) => $r->evaluation->period->translatedFormat('M Y'))->values()];
        foreach (array_keys(PhysicalEvaluation::ITEMS) as $key) {
            $series[$key] = $results->pluck($key)->values();
        }

        return [
            'results'  => $results->reverse()->values(),
            'latest'   => $results->last(),
            'previous' => $results->count() > 1 ? $results[$results->count() - 2] : null,
            'series'   => $series,
            'gender'   => $student->studentRegistration?->gender,
        ];
    }

    public function physical(User $student): array
    {
        $records = $student->physicalRecords()->get();

        return [
            'records' => $records->reverse()->values(),
            'latest'  => $records->last(),
            'first'   => $records->first(),
            'health'  => $records->filter->hasHealthIssue()->reverse()->values(),
            'chart'   => [
                'labels' => $records->map(fn ($r) => $r->period->translatedFormat('M Y'))->values(),
                'height' => $records->pluck('height_cm')->values(),
                'weight' => $records->pluck('weight_kg')->values(),
            ],
        ];
    }
}
