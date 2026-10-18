@php
    $cat = \App\Models\StudentPhysicalRecord::bmiCategory($bmi);
    $tone = [
        'emerald' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300',
        'amber' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
        'red' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
    ];
@endphp
@if($cat)
    <span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2 py-0.5 rounded-full {{ $tone[$cat['tone']] }}">
        IMT {{ number_format($bmi, 1, ',', '') }} · {{ $cat['label'] }}
    </span>
@endif
