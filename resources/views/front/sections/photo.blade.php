<!-- resources/views/front/sections/photo.blade.php -->
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

<section class="relative py-16 md:py-20 overflow-hidden bg-gradient-to-b from-white via-[#F8FAFC] to-white">
    {{-- Background Decoration --}}
    <div class="absolute inset-0">
        <div class="absolute -top-40 -left-32 w-80 h-80 bg-[#2563EB]/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#8B5CF6]/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative container-custom">
        {{-- Header --}}
        <div class="text-center mb-10 md:mb-14">
            <span class="section-label inline-flex">
                Dokumentasi
            </span>

            <h2 class="mt-4 md:mt-5 text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#0F172A]">
                Galeri
                <span class="text-gradient-primary">Satya Naratama</span>
            </h2>
        </div>

        {{-- Slider --}}
        <div class="relative">
            <div class="overflow-hidden rounded-3xl shadow-elegant-lg">
                <div
                    id="photoSlider"
                    class="flex transition-transform duration-500 ease-in-out"
                    style="transform: translateX(0);"
                >
                    @foreach($photos as $index => $photo)
                        <div class="flex-none w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 px-2 md:px-3">
                            <div class="relative rounded-2xl md:rounded-3xl overflow-hidden shadow-lg group">
                                <img
                                    src="{{ asset('img/sn/' . $photo->getFilename()) }}"
                                    alt="Galeri Satya Naratama - {{ $index + 1 }}"
                                    class="w-full h-[250px] sm:h-[300px] md:h-[380px] lg:h-[420px] object-cover duration-700 group-hover:scale-110"
                                    loading="lazy"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <p class="text-sm font-medium">Dokumentasi {{ $index + 1 }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Navigation --}}
            <button
                id="prevBtn"
                class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 z-10 bg-white/90 hover:bg-white text-[#0F172A] p-2 md:p-3 rounded-full shadow-elegant hover:shadow-elegant-hover transition-all duration-300 backdrop-blur-sm"
                aria-label="Previous"
            >
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <button
                id="nextBtn"
                class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 z-10 bg-white/90 hover:bg-white text-[#0F172A] p-2 md:p-3 rounded-full shadow-elegant hover:shadow-elegant-hover transition-all duration-300 backdrop-blur-sm"
                aria-label="Next"
            >
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- Dots --}}
            <div id="dotsContainer" class="flex justify-center gap-2 mt-6 md:mt-8">
                @foreach($photos as $index => $photo)
                    <button
                        class="dot h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-[#2563EB] w-6 md:w-8' : 'bg-[#CBD5E1] w-2 md:w-3 hover:bg-[#94A3B8]' }}"
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
                dot.classList.add('bg-[#2563EB]', 'w-6', 'md:w-8');
                dot.classList.remove('bg-[#CBD5E1]', 'w-2', 'md:w-3');
            } else {
                dot.classList.remove('bg-[#2563EB]', 'w-6', 'md:w-8');
                dot.classList.add('bg-[#CBD5E1]', 'w-2', 'md:w-3');
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

    dots.forEach((dot, index) => {
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
