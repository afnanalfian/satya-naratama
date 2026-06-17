<section
    id="home"
    class="relative w-full min-h-[calc(100vh-80px)] flex items-center overflow-hidden
           bg-azwara-lightest"
>

    {{-- Decorative background --}}
    <div class="absolute inset-0 -z-10">
        <div
            class="absolute top-0 right-0 w-full lg:w-[60%] h-full
                   bg-brand-gradient opacity-90
                   lg:rounded-bl-[120px]"
        ></div>
    </div>

    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full
               grid grid-cols-1 lg:grid-cols-2
               gap-6 lg:gap-12 items-center
               py-6 lg:py-0"
    >

        {{-- MOBILE: Image First --}}
        <div class="lg:hidden relative flex justify-center order-1">
            <img
                src="{{ asset('front/img/hero-img-1.png') }}"
                alt="Azwara Learning Hero"
                class="w-full max-w-xs sm:max-w-sm md:max-w-md
                       drop-shadow-xl animate-float"
            >
        </div>

        {{-- LEFT: Text Content --}}
        <div class="space-y-4 lg:space-y-6 order-2 lg:order-1 mt-4 lg:mt-0">
            <span
                class="inline-block px-4 py-1.5 rounded-full
                       bg-white/80 backdrop-blur-sm text-azwara-darkest
                       text-sm font-medium border border-azwara-lighter"
            >
                Platform Bimbel Online Terpercaya
            </span>

            <h1
                class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl
                       font-bold leading-snug lg:leading-tight
                       text-azwara-darkest"
            >
                Belajar Lebih Terarah
                <span class="block text-primary">Azwara Learning</span>
            </h1>

            <p
                class="text-base sm:text-lg text-secondary/90 max-w-xl
                       leading-relaxed"
            >
                Bimbel online dengan materi terstruktur, tentor berpengalaman,
                serta tryout dan pembahasan yang membantu kamu
                mencapai target belajar dengan lebih efektif.
            </p>

            <div class="flex flex-wrap gap-3 sm:gap-4 pt-2">
                <a
                    href="{{ route('register') }}"
                    class="inline-flex items-center justify-center
                           px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl
                           bg-primary text-white font-semibold
                           hover:bg-azwara-medium transition-all duration-300
                           shadow-md hover:shadow-lg transform hover:-translate-y-0.5
                           text-sm sm:text-base"
                >
                    Get Started
                    <svg class="ml-2 w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>

                <a
                    href="#courses"
                    class="inline-flex items-center justify-center
                           px-5 sm:px-6 py-2.5 sm:py-3 rounded-xl
                           border-2 border-primary text-primary
                           font-semibold hover:bg-azwara-lighter/50
                           transition-all duration-300
                           text-sm sm:text-base"
                >
                    Lihat Course
                </a>
            </div>
        </div>

        {{-- DESKTOP: Image Right --}}
        <div class="hidden lg:flex relative justify-center lg:justify-end order-1 lg:order-2">
            <img
                src="{{ asset('front/img/hero-img-1.png') }}"
                alt="Azwara Learning Hero"
                class="w-full max-w-lg xl:max-w-xl
                       drop-shadow-2xl animate-float"
            >
        </div>

    </div>
</section>
