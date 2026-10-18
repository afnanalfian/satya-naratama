{{-- Field data fisik. Opsional: $record (nilai awal), $withPeriod (bool), $periodValue --}}
@php $r = $record ?? null; @endphp
<div x-data="{ ill: {{ old('has_illness', $r?->has_illness) ? 'true' : 'false' }}, inj: {{ old('has_injury', $r?->has_injury) ? 'true' : 'false' }} }" class="space-y-4">
    @if($withPeriod ?? false)
        <label class="block">
            <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Bulan <span class="text-accent-500">*</span></span>
            <input type="month" name="period" required value="{{ old('period', $periodValue ?? now()->format('Y-m')) }}" class="input-primary">
        </label>
    @endif

    <div class="grid grid-cols-2 gap-4">
        <label class="block">
            <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Tinggi badan <span class="text-accent-500">*</span></span>
            <div class="relative">
                <input type="number" step="0.1" min="100" max="250" name="height_cm" required value="{{ old('height_cm', $r?->height_cm) }}" class="input-primary pr-12" placeholder="170">
                <span class="absolute right-4 top-1/2 -translate-y-1/2 mt-0.5 text-sm text-secondary-400">cm</span>
            </div>
        </label>
        <label class="block">
            <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Berat badan <span class="text-accent-500">*</span></span>
            <div class="relative">
                <input type="number" step="0.1" min="20" max="250" name="weight_kg" required value="{{ old('weight_kg', $r?->weight_kg) }}" class="input-primary pr-12" placeholder="60">
                <span class="absolute right-4 top-1/2 -translate-y-1/2 mt-0.5 text-sm text-secondary-400">kg</span>
            </div>
        </label>
    </div>

    <div class="rounded-xl border border-primary-200 dark:border-primary-700/50 p-4">
        <p class="text-sm font-medium text-primary-700 dark:text-primary-300">Apakah sedang / pernah sakit bulan ini?</p>
        <div class="mt-2 flex gap-2">
            <label class="flex-1 cursor-pointer"><input type="radio" name="has_illness" value="0" class="sr-only peer" @change="ill=false" {{ old('has_illness', $r?->has_illness) ? '' : 'checked' }}>
                <span class="block text-center px-3 py-2 rounded-lg border text-sm peer-checked:bg-emerald-50 peer-checked:border-emerald-400 peer-checked:text-emerald-700 dark:peer-checked:bg-emerald-900/20 dark:peer-checked:text-emerald-300 border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300">Tidak</span></label>
            <label class="flex-1 cursor-pointer"><input type="radio" name="has_illness" value="1" class="sr-only peer" @change="ill=true" {{ old('has_illness', $r?->has_illness) ? 'checked' : '' }}>
                <span class="block text-center px-3 py-2 rounded-lg border text-sm peer-checked:bg-red-50 peer-checked:border-red-400 peer-checked:text-red-700 dark:peer-checked:bg-red-900/20 dark:peer-checked:text-red-300 border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300">Ya</span></label>
        </div>
        <textarea x-show="ill" x-cloak name="illness_notes" rows="2" :required="ill" placeholder="Sebutkan penyakit, lama sakit, dan pengobatannya (mis. demam 3 hari, sudah sembuh)"
                  class="input-primary mt-3">{{ old('illness_notes', $r?->illness_notes) }}</textarea>
    </div>

    <div class="rounded-xl border border-primary-200 dark:border-primary-700/50 p-4">
        <p class="text-sm font-medium text-primary-700 dark:text-primary-300">Apakah mengalami cedera bulan ini?</p>
        <div class="mt-2 flex gap-2">
            <label class="flex-1 cursor-pointer"><input type="radio" name="has_injury" value="0" class="sr-only peer" @change="inj=false" {{ old('has_injury', $r?->has_injury) ? '' : 'checked' }}>
                <span class="block text-center px-3 py-2 rounded-lg border text-sm peer-checked:bg-emerald-50 peer-checked:border-emerald-400 peer-checked:text-emerald-700 dark:peer-checked:bg-emerald-900/20 dark:peer-checked:text-emerald-300 border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300">Tidak</span></label>
            <label class="flex-1 cursor-pointer"><input type="radio" name="has_injury" value="1" class="sr-only peer" @change="inj=true" {{ old('has_injury', $r?->has_injury) ? 'checked' : '' }}>
                <span class="block text-center px-3 py-2 rounded-lg border text-sm peer-checked:bg-red-50 peer-checked:border-red-400 peer-checked:text-red-700 dark:peer-checked:bg-red-900/20 dark:peer-checked:text-red-300 border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-300">Ya</span></label>
        </div>
        <textarea x-show="inj" x-cloak name="injury_notes" rows="2" :required="inj" placeholder="Bagian tubuh yang cedera dan kondisinya (mis. keseleo pergelangan kaki kiri)"
                  class="input-primary mt-3">{{ old('injury_notes', $r?->injury_notes) }}</textarea>
    </div>

    <label class="block">
        <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Catatan lain</span>
        <textarea name="notes" rows="2" class="input-primary" placeholder="opsional">{{ old('notes', $r?->notes) }}</textarea>
    </label>
</div>
