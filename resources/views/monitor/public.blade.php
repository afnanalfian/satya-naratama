<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="referrer" content="no-referrer">
    <link rel="icon" href="/favicon.ico" sizes="any">
    <title>Rapor {{ $student->studentRegistration?->full_name ?: $student->name }} · Satya Naratama</title>
    @vite(['resources/css/app.css'])
    <script>
        (function () {
            const t = localStorage.getItem('theme');
            if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) document.documentElement.classList.add('dark');
        })();
    </script>
</head>
<body class="min-h-screen bg-neutral-50 dark:bg-primary-950 text-primary-900 dark:text-primary-50 antialiased">
    <header class="sticky top-0 z-20 bg-white/90 dark:bg-primary-950/90 backdrop-blur border-b border-primary-100 dark:border-primary-800/40">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('img/logo.png') }}" alt="Satya Naratama" class="w-9 h-9 rounded-lg object-contain bg-white">
                <div>
                    <p class="font-bold leading-tight text-primary-800 dark:text-primary-100">Satya Naratama</p>
                    <p class="text-[11px] text-secondary-500 dark:text-secondary-400 leading-tight">Laporan Perkembangan Siswa</p>
                </div>
            </div>
            <button type="button" onclick="document.documentElement.classList.toggle('dark'); localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light')"
                    class="p-2 rounded-lg text-secondary-500 hover:bg-primary-50 dark:hover:bg-primary-800/40" aria-label="Ganti tema">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
            </button>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-6 space-y-8">
        @include('monitor.partials.report')

        <footer class="pt-4 pb-8 text-center text-xs text-secondary-500 dark:text-secondary-400">
            Laporan ini diperbarui otomatis dari sistem Satya Naratama. Link bersifat pribadi — mohon tidak dibagikan ke pihak lain.
        </footer>
    </main>

    @stack('scripts')
</body>
</html>
