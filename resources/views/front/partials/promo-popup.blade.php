@if($activePromo && $activePromo->isCurrentlyActive() && $activePromo->type == 'popup')
<div id="promoPopup"
     class="fixed inset-0 z-[100] hidden flex items-center justify-center"
     data-delay="{{ $activePromo->display_delay }}"
     data-duration="{{ $activePromo->display_duration }}">

    {{-- Overlay --}}
    <div id="promoOverlay"
         class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>

    {{-- Image Wrapper --}}
    <div class="relative z-10 max-w-[90vw] max-h-[90vh] flex items-center justify-center animate-fadeIn">

        {{-- Close Button --}}
        <button id="closePromo"
                class="absolute -top-4 -right-4 w-10 h-10 rounded-full bg-white shadow-lg flex items-center justify-center hover:scale-110 transition">
            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Countdown --}}
        <div class="absolute -top-4 -left-4 px-3 py-1 bg-primary text-white text-xs font-bold rounded-full">
            Menutup dalam <span id="countdownTimer">{{ $activePromo->display_duration }}</span>s
        </div>

        {{-- Promo Image --}}
        @if($activePromo->target_url)
        <a href="{{ $activePromo->resolved_url }}" target="_blank">
            <img src="{{ $activePromo->image_url }}"
                 alt="{{ $activePromo->title }}"
                 class="max-w-full max-h-[90vh] object-contain">
        </a>
        @else
        <img src="{{ $activePromo->image_url }}"
             alt="{{ $activePromo->title }}"
             class="max-w-full max-h-[90vh] object-contain">
        @endif

    </div>
</div>

@push('styles')
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.96); }
    to   { opacity: 1; transform: scale(1); }
}
.animate-fadeIn {
    animation: fadeIn 0.35s ease-out;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('promoPopup');
    const overlay = document.getElementById('promoOverlay');
    const closeBtn = document.getElementById('closePromo');
    const countdown = document.getElementById('countdownTimer');

    const cookieKey = 'promo_closed_{{ $activePromo->id }}';

    if (!getCookie(cookieKey)) {
        const delay = parseInt(popup.dataset.delay) || 3000;
        const duration = parseInt(popup.dataset.duration) || 15;

        setTimeout(() => {
            popup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            let timeLeft = duration;
            const timer = setInterval(() => {
                timeLeft--;
                countdown.textContent = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    closePopup();
                }
            }, 1000);
        }, delay);
    }

    function closePopup() {
        popup.classList.add('hidden');
        document.body.style.overflow = 'auto';
        setCookie(cookieKey, '1', 1);
    }

    closeBtn.addEventListener('click', closePopup);
    overlay.addEventListener('click', closePopup);

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closePopup();
    });

    function setCookie(name, value, days) {
        const d = new Date();
        d.setTime(d.getTime() + days * 86400000);
        document.cookie = `${name}=${value};expires=${d.toUTCString()};path=/`;
    }

    function getCookie(name) {
        return document.cookie.split('; ').find(row => row.startsWith(name + '='))?.split('=')[1];
    }
});
</script>
@endpush
@endif
