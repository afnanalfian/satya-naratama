<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azwara Learning</title>
    <meta name="description" content="Bimbel online, tryout beragam, quiz harian, live zoom, materi lengkap, latihan soal terbaru.">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <meta name="google-site-verification" content="exlEPP1kFOZJWZ_zxo5Qa-PoW-3oPa-9avX-Xbgcjb4" />
    <meta name="msvalidate.01" content="E0E1D8239606A4386F61EB8D5FC2DED6" />
    @vite(['resources/css/app.css','resources/js/app.js'])
    @include('layouts.partials.ga')
    <script>
        (function () {
            const storedTheme = localStorage.getItem('theme');

            if (storedTheme === 'dark' ||
                (!storedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    @include('components.structured-data')
</head>

<body
  class="h-screen overflow-hidden flex flex-col
         bg-gradient-to-br from-azwara-lighter via-white to-azwara-light/30
         dark:bg-brand-gradient bg-fixed
         text-azwara-darker dark:text-azwara-lighter
         transition-colors">


    {{-- Navbar --}}
    <nav class="w-full
                bg-azwara-lightest dark:bg-azwara-darkest/80
                backdrop-blur
                border-b border-azwara-light/30
                shadow-sm py-4
                sticky top-0 z-50">
        <div class="container mx-auto px-4 flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
            class="text-xl font-bold text-azwara-darker dark:text-white tracking-wide">
                Azwara<span class="text-primary dark:text-azwara-lighter">Learning</span>
            </a>

            <div class="flex items-center gap-4">

            {{-- Theme Toggle Icon --}}
            <button
                onclick="
                    const html = document.documentElement;
                    const isDark = html.classList.toggle('dark');
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                "
                class="text-azwara-darkest dark:text-azwara-lighter hover:scale-110 transition">

                <!-- Moon (light mode) -->
                <svg class="block dark:hidden" width="24" height="24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79Z"/>
                </svg>

                <!-- Sun (dark mode) -->
                <svg class="hidden dark:block" width="24" height="24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="5"/>
                    <path d="M12 1v2m0 18v2m11-11h-2M3 12H1
                            m16.95 7.95-1.41-1.41
                            M6.46 6.46 5.05 5.05
                            m12.9 0-1.41 1.41
                            M6.46 17.54 5.05 18.95"/>
                </svg>
            </button>

            <a href="{{ route('login') }}"
            class="text-sm font-medium rounded-xl transition
                    {{ request()->routeIs('login')
                        ? 'px-4 py-2 bg-primary text-white font-semibold shadow hover:shadow-lg hover:scale-105'
                        : 'text-gray-700 dark:text-gray-300 hover:text-primary' }}">
                Login
            </a>

            <a href="{{ route('register') }}"
            class="text-sm font-medium rounded-xl transition
                    {{ request()->routeIs('register')
                        ? 'px-4 py-2 bg-primary text-white font-semibold shadow hover:shadow-lg hover:scale-105'
                        : 'text-gray-700 dark:text-gray-300 hover:text-primary' }}">
                Register
            </a>
            </div>
        </div>
    </nav>

    {{-- Page content --}}
    <main class="flex-1 overflow-y-auto">
        @yield('content')
        {{-- Footer --}}
        <footer
        class="py-6 text-center text-sm
                text-gray-600 dark:text-gray-400
                border-t border-azwara-light/30
                backdrop-blur-sm">
        © {{ date('Y') }} Azwara Learning
        </footer>
    </main>
    @include('layouts.partials.toast')
    @stack('scripts')
</body>
</html>
