{{-- $action, $record (nullable), $withPeriod (bool) --}}
@php $r = $record ?? null; @endphp
<form method="POST" action="{{ $action }}" class="space-y-4" x-data="{ ill: {{ old('has_illness', $r?->has_illness) ? 'true' : 'false' }}, inj: {{ old('has_injury', $r?->has_injury) ? 'true' : 'false' }}, h: '{{ old('height_cm', $r?->height_cm) }}', w: '{{ old('weight_kg', $r?->weight_kg) }}',
    get bmi() { const h = parseFloat(String(this.h).replace(',', '.')) / 100, w = parseFloat(String(this.w).replace(',', '.')); return h > 0 && w > 0 ? (w / (h * h)).toFixed(1) : null } }">
    @csrf
    @if($withPeriod ?? false)
        <x-field label="Bulan" name="period" required><input type="month" name="period" value="{{ old('period', $r?->period?->format('Y-m') ?? now()->format('Y-m')) }}" class="input" required></x-field>
    @endif
    <div class="grid grid-cols-2 gap-3">
        <x-field label="Tinggi badan (cm)" name="height_cm" required><input name="height_cm" x-model="h" inputmode="decimal" type="number" step="0.1" class="input" required></x-field>
        <x-field label="Berat badan (kg)" name="weight_kg" required><input name="weight_kg" x-model="w" inputmode="decimal" type="number" step="0.1" class="input" required></x-field>
    </div>
    <div x-show="bmi" class="flex items-center justify-between rounded-2xl bg-cream px-4 py-3 text-sm"><span class="font-bold">Perkiraan IMT</span><span class="font-display text-xl font-extrabold" x-text="bmi"></span></div>
    <label class="flex items-center gap-3 text-sm font-bold"><input type="hidden" name="has_illness" value="0"><input type="checkbox" name="has_illness" value="1" x-model="ill" class="checkbox"> Sedang/pernah sakit bulan ini</label>
    <div x-show="ill" x-collapse><x-field name="illness_notes"><textarea name="illness_notes" class="textarea" placeholder="Tuliskan penyakit yang dialami…">{{ old('illness_notes', $r?->illness_notes) }}</textarea></x-field></div>
    <label class="flex items-center gap-3 text-sm font-bold"><input type="hidden" name="has_injury" value="0"><input type="checkbox" name="has_injury" value="1" x-model="inj" class="checkbox"> Mengalami cedera</label>
    <div x-show="inj" x-collapse><x-field name="injury_notes"><textarea name="injury_notes" class="textarea" placeholder="Tuliskan cedera yang dialami…">{{ old('injury_notes', $r?->injury_notes) }}</textarea></x-field></div>
    <x-field label="Catatan lain" name="notes"><textarea name="notes" class="textarea !min-h-[70px]">{{ old('notes', $r?->notes) }}</textarea></x-field>
    <button class="btn-primary w-full"><x-icon name="check" class="h-4 w-4"/> Simpan</button>
</form>
