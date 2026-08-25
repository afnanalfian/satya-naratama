<!-- resources/views/front/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.partials.head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @include('layouts.partials.ga')
    @include('components.structured-data')
    <style>
        /* Custom Root Variables - No Tailwind Dependencies */
        :root {
            --primary-500: #2563EB;
            --primary-600: #1D4ED8;
            --primary-700: #1E40AF;
            --primary-50: #EFF6FF;
            --primary-100: #DBEAFE;

            --secondary-900: #0F172A;
            --secondary-800: #1E293B;
            --secondary-700: #334155;
            --secondary-600: #475569;
            --secondary-500: #64748B;
            --secondary-400: #94A3B8;
            --secondary-300: #CBD5E1;
            --secondary-200: #E2E8F0;
            --secondary-100: #F1F5F9;
            --secondary-50: #F8FAFC;

            --accent-500: #8B5CF6;
            --accent-400: #A78BFA;
            --accent-100: #EDE9FE;

            --success-500: #22C55E;
            --warning-500: #F59E0B;

            --font-primary: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-heading: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-primary);
            color: var(--secondary-700);
            background: var(--secondary-50);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container-custom {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        @media (min-width: 640px) {
            .container-custom {
                padding: 0 2rem;
            }
        }
        @media (min-width: 1024px) {
            .container-custom {
                padding: 0 3rem;
            }
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Utility Classes */
        .text-gradient-primary {
            background: linear-gradient(135deg, var(--primary-500), var(--accent-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--primary-500), var(--primary-700));
        }

        .bg-gradient-primary-light {
            background: linear-gradient(135deg, var(--primary-50), var(--secondary-50));
        }

        .bg-gradient-hero {
            background: linear-gradient(135deg, var(--secondary-900) 0%, var(--secondary-800) 50%, var(--secondary-900) 100%);
        }

        .shadow-elegant {
            box-shadow: 0 4px 24px rgba(37, 99, 235, 0.12), 0 1px 4px rgba(0, 0, 0, 0.04);
        }

        .shadow-elegant-hover {
            box-shadow: 0 8px 40px rgba(37, 99, 235, 0.18), 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .shadow-elegant-lg {
            box-shadow: 0 12px 56px rgba(37, 99, 235, 0.15), 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            color: white;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 0.75rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(37, 99, 235, 0.35);
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            background: transparent;
            color: var(--secondary-700);
            font-weight: 600;
            font-size: 1rem;
            border-radius: 0.75rem;
            border: 2px solid var(--secondary-200);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
        }

        .btn-secondary:hover {
            border-color: var(--primary-500);
            color: var(--primary-500);
            background: var(--primary-50);
            transform: translateY(-2px);
        }

        .btn-outline-light {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            background: rgba(255, 255, 255, 0.08);
            color: white;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 0.75rem;
            border: 2px solid rgba(255, 255, 255, 0.15);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            backdrop-filter: blur(8px);
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.16);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 1rem;
            background: var(--primary-50);
            color: var(--primary-500);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-radius: 9999px;
        }

        .section-label::before {
            content: '';
            width: 0.375rem;
            height: 0.375rem;
            background: var(--primary-500);
            border-radius: 50%;
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 48px rgba(37, 99, 235, 0.12), 0 4px 16px rgba(0, 0, 0, 0.04);
        }

        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-16px); }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .animate-shimmer {
            animation: shimmer 2.5s infinite;
        }

        /* Scrollbar Customization */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--secondary-100);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary-400);
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-500);
        }
    </style>
</head>

<body>

    @include('front.partials.header')
    @include('front.partials.promo')

    <main>
        @yield('content')
    </main>

    @include('front.partials.footer')
    @include('front.partials.scroll-to-top')

    @stack('scripts')
</body>
</html>
