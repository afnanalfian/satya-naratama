<!-- resources/views/front/partials/scroll-to-top.blade.php -->
<style>
    #scroll-to-top {
        position: fixed;
        bottom: 1.5rem;
        right: 1.5rem;
        z-index: 40;
        display: none;
        align-items: center;
        justify-content: center;
        width: 2.75rem;
        height: 2.75rem;
        border-radius: 9999px;
        background: linear-gradient(135deg, #2563EB, #1D4ED8);
        color: white;
        box-shadow: 0 4px 16px rgba(37, 99, 235, 0.3);
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 1.25rem;
    }

    #scroll-to-top:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 32px rgba(37, 99, 235, 0.4);
        background: linear-gradient(135deg, #1D4ED8, #1E40AF);
    }

    #scroll-to-top.visible {
        display: flex;
        animation: fadeInUp 0.3s ease-out;
    }
</style>

<button
    id="scroll-to-top"
    onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
    aria-label="Scroll to top"
>
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
    </svg>
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('scroll-to-top');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 400) {
            btn.classList.add('visible');
        } else {
            btn.classList.remove('visible');
        }
    });
});
</script>
