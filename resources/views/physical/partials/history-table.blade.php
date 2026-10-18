{{-- Tabel riwayat data fisik. Butuh: $records (urut naik), opsional $editable (admin) --}}
@php $num = fn ($v) => $v === null ? '–' : rtrim(rtrim(number_format($v, 1, ',', '.'), '0'), ','); @endphp
<div class="overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-primary-50/60 dark:bg-primary-800/20 text-xs uppercase tracking-wide text-secondary-500 dark:text-secondary-400">
            <tr>
                <th class="px-4 py-3 text-left">Bulan</th>
                <th class="px-3 py-3 text-right">TB (cm)</th>
                <th class="px-3 py-3 text-right">BB (kg)</th>
                <th class="px-3 py-3 text-left">IMT</th>
                <th class="px-3 py-3 text-left">Penyakit</th>
                <th class="px-3 py-3 text-left">Cedera</th>
                @if($editable ?? false)<th class="px-3 py-3"></th>@endif
            </tr>
        </thead>
        <tbody class="divide-y divide-primary-100 dark:divide-primary-800/30">
            @php $prev = null; @endphp
            @forelse($records as $r)
                @php
                    $dh = $prev ? $r->height_cm - $prev->height_cm : null;
                    $dw = $prev ? $r->weight_kg - $prev->weight_kg : null;
                    $prev = $r;
                @endphp
                <tr class="align-top">
                    <td class="px-4 py-3 font-medium text-primary-800 dark:text-primary-100 whitespace-nowrap">{{ $r->period_label }}</td>
                    <td class="px-3 py-3 text-right tabular-nums text-primary-800 dark:text-primary-100">
                        {{ $num($r->height_cm) }}
                        @if($dh)<span class="block text-[10px] text-secondary-500">{{ $dh > 0 ? '+' : '' }}{{ $num($dh) }}</span>@endif
                    </td>
                    <td class="px-3 py-3 text-right tabular-nums text-primary-800 dark:text-primary-100">
                        {{ $num($r->weight_kg) }}
                        @if($dw)<span class="block text-[10px] text-secondary-500">{{ $dw > 0 ? '+' : '' }}{{ $num($dw) }}</span>@endif
                    </td>
                    <td class="px-3 py-3">@include('physical.partials.bmi-badge', ['bmi' => $r->bmi])</td>
                    <td class="px-3 py-3 text-xs {{ $r->has_illness ? 'text-red-700 dark:text-red-300' : 'text-secondary-400' }}">{{ $r->has_illness ? $r->illness_notes : 'Tidak' }}</td>
                    <td class="px-3 py-3 text-xs {{ $r->has_injury ? 'text-red-700 dark:text-red-300' : 'text-secondary-400' }}">{{ $r->has_injury ? $r->injury_notes : 'Tidak' }}</td>
                    @if($editable ?? false)
                        <td class="px-3 py-3 text-right whitespace-nowrap">
                            <button type="button" @click="$dispatch('edit-record', {{ json_encode([
                                'period' => $r->period->format('Y-m'), 'height_cm' => $r->height_cm, 'weight_kg' => $r->weight_kg,
                                'has_illness' => $r->has_illness, 'illness_notes' => $r->illness_notes,
                                'has_injury' => $r->has_injury, 'injury_notes' => $r->injury_notes, 'notes' => $r->notes,
                            ]) }})" class="text-xs font-medium text-primary-600 dark:text-primary-300 hover:underline mr-2">Ubah</button>
                            <form method="POST" action="{{ route('physical.destroy', $r) }}" class="inline sweet-confirm" data-message="Hapus data {{ $r->period_label }}?">
                                @csrf @method('DELETE')
                                <button class="text-xs font-medium text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-10 text-center text-secondary-500 dark:text-secondary-400">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
