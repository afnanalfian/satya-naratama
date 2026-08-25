@php
    use Illuminate\Support\Facades\File;

    $path = public_path('img/sn');

    $photos = collect(File::files($path))
        ->filter(function ($file) {
            return in_array(strtolower($file->getExtension()), [
                'jpg', 'jpeg', 'png', 'webp', 'gif'
            ]);
        })
        ->sortByDesc(fn($file) => $file->getMTime())
        ->values();
@endphp

<section class="relative py-16 md:py-20 overflow-hidden bg-gradient-to-b from-black via-gray-900 to-black">
    {{-- Background Decoration --}}
    <div class="absolute inset-0">
        <div class="absolute -top-40 -left-32 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6">
        {{-- Header --}}
        <div class="text-center mb-10 md:mb-14">
            <span class="inline-flex items-center rounded-full bg-primary/20 px-4 py-1.5 md:px-5 md:py-2 text-sm md:text-base text-primary font-semibold border border-primary/30">
                Dokumentasi
            </span>

            <h2 class="mt-4 md:mt-5 text-3xl md:text-4xl lg:text-5xl font-extrabold text-white">
                Galeri
                <span class="text-primary">Satya Naratama</span>
            </h2>
        </div>

        {{-- Slider Container --}}
        <div class="relative">
            {{-- Slider Wrapper --}}
            <div class="overflow-hidden rounded-3xl border border-primary/20">
                <div
                    id="photoSlider"
                    class="flex transition-transform duration-500 ease-in-out"
                    style="transform: translateX(0);"
                >
                    @foreach($photos as $index => $photo)
                        <div class="flex-none w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 px-2 md:px-3">
                            <div class="relative rounded-2xl md:rounded-3xl overflow-hidden shadow-xl group">
                                <img
                                    src="{{ asset('img/sn/' . $photo->getFilename()) }}"
                                    alt="Galeri Satya Naratama - {{ $index + 1 }}"
                                    class="w-full h-[250px] sm:h-[300px] md:h-[380px] lg:h-[420px] object-cover duration-700 group-hover:scale-110"
                                    loading="lazy"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                {{-- Hover overlay --}}
                                <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/20 transition-all duration-500"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Navigation Buttons --}}
            <button
                id="prevBtn"
                class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 z-10 bg-black/90 hover:bg-primary text-white p-2 md:p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 backdrop-blur-sm border border-primary/30"
                aria-label="Previous"
            >
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <button
                id="nextBtn"
                class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 z-10 bg-black/90 hover:bg-primary text-white p-2 md:p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 backdrop-blur-sm border border-primary/30"
                aria-label="Next"
            >
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- Dots Indicator --}}
            <div id="dotsContainer" class="flex justify-center gap-2 mt-6 md:mt-8">
                @foreach($photos as $index => $photo)
                    <button
                        class="dot w-2 h-2 md:w-3 md:h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-primary w-6 md:w-8' : 'bg-gray-600 hover:bg-gray-400' }}"
                        data-index="{{ $index }}"
                        aria-label="Go to slide {{ $index + 1 }}"
                    ></button>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('photoSlider');
        const slides = slider.querySelectorAll('.flex-none');
        const totalSlides = slides.length;
        let currentIndex = 0;
        let slidesPerView = getSlidesPerView();
        let autoplayInterval = null;
        let isTransitioning = false;

        const dots = document.querySelectorAll('.dot');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        function getSlidesPerView() {
            const width = window.innerWidth;
            if (width < 640) return 1;
            if (width < 1024) return 2;
            if (width < 1280) return 3;
            return 4;
        }

        function getMaxIndex() {
            const spv = getSlidesPerView();
            return Math.max(0, totalSlides - spv);
        }

        function goToSlide(index) {
            if (isTransitioning) return;
            if (index < 0) index = 0;
            if (index > getMaxIndex()) index = getMaxIndex();

            isTransitioning = true;
            currentIndex = index;
            const translateX = -(currentIndex * (100 / getSlidesPerView()));
            slider.style.transform = `translateX(${translateX}%)`;

            dots.forEach((dot, i) => {
                const dotIndex = parseInt(dot.dataset.index);
                if (dotIndex >= currentIndex && dotIndex < currentIndex + getSlidesPerView()) {
                    dot.classList.add('bg-primary', 'w-6', 'md:w-8');
                    dot.classList.remove('bg-gray-600', 'hover:bg-gray-400');
                } else {
                    dot.classList.remove('bg-primary', 'w-6', 'md:w-8');
                    dot.classList.add('bg-gray-600', 'hover:bg-gray-400');
                }
            });

            setTimeout(() => {
                isTransitioning = false;
            }, 500);
        }

        function nextSlide() {
            const maxIndex = getMaxIndex();
            if (currentIndex >= maxIndex) {
                goToSlide(0);
            } else {
                goToSlide(currentIndex + 1);
            }
        }

        function prevSlide() {
            if (currentIndex <= 0) {
                goToSlide(getMaxIndex());
            } else {
                goToSlide(currentIndex - 1);
            }
        }

        function startAutoplay() {
            if (autoplayInterval) clearInterval(autoplayInterval);
            autoplayInterval = setInterval(nextSlide, 3000);
        }

        function stopAutoplay() {
            if (autoplayInterval) {
                clearInterval(autoplayInterval);
                autoplayInterval = null;
            }
        }

        let resizeTimeout;
        function handleResize() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                const newSlidesPerView = getSlidesPerView();
                if (newSlidesPerView !== slidesPerView) {
                    slidesPerView = newSlidesPerView;
                    goToSlide(0);
                }
            }, 250);
        }

        prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            stopAutoplay();
            prevSlide();
            startAutoplay();
        });

        nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            stopAutoplay();
            nextSlide();
            startAutoplay();
        });

        dots.forEach((dot) => {
            dot.addEventListener('click', function() {
                const dotIndex = parseInt(this.dataset.index);
                const spv = getSlidesPerView();
                let targetIndex = dotIndex;
                if (dotIndex >= totalSlides - spv) {
                    targetIndex = totalSlides - spv;
                }
                stopAutoplay();
                goToSlide(targetIndex);
                startAutoplay();
            });
        });

        const sliderContainer = document.querySelector('.overflow-hidden');
        sliderContainer.addEventListener('mouseenter', stopAutoplay);
        sliderContainer.addEventListener('mouseleave', startAutoplay);

        let touchStartX = 0;
        let touchEndX = 0;

        sliderContainer.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        sliderContainer.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    stopAutoplay();
                    nextSlide();
                    startAutoplay();
                } else {
                    stopAutoplay();
                    prevSlide();
                    startAutoplay();
                }
            }
        }, { passive: true });

        window.addEventListener('resize', handleResize);

        goToSlide(0);
        startAutoplay();
    });
</script>
