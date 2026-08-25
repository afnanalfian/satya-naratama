<header
    id="site-header"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-300 bg-transparent"
>
    <div class="w-full bg-transparent transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                {{-- Logo --}}
                <a href="#home" class="flex items-center gap-3 group">
                    <div class="relative">
                        <div class="h-12 w-12 rounded-full overflow-hidden border-2 border-white/80 shadow-md">
                            <img
                                src="{{ asset('img/logo.png') }}"
                                alt="Satya Naratama"
                                class="h-full w-full object-cover"
                            >
                        </div>
                        <div class="absolute inset-0 rounded-full border-2 border-transparent group-hover:border-primary transition-all duration-300"></div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-2xl text-white leading-tight">
                            Satya<span class="text-gold">Naratama</span>
                        </span>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#home" class="nav-link text-white/80 hover:text-gold text-lg font-medium transition-colors">Home</a>
                    <a href="#about" class="nav-link text-white/80 hover:text-gold text-lg font-medium transition-colors">About</a>
                    <a href="#courses" class="nav-link text-white/80 hover:text-gold text-lg font-medium transition-colors">Course</a>
                    <a href="#teachers" class="nav-link text-white/80 hover:text-gold text-lg font-medium transition-colors">Teachers</a>
                </nav>

                {{-- Auth Buttons --}}
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <a
                            href="{{ route('dashboard.redirect') }}"
                            class="px-5 py-2.5 rounded-lg bg-gold text-secondary font-medium hover:bg-gold/80 transition duration-300 shadow-md hover:shadow-lg"
                        >
                            Dashboard
                        </a>
                    @endauth

                    @guest
                        <a
                            href="{{ route('login') }}"
                            class="px-5 py-2.5 rounded-lg border-2 border-white/30 text-white font-medium hover:bg-white/10 transition duration-300"
                        >
                            Login
                        </a>
                        <a
                            href="{{ route('daftar.form') }}"
                            class="px-5 py-2.5 rounded-lg bg-gold text-secondary font-medium hover:bg-gold/80 transition duration-300 shadow-md hover:shadow-lg"
                        >
                            Daftar
                        </a>
                    @endguest
                </div>

                {{-- Mobile Toggle --}}
                <button
                    id="mobile-menu-btn"
                    class="md:hidden text-white p-2 rounded-lg hover:bg-white/10 transition duration-300"
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
        class="md:hidden hidden bg-secondary/95 backdrop-blur-lg shadow-xl"
    >
        <div class="px-4 py-6 space-y-1">
            <a href="#home" class="block py-3 px-4 rounded-lg hover:bg-white/10 text-white/80 hover:text-gold text-lg font-medium transition-colors">Home</a>
            <a href="#about" class="block py-3 px-4 rounded-lg hover:bg-white/10 text-white/80 hover:text-gold text-lg font-medium transition-colors">About</a>
            <a href="#courses" class="block py-3 px-4 rounded-lg hover:bg-white/10 text-white/80 hover:text-gold text-lg font-medium transition-colors">Course</a>
            <a href="#teachers" class="block py-3 px-4 rounded-lg hover:bg-white/10 text-white/80 hover:text-gold text-lg font-medium transition-colors">Teachers</a>

            <div class="pt-4 mt-4 border-t border-white/10">
                @auth
                    <a
                        href="{{ route('dashboard.redirect') }}"
                        class="block text-center py-3 px-4 rounded-lg bg-gold text-secondary font-medium hover:bg-gold/80 transition duration-300 mb-2"
                    >
                        Dashboard
                    </a>
                @endauth

                @guest
                    <a
                        href="{{ route('login') }}"
                        class="block py-3 px-4 rounded-lg border border-white/20 text-white/80 text-center font-medium hover:bg-white/10 transition duration-300 mb-3"
                    >
                        Login
                    </a>
                    <a
                        href="{{ route('daftar.form') }}"
                        class="block text-center py-3 px-4 rounded-lg bg-gold text-secondary font-medium hover:bg-gold/80 transition duration-300"
                    >
                        Register
                    </a>
                @endguest
            </div>
        </div>
    </div>
</header>

<style>
    .nav-link {
        position: relative;
    }
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 0;
        height: 2px;
        background: #C9A84C;
        transition: width 0.3s ease;
    }
    .nav-link:hover::after {
        width: 100%;
    }
</style>
