@extends('layouts.app')

@section('title', 'Scan Absensi')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-5">
            <h1 class="text-2xl font-bold text-primary-900 dark:text-white">Scan Absensi</h1>
            <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">Pilih pertemuan, lalu scan QR code siswa untuk mencatat kehadiran beserta jamnya.</p>
        </div>

        @include('attendance.partials.nav')

        {{-- Hari ini --}}
        <section class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden mb-6">
            <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30 flex items-center justify-between">
                <h2 class="font-semibold text-primary-800 dark:text-primary-100">Hari ini · {{ now()->translatedFormat('l, d F Y') }}</h2>
                <span class="text-xs text-secondary-500 dark:text-secondary-400">{{ $today->count() }} pertemuan</span>
            </div>
            <div class="divide-y divide-primary-100 dark:divide-primary-800/30">
                @forelse($today as $m)
                    @include('attendance.partials.meeting-row')
                @empty
                    <div class="px-5 py-12 text-center">
                        <p class="text-sm text-secondary-500 dark:text-secondary-400">Tidak ada pertemuan terjadwal hari ini.</p>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- Mendatang --}}
        @if($upcoming->isNotEmpty())
        <section class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden mb-6">
            <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30">
                <h2 class="font-semibold text-primary-800 dark:text-primary-100">Pertemuan Mendatang</h2>
            </div>
            <div class="divide-y divide-primary-100 dark:divide-primary-800/30">
                @foreach($upcoming as $m)
                    @include('attendance.partials.meeting-row')
                @endforeach
            </div>
        </section>
        @endif

        {{-- Lampau: absensi manual (admin) --}}
        @if($isAdmin && $past)
        <section class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30 flex flex-wrap items-center justify-between gap-2">
                <div>
                    <h2 class="font-semibold text-primary-800 dark:text-primary-100">Pertemuan Lampau · Absensi Manual</h2>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Khusus admin: koreksi atau isi absensi pertemuan yang sudah lewat.</p>
                </div>
                <span class="text-[11px] font-semibold px-2 py-1 rounded-lg bg-accent-50 text-accent-700 dark:bg-accent-900/30 dark:text-accent-200">ADMIN</span>
            </div>
            <div class="divide-y divide-primary-100 dark:divide-primary-800/30">
                @forelse($past as $m)
                    @include('attendance.partials.meeting-row')
                @empty
                    <div class="px-5 py-10 text-center text-sm text-secondary-500 dark:text-secondary-400">Belum ada pertemuan lampau.</div>
                @endforelse
            </div>
            @if($past->hasPages())
                <div class="px-5 py-4 border-t border-primary-100 dark:border-primary-800/30">{{ $past->links() }}</div>
            @endif
        </section>
        @endif
    </div>
</div>
@endsection
