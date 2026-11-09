<x-layouts.public title="Pantauan Belajar {{ $student->display_name }}" robots="noindex, nofollow" :bare="true">
    <div class="border-b border-ink-100 bg-white/70 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center gap-3 px-4 py-4 sm:px-6">
            <img src="{{ asset('img/logo.png') }}" class="h-10 w-10 object-contain" alt="">
            <div class="flex-1"><p class="font-display font-extrabold">Satya<span class="text-garnet-600">Naratama</span></p><p class="text-xs text-ink-400">Laporan untuk orang tua/wali · diperbarui {{ now()->translatedFormat('d F Y, H:i') }}</p></div>
            <button onclick="window.print()" class="btn-soft btn-sm no-print"><x-icon name="printer" class="h-4 w-4"/> Cetak</button>
        </div>
    </div>
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6">
        @include('monitor.partials.report')
        <p class="mt-10 text-center text-xs text-ink-400">Link ini bersifat pribadi. Ada pertanyaan? <a class="link" href="https://wa.me/{{ config('satya.cs_wa') }}" target="_blank">Hubungi admin</a>.</p>
    </div>
</x-layouts.public>
