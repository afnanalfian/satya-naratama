<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.partials.head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @include('layouts.partials.ga')
    @include('components.structured-data')

    {{-- Custom CSS untuk redesign merah-hitam --}}
    <style>
        :root {
            --primary-red: #C41E24;
            --primary-red-dark: #8B0000;
            --primary-red-light: #E63946;
            --black: #1A1A1A;
            --black-light: #2D2D2D;
            --gray-dark: #4A4A4A;
            --gray-light: #F5F5F5;
            --white: #FFFFFF;
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            background: var(--white);
            color: var(--black);
        }

        /* Gradient merah-hitam */
        .gradient-red-black {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--black) 100%);
        }

        .gradient-red-black-horizontal {
            background: linear-gradient(90deg, var(--primary-red) 0%, var(--black) 80%);
        }

        .gradient-black-red {
            background: linear-gradient(135deg, var(--black) 0%, var(--primary-red) 100%);
        }

        /* Animasi float */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* Text gradient */
        .text-gradient-red-black {
            background: linear-gradient(135deg, var(--primary-red), var(--black));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Card hover effect */
        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(196, 30, 36, 0.15);
        }

        /* Button styles */
        .btn-primary {
            background: var(--primary-red);
            color: white;
            padding: 12px 32px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: none;
        }

        .btn-primary:hover {
            background: var(--black);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(196, 30, 36, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-red);
            padding: 12px 32px;
            border-radius: 12px;
            font-weight: 600;
            border: 2px solid var(--primary-red);
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: var(--primary-red);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(196, 30, 36, 0.2);
        }

        /* Section titles */
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--gray-dark);
            font-size: 1.1rem;
            max-width: 600px;
        }

        /* Glassmorphism */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body class="font-sans text-secondary bg-azwara-lightest overflow-x-hidden landing-page">

    @include('front.partials.header')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('front.partials.footer')
    @include('front.partials.scroll-to-top')
    @include('front.partials.promo')
    @stack('scripts')
</body>
</html>
