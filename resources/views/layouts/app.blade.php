<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    @include('layouts.partials.head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @include('layouts.partials.ga')
    @include('components.structured-data')
</head>

<body
    class="flex h-screen overflow-hidden
           bg-gradient-to-br from-azwara-lighter via-azwara-medium/20 to-white
           dark:bg-brand-gradient
           bg-fixed bg-no-repeat bg-[length:200%_200%]
           transition-all duration-500">

    @include('layouts.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen relative z-10">
        @include('layouts.partials.header')

        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
            @include('layouts.partials.footer')
        </main>
    </div>
    @include('layouts.partials.toast')
    @stack('scripts')
</body>
</html>
