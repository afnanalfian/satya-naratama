@extends('layouts.app')

@section('title', 'Data Fisik · ' . $student->name)

@section('content')
<div class="py-6 md:py-8" x-data="{ open: false, form: {} }" @edit-record.window="form = $event.detail; open = true">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('physical.index') }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300">Data Fisik</a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">{{ $student->name }}</span>
        </nav>

        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm mb-6 flex flex-col sm:flex-row sm:items-center gap-4">
            <img src="{{ $student->avatar_url }}" class="w-14 h-14 rounded-full object-cover" alt="">
            <div class="flex-1">
                <h1 class="text-xl font-bold text-primary-900 dark:text-white">{{ $student->name }}</h1>
                <p class="text-sm text-secondary-500 dark:text-secondary-400">{{ $student->studentRegistration?->gender_label }} · {{ $records->count() }} bulan tercatat</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('monitor.student', $student) }}" class="px-4 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-sm font-medium text-secondary-700 dark:text-secondary-200">Rapor Lengkap</a>
                @role('admin')
                <button type="button" @click="form = { period: '{{ now()->format('Y-m') }}' }; open = true" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium">+ Tambah / Ubah Bulan</button>
                @endrole
            </div>
        </div>

        @if($errors->any())
            <div class="mb-6 p-3 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/40 text-sm text-red-700 dark:text-red-300">
                Data gagal disimpan: {{ $errors->first() }}
            </div>
        @endif

        @if($records->isNotEmpty())
            <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 p-5 shadow-sm mb-6">
                @include('physical.partials.charts', ['chart' => $chart, 'prefix' => 'stu'])
            </div>
        @endif

        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-primary-100 dark:border-primary-800/30"><h2 class="font-semibold text-primary-800 dark:text-primary-100">Riwayat Bulanan</h2></div>
            @include('physical.partials.history-table', ['records' => $records, 'editable' => auth()->user()->hasRole('admin')])
        </div>
    </div>

    @role('admin')
    {{-- Modal admin: tambah / ubah data bulan mana pun --}}
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4" @keydown.escape.window="open = false">
        <div @click.outside="open = false" class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-2xl bg-white dark:bg-primary-900 p-6 shadow-2xl">
            <h3 class="text-lg font-bold text-primary-900 dark:text-white mb-1">Data Fisik {{ $student->name }}</h3>
            <p class="text-xs text-secondary-500 dark:text-secondary-400 mb-4">Jika bulan sudah ada datanya, data akan diperbarui.</p>
            <template x-if="open">
                <form method="POST" action="{{ route('physical.student.store', $student) }}" class="space-y-4"
                      x-init="$nextTick(() => {
                          const f = $el;
                          f.period.value = form.period || '';
                          f.height_cm.value = form.height_cm ?? '';
                          f.weight_kg.value = form.weight_kg ?? '';
                          f.querySelector('[name=has_illness][value=\'' + (form.has_illness ? 1 : 0) + '\']').click();
                          f.querySelector('[name=has_injury][value=\'' + (form.has_injury ? 1 : 0) + '\']').click();
                          f.illness_notes.value = form.illness_notes ?? '';
                          f.injury_notes.value = form.injury_notes ?? '';
                          f.notes.value = form.notes ?? '';
                      })">
                    @csrf
                    @include('physical.partials.form-fields', ['record' => null, 'withPeriod' => true])
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="open = false" class="px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 text-sm text-secondary-600 dark:text-secondary-300">Batal</button>
                        <button class="px-5 py-2.5 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold">Simpan</button>
                    </div>
                </form>
            </template>
        </div>
    </div>
    @endrole
</div>
@endsection
