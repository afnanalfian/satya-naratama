@extends('layouts.app')

@section('title', 'Rapor · ' . $student->name)

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('siswa.show', $student->id) }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300">{{ $student->name }}</a>
                <span class="text-secondary-300 dark:text-secondary-600">/</span>
                <span class="text-primary-600 dark:text-primary-300 font-medium">Rapor Perkembangan</span>
            </nav>
            @role('admin')
                <div x-data="{ copied: false }" class="flex gap-2">
                    <button type="button" @click="navigator.clipboard.writeText('{{ $student->parent_monitor_url }}'); copied = true; setTimeout(() => copied = false, 2000)"
                            class="px-4 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-sm font-medium text-primary-700 dark:text-primary-200 hover:bg-primary-50 dark:hover:bg-primary-800/30">
                        <span x-text="copied ? 'Link tersalin ✓' : 'Salin link orang tua'"></span>
                    </button>
                    <a href="{{ $student->parent_monitor_url }}" target="_blank" class="px-4 py-2 rounded-xl bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium">Buka tampilan orang tua</a>
                </div>
            @endrole
        </div>

        @include('monitor.partials.report')
    </div>
</div>
@endsection
