<section id="teachers" class="scroll-mt-20 py-16 lg:py-24 bg-gradient-to-b from-white to-azwara-lightest/30 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-12">
            <div class="space-y-2">
                <div class="flex items-center gap-3">
                    <span class="h-px w-8 bg-primary/60"></span>
                    <p class="text-xs font-semibold tracking-[0.2em] text-primary uppercase">Tim Tentor</p>
                    <span class="h-px w-8 bg-primary/60"></span>
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-azwara-darkest leading-tight">
                    Belajar dari <br class="hidden sm:block">
                    <span class="bg-gradient-to-r from-primary to-azwara-medium bg-clip-text text-transparent">
                        Tentor Profesional
                    </span>
                </h2>
                <p class="text-secondary text-sm md:text-base max-w-lg mt-2">
                    Kami menghadirkan pengajar terbaik dengan pengalaman dan dedikasi tinggi untuk mendukung kesuksesan belajar Anda.
                </p>
            </div>
            @if($teachers->count() > 0)
            <div class="flex items-center gap-3 flex-shrink-0 pb-1" id="teacher-nav">
                <button
                    id="teacher-prev"
                    aria-label="Sebelumnya"
                    class="group h-11 w-11 rounded-full bg-white border border-azwara-lighter shadow-sm hover:shadow-md hover:bg-primary hover:border-primary hover:text-white transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed disabled:hover:shadow-none disabled:hover:bg-white disabled:hover:text-azwara-medium"
                >
                    <svg class="w-4 h-4 mx-auto transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button
                    id="teacher-next"
                    aria-label="Berikutnya"
                    class="group h-11 w-11 rounded-full bg-white border border-azwara-lighter shadow-sm hover:shadow-md hover:bg-primary hover:border-primary hover:text-white transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed disabled:hover:shadow-none disabled:hover:bg-white disabled:hover:text-azwara-medium"
                >
                    <svg class="w-4 h-4 mx-auto transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            @endif
        </div>

        @if($teachers->count() > 0)

            {{-- Carousel Track Wrapper --}}
            <div class="relative">
                {{-- Gradient Fade Edges --}}
                <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-12 md:w-20 bg-gradient-to-r from-white via-white/80 to-transparent z-10"></div>
                <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-12 md:w-20 bg-gradient-to-l from-white via-white/80 to-transparent z-10"></div>

                <div
                    id="teacher-carousel"
                    class="flex gap-6 md:gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-6 cursor-grab active:cursor-grabbing select-none"
                    style="scrollbar-width: none; -ms-overflow-style: none;"
                >
                    @foreach($teachers as $teacher)
                        <div class="snap-start flex-shrink-0 w-72 sm:w-80 lg:w-88">
                            {{-- Card --}}
                            <div class="group relative bg-white rounded-2xl border border-azwara-lighter/60 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 ease-out h-full flex flex-col overflow-hidden">

                                {{-- Decorative top bar with gradient --}}
                                <div class="h-1.5 w-full bg-gradient-to-r from-primary via-azwara-medium to-azwara-light relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent animate-shimmer"></div>
                                </div>

                                {{-- Decorative corner accents --}}
                                <div class="absolute top-3 right-3 opacity-20">
                                    <svg class="w-8 h-8 text-azwara-medium" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                    </svg>
                                </div>

                                <div class="p-6 md:p-7 flex flex-col flex-1 relative z-10">
                                    {{-- Avatar with ring animation --}}
                                    <div class="flex justify-center mb-5">
                                        <div class="relative">
                                            <div class="h-24 w-24 rounded-full overflow-hidden ring-4 ring-azwara-lighter/50 group-hover:ring-primary/40 transition-all duration-500 shadow-md group-hover:shadow-xl">
                                                @if($teacher->user->avatar)
                                                    <img
                                                        src="{{ Storage::url($teacher->user->avatar) }}"
                                                        alt="{{ $teacher->user->name }}"
                                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                                        draggable="false"
                                                        loading="lazy"
                                                    >
                                                @else
                                                    <div class="h-full w-full bg-gradient-to-br from-primary to-azwara-darker flex items-center justify-center">
                                                        <span class="text-2xl font-bold text-white">
                                                            {{ strtoupper(substr($teacher->user->name, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            {{-- Status badge --}}
                                            <div class="absolute -bottom-0.5 -right-0.5">
                                                <span class="flex h-4 w-4">
                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                                    <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-2 border-white shadow-sm"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Name & Title --}}
                                    <div class="text-center">
                                        <h3 class="text-lg font-bold text-azwara-darkest leading-snug mb-0.5 group-hover:text-primary transition-colors duration-300">
                                            {{ $teacher->user->name }}
                                        </h3>
                                        <div class="flex items-center justify-center gap-2 mb-4">
                                            <span class="h-px w-4 bg-primary/40"></span>
                                            <p class="text-[11px] font-semibold tracking-[0.1em] text-primary uppercase">
                                                Tentor Profesional
                                            </p>
                                            <span class="h-px w-4 bg-primary/40"></span>
                                        </div>
                                    </div>

                                    {{-- Divider with icon --}}
                                    <div class="flex items-center justify-center gap-3 mb-4">
                                        <span class="h-px flex-1 max-w-8 bg-azwara-lighter"></span>
                                        <svg class="w-3 h-3 text-azwara-medium/60" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="h-px flex-1 max-w-8 bg-azwara-lighter"></span>
                                    </div>

                                    {{-- Bio with line clamping --}}
                                    @if($teacher->bio)
                                        <p class="text-secondary text-sm leading-relaxed text-center flex-1 line-clamp-4">
                                            {{ $teacher->bio }}
                                        </p>
                                    @else
                                        <p class="text-secondary text-sm leading-relaxed text-center flex-1">
                                            Tentor berpengalaman dengan metode pengajaran yang mudah dipahami dan fokus pada pemahaman konsep dasar.
                                        </p>
                                    @endif

                                    {{-- Decorative bottom bar --}}
                                    <div class="mt-5 pt-4 border-t border-azwara-lighter/40 flex justify-center">
                                        <span class="inline-flex items-center gap-2 text-[10px] font-medium text-secondary/50 uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-primary/60"></span>
                                            Siap Membantu
                                            <span class="w-1.5 h-1.5 rounded-full bg-primary/60"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Dot Indicators --}}
            <div id="teacher-dots" class="flex justify-center gap-2.5 mt-8">
                {{-- Dots injected by JS --}}
            </div>

        @else
            {{-- Enhanced Empty State --}}
            <div class="text-center py-20 px-4">
                <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-azwara-lightest/60 border-2 border-dashed border-azwara-lighter mb-6">
                    <svg class="w-9 h-9 text-primary/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-azwara-darkest mb-2">Tim Tentor Sedang Disiapkan</h3>
                <p class="text-secondary text-sm max-w-sm mx-auto leading-relaxed">
                    Kami sedang mempersiapkan tim tentor profesional terbaik untuk memberikan pengalaman belajar yang luar biasa bagi Anda.
                </p>
                <div class="mt-4 flex justify-center gap-2">
                    <span class="h-1.5 w-8 rounded-full bg-azwara-lighter"></span>
                    <span class="h-1.5 w-8 rounded-full bg-azwara-lighter"></span>
                    <span class="h-1.5 w-8 rounded-full bg-primary/40"></span>
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    #teacher-carousel::-webkit-scrollbar { display: none; }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .animate-shimmer {
        animation: shimmer 2.5s infinite;
    }
    
    .line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
(function () {
    const carousel = document.getElementById('teacher-carousel');
    if (!carousel) return;

    const btnPrev = document.getElementById('teacher-prev');
    const btnNext = document.getElementById('teacher-next');
    const dotsWrap = document.getElementById('teacher-dots');
    const cards = carousel.querySelectorAll(':scope > div');
    const total = cards.length;

    if (total === 0) return;

    // ── Dot creation ──────────────────────────────────────────────
    const dots = [];
    cards.forEach((_, i) => {
        const d = document.createElement('button');
        d.className = 'h-2 rounded-full bg-azwara-lighter transition-all duration-500 ease-out hover:bg-primary/60';
        d.style.width = '32px';
        d.setAttribute('aria-label', `Tentor ${i + 1}`);
        d.addEventListener('click', () => scrollToCard(i));
        dotsWrap.appendChild(d);
        dots.push(d);
    });

    function activeDot(idx) {
        dots.forEach((d, i) => {
            if (i === idx) {
                d.style.width = '48px';
                d.style.background = 'linear-gradient(to right, #1E4E6D, #3A7B9C)';
                d.style.boxShadow = '0 0 12px rgba(30, 78, 109, 0.3)';
            } else {
                d.style.width = '32px';
                d.style.background = '#BFD3E0';
                d.style.boxShadow = 'none';
            }
        });
    }

    // ── Card width helper ──────────────────────────────────────────
    function cardWidth() {
        const firstCard = cards[0];
        return firstCard.getBoundingClientRect().width + 
            parseInt(getComputedStyle(carousel).gap || '24');
    }

    function currentIndex() {
        const scrollLeft = carousel.scrollLeft;
        const width = cardWidth();
        return Math.round(scrollLeft / width);
    }

    function scrollToCard(idx) {
        const targetIdx = Math.max(0, Math.min(total - 1, idx));
        carousel.scrollTo({ 
            left: targetIdx * cardWidth(), 
            behavior: 'smooth' 
        });
    }

    // ── Button nav ─────────────────────────────────────────────────
    btnPrev.addEventListener('click', () => scrollToCard(currentIndex() - 1));
    btnNext.addEventListener('click', () => scrollToCard(currentIndex() + 1));

    // ── Sync dots + button state on scroll ────────────────────────
    let scrollTimeout;

    function onScroll() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            const idx = currentIndex();
            activeDot(idx);
            if (btnPrev) btnPrev.disabled = idx === 0;
            if (btnNext) btnNext.disabled = idx === total - 1;
        }, 50);
    }

    carousel.addEventListener('scroll', onScroll, { passive: true });
    
    // Initial state
    setTimeout(() => {
        activeDot(0);
        if (btnPrev) btnPrev.disabled = true;
    }, 100);

    // ── Drag-to-scroll (mouse) ─────────────────────────────────────
    let isDragging = false, startX, scrollStart;

    carousel.addEventListener('mousedown', e => {
        isDragging = true;
        startX = e.pageX - carousel.offsetLeft;
        scrollStart = carousel.scrollLeft;
        carousel.style.cursor = 'grabbing';
        carousel.style.scrollBehavior = 'auto';
    });

    carousel.addEventListener('mousemove', e => {
        if (!isDragging) return;
        e.preventDefault();
        const dx = e.pageX - carousel.offsetLeft - startX;
        carousel.scrollLeft = scrollStart - dx;
    });

    ['mouseup', 'mouseleave'].forEach(ev => {
        carousel.addEventListener(ev, () => {
            if (!isDragging) return;
            isDragging = false;
            carousel.style.cursor = 'grab';
            carousel.style.scrollBehavior = 'smooth';
            scrollToCard(currentIndex());
        });
    });

    // ── Keyboard navigation ────────────────────────────────────────
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            const target = e.target.closest('#teachers');
            if (target) {
                e.preventDefault();
                scrollToCard(currentIndex() - 1);
            }
        } else if (e.key === 'ArrowRight') {
            const target = e.target.closest('#teachers');
            if (target) {
                e.preventDefault();
                scrollToCard(currentIndex() + 1);
            }
        }
    });

    // ── Resize handler ─────────────────────────────────────────────
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            const idx = currentIndex();
            activeDot(idx);
        }, 200);
    });

})();
</script>