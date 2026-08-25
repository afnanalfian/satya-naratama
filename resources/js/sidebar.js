let sidebarOpen = false;

window.toggleSidebar = function () {
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('sidebar-backdrop');

    sidebarOpen = !sidebarOpen;

    if (sidebarOpen) {
        sidebar.classList.remove('-translate-x-full');
        backdrop.classList.remove('hidden');
        backdrop.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scroll saat sidebar terbuka
    } else {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
        backdrop.classList.remove('active');
        document.body.style.overflow = '';
    }
};

// Fungsi untuk menutup sidebar
window.closeSidebar = function () {
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('sidebar-backdrop');

    if (sidebarOpen) {
        sidebarOpen = false;
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
        backdrop.classList.remove('active');
        document.body.style.overflow = '';
    }
};

// Tutup sidebar saat klik di luar (backdrop)
document.addEventListener('DOMContentLoaded', function() {
    const backdrop = document.getElementById('sidebar-backdrop');
    if (backdrop) {
        backdrop.addEventListener('click', function() {
            window.closeSidebar();
        });
    }

    // Tutup sidebar saat resize ke desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768 && sidebarOpen) {
            window.closeSidebar();
        }
    });

    // Tutup sidebar saat tekan ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebarOpen) {
            window.closeSidebar();
        }
    });
});
