@extends('layouts.app')

@section('title', 'Kartu QR Siswa')

@section('content')
<div class="py-6 md:py-8" x-data="{ selected: [] }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3 mb-5">
            <div>
                <h1 class="text-2xl font-bold text-primary-900 dark:text-white">Kartu QR Siswa</h1>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">
                    Setiap siswa punya QR unik untuk absensi. Siswa juga bisa membuka QR-nya sendiri di menu <strong>QR Absensi</strong>.
                </p>
            </div>
            <div class="flex gap-2">
                <a :href="'{{ route('attendance.qr-cards', ['print' => 1]) }}' + (selected.length ? '&ids=' + selected.join(',') : '')" target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    <span x-text="selected.length ? 'Cetak ' + selected.length + ' kartu' : 'Cetak semua kartu'"></span>
                </a>
            </div>
        </div>

        @include('attendance.partials.nav')

        <form method="GET" class="mb-6 flex gap-2 max-w-md">
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama siswa..."
                   class="flex-1 rounded-xl border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100">
            <button class="px-4 py-2 rounded-xl bg-secondary-600 hover:bg-secondary-700 text-white text-sm font-medium">Cari</button>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @forelse($students as $s)
                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm p-4 flex flex-col items-center text-center"
                     :class="selected.includes({{ $s->id }}) ? 'ring-2 ring-primary-500' : ''">
                    <label class="self-start flex items-center gap-2 text-xs text-secondary-500 dark:text-secondary-400 cursor-pointer">
                        <input type="checkbox" value="{{ $s->id }}" x-model.number="selected" class="rounded border-primary-300 text-primary-600 focus:ring-primary-500">
                        Pilih
                    </label>
                    <div class="bg-white p-2 rounded-xl mt-1">
                        <div data-qr="{{ $s->qr_payload }}" data-size="148" class="w-[148px] h-[148px]"></div>
                    </div>
                    <p class="mt-3 font-semibold text-primary-800 dark:text-primary-100 leading-tight">{{ $s->name }}</p>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">
                        {{ $s->studentRegistration?->class ? 'Kelas ' . $s->studentRegistration->class : 'Siswa' }}
                        {{ $s->studentRegistration?->gender ? '· ' . ($s->studentRegistration->gender === 'L' ? 'Putra' : 'Putri') : '' }}
                    </p>
                    <p class="mt-1 text-[10px] font-mono text-secondary-400 dark:text-secondary-500 break-all">{{ $s->qr_payload }}</p>
                    <form method="POST" action="{{ route('attendance.qr-regenerate', $s) }}" class="sweet-confirm mt-3"
                          data-message="Buat QR baru untuk {{ $s->name }}? QR/kartu lama tidak berlaku lagi.">
                        @csrf
                        <button class="text-xs text-red-600 dark:text-red-400 hover:underline">Perbarui QR (kartu hilang)</button>
                    </form>
                </div>
            @empty
                <p class="col-span-full py-12 text-center text-secondary-500 dark:text-secondary-400">Tidak ada siswa aktif.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('attendance.partials.qr-script')
@endpush
