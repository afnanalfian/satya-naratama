@if($activePromo && $activePromo->isCurrentlyActive() && $activePromo->type == 'modal')
<div id="promoModal"
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 hidden"
     data-delay="{{ $activePromo->display_delay }}">

    <!-- Overlay -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" id="modalOverlay"></div>

    <!-- Modal Content -->
    <div class="relative z-10 w-full max-w-md bg-white rounded-xl shadow-2xl animate-modalIn">
        <!-- Modal Header -->
        <div class="p-6 border-b border-azwara-lighter">
            <div class="flex justify-between items-start">
                <div>
                    @if($activePromo->title)
                    <h3 class="text-lg font-bold text-azwara-darkest mb-1">{{ $activePromo->title }}</h3>
                    @endif
                    @if($activePromo->description)
                    <p class="text-sm text-gray-600">{{ $activePromo->description }}</p>
                    @endif
                </div>
                <button id="closeModal"
                        class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            @if($activePromo->image_url)
            <div class="relative w-full flex items-center justify-center bg-azwara-lightest rounded-lg">
                <img src="{{ $activePromo->image_url }}"
                    alt="{{ $activePromo->title }}"
                    class="max-w-full max-h-56 object-contain">
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                @if($activePromo->target_url)
                <a href="{{ $activePromo->resolved_url }}"
                   target="_blank"
                   class="flex-1 px-4 py-3 bg-primary text-white font-medium rounded-lg hover:bg-azwara-medium transition-colors text-center">
                    Lihat Promo
                </a>
                @endif

                <button id="modalCancel"
                        class="flex-1 px-4 py-3 border border-azwara-lighter text-azwara-darkest font-medium rounded-lg hover:bg-azwara-lightest transition-colors">
                    Nanti Saja
                </button>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-3 bg-azwara-lightest rounded-b-xl border-t border-azwara-lighter">
            <p class="text-xs text-gray-500 text-center">
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

    // Cek cookie
    const modalClosedToday = getCookie('modal_closed_{{ $activePromo->id }}');

    if (!modalClosedToday) {
        // Delay sebelum menampilkan
        const delay = parseInt(promoModal.getAttribute('data-delay')) || 2000;

        setTimeout(() => {
            promoModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }, delay);
    }

    // Fungsi close modal
    function closeModal() {
        promoModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        setCookie('modal_closed_{{ $activePromo->id }}', 'true', 1);
    }

    // Event listeners
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
    }

    if (modalOverlay) {
        modalOverlay.addEventListener('click', closeModal);
    }

    if (modalCancelBtn) {
        modalCancelBtn.addEventListener('click', closeModal);
    }

    // Close dengan ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !promoModal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Cookie helpers
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
