{{-- Backdrop mobile.

     `data-sidebar-close` dipakai oleh event delegation di
     resources/js/sidebar.js. Listener-nya menempel di `document`,
     bukan di elemen ini, sehingga tetap berfungsi walau elemen ini
     dirender ulang (Livewire, wire:navigate, bfcache). Jangan hapus
     atributnya. --}}
<div id="sidebar-backdrop"
     data-sidebar-close
     aria-hidden="true"
     class="fixed inset-0 bg-primary-900/40 backdrop-blur-sm hidden z-40">
</div>

<aside id="sidebar"
       aria-hidden="true"
       class="fixed md:static z-50 inset-y-0 left-0 w-72
              min-h-screen
              bg-gradient-to-b from-primary-50 via-white to-neutral-50
              dark:bg-gradient-to-b dark:from-primary-900 dark:via-primary-950 dark:to-primary-950
              border-r border-primary-200/50 dark:border-primary-800/50
              transform -translate-x-full
              transition-transform duration-300 ease-in-out
              flex flex-col shadow-2xl md:shadow-none">

    {{-- Brand Section --}}
    <div class="flex-shrink-0 flex flex-col items-center py-8 gap-3
                border-b border-primary-200/30 dark:border-primary-800/30
                relative"> {{-- Tambahkan relative --}}

        {{-- Tombol close untuk mobile.
             `data-sidebar-close` adalah jalur utamanya; atribut
             onclick dipertahankan sebagai cadangan kalau sidebar.js
             belum sempat ter-load. --}}
        <button type="button"
                data-sidebar-close
                onclick="closeSidebar()"
                aria-label="Tutup menu"
                class="md:hidden absolute top-4 right-4 p-2 rounded-full
                       hover:bg-primary-100/50 dark:hover:bg-primary-800/50
                       text-primary-700 dark:text-primary-300
                       transition-all duration-200
                       z-50"> {{-- Tambahkan z-50 --}}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- Logo with Glow Effect --}}
        <a href="{{ route('dashboard.redirect') }}" class="relative group">
            <div class="w-24 h-24 rounded-2xl overflow-hidden
                        border-2 border-primary-500/30 dark:border-primary-400/30
                        shadow-lg shadow-primary-500/20 dark:shadow-primary-400/10
                        group-hover:shadow-xl group-hover:shadow-primary-500/30
                        transition-all duration-300
                        bg-white dark:bg-primary-800">
                <img src="{{ asset('img/logo.png') }}"
                    alt="Logo"
                    class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300">
            </div>

            {{-- Glow Ring --}}
            <div class="absolute -inset-1 rounded-2xl bg-primary-500/20 dark:bg-primary-400/10 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>
        </a>

        {{-- Brand Name --}}
        <div class="text-center">
            <h1 class="text-xl font-bold text-primary-700 dark:text-primary-200 tracking-tight">
                Satya Naratama
            </h1>
            <p class="text-xs text-secondary-500 dark:text-secondary-400 font-medium tracking-wider uppercase">
                Learning Management System
            </p>
        </div>
    </div>

    {{-- Menu Navigation --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6
                scrollbar-thin scrollbar-thumb-primary-400/30 dark:scrollbar-thumb-primary-600/30
                scrollbar-track-transparent">

        <div class="space-y-1">
            @role('admin')
                @include('layouts.partials.menus.admin')
            @endrole

            @role('tentor')
                @include('layouts.partials.menus.tentor')
            @endrole

            @role('siswa')
                @include('layouts.partials.menus.siswa')
            @endrole
        </div>

        {{-- Footer Menu --}}
        <div class="mt-8 pt-6 border-t border-primary-200/30 dark:border-primary-800/30">
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl
                      text-secondary-600 dark:text-secondary-400
                      hover:bg-primary-100/50 dark:hover:bg-primary-800/50
                      hover:text-primary-700 dark:hover:text-primary-300
                      transition-all duration-200 text-sm font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Beranda</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-1">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl
                               text-red-600 dark:text-red-400
                               hover:bg-red-50 dark:hover:bg-red-900/20
                               transition-all duration-200 text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
