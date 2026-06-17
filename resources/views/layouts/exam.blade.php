<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Halaman Ujian | Azwara Learning')</title>
    <meta name="description" content="@yield('description', 'Kerjakan dengan jujur dan serius agar hasilnya maksimal dan berkah.')">
    <meta name="google-site-verification" content="exlEPP1kFOZJWZ_zxo5Qa-PoW-3oPa-9avX-Xbgcjb4" />
    <meta name="msvalidate.01" content="E0E1D8239606A4386F61EB8D5FC2DED6" />
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://azwaralearning.com{{ request()->getRequestUri() }}">

    <meta property="og:title" content="@yield('title', 'Azwara Learning')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @include('layouts.partials.ga')
    @include('components.structured-data')
</head>

<body class="h-full bg-gray-100 dark:bg-azwara-darkest text-gray-900 dark:text-white">
    @yield('content')
    @stack('script')
</body>
</html>
