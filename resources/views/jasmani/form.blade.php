@extends('layouts.app')

@section('title', $evaluation->exists ? 'Ubah Evaluasi Jasmani' : 'Buat Evaluasi Jasmani')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('jasmani.index') }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300">Evaluasi Jasmani</a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">{{ $evaluation->exists ? 'Ubah' : 'Baru' }}</span>
        </nav>

        <form method="POST" action="{{ $evaluation->exists ? route('jasmani.update', $evaluation) : route('jasmani.store') }}"
              class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm p-6 space-y-5">
            @csrf
            @if($evaluation->exists) @method('PUT') @endif

            <div>
                <h1 class="text-xl font-bold text-primary-900 dark:text-white">{{ $evaluation->exists ? 'Ubah Data Evaluasi' : 'Evaluasi Jasmani Baru' }}</h1>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Setelah disimpan, Anda akan diarahkan ke halaman input hasil per siswa.</p>
            </div>

            @if($errors->any())
                <div class="p-3 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/40 text-sm text-red-700 dark:text-red-300">
                    <ul class="list-disc pl-5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <label class="block">
                <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Judul <span class="text-accent-500">*</span></span>
                <input type="text" name="title" required value="{{ old('title', $evaluation->title) }}" class="input-primary">
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <label class="block">
                    <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Bulan evaluasi <span class="text-accent-500">*</span></span>
                    <input type="month" name="period" required value="{{ old('period', $evaluation->period?->format('Y-m')) }}" class="input-primary">
                </label>
                <label class="block">
                    <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Tanggal pelaksanaan <span class="text-accent-500">*</span></span>
                    <input type="date" name="held_on" required value="{{ old('held_on', $evaluation->held_on?->format('Y-m-d')) }}" class="input-primary">
                </label>
            </div>
            <label class="block">
                <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Lokasi</span>
                <input type="text" name="location" value="{{ old('location', $evaluation->location) }}" placeholder="mis. Lapangan Kantor Bupati" class="input-primary">
            </label>
            <label class="block">
                <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Catatan</span>
                <textarea name="notes" rows="3" class="input-primary">{{ old('notes', $evaluation->notes) }}</textarea>
            </label>

            <div class="flex flex-col-reverse sm:flex-row sm:justify-between gap-3 pt-4 border-t border-primary-100 dark:border-primary-800/30">
                <a href="{{ $evaluation->exists ? route('jasmani.show', $evaluation) : route('jasmani.index') }}" class="px-5 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-sm text-center text-secondary-600 dark:text-secondary-300">Batal</a>
                <button class="px-6 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold">
                    {{ $evaluation->exists ? 'Simpan Perubahan' : 'Simpan & Input Hasil' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
