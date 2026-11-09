<x-layouts.app :title="$evaluation->exists ? 'Ubah Evaluasi' : 'Evaluasi Baru'">
<div class="mx-auto max-w-2xl">
    <x-page-header :title="$evaluation->exists ? 'Ubah Evaluasi Jasmani' : 'Evaluasi Jasmani Baru'" :back="$evaluation->exists ? route('jasmani.show', $evaluation) : route('jasmani.index')"/>
    <form method="POST" action="{{ $evaluation->exists ? route('jasmani.update', $evaluation) : route('jasmani.store') }}" class="card card-pad space-y-4">
        @csrf @if($evaluation->exists) @method('PUT') @endif
        <x-field label="Judul" name="title" required><input name="title" value="{{ old('title', $evaluation->title) }}" class="input" required></x-field>
        <div class="grid gap-4 sm:grid-cols-2">
            <x-field label="Periode (bulan)" name="period" required><input type="month" name="period" value="{{ old('period', $evaluation->period?->format('Y-m')) }}" class="input" required></x-field>
            <x-field label="Tanggal pelaksanaan" name="held_on" required><input type="date" name="held_on" value="{{ old('held_on', $evaluation->held_on?->format('Y-m-d')) }}" class="input" required></x-field>
        </div>
        <x-field label="Lokasi" name="location"><input name="location" value="{{ old('location', $evaluation->location) }}" class="input" placeholder="mis. Lapangan Citra Mas"></x-field>
        <x-field label="Catatan" name="notes"><textarea name="notes" class="textarea">{{ old('notes', $evaluation->notes) }}</textarea></x-field>
        <div class="flex justify-end gap-2"><a href="{{ route('jasmani.index') }}" class="btn-soft">Batal</a><button class="btn-primary"><x-icon name="check" class="h-4 w-4"/> {{ $evaluation->exists ? 'Simpan' : 'Lanjut input hasil' }}</button></div>
    </form>
</div>
</x-layouts.app>
