@props(['title' => null, 'description' => null, 'robots' => null, 'bare' => false])
<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head', ['title' => $title, 'description' => $description, 'robots' => $robots])
    {{ $head ?? '' }}
</head>
<body class="min-h-screen overflow-x-hidden bg-cream">
@unless($bare)
<header x-data="{ o: false, s: false }" @scroll.window="s = window.scrollY > 10"
        class="fixed inset-x-0 top-0 z-50 transition" :class="s ? 'bg-cream/85 backdrop-blur-md shadow-soft' : ''">
    <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-4 sm:h-20 sm:px-6">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <img src="{{ asset('img/logo.png') }}" alt="Satya Naratama" class="h-10 w-10 object-contain sm:h-12 sm:w-12">
            <span class="hidden font-display text-lg font-extrabold leading-none min-[440px]:inline sm:text-xl">Satya<span class="text-garnet-600">Naratama</span></span>
        </a>
        <nav class="ml-auto hidden items-center gap-1 text-sm font-bold text-ink-700 lg:flex">
            <a href="{{ route('home') }}#program" class="rounded-xl px-3 py-2 hover:bg-white">Program</a>
            <a href="{{ route('home') }}#jadwal" class="rounded-xl px-3 py-2 hover:bg-white">Jadwal</a>
            <a href="{{ route('home') }}#tentor" class="rounded-xl px-3 py-2 hover:bg-white">Tentor</a>
            <a href="{{ route('tutorial') }}" class="rounded-xl px-3 py-2 hover:bg-white">Tutorial</a>
            <a href="{{ route('daftar.status.form') }}" class="rounded-xl px-3 py-2 hover:bg-white">Cek Status</a>
        </nav>
        <div class="ml-auto flex items-center gap-2 lg:ml-2">
            @auth
                <a href="{{ route('dashboard.redirect') }}" class="btn-ink btn-sm">Dashboard <x-icon name="arrow-right" class="h-4 w-4"/></a>
            @else
                <a href="{{ route('login') }}" class="btn-ghost hidden sm:inline-flex">Masuk</a>
                <a href="{{ route('daftar.form') }}" class="btn-primary btn-sm">Daftar<span class="hidden sm:inline">&nbsp;Sekarang</span></a>
            @endauth
            <button class="btn-icon btn-ghost lg:hidden" @click="o = !o" aria-label="Menu"><x-icon name="menu" class="h-6 w-6"/></button>
        </div>
    </div>
    <div x-show="o" x-collapse x-cloak class="border-t border-ink-100 bg-cream lg:hidden">
        <div class="grid gap-1 px-4 py-3 text-sm font-bold">
            <a @click="o=false" href="{{ route('home') }}#program" class="rounded-xl px-3 py-2.5 hover:bg-white">Program</a>
            <a @click="o=false" href="{{ route('home') }}#jadwal" class="rounded-xl px-3 py-2.5 hover:bg-white">Jadwal</a>
            <a @click="o=false" href="{{ route('home') }}#tentor" class="rounded-xl px-3 py-2.5 hover:bg-white">Tentor</a>
            <a href="{{ route('tutorial') }}" class="rounded-xl px-3 py-2.5 hover:bg-white">Tutorial</a>
            <a href="{{ route('daftar.status.form') }}" class="rounded-xl px-3 py-2.5 hover:bg-white">Cek Status Pendaftaran</a>
            @guest<a href="{{ route('login') }}" class="rounded-xl px-3 py-2.5 hover:bg-white">Masuk</a>@endguest
        </div>
    </div>
</header>
<div class="h-16 sm:h-20"></div>
@endunless

<main>{{ $slot }}</main>

@unless($bare)
<footer class="relative mt-20 overflow-hidden bg-ink-950 text-ink-200">
    <div class="absolute inset-0 bg-grid-ink [background-size:36px_36px]"></div>
    <div class="blob -left-24 top-0 h-72 w-72 bg-garnet-700/40"></div>
    <div class="relative mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 md:grid-cols-4">
        <div class="md:col-span-2">
            <div class="flex items-center gap-3">
                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-white p-1.5"><img src="{{ asset('img/logo.png') }}" alt="" class="h-full w-full object-contain"></span>
                <span class="font-display text-2xl font-extrabold text-white">Satya<span class="text-saffron-400">Naratama</span></span>
            </div>
            <p class="mt-4 max-w-md text-sm leading-relaxed text-ink-300">Bimbingan belajar persiapan sekolah kedinasan & TNI–POLRI di Pangkajene dan Kepulauan. Kelas akademik, latihan jasmani terukur, kuis harian, dan tryout berstandar CAT.</p>
            <div class="mt-5 flex gap-2">
                <a href="https://www.instagram.com/satya.naratama" target="_blank" rel="noopener" class="grid h-10 w-10 place-items-center rounded-xl bg-white/10 hover:bg-garnet-600" aria-label="Instagram"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/></svg></a>
                <a href="https://www.tiktok.com/@satya.naratama" target="_blank" rel="noopener" class="grid h-10 w-10 place-items-center rounded-xl bg-white/10 hover:bg-garnet-600" aria-label="TikTok"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 3v11.5a3.5 3.5 0 1 1-3.5-3.5M14 3c.5 2.5 2.5 4.5 5 4.5"/></svg></a>
                <a href="https://www.youtube.com/@SatyaNaratama" target="_blank" rel="noopener" class="grid h-10 w-10 place-items-center rounded-xl bg-white/10 hover:bg-garnet-600" aria-label="YouTube"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="5" width="20" height="14" rx="4"/><path d="M10 9l5 3-5 3V9Z"/></svg></a>
            </div>
        </div>
        <div>
            <p class="font-display text-sm font-bold uppercase tracking-widest text-saffron-400">Jelajahi</p>
            <ul class="mt-4 space-y-2 text-sm">
                <li><a class="hover:text-white" href="{{ route('home') }}#program">Program Belajar</a></li>
                <li><a class="hover:text-white" href="{{ route('daftar.form') }}">Pendaftaran Siswa</a></li>
                <li><a class="hover:text-white" href="{{ route('daftar.status.form') }}">Cek Status Pendaftaran</a></li>
                <li><a class="hover:text-white" href="{{ route('tutorial') }}">Tutorial Penggunaan</a></li>
                <li><a class="hover:text-white" href="{{ route('login') }}">Masuk Akun</a></li>
            </ul>
        </div>
        <div>
            <p class="font-display text-sm font-bold uppercase tracking-widest text-saffron-400">Kontak</p>
            <ul class="mt-4 space-y-3 text-sm">
                <li class="flex gap-2"><x-icon name="whatsapp" class="h-5 w-5 shrink-0 text-lagoon-400"/><a href="https://wa.me/6285141339645" class="hover:text-white">+62 851-4133-9645</a></li>
                <li class="flex gap-2"><x-icon name="mail" class="h-5 w-5 shrink-0 text-saffron-400"/><a href="mailto:satyanaratama@gmail.com" class="hover:text-white">satyanaratama@gmail.com</a></li>
                <li class="flex gap-2"><x-icon name="map" class="h-5 w-5 shrink-0 text-garnet-400"/><span>Pangkajene dan Kepulauan, Sulawesi Selatan</span></li>
            </ul>
        </div>
    </div>
    <div class="relative border-t border-white/10 py-5 text-center text-xs text-ink-400">© {{ date('Y') }} Satya Naratama. Semua hak dilindungi.</div>
</footer>
@endunless

@include('partials.toaster')
@livewireScriptConfig
@stack('scripts')
</body>
</html>
