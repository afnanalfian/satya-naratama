<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentPhysicalRecord;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Data fisik bulanan (tinggi, berat, penyakit, cedera).
 * - Siswa mengisi data bulan berjalan.
 * - Admin dapat mengisi/mengubah bulan mana pun.
 * - Admin & tentor dapat memonitor.
 */
class PhysicalRecordController extends Controller
{
    /* =====================================================
     | SISWA
     |===================================================== */

    public function mine()
    {
        $user = auth()->user();
        $period = now()->startOfMonth();

        $records = $user->physicalRecords()->get();
        $current = $records->first(fn ($r) => $r->period->isSameMonth($period));
        $previous = $records->filter(fn ($r) => $r->period->lt($period))->last();

        return view('physical.mine', [
            'user'     => $user,
            'period'   => $period,
            'current'  => $current,
            'previous' => $previous,
            'records'  => $records,
            'chart'    => $this->chartData($records),
        ]);
    }

    public function storeMine(Request $request)
    {
        $data = $this->validateRecord($request, false);
        $period = now()->startOfMonth();

        $this->upsert($request->user(), $period, $data, $request->user());

        toast('success', 'Data fisik bulan ' . $period->translatedFormat('F Y') . ' tersimpan.');

        return redirect()->route('physical.mine');
    }

    /* =====================================================
     | ADMIN / TENTOR
     |===================================================== */

    public function index(Request $request)
    {
        $period = $this->parsePeriod($request->query('month')) ?? now()->startOfMonth();
        $prevPeriod = $period->copy()->subMonth();
        $q = trim((string) $request->query('q'));
        $filter = $request->query('filter');

        $students = User::query()->activeStudents()
            ->with('studentRegistration:id,user_id,full_name,gender,class')
            ->orderBy('name')
            ->get();

        $records = StudentPhysicalRecord::whereIn('period', [$period->toDateString(), $prevPeriod->toDateString()])
            ->whereIn('user_id', $students->pluck('id'))
            ->get()
            ->groupBy(fn ($r) => $r->period->toDateString());

        $current = ($records[$period->toDateString()] ?? collect())->keyBy('user_id');
        $previous = ($records[$prevPeriod->toDateString()] ?? collect())->keyBy('user_id');

        $rows = $students->map(fn ($s) => [
            'student'  => $s,
            'record'   => $current->get($s->id),
            'previous' => $previous->get($s->id),
        ]);

        // KPI dihitung dari semua siswa (sebelum filter tabel)
        $filled = $current->values();
        $bmiBuckets = ['kurus_berat' => 0, 'kurus' => 0, 'normal' => 0, 'gemuk' => 0, 'obesitas' => 0];
        foreach ($filled as $r) {
            if ($cat = $r->bmi_category) {
                $bmiBuckets[$cat['key']]++;
            }
        }

        $kpi = [
            'total'       => $students->count(),
            'filled'      => $filled->count(),
            'avg_height'  => $filled->count() ? round($filled->avg('height_cm'), 1) : null,
            'avg_weight'  => $filled->count() ? round($filled->avg('weight_kg'), 1) : null,
            'avg_bmi'     => $filled->count() ? round($filled->avg(fn ($r) => $r->bmi), 1) : null,
            'illness'     => $filled->where('has_illness', true)->count(),
            'injury'      => $filled->where('has_injury', true)->count(),
        ];

        if ($q !== '') {
            $rows = $rows->filter(fn ($r) => str_contains(mb_strtolower($r['student']->name), mb_strtolower($q)));
        }
        $rows = match ($filter) {
            'missing' => $rows->filter(fn ($r) => ! $r['record']),
            'health'  => $rows->filter(fn ($r) => $r['record']?->hasHealthIssue()),
            default   => $rows,
        };

        // Tren rata-rata 12 bulan terakhir
        $trendStart = $period->copy()->subMonths(11);
        $trendRaw = StudentPhysicalRecord::whereBetween('period', [$trendStart->toDateString(), $period->toDateString()])
            ->whereIn('user_id', $students->pluck('id'))
            ->get()
            ->groupBy(fn ($r) => $r->period->format('Y-m'));
        $trend = ['labels' => [], 'height' => [], 'weight' => [], 'count' => []];
        for ($m = $trendStart->copy(); $m->lte($period); $m->addMonth()) {
            $g = $trendRaw->get($m->format('Y-m'), collect());
            $trend['labels'][] = $m->translatedFormat('M Y');
            $trend['height'][] = $g->count() ? round($g->avg('height_cm'), 1) : null;
            $trend['weight'][] = $g->count() ? round($g->avg('weight_kg'), 1) : null;
            $trend['count'][] = $g->count();
        }

        // Buang bulan-bulan awal yang belum ada datanya
        while (count($trend['count']) > 1 && $trend['count'][0] === 0) {
            foreach ($trend as $k => $_) {
                array_shift($trend[$k]);
            }
        }

        return view('physical.index', [
            'period'     => $period,
            'rows'       => $rows->values(),
            'kpi'        => $kpi,
            'bmiBuckets' => $bmiBuckets,
            'trend'      => $trend,
            'q'          => $q,
            'filter'     => $filter,
        ]);
    }

