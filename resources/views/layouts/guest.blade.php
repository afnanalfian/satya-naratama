<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Satya Naratama')</title>
    <meta name="description" content="Bimbel online, tryout beragam, quiz harian, live zoom, materi lengkap, latihan soal terbaru.">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <meta name="google-site-verification" content="exlEPP1kFOZJWZ_zxo5Qa-PoW-3oPa-9avX-Xbgcjb4" />
    <meta name="msvalidate.01" content="E0E1D8239606A4386F61EB8D5FC2DED6" />
    @vite(['resources/css/app.css','resources/js/app.js'])
    @include('layouts.partials.ga')
    @include('components.structured-data')

    <style>
        /* Reset and Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 50%, #F8FAFC 100%);
            color: #0F172A;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Navbar */
        .guest-nav {
            width: 100%;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            padding: 0.875rem 0;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .guest-nav .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        @media (min-width: 640px) {
            .guest-nav .container {
                padding: 0 2rem;
            }
        }

        .guest-nav .logo {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0F172A;
            text-decoration: none;
            letter-spacing: -0.02em;
            transition: color 0.2s ease;
        }

        .guest-nav .logo:hover {
            color: #2563EB;
        }

        .guest-nav .logo span {
            color: #2563EB;
        }

        .guest-nav .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .guest-nav .nav-link {
            font-size: 0.875rem;
            font-weight: 500;
            color: #475569;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.2s ease;
        }

        .guest-nav .nav-link:hover {
            color: #2563EB;
            background: rgba(37, 99, 235, 0.06);
        }

        .guest-nav .nav-link.active {
            background: #2563EB;
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .guest-nav .nav-link.active:hover {
            background: #1D4ED8;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
            transform: translateY(-1px);
        }

        /* Main content */
        .guest-main {
            flex: 1;
            overflow-y: auto;
            padding: 0;
        }

        /* Scrollbar styling */
        .guest-main::-webkit-scrollbar {
            width: 6px;
        }

        .guest-main::-webkit-scrollbar-track {
            background: #F1F5F9;
        }

        .guest-main::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 9999px;
        }

        .guest-main::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        /* Footer */
        .guest-footer {
            padding: 1.25rem 0;
            text-align: center;
            font-size: 0.875rem;
            color: #94A3B8;
            border-top: 1px solid rgba(226, 232, 240, 0.5);
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            flex-shrink: 0;
        }

        .guest-footer a {
            color: #2563EB;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .guest-footer a:hover {
            color: #1D4ED8;
            text-decoration: underline;
        }

        /* Toast container */
        .toast-container {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            max-width: 24rem;
            width: 100%;
        }

        .toast {
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            animation: slideUp 0.3s ease-out;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid transparent;
        }

        .toast-success {
            background: #F0FDF4;
            color: #166534;
            border-color: #BBF7D0;
        }

        .toast-error {
            background: #FEF2F2;
            color: #991B1B;
            border-color: #FECACA;
        }

        .toast-info {
            background: #EFF6FF;
            color: #1E40AF;
            border-color: #BFDBFE;
        }

        .toast-warning {
            background: #FEFCE8;
            color: #854D0E;
            border-color: #FDE68A;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .guest-nav .container {
                padding: 0 1rem;
            }

            .guest-nav .logo {
                font-size: 1rem;
            }

            .guest-nav .nav-link {
                font-size: 0.75rem;
                padding: 0.375rem 0.75rem;
            }

            .guest-nav .nav-actions {
                gap: 0.5rem;
            }

            .toast-container {
                bottom: 1rem;
                right: 1rem;
                left: 1rem;
                max-width: none;
            }
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="guest-nav">
        <div class="container">
            <a href="{{ route('home') }}" class="logo">
                Satya<span>Naratama</span>
            </a>

            <div class="nav-actions">
                <a href="{{ route('login') }}"
                   class="nav-link @if(request()->routeIs('login')) active @endif">
                    Login
                </a>
                <a href="{{ route('daftar.form') }}"
                   class="nav-link @if(request()->routeIs('daftar.*')) active @endif">
                    Daftar Bimbel
                </a>
            </div>
        </div>
    </nav>

    {{-- Page content --}}
    <main class="guest-main">
        @yield('content')

        {{-- Footer --}}
        <footer class="guest-footer">
            &copy; {{ date('Y') }} <a href="{{ route('home') }}">Satya Naratama</a>. All rights reserved.
        </footer>
    </main>

    {{-- Toast Container --}}
    <div class="toast-container" id="toastContainer">
        @if(session('success'))
            <div class="toast toast-success">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="toast toast-error">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div class="toast toast-info">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('info') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="toast toast-warning">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                {{ session('warning') }}
            </div>
        @endif
    </div>

    @stack('scripts')

    <script>
        // Auto-dismiss toast messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach((toast, index) => {
                setTimeout(() => {
                    toast.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(20px)';
                    setTimeout(() => {
                        toast.remove();
                    }, 400);
                }, 5000 + (index * 200));
            });
        });
    </script>

</body>
</html>
