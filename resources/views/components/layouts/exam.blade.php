@props(['title' => null])
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    @include('partials.head', ['title' => $title, 'robots' => 'noindex, nofollow'])
    <link rel="stylesheet" href="{{ asset('vendor/katex/katex.min.css') }}">
    <script defer src="{{ asset('vendor/katex/katex.min.js') }}"></script>
    <script defer src="{{ asset('vendor/katex/contrib/auto-render.min.js') }}" onload="window.renderMath && window.renderMath()"></script>
</head>
<body class="h-full bg-cream">
{{ $slot }}
@include('partials.toaster')
@livewireScriptConfig
@stack('scripts')
</body>
</html>
