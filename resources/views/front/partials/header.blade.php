<header
    id="site-header"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-500"
    style="background: rgba(26, 26, 26, 0.95); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(196, 30, 36, 0.2);"
>
    <div class="w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                {{-- Logo Premium --}}
                <a href="#home" class="flex items-center gap-3 group">
                    <div class="relative">
                        <div class="h-12 w-12 rounded-xl overflow-hidden border-2 border-primary shadow-lg shadow-red-500/20">
                            <img
                                src="{{ asset('img/logo.png') }}"
                                alt="Satya Naratama"
                                class="h-full w-full object-cover"
                            >
                        </div>
                        {{-- Efek glow --}}
                        <div class="absolute inset-0 rounded-xl border-2 border-primary opacity-0 group-hover:opacity-100 transition-all duration-500 blur-sm"></div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-2xl text-white leading-tight tracking-tight">
                            Satya<span class="text-primary">Naratama</span>
                        </span>
                        <span class="text-[10px] text-gray-400 tracking-wider uppercase">Bimbel Kedinasan</span>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <nav class="hidden md:flex items-center gap-1">
                    @php
                        $navItems = [
                            'Home' => '#home',
                            'About' => '#about',
                            'Course' => '#courses',
                            'Teachers' => '#teachers'
                        ];
                    @endphp

                    @foreach($navItems as $label => $link)
                        <a
                            href="{{ $link }}"
                            class="nav-link px-4 py-2 text-sm font-medium text-gray-300 hover:text-white rounded-lg transition-all duration-300 hover:bg-white/5 relative"
                        >
                            {{ $label }}
                            <span class="absolute bottom-0 left-1/2 w-0 h-0.5 bg-primary transition-all duration-300 -translate-x-1/2 group-hover:w-full"></span>
                        </a>
                    @endforeach
                </nav>

                {{-- Auth Buttons --}}
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a
                            href="{{ route('dashboard.redirect') }}"
                            class="px-6 py-2.5 rounded-xl bg-primary text-white font-medium hover:bg-black transition-all duration-300 shadow-lg shadow-red-500/20 hover:shadow-red-500/40 hover:scale-105"
                        >
                            Dashboard
                        </a>
                    @endauth

                    @guest
                        <a
                            href="{{ route('login') }}"
                            class="px-5 py-2.5 rounded-xl border-2 border-primary/50 text-white font-medium hover:bg-primary hover:border-primary transition-all duration-300 hover:shadow-lg hover:shadow-red-500/20"
                        >
                            Login
                        </a>
                        <a
                            href="{{ route('daftar.form') }}"
                            class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-primary to-red-700 text-white font-medium hover:from-black hover:to-black transition-all duration-300 shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:scale-105"
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
        class="md:hidden hidden bg-black/95 backdrop-blur-xl border-t border-primary/20"
    >
        <div class="px-4 py-6 space-y-1">
            @foreach($navItems as $label => $link)
                <a
                    href="{{ $link }}"
                    class="block py-3 px-4 rounded-xl hover:bg-white/5 text-gray-300 hover:text-white text-lg font-medium transition-all duration-300"
                >
                    {{ $label }}
                </a>
            @endforeach

            <div class="pt-4 mt-4 border-t border-white/10">
                @auth
                    <a
                        href="{{ route('dashboard.redirect') }}"
                        class="block text-center py-3 px-4 rounded-xl bg-primary text-white font-medium hover:bg-black transition duration-300 shadow-lg shadow-red-500/20"
                    >
                        Dashboard
                    </a>
                @endauth

                @guest
                    <a
                        href="{{ route('login') }}"
                        class="block py-3 px-4 rounded-xl border-2 border-primary/50 text-white text-center font-medium hover:bg-primary transition duration-300 mb-3"
                    >
                        Login
                    </a>
                    <a
                        href="{{ route('daftar.form') }}"
                        class="block text-center py-3 px-4 rounded-xl bg-gradient-to-r from-primary to-red-700 text-white font-medium hover:from-black hover:to-black transition duration-300 shadow-lg shadow-red-500/30"
                    >
                        Register
                    </a>
                @endguest
            </div>
        </div>
    </div>
</header>

{{-- JavaScript untuk header scroll --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('site-header');
        let lastScroll = 0;

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

            if (currentScroll > 50) {
                header.style.background = 'rgba(26, 26, 26, 0.98)';
                header.style.boxShadow = '0 4px 30px rgba(0,0,0,0.3)';
            } else {
                header.style.background = 'rgba(26, 26, 26, 0.95)';
                header.style.boxShadow = 'none';
            }

            lastScroll = currentScroll;
        });

        // Mobile menu toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            // Change icon
            const svg = this.querySelector('svg');
            if (mobileMenu.classList.contains('hidden')) {
                svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
            } else {
                svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            }
        });
    });
</script>
@endpush
