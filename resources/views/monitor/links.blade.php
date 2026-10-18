@extends('layouts.app')

@section('title', 'Link Pantauan Orang Tua')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-primary-900 dark:text-white">Link Pantauan Orang Tua</h1>
            <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1">
                Setiap siswa punya link rahasia yang bisa dibuka orang tua <strong>tanpa login</strong> untuk memantau presensi, tryout, evaluasi jasmani, dan data fisik.
                Jika link tersebar ke pihak lain, klik <em>Buat ulang</em> — link lama otomatis tidak berlaku.
            </p>
        </div>

        <form method="GET" class="mb-5 flex gap-2 max-w-md">
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama siswa / orang tua..."
                   class="flex-1 rounded-xl border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-sm text-primary-800 dark:text-primary-100">
            <button class="px-4 py-2 rounded-xl bg-secondary-600 hover:bg-secondary-700 text-white text-sm font-medium">Cari</button>
        </form>

        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden">
            <ul class="divide-y divide-primary-100 dark:divide-primary-800/30">
                @forelse($students as $s)
                    @php
                        $reg = $s->studentRegistration;
                        $url = $s->parent_monitor_url;
                        $parentWa = $reg?->parent_phone ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $reg->parent_phone)) : null;
                        $msg = "Assalamu'alaikum Bapak/Ibu " . ($reg?->parent_name ?? '') . ",\n\nBerikut link untuk memantau perkembangan ananda {$s->name} di Satya Naratama (presensi, tryout, evaluasi jasmani, dan data fisik):\n{$url}\n\nLink ini bersifat pribadi, mohon tidak dibagikan. Terima kasih.";
                    @endphp
                    <li class="px-5 py-4 flex flex-col lg:flex-row lg:items-center gap-3" x-data="{ copied: false }">
                        <div class="flex items-center gap-3 lg:w-72 shrink-0">
                            <img src="{{ $s->avatar_url }}" class="w-10 h-10 rounded-full object-cover" alt="">
                            <div class="min-w-0">
                                <p class="font-medium text-primary-800 dark:text-primary-100 truncate">{{ $s->name }}
                                    @unless($s->is_active)<span class="text-[10px] font-semibold text-red-600 ml-1">NONAKTIF</span>@endunless
                                </p>
                                <p class="text-xs text-secondary-500 dark:text-secondary-400 truncate">
                                    Ortu: {{ $reg?->parent_name ?? '–' }}{{ $reg?->parent_phone ? ' · ' . $reg->parent_phone : '' }}
                                </p>
                            </div>
                        </div>
                        <input type="text" readonly value="{{ $url }}" @focus="$el.select()"
                               class="flex-1 min-w-0 rounded-xl border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-xs font-mono text-secondary-600 dark:text-secondary-300">
                        <div class="flex flex-wrap gap-2 shrink-0">
                            <button type="button" @click="navigator.clipboard.writeText(@js($url)); copied = true; setTimeout(() => copied = false, 2000)"
                                    class="px-3 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-xs font-medium text-primary-700 dark:text-primary-200 hover:bg-primary-50 dark:hover:bg-primary-800/30">
                                <span x-text="copied ? 'Tersalin ✓' : 'Salin'"></span>
                            </button>
                            @if($parentWa)
                                <a href="https://wa.me/{{ $parentWa }}?text={{ rawurlencode($msg) }}" target="_blank" rel="noopener"
                                   class="px-3 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium">Kirim WA</a>
                            @endif
                            <a href="{{ $url }}" target="_blank" class="px-3 py-2 rounded-xl border border-primary-200 dark:border-primary-700/50 text-xs font-medium text-primary-700 dark:text-primary-200 hover:bg-primary-50 dark:hover:bg-primary-800/30">Buka</a>
                            <form method="POST" action="{{ route('monitor.regenerate', $s) }}" class="sweet-confirm" data-message="Buat link baru untuk {{ $s->name }}? Link lama tidak bisa dibuka lagi.">
                                @csrf
                                <button class="px-3 py-2 rounded-xl text-xs font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">Buat ulang</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="px-5 py-12 text-center text-secondary-500 dark:text-secondary-400">Tidak ada siswa.</li>
                @endforelse
            </ul>
        </div>

        @if($students->hasPages())
            <div class="mt-6">{{ $students->links() }}</div>
        @endif
    </div>
</div>
@endsection
