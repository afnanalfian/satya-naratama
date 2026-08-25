<button
    id="scroll-to-top"
    class="hidden fixed bottom-6 right-6 z-40
           bg-primary hover:bg-red-700 text-white
           w-12 h-12 rounded-full
           flex items-center justify-center
           shadow-lg shadow-red-500/30 hover:shadow-red-500/50
           transition-all duration-300 hover:scale-110"
    onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
    aria-label="Scroll to top"
>
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
    </svg>
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('scroll-to-top');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            btn.classList.remove('hidden');
        } else {
            btn.classList.add('hidden');
        }
    });
});
</script>
