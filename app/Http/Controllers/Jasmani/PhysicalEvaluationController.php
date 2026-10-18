<?php

namespace App\Http\Controllers\Jasmani;

use App\Http\Controllers\Controller;
use App\Models\PhysicalEvaluation;
use App\Models\PhysicalEvaluationResult;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Evaluasi jasmani bulanan (admin & tentor).
 */
class PhysicalEvaluationController extends Controller
{
    public function index()
    {
        $evaluations = PhysicalEvaluation::with('results', 'creator:id,name')
            ->orderByDesc('period')
            ->orderByDesc('held_on')
            ->get();

        // Tren rata-rata per item, dipisah putra (L) & putri (P)
        $chronological = $evaluations->sortBy(fn ($e) => [$e->period, $e->held_on])->values();
        $trend = ['labels' => $chronological->map(fn ($e) => $e->period->translatedFormat('M Y'))->all()];
        foreach (PhysicalEvaluation::ITEMS as $key => $item) {
            foreach (['L', 'P'] as $g) {
                $trend[$key][$g] = $chronological->map(function ($e) use ($key, $g) {
                    $v = $e->results->where('gender', $g)->pluck($key)->filter(fn ($x) => $x !== null);

                    return $v->count() ? round($v->avg(), 1) : null;
                })->all();
            }
        }

        return view('jasmani.index', [
            'evaluations'  => $evaluations,
            'trend'        => $trend,
            'items'        => PhysicalEvaluation::ITEMS,
            'studentCount' => User::query()->activeStudents()->count(),
        ]);
    }

