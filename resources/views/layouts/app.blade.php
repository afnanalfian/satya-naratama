<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    @include('layouts.partials.head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @include('layouts.partials.ga')
    @include('components.structured-data')

    {{-- Inisialisasi dark mode di head --}}
    <script>
        (function() {
            const storedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (storedTheme === 'dark' || (!storedTheme && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>

<body
    class="flex h-screen overflow-hidden
           bg-gradient-to-br from-neutral-50 via-primary-50/30 to-neutral-100
           dark:bg-gradient-to-br dark:from-primary-900 dark:via-primary-800/80 dark:to-primary-950
           bg-fixed bg-no-repeat bg-[length:200%_200%]
           transition-all duration-500">

    @include('layouts.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen relative z-10 overflow-hidden">
        @include('layouts.partials.header')

        <main class="flex-1 p-6 overflow-y-auto
                    bg-white/60 dark:bg-primary-950/40
                    backdrop-blur-sm
                    rounded-tl-3xl
                    transition-all duration-300">
            @yield('content')
            @include('layouts.partials.footer')
        </main>
    </div>
    @include('layouts.partials.toast')
    @stack('scripts')
</body>
</html>
