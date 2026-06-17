@if($activePromo && $activePromo->isCurrentlyActive() && $activePromo->type == 'banner')
{{-- POSISI FIXED: TOP untuk semua banner --}}
<div id="promoBanner"
     class="fixed top-0 left-0 right-0 z-[90] transition-all duration-300"
     data-delay="{{ $activePromo->display_delay }}"
     data-duration="{{ $activePromo->display_duration }}"
     data-promo-id="{{ $activePromo->id }}">

    <div class="relative bg-gradient-to-r from-primary to-azwara-darker text-white shadow-lg">
        <!-- Close Button -->
        <button id="closeBanner"
                class="absolute top-1/2 -translate-y-1/2 right-4 z-20 w-8 h-8 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Banner Content -->
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <!-- Text Content -->
                <div class="flex-1 text-center sm:text-left">
                    @if($activePromo->title)
                    <h4 class="font-bold text-sm sm:text-base mb-1">{{ $activePromo->title }}</h4>
                    @endif
                    @if($activePromo->description)
                    <p class="text-xs sm:text-sm opacity-90 line-clamp-1">{{ $activePromo->description }}</p>
                    @endif
                </div>

                <!-- Action Button -->
                @if($activePromo->target_url)
                <div>
                    <a href="{{ $activePromo->resolved_url }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 px-4 py-1.5 bg-white text-primary text-sm font-semibold rounded-lg hover:bg-gray-100 transition-colors whitespace-nowrap">
                        <span>Lihat Promo</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Progress Bar -->
        <div id="bannerProgress" class="h-1 bg-white/30">
            <div class="h-full bg-white transition-all duration-1000" style="width: 0%"></div>
        </div>
    </div>
</div>

@push('styles')
<style>
#promoBanner {
    animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
    }
    to {
        transform: translateY(0);
    }
}

.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Adjust body padding untuk banner */
body.has-banner {
    padding-top: 60px; /* Sesuaikan tinggi banner */
}

/* Dark mode */
.dark #promoBanner {
    background: linear-gradient(to right, #0B1F33, #102F4A);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const promoBanner = document.getElementById('promoBanner');
    if (!promoBanner) return;

    const promoId = promoBanner.getAttribute('data-promo-id');
    const closeBannerBtn = document.getElementById('closeBanner');
    const bannerProgress = document.getElementById('bannerProgress');
    const progressBar = bannerProgress?.querySelector('div');

    // Cek cookie
    const bannerClosedToday = getCookie(`banner_closed_${promoId}`);

    if (!bannerClosedToday) {
        // Delay sebelum menampilkan
        const delay = parseInt(promoBanner.getAttribute('data-delay')) || 1000;
        const duration = parseInt(promoBanner.getAttribute('data-duration')) || 30;

        setTimeout(() => {
            promoBanner.classList.remove('hidden');
            document.body.classList.add('has-banner');

            // Auto close dengan progress bar
            if (progressBar && duration > 0) {
                let progress = 0;
                const interval = 100;
                const step = (interval / (duration * 1000)) * 100;

                const progressInterval = setInterval(() => {
                    progress += step;
                    progressBar.style.width = progress + '%';

                    if (progress >= 100) {
                        clearInterval(progressInterval);
                        closeBanner();
                    }
                }, interval);
            }

        }, delay);
    }

    // Fungsi close banner
    function closeBanner() {
        promoBanner.style.transform = 'translateY(-100%)';
        promoBanner.style.transition = 'transform 0.5s ease-out';
        document.body.classList.remove('has-banner');

        setTimeout(() => {
            promoBanner.remove();
        }, 500);

        // Set cookie
        setCookie(`banner_closed_${promoId}`, 'true', 1);
    }

    // Event listeners
    if (closeBannerBtn) {
        closeBannerBtn.addEventListener('click', closeBanner);
    }

    // Cookie helpers (global)
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
});
</script>
@endpush
@endif