    public function create()
    {
        return view('jasmani.form', [
            'evaluation' => new PhysicalEvaluation([
                'title'   => 'Evaluasi Jasmani ' . now()->translatedFormat('F Y'),
                'period'  => now()->startOfMonth(),
                'held_on' => now(),
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateMeta($request);
        $data['created_by'] = $request->user()->id;

        $evaluation = PhysicalEvaluation::create($data);

        toast('success', 'Evaluasi dibuat. Silakan input hasil tes.');

        return redirect()->route('jasmani.input', $evaluation);
    }

    public function edit(PhysicalEvaluation $evaluation)
    {
        return view('jasmani.form', compact('evaluation'));
    }

    public function update(Request $request, PhysicalEvaluation $evaluation)
    {
        $evaluation->update($this->validateMeta($request));

        toast('success', 'Data evaluasi diperbarui.');

        return redirect()->route('jasmani.show', $evaluation);
    }

    public function destroy(PhysicalEvaluation $evaluation)
    {
        $evaluation->delete();

        toast('warning', 'Evaluasi jasmani dihapus.');

        return redirect()->route('jasmani.index');
    }

    public function show(Request $request, PhysicalEvaluation $evaluation)
    {
        $evaluation->load(['results.user.studentRegistration', 'creator:id,name']);

        $gender = in_array($request->query('gender'), ['L', 'P'], true) ? $request->query('gender') : null;
        $sort = array_key_exists($request->query('sort'), PhysicalEvaluation::ITEMS) ? $request->query('sort') : null;

        $results = $evaluation->results
            ->when($gender, fn ($c) => $c->where('gender', $gender))
            ->sortBy(fn ($r) => mb_strtolower($r->user?->name ?? ''));

        if ($sort) {
            $better = PhysicalEvaluation::ITEMS[$sort]['better'];
            $results = $results->filter(fn ($r) => $r->{$sort} !== null)
                ->sortBy($sort, SORT_REGULAR, $better === 'high')
                ->concat($results->filter(fn ($r) => $r->{$sort} === null));
        }

        // Evaluasi sebelumnya untuk perbandingan per siswa
        $previous = PhysicalEvaluation::where(function ($q) use ($evaluation) {
                $q->where('period', '<', $evaluation->period->toDateString())
                  ->orWhere(fn ($q2) => $q2->where('period', $evaluation->period->toDateString())
                      ->where('held_on', '<', $evaluation->held_on->toDateString()));
            })
            ->orderByDesc('period')->orderByDesc('held_on')
            ->with('results')
            ->first();

        $missing = User::query()->activeStudents()
            ->whereNotIn('users.id', $evaluation->results->pluck('user_id'))
            ->orderBy('name')
            ->get(['users.id', 'name']);

        return view('jasmani.show', [
            'evaluation' => $evaluation,
            'results'    => $results->values(),
            'stats'      => $evaluation->itemStats(),
            'items'      => PhysicalEvaluation::ITEMS,
            'previous'   => $previous,
            'prevByUser' => $previous?->results->keyBy('user_id') ?? collect(),
            'missing'    => $missing,
            'gender'     => $gender,
            'sort'       => $sort,
        ]);
    }

    /**
     * Grid input hasil (satu baris per siswa).
     */
    public function input(PhysicalEvaluation $evaluation)
    {
        $students = User::query()->activeStudents()
            ->with('studentRegistration:id,user_id,full_name,gender,class')
            ->orderBy('name')
            ->get();

        // Siswa nonaktif yang sudah punya hasil tetap ditampilkan
        $existing = $evaluation->results()->get()->keyBy('user_id');
        $extra = User::with('studentRegistration:id,user_id,full_name,gender,class')
            ->whereIn('id', $existing->keys()->diff($students->pluck('id')))
            ->get();

        return view('jasmani.input', [
            'evaluation' => $evaluation,
            'students'   => $students->concat($extra),
            'existing'   => $existing,
            'items'      => PhysicalEvaluation::ITEMS,
        ]);
    }

    public function saveInput(Request $request, PhysicalEvaluation $evaluation)
    {
        // Terima desimal koma (format Indonesia), mis. "19,5"
        $normalized = collect($request->input('results', []))->map(function ($row) {
            foreach (array_keys(PhysicalEvaluation::ITEMS) as $key) {
                if (isset($row[$key]) && is_string($row[$key])) {
                    $row[$key] = str_replace(',', '.', trim($row[$key]));
                }
            }

            return $row;
        })->all();
        $request->merge(['results' => $normalized]);

        $rules = ['results' => 'array'];
        foreach (PhysicalEvaluation::ITEMS as $key => $item) {
            $rules["results.*.{$key}"] = 'nullable|numeric|min:0|max:' . $item['max'];
        }
        $rules['results.*.notes'] = 'nullable|string|max:255';
        $request->validate($rules, [], [
            'results.*.run_12min_m'      => 'Lari 12 menit',
            'results.*.pull_up_chinning' => 'Pull up / chinning',
            'results.*.push_up'          => 'Push up',
            'results.*.sit_up'           => 'Sit up',
            'results.*.shuttle_run_sec'  => 'Shuttle run',
        ]);

        $input = $request->input('results', []);
        $students = User::role('siswa')
            ->with('studentRegistration:id,user_id,gender')
            ->whereIn('id', array_keys($input))
            ->get()
            ->keyBy('id');

        $saved = $removed = 0;

        DB::transaction(function () use ($input, $students, $evaluation, $request, &$saved, &$removed) {
            foreach ($input as $userId => $values) {
                $student = $students->get((int) $userId);
                if (! $student) {
                    continue;
                }

                $payload = [];
                foreach (PhysicalEvaluation::ITEMS as $key => $item) {
                    $v = $values[$key] ?? null;
                    $v = ($v === '' || $v === null) ? null : str_replace(',', '.', (string) $v);
                    $payload[$key] = $v === null ? null : ($key === 'shuttle_run_sec' ? round((float) $v, 2) : (int) round((float) $v));
                }
                $notes = trim((string) ($values['notes'] ?? '')) ?: null;

                $allEmpty = collect($payload)->every(fn ($v) => $v === null) && ! $notes;

                if ($allEmpty) {
                    $removed += PhysicalEvaluationResult::where('physical_evaluation_id', $evaluation->id)
                        ->where('user_id', $student->id)
                        ->delete();
                    continue;
                }

                PhysicalEvaluationResult::updateOrCreate(
                    ['physical_evaluation_id' => $evaluation->id, 'user_id' => $student->id],
                    $payload + [
                        'notes'       => $notes,
                        'gender'      => $student->studentRegistration?->gender,
                        'recorded_by' => $request->user()->id,
                    ]
                );
                $saved++;
            }
        });

        toast('success', "Hasil evaluasi tersimpan ({$saved} siswa)" . ($removed ? ", {$removed} baris dikosongkan" : '') . '.');

        return redirect()->route('jasmani.show', $evaluation);
    }

    public function export(PhysicalEvaluation $evaluation): StreamedResponse
    {
        $evaluation->load('results.user');
        $results = $evaluation->results->sortBy(fn ($r) => mb_strtolower($r->user?->name ?? ''))->values();

        return response()->streamDownload(function () use ($results) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, ['NO.', 'NAMA', 'L/P', 'LARI 12menit (meter)', 'PULL UP / CHINNING', 'PUSH UP', 'SIT UP', 'SHUTTLE RUN (detik)', 'CATATAN'], ';');
            foreach ($results as $i => $r) {
                fputcsv($out, [
                    $i + 1,
                    $r->user?->name,
                    $r->gender,
                    $r->run_12min_m,
                    $r->pull_up_chinning,
                    $r->push_up,
                    $r->sit_up,
                    $r->shuttle_run_sec === null ? null : str_replace('.', ',', (string) $r->shuttle_run_sec),
                    $r->notes,
                ], ';');
            }
            fclose($out);
        }, 'evaluasi-jasmani-' . $evaluation->period->format('Y-m') . '.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    protected function validateMeta(Request $request): array
    {
        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'period'   => 'required|date_format:Y-m',
            'held_on'  => 'required|date',
            'location' => 'nullable|string|max:255',
            'notes'    => 'nullable|string|max:2000',
        ]);

        $data['period'] = Carbon::createFromFormat('Y-m-d', $data['period'] . '-01')->startOfDay();

        return $data;
    }
}
