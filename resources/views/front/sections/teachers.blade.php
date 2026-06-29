<section id="teachers" class="scroll-mt-20 py-16 lg:py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10">
            <div>
                <p class="text-xs font-semibold tracking-widest text-primary uppercase mb-2">Belajar dari yang Terbaik</p>
                <h2 class="text-3xl md:text-4xl font-bold text-azwara-darkest leading-tight">
                    Tim <span class="text-primary">Tentor</span> Profesional
                </h2>
            </div>
            @if($teachers->count() > 0)
            {{-- Carousel Nav Arrows --}}
            <div class="flex items-center gap-3 flex-shrink-0" id="teacher-nav">
                <button
                    id="teacher-prev"
                    aria-label="Sebelumnya"
                    class="group h-10 w-10 rounded-full border-2 border-azwara-lighter flex items-center justify-center text-azwara-medium hover:bg-primary hover:border-primary hover:text-white transition-all duration-200 disabled:opacity-30 disabled:cursor-not-allowed"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button
                    id="teacher-next"
                    aria-label="Berikutnya"
                    class="group h-10 w-10 rounded-full border-2 border-azwara-lighter flex items-center justify-center text-azwara-medium hover:bg-primary hover:border-primary hover:text-white transition-all duration-200 disabled:opacity-30 disabled:cursor-not-allowed"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            @endif
        </div>

        @if($teachers->count() > 0)

            {{-- Carousel Track Wrapper --}}
            <div class="relative">
                {{-- Fade edges --}}
                <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-6 bg-gradient-to-r from-white to-transparent z-10"></div>
                <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-6 bg-gradient-to-l from-white to-transparent z-10"></div>

                <div
                    id="teacher-carousel"
                    class="flex gap-5 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-4 cursor-grab active:cursor-grabbing select-none"
                    style="scrollbar-width: none; -ms-overflow-style: none;"
                >
                    @foreach($teachers as $teacher)
                        <div class="snap-start flex-shrink-0 w-72 sm:w-80">
                            {{-- Card --}}
                            <div class="group relative bg-white rounded-2xl border border-azwara-lighter shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 overflow-hidden h-full flex flex-col">

                                {{-- Top accent bar --}}
                                <div class="h-1 w-full bg-gradient-to-r from-azwara-medium to-azwara-light"></div>

                                <div class="p-6 flex flex-col flex-1">
                                    {{-- Avatar --}}
                                    <div class="flex justify-center mb-5">
                                        <div class="relative">
                                            <div class="h-24 w-24 rounded-full overflow-hidden ring-4 ring-azwara-lighter group-hover:ring-primary/30 transition-all duration-300 shadow-md">
                                                @if($teacher->user->avatar)
                                                    <img
                                                        src="{{ Storage::url($teacher->user->avatar) }}"
                                                        alt="{{ $teacher->user->name }}"
                                                        class="h-full w-full object-cover"
                                                        draggable="false"
                                                    >
                                                @else
                                                    <div class="h-full w-full bg-gradient-to-br from-azwara-medium to-azwara-darker flex items-center justify-center">
                                                        <span class="text-2xl font-bold text-white">
                                                            {{ strtoupper(substr($teacher->user->name, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            {{-- Active dot --}}
                                            <span class="absolute bottom-1 right-1 h-3.5 w-3.5 rounded-full bg-emerald-400 border-2 border-white shadow-sm"></span>
                                        </div>
                                    </div>

                                    {{-- Name --}}
                                    <h3 class="text-center text-lg font-bold text-azwara-darkest leading-snug mb-1">
                                        {{ $teacher->user->name }}
                                    </h3>
                                    <p class="text-center text-xs font-semibold tracking-wide text-primary uppercase mb-4">
                                        Tentor Profesional
                                    </p>

                                    {{-- Divider --}}
                                    <div class="w-10 h-px bg-azwara-lighter mx-auto mb-4"></div>

                                    {{-- Bio --}}
                                    @if($teacher->bio)
                                        <p class="text-secondary text-sm leading-relaxed text-center flex-1 whitespace-pre-line">
                                            {{ $teacher->bio }}
                                        </p>
                                    @else
                                        <p class="text-secondary text-sm leading-relaxed text-center flex-1">
                                            Tentor berpengalaman dengan metode pengajaran yang mudah dipahami dan fokus pada pemahaman konsep dasar.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Dot Indicators --}}
            <div id="teacher-dots" class="flex justify-center gap-2 mt-6">
                {{-- Dots injected by JS --}}
            </div>

        @else
            {{-- Empty State --}}
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-azwara-lightest text-primary mb-5">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-azwara-darkest mb-2">Tim Tentor Sedang Disiapkan</h3>
                <p class="text-secondary text-sm max-w-sm mx-auto">
                    Tim tentor profesional kami sedang mempersiapkan materi terbaik untuk Anda.
                </p>
            </div>
        @endif
    </div>
</section>

<style>
    #teacher-carousel::-webkit-scrollbar { display: none; }
</style>

<script>
(function () {
    const carousel  = document.getElementById('teacher-carousel');
    if (!carousel) return;

    const btnPrev   = document.getElementById('teacher-prev');
    const btnNext   = document.getElementById('teacher-next');
    const dotsWrap  = document.getElementById('teacher-dots');
    const cards     = carousel.querySelectorAll(':scope > div');
    const total     = cards.length;

    if (total === 0) return;

    // ── Dot creation ──────────────────────────────────────────────
    const dots = [];
    cards.forEach((_, i) => {
        const d = document.createElement('button');
        d.className = 'h-1.5 rounded-full bg-azwara-lighter transition-all duration-300';
        d.style.width = '24px';
        d.setAttribute('aria-label', `Tentor ${i + 1}`);
        d.addEventListener('click', () => scrollToCard(i));
        dotsWrap.appendChild(d);
        dots.push(d);
    });

    function activeDot(idx) {
        dots.forEach((d, i) => {
            d.style.width        = i === idx ? '40px' : '24px';
            d.style.background   = i === idx ? '#1E4E6D' : '#BFD3E0';
        });
    }

    // ── Card width helper ──────────────────────────────────────────
    function cardWidth() {
        return cards[0].getBoundingClientRect().width + 20; // 20 = gap-5
    }

    function currentIndex() {
        return Math.round(carousel.scrollLeft / cardWidth());
    }

    function scrollToCard(idx) {
        carousel.scrollTo({ left: idx * cardWidth(), behavior: 'smooth' });
    }

    // ── Button nav ─────────────────────────────────────────────────
    btnPrev.addEventListener('click', () => scrollToCard(Math.max(0, currentIndex() - 1)));
    btnNext.addEventListener('click', () => scrollToCard(Math.min(total - 1, currentIndex() + 1)));

    // ── Sync dots + button state on scroll ────────────────────────
    function onScroll() {
        const idx = currentIndex();
        activeDot(idx);
        if (btnPrev) btnPrev.disabled = idx === 0;
        if (btnNext) btnNext.disabled = idx === total - 1;
    }

    carousel.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // init

    // ── Drag-to-scroll (mouse) ─────────────────────────────────────
    let isDragging = false, startX, scrollStart;

    carousel.addEventListener('mousedown', e => {
        isDragging  = true;
        startX      = e.pageX - carousel.offsetLeft;
        scrollStart = carousel.scrollLeft;
        carousel.classList.add('active:cursor-grabbing');
    });

    carousel.addEventListener('mousemove', e => {
        if (!isDragging) return;
        e.preventDefault();
        const dx = e.pageX - carousel.offsetLeft - startX;
        carousel.scrollLeft = scrollStart - dx;
    });

    ['mouseup', 'mouseleave'].forEach(ev => carousel.addEventListener(ev, () => {
        if (!isDragging) return;
        isDragging = false;
        // Snap to nearest card after drag ends
        scrollToCard(currentIndex());
    }));
})();
</script>