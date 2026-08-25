<!-- resources/views/front/partials/header.blade.php -->
<header
    id="site-header"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-300 bg-transparent"
>
    <div class="w-full bg-transparent transition-all duration-300">
        <div class="container-custom">
            <div class="flex items-center justify-between h-20">

                {{-- Logo --}}
                <a href="#home" class="flex items-center gap-3 group">
                    <div class="relative">
                        <div class="h-12 w-12 rounded-full overflow-hidden border-2 border-white/80 shadow-elegant">
                            <img
                                src="{{ asset('img/logo.png') }}"
                                alt="Satya Naratama"
                                class="h-full w-full object-cover"
                            >
                        </div>
                        <div class="absolute inset-0 rounded-full border-2 border-transparent group-hover:border-[#2563EB] transition-all duration-300"></div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-2xl text-[#0F172A] leading-tight">
                            Satya<span class="text-[#2563EB]">Naratama</span>
                        </span>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#home" class="nav-link text-lg font-medium text-[#475569] hover:text-[#2563EB] transition-colors duration-300">Home</a>
                    <a href="#about" class="nav-link text-lg font-medium text-[#475569] hover:text-[#2563EB] transition-colors duration-300">About</a>
                    <a href="#courses" class="nav-link text-lg font-medium text-[#475569] hover:text-[#2563EB] transition-colors duration-300">Course</a>
                    <a href="#teachers" class="nav-link text-lg font-medium text-[#475569] hover:text-[#2563EB] transition-colors duration-300">Teachers</a>
                </nav>

                {{-- Auth Buttons --}}
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a
                            href="{{ route('dashboard.redirect') }}"
                            class="btn-primary"
                        >
                            Dashboard
                        </a>
                    @endauth

                    @guest
                        <a
                            href="{{ route('login') }}"
                            class="px-5 py-2.5 rounded-lg border-2 border-[#2563EB] text-[#2563EB] font-medium hover:bg-[#2563EB] hover:text-white transition-all duration-300"
                        >
                            Login
                        </a>
                        <a
                            href="{{ route('daftar.form') }}"
                            class="btn-primary"
                        >
                            Daftar
                        </a>
                    @endguest
                </div>

                {{-- Mobile Toggle --}}
                <button
                    id="mobile-menu-btn"
                    class="md:hidden text-[#0F172A] p-2 rounded-lg hover:bg-[#F1F5F9] transition duration-300"
                    aria-label="Toggle menu"
                >
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div
        id="mobile-menu"
        class="md:hidden hidden bg-white shadow-elegant-lg"
    >
        <div class="px-4 py-6 space-y-1">
            <a href="#home" class="block py-3 px-4 rounded-lg hover:bg-[#F1F5F9] text-lg font-medium text-[#1E293B]">Home</a>
            <a href="#about" class="block py-3 px-4 rounded-lg hover:bg-[#F1F5F9] text-lg font-medium text-[#1E293B]">About</a>
            <a href="#courses" class="block py-3 px-4 rounded-lg hover:bg-[#F1F5F9] text-lg font-medium text-[#1E293B]">Course</a>
            <a href="#teachers" class="block py-3 px-4 rounded-lg hover:bg-[#F1F5F9] text-lg font-medium text-[#1E293B]">Teachers</a>

            <div class="pt-4 mt-4 border-t border-[#E2E8F0]">
                @auth
                    <a
                        href="{{ route('dashboard.redirect') }}"
                        class="block text-center py-3 px-4 rounded-lg bg-[#2563EB] text-white font-medium hover:bg-[#1D4ED8] transition duration-300 mb-2"
                    >
                        Dashboard
                    </a>
                @endauth

                @guest
                    <a
                        href="{{ route('login') }}"
                        class="block py-3 px-4 rounded-lg border-2 border-[#2563EB] text-[#2563EB] text-center font-medium hover:bg-[#2563EB] hover:text-white transition duration-300 mb-3"
                    >
                        Login
                    </a>
                    <a
                        href="{{ route('daftar.form') }}"
                        class="block text-center py-3 px-4 rounded-lg bg-[#2563EB] text-white font-medium hover:bg-[#1D4ED8] transition duration-300"
                    >
                        Register
                    </a>
                @endguest
            </div>
        </div>
    </div>
</header>
