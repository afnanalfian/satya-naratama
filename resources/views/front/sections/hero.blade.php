<!-- resources/views/front/sections/hero.blade.php -->
<section
    id="home"
    class="relative w-full min-h-screen flex items-center overflow-hidden bg-gradient-hero"
>

    {{-- Background Pattern --}}
    <div class="absolute inset-0 -z-10 opacity-20">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 20% 50%, rgba(37,99,235,0.15) 0%, transparent 50%);"></div>
        <div class="absolute inset-0" style="background-image:
            linear-gradient(45deg, rgba(37,99,235,0.03) 1px, transparent 1px),
            linear-gradient(-45deg, rgba(37,99,235,0.03) 1px, transparent 1px);
            background-size: 48px 48px;">
        </div>
    </div>

    {{-- Decorative Elements --}}
    <div class="absolute top-0 right-0 w-1/2 h-full -z-10 opacity-10">
        <div class="absolute top-1/2 right-0 w-96 h-96 rounded-full bg-[#2563EB] blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 rounded-full bg-[#8B5CF6] blur-3xl"></div>
    </div>

    <div class="container-custom w-full py-16 lg:py-0">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center min-h-[calc(100vh-80px)]">

            {{-- MOBILE: Image First --}}
            <div class="lg:hidden relative flex justify-center order-1">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#2563EB]/20 to-transparent rounded-3xl blur-2xl"></div>
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
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full
                               bg-[#2563EB]/10 backdrop-blur-sm text-[#2563EB]
                               text-sm font-semibold border border-[#2563EB]/20"
                    >
                        <span class="w-1.5 h-1.5 bg-[#2563EB] rounded-full"></span>
                        🎯 Platform Bimbel Kedinasan & TNI POLRI
                    </span>
                </div>

                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl
                           font-extrabold leading-tight"
                >
                    <span class="text-white">Belajar Lebih</span>
                    <span class="text-gradient-primary block">Terarah</span>
                    <span class="text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl">dengan Satya Naratama</span>
                </h1>

                <p
                    class="text-base sm:text-lg text-[#94A3B8] max-w-xl
                           leading-relaxed"
                >
                    Bimbel Kedinasan + TNI POLRI dengan materi terstruktur, tentor berpengalaman,
                    serta tryout dan pembahasan yang membantu kamu mencapai target belajar
                    dengan lebih efektif.
                </p>

                <div class="flex flex-wrap gap-4 pt-4">
                    <a
                        href="{{ route('daftar.form') }}"
                        class="btn-primary text-base px-8 py-3.5 rounded-2xl shadow-[0_8px_32px_rgba(37,99,235,0.3)] hover:shadow-[0_12px_48px_rgba(37,99,235,0.4)]"
                    >
                        Mulai Sekarang
                        <svg class="ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>

                    <a
                        href="#courses"
                        class="btn-outline-light"
                    >
                        Lihat Course
                    </a>
                </div>
            </div>

            {{-- DESKTOP: Image Right --}}
            <div class="hidden lg:flex relative justify-center lg:justify-end order-1 lg:order-2">
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-[#2563EB]/20 to-transparent rounded-3xl blur-3xl"></div>
                    <div class="relative z-10">
                        <img
                            src="{{ asset('front/img/hero-img-1.png') }}"
                            alt="Satya Naratama Hero"
                            class="w-full max-w-lg xl:max-w-xl drop-shadow-2xl animate-float"
                        >
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