    public function student(User $user)
    {
        abort_unless($user->hasRole('siswa'), 404);
        $user->load('studentRegistration');
        $records = $user->physicalRecords()->with('editor:id,name')->get();

        return view('physical.student', [
            'student' => $user,
            'records' => $records,
            'chart'   => $this->chartData($records),
        ]);
    }

    /** Admin: simpan / ubah data bulan mana pun. */
    public function storeForStudent(Request $request, User $user)
    {
        abort_unless($user->hasRole('siswa'), 404);
        $data = $this->validateRecord($request, true);
        $period = $this->parsePeriod($data['period']);

        $this->upsert($user, $period, $data, $request->user());

        toast('success', "Data fisik {$user->name} bulan " . $period->translatedFormat('F Y') . ' tersimpan.');

        return back();
    }

    public function destroy(StudentPhysicalRecord $record)
    {
        $user = $record->user;
        $record->delete();
        $this->syncRegistration($user);

        toast('warning', 'Data fisik dihapus.');

        return back();
    }

    /* ===================================================== */

    protected function validateRecord(Request $request, bool $withPeriod): array
    {
        $rules = [
            'height_cm'     => 'required|numeric|min:100|max:250',
            'weight_kg'     => 'required|numeric|min:20|max:250',
            'has_illness'   => 'nullable|boolean',
            'illness_notes' => 'nullable|required_if:has_illness,1|string|max:1000',
            'has_injury'    => 'nullable|boolean',
            'injury_notes'  => 'nullable|required_if:has_injury,1|string|max:1000',
            'notes'         => 'nullable|string|max:1000',
        ];
        if ($withPeriod) {
            $rules['period'] = 'required|date_format:Y-m';
        }

        $data = $request->validate($rules, [
            'illness_notes.required_if' => 'Tuliskan penyakit yang dialami.',
            'injury_notes.required_if'  => 'Tuliskan cedera yang dialami.',
        ], [
            'height_cm' => 'tinggi badan',
            'weight_kg' => 'berat badan',
        ]);

        $data['has_illness'] = $request->boolean('has_illness');
        $data['has_injury'] = $request->boolean('has_injury');
        if (! $data['has_illness']) {
            $data['illness_notes'] = null;
        }
        if (! $data['has_injury']) {
            $data['injury_notes'] = null;
        }

        return $data;
    }

    protected function upsert(User $student, Carbon $period, array $data, User $editor): StudentPhysicalRecord
    {
        $record = StudentPhysicalRecord::firstOrNew([
            'user_id' => $student->id,
            'period'  => $period->toDateString(),
        ]);

        $record->fill([
            'height_cm'     => $data['height_cm'],
            'weight_kg'     => $data['weight_kg'],
            'has_illness'   => $data['has_illness'],
            'illness_notes' => $data['illness_notes'] ?? null,
            'has_injury'    => $data['has_injury'],
            'injury_notes'  => $data['injury_notes'] ?? null,
            'notes'         => $data['notes'] ?? null,
            'updated_by'    => $editor->id,
        ])->save();

        $this->syncRegistration($student);

        return $record;
    }

    /** Data pendaftaran ikut menampilkan TB/BB terbaru. */
    protected function syncRegistration(?User $student): void
    {
        $reg = $student?->studentRegistration;
        if (! $reg) {
            return;
        }
        $latest = $student->physicalRecords()->reorder('period', 'desc')->first();
        if ($latest) {
            $reg->update([
                'height_cm' => (int) round($latest->height_cm),
                'weight_kg' => (int) round($latest->weight_kg),
            ]);
        }
    }

    protected function parsePeriod(?string $value): ?Carbon
    {
        if (! $value || ! preg_match('/^\d{4}-\d{2}$/', $value)) {
            return null;
        }

        return Carbon::createFromFormat('Y-m-d', $value . '-01')->startOfDay();
    }

    protected function chartData($records): array
    {
        return [
            'labels' => $records->map(fn ($r) => $r->period->translatedFormat('M Y'))->values(),
            'height' => $records->pluck('height_cm')->values(),
            'weight' => $records->pluck('weight_kg')->values(),
            'bmi'    => $records->map(fn ($r) => $r->bmi)->values(),
        ];
    }
}
