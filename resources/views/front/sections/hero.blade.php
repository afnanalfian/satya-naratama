<section
    id="home"
    class="relative w-full min-h-screen flex items-center overflow-hidden bg-hero-gradient"
>

    {{-- Background Pattern --}}
    <div class="absolute inset-0 -z-10 opacity-20">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 20% 50%, rgba(30,78,109,0.3) 0%, transparent 50%);"></div>
        <div class="absolute inset-0" style="background-image:
            linear-gradient(45deg, rgba(30,78,109,0.1) 1px, transparent 1px),
            linear-gradient(-45deg, rgba(30,78,109,0.1) 1px, transparent 1px);
            background-size: 40px 40px;">
        </div>
    </div>

    {{-- Decorative Elements --}}
    <div class="absolute top-0 right-0 w-1/2 h-full -z-10 opacity-20">
        <div class="absolute top-1/2 right-0 w-96 h-96 rounded-full bg-primary blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 rounded-full bg-gold blur-3xl opacity-30"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-20 lg:py-0">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center min-h-[calc(100vh-80px)]">

            {{-- MOBILE: Image --}}
            <div class="lg:hidden relative flex justify-center order-1">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent rounded-3xl blur-2xl"></div>
                    <img
                        src="{{ asset('front/img/hero-img-1.png') }}"
                        alt="Satya Naratama Hero"
                        class="w-full max-w-xs sm:max-w-sm md:max-w-md relative z-10 drop-shadow-2xl animate-float"
                    >
                </div>
            </div>

            {{-- LEFT: Text Content --}}
            <div class="space-y-6 lg:space-y-8 order-2 lg:order-1">
                <div class="space-y-2">
                    <span
                        class="inline-block px-5 py-2 rounded-full
                               bg-white/10 backdrop-blur-sm text-gold
                               text-sm font-semibold border border-white/20"
                    >
                        🎯 Platform Bimbel Kedinasan & TNI POLRI
                    </span>
                </div>

                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl
                           font-extrabold leading-tight"
                >
                    <span class="text-white">Belajar Lebih</span>
                    <span class="text-gold block">Terarah</span>
                    <span class="text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl">dengan Satya Naratama</span>
                </h1>

                <p
                    class="text-base sm:text-lg text-white/70 max-w-xl
                           leading-relaxed"
                >
                    Bimbel Kedinasan + TNI POLRI dengan materi terstruktur, tentor berpengalaman,
                    serta tryout dan pembahasan yang membantu kamu mencapai target belajar
                    dengan lebih efektif.
                </p>

                <div class="flex flex-wrap gap-4 pt-4">
                    <a
                        href="{{ route('daftar.form') }}"
                        class="inline-flex items-center justify-center
                               px-8 py-3.5 rounded-2xl
                               bg-gold text-secondary
                               font-semibold text-base
                               hover:bg-gold/80 hover:scale-105
                               transition-all duration-300
                               shadow-2xl shadow-gold/30
                               hover:shadow-gold/50
                               transform hover:-translate-y-1"
                    >
                        Mulai Sekarang
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>

                    <a
                        href="#courses"
                        class="inline-flex items-center justify-center
                               px-8 py-3.5 rounded-2xl
                               border-2 border-white/30 text-white
                               font-semibold text-base
                               hover:bg-white/10 hover:border-white/50
                               transition-all duration-300
                               transform hover:-translate-y-1"
                    >
                        Lihat Course
                    </a>
                </div>

                {{-- Stats --}}
                <div class="flex gap-8 pt-6 border-t border-white/10">
                    <div>
                        <p class="text-3xl font-bold text-gold">500+</p>
                        <p class="text-sm text-white/60">Siswa Terdaftar</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gold">98%</p>
                        <p class="text-sm text-white/60">Tingkat Kelulusan</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gold">50+</p>
                        <p class="text-sm text-white/60">Tentor Profesional</p>
                    </div>
                </div>
            </div>

            {{-- DESKTOP: Image --}}
            <div class="hidden lg:flex relative justify-center lg:justify-end order-1 lg:order-2">
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-primary/20 to-transparent rounded-3xl blur-3xl"></div>
                    <div class="relative z-10">
                        <img
                            src="{{ asset('front/img/hero-img-1.png') }}"
                            alt="Satya Naratama Hero"
                            class="w-full max-w-lg xl:max-w-xl drop-shadow-2xl animate-float"
                        >
                    </div>
                    {{-- Floating badge --}}
                    <div class="absolute -bottom-6 -left-6 bg-secondary/90 backdrop-blur-xl rounded-2xl p-4 border border-gold/20 shadow-2xl z-20">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-gold/20 flex items-center justify-center">
                                <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-bold">100%</p>
                                <p class="text-xs text-white/60">Garansi Lulus</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
