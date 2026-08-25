<!-- resources/views/front/partials/promo-modal.blade.php -->
@if($activePromo && $activePromo->isCurrentlyActive() && $activePromo->type == 'modal')
<div id="promoModal"
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 hidden"
     data-delay="{{ $activePromo->display_delay }}">

    <!-- Overlay -->
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" id="modalOverlay"></div>

    <!-- Modal Content -->
    <div class="relative z-10 w-full max-w-md bg-white rounded-2xl shadow-elegant-lg animate-modalIn">
        <!-- Modal Header -->
        <div class="p-6 border-b border-[#E2E8F0]">
            <div class="flex justify-between items-start">
                <div>
                    @if($activePromo->title)
                    <h3 class="text-lg font-bold text-[#0F172A] mb-1">{{ $activePromo->title }}</h3>
                    @endif
                    @if($activePromo->description)
                    <p class="text-sm text-[#64748B]">{{ $activePromo->description }}</p>
                    @endif
                </div>
                <button id="closeModal"
                        class="text-[#94A3B8] hover:text-[#0F172A] p-1 rounded-lg hover:bg-[#F1F5F9] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            @if($activePromo->image_url)
            <div class="relative w-full flex items-center justify-center bg-[#F8FAFC] rounded-xl mb-4">
                <img src="{{ $activePromo->image_url }}"
                    alt="{{ $activePromo->title }}"
                    class="max-w-full max-h-56 object-contain rounded-lg">
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                @if($activePromo->target_url)
                <a href="{{ $activePromo->resolved_url }}"
                   target="_blank"
                   class="flex-1 px-4 py-3 bg-[#2563EB] text-white font-medium rounded-xl hover:bg-[#1D4ED8] transition-colors text-center shadow-elegant">
                    Lihat Promo
                </a>
                @endif

                <button id="modalCancel"
                        class="flex-1 px-4 py-3 border border-[#E2E8F0] text-[#0F172A] font-medium rounded-xl hover:bg-[#F1F5F9] transition-colors">
                    Nanti Saja
                </button>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-3 bg-[#F8FAFC] rounded-b-2xl border-t border-[#E2E8F0]">
            <p class="text-xs text-[#94A3B8] text-center">
                Promo ini berlaku hingga {{ $activePromo->ends_at ? $activePromo->ends_at->format('d M Y') : 'waktu yang ditentukan' }}
            </p>
        </div>
    </div>
</div>

@push('styles')
<style>
@keyframes modalIn {
    from {
        opacity: 0;
        transform: scale(0.95) translateY(-20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.animate-modalIn {
    animation: modalIn 0.3s ease-out;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const promoModal = document.getElementById('promoModal');
    const closeModalBtn = document.getElementById('closeModal');
    const modalOverlay = document.getElementById('modalOverlay');
    const modalCancelBtn = document.getElementById('modalCancel');

    const modalClosedToday = getCookie('modal_closed_{{ $activePromo->id }}');

    if (!modalClosedToday) {
        const delay = parseInt(promoModal.getAttribute('data-delay')) || 2000;

        setTimeout(() => {
            promoModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }, delay);
    }

    function closeModal() {
        promoModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        setCookie('modal_closed_{{ $activePromo->id }}', 'true', 1);
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
    }

    if (modalOverlay) {
        modalOverlay.addEventListener('click', closeModal);
    }

    if (modalCancelBtn) {
        modalCancelBtn.addEventListener('click', closeModal);
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !promoModal.classList.contains('hidden')) {
            closeModal();
        }
    });

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
