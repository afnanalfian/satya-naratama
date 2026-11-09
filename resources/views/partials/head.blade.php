@php
    $siteTitle = 'Satya Naratama – Bimbel Kedinasan TNI POLRI, Quiz Harian, & Tryout';
    $pageTitle = isset($title) && $title ? (str_contains($title, 'Satya') ? $title : $title.' · Satya Naratama') : $siteTitle;
    $pageDesc = $description ?? 'Bimbel Kedinasan TNI POLRI, tryout beragam, quiz harian, live zoom, materi lengkap, latihan soal terbaru.';
@endphp
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="theme-color" content="#22173a">
<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDesc }}">
<meta name="robots" content="{{ $robots ?? 'index, follow' }}">
<link rel="canonical" href="{{ url()->current() }}">
<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">
<meta name="google-site-verification" content="exlEPP1kFOZJWZ_zxo5Qa-PoW-3oPa-9avX-Xbgcjb4">
<meta name="msvalidate.01" content="E0E1D8239606A4386F61EB8D5FC2DED6">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDesc }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('img/og-image.jpg') }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDesc }}">
<meta name="twitter:image" content="{{ asset('img/og-image.jpg') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
@stack('head')
@if(app()->environment('production') && config('services.ga.id', env('GA_MEASUREMENT_ID')))
<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GA_MEASUREMENT_ID') }}"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ env('GA_MEASUREMENT_ID') }}');</script>
@endif
