document.addEventListener("DOMContentLoaded", () => {
    const header = document.getElementById("site-header");
    if (!header) return; //jangan eksekusi jika bukan landing page

    const mobileBtn = document.getElementById("mobile-menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");
    const toTop = document.getElementById("scroll-to-top");
    const navLinks = document.querySelectorAll('.nav-link');

    // ===== HEADER SCROLL EFFECT =====
    const updateHeader = () => {
        if (window.scrollY > 40) {
            header.classList.remove("bg-transparent");
            header.classList.add("bg-azwara-lightest", "shadow-lg", "backdrop-blur-sm", "bg-opacity-95");
        } else {
            header.classList.remove("bg-azwara-lightest", "shadow-lg", "backdrop-blur-sm", "bg-opacity-95");
            header.classList.add("bg-transparent");
        }
    };

    // Initial state
    updateHeader();

    // ===== MOBILE MENU TOGGLE =====
    const toggleMobileMenu = () => {
        mobileMenu.classList.toggle("hidden");
        mobileMenu.classList.toggle("block");
    };

    // Event listener untuk mobile button
    if (mobileBtn) {
        mobileBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            toggleMobileMenu();
        });
    }

    // Close mobile menu ketika klik di luar
    document.addEventListener('click', (e) => {
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            if (!mobileMenu.contains(e.target) &&
                (!mobileBtn || !mobileBtn.contains(e.target))) {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('block');
            }
        }
    });

    // ===== SCROLL TO TOP =====
    const updateScrollToTop = () => {
        if (toTop) {
            toTop.classList.toggle("hidden", window.scrollY < 200);
        }
    };

    // ===== SMOOTH SCROLL FOR ANCHOR LINKS =====
    const setupSmoothScroll = () => {
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && href.startsWith('#')) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        // Close mobile menu jika terbuka
                        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                            mobileMenu.classList.remove('block');
                        }

                        // Smooth scroll ke target
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            }
        });
    };

    // ===== SCROLL EVENT HANDLER =====
    const handleScroll = () => {
        updateHeader();
        updateScrollToTop();
    };

    // Setup semua event listeners
    window.addEventListener("scroll", handleScroll);
    setupSmoothScroll();
});
