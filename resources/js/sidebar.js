/* =====================================================================
   SIDEBAR DASHBOARD (off-canvas mobile)

   Prinsip dasar:
   1. STATE DIBACA DARI DOM, bukan dari variabel salinan. Sumber
      kebenaran satu-satunya adalah ada/tidaknya class
      `-translate-x-full` pada #sidebar. Tidak ada flag yang bisa
      desync, jadi closeSidebar() tidak pernah jadi no-op diam-diam.
   2. LISTENER DIPASANG DI `document` (event delegation), bukan di
      elemen. Tetap berfungsi walau elemennya dirender ulang oleh
      Livewire / wire:navigate / bfcache -- kasus yang bikin
      backdrop.addEventListener() lama berhenti bekerja.
   3. JARING PENGAMAN TAP-DI-LUAR memakai potret state saat
      `pointerdown`. Ini krusial -- lihat catatan panjang di bawah.
   ===================================================================== */

const SIDEBAR_ID = 'sidebar';
const BACKDROP_ID = 'sidebar-backdrop';
const CLOSED_CLASS = '-translate-x-full';

/* Elemen yang tidak boleh dianggap "tap di luar": tombol pembuka
   sidebar itu sendiri, dalam segala bentuk penulisannya. */
const TOGGLE_SELECTOR = [
    '[data-sidebar-toggle]',
    '[onclick*="toggleSidebar"]',
    '[onclick*="openSidebar"]',
    '[aria-controls="sidebar"]',
].join(',');

const mqDesktop = window.matchMedia('(min-width: 768px)');

function getSidebar() {
    return document.getElementById(SIDEBAR_ID);
}

function getBackdrop() {
    return document.getElementById(BACKDROP_ID);
}

function isSidebarOpen() {
    const sidebar = getSidebar();
    return !!sidebar && !sidebar.classList.contains(CLOSED_CLASS);
}

/* Apakah elemen ini sudah menangani sendiri lewat atribut onclick?
   Kalau ya, delegation TIDAK boleh ikut memanggil fungsi yang sama,
   karena satu tap akan terhitung dua kali (buka lalu tutup). */
function hasInlineSidebarHandler(el) {
    return /(toggle|open|close)Sidebar\s*\(/i.test(el.getAttribute('onclick') || '');
}

function openSidebar() {
    const sidebar = getSidebar();
    if (!sidebar || mqDesktop.matches) return;

    sidebar.classList.remove(CLOSED_CLASS);
    sidebar.setAttribute('aria-hidden', 'false');

    const backdrop = getBackdrop();
    if (backdrop) {
        backdrop.classList.remove('hidden');
        backdrop.classList.add('active');
    }

    document.body.style.overflow = 'hidden';
    syncToggleButtons(true);
}

function closeSidebar() {
    const sidebar = getSidebar();

    if (sidebar) {
        sidebar.classList.add(CLOSED_CLASS);
        if (mqDesktop.matches) {
            sidebar.removeAttribute('aria-hidden');
        } else {
            sidebar.setAttribute('aria-hidden', 'true');
        }
    }

    const backdrop = getBackdrop();
    if (backdrop) {
        backdrop.classList.remove('active');
        backdrop.classList.add('hidden');
    }

    document.body.style.overflow = '';
    syncToggleButtons(false);
}

function toggleSidebar() {
    if (isSidebarOpen()) {
        closeSidebar();
    } else {
        openSidebar();
    }
}

function syncToggleButtons(open) {
    document
        .querySelectorAll('[data-sidebar-toggle]')
        .forEach((btn) => btn.setAttribute('aria-expanded', open ? 'true' : 'false'));
}

/* ---------------------------------------------------------------
   API global -- dipakai atribut onclick yang sudah ada di blade.
   --------------------------------------------------------------- */
window.toggleSidebar = toggleSidebar;
window.openSidebar = openSidebar;
window.closeSidebar = closeSidebar;
window.isSidebarOpen = isSidebarOpen;

/* ---------------------------------------------------------------
   POTRET STATE SEBELUM INTERAKSI

   PENTING -- ini yang memperbaiki bug "hamburger tidak bisa membuka
   sidebar sama sekali".

   Satu tap pada tombol ber-onclick menghasilkan urutan:
       (a) onclick jalan di tombol       -> sidebar TERBUKA
       (b) event bubble sampai document  -> listener di bawah jalan
   Kalau di langkah (b) kita membaca isSidebarOpen(), jawabannya
   sudah `true` gara-gara langkah (a) sendiri. Tap pada hamburger
   pun jadi terbaca sebagai "tap di luar sidebar yang sedang
   terbuka", lalu langsung ditutup lagi. Buka-tutup dalam satu tap:
   dari layar terlihat seperti tombolnya mati.

   Solusinya: catat state pada `pointerdown` (fase capture), yaitu
   sebelum handler mana pun sempat mengubah DOM. Jaring pengaman
   hanya menutup kalau sidebar memang SUDAH terbuka sejak sebelum
   interaksi dimulai. Cara ini tidak bergantung pada markup tombol,
   jadi tetap benar untuk tombol pembuka yang belum kita ketahui.
   --------------------------------------------------------------- */
let openBeforeInteraction = false;

function snapshotState() {
    openBeforeInteraction = isSidebarOpen();
}

document.addEventListener('pointerdown', snapshotState, true);
// Cadangan untuk browser/WebView lawas tanpa Pointer Events.
document.addEventListener('touchstart', snapshotState, true);
document.addEventListener('mousedown', snapshotState, true);

/* ---------------------------------------------------------------
   Satu listener untuk semua interaksi sidebar.
   --------------------------------------------------------------- */
document.addEventListener('click', function (e) {
    const target = e.target instanceof Element ? e.target : null;
    if (!target) return;

    // 1. Elemen bertanda tutup (backdrop, tombol X)
    const closer = target.closest('[data-sidebar-close]');
    if (closer) {
        if (!hasInlineSidebarHandler(closer)) {
            e.preventDefault();
            closeSidebar();
        }
        return;
    }

    // 2. Tombol bertanda toggle (hamburger)
    const toggler = target.closest('[data-sidebar-toggle]');
    if (toggler) {
        if (!hasInlineSidebarHandler(toggler)) {
            e.preventDefault();
            toggleSidebar();
        }
        return;
    }

    // 3. Backdrop lama yang belum diberi data-attribute
    if (target.id === BACKDROP_ID) {
        closeSidebar();
        return;
    }

    // 4. Jaring pengaman: tap di luar sidebar menutupnya. Berlaku juga
    //    kalau backdrop kebetulan tertutupi elemen lain sehingga tap
    //    tidak pernah mengenainya.
    if (mqDesktop.matches) return;

    // Sidebar harus SUDAH terbuka sebelum tap ini dimulai -- bukan
    // terbuka gara-gara tap ini sendiri.
    if (!openBeforeInteraction || !isSidebarOpen()) return;

    // Tombol pembuka tidak pernah dihitung sebagai "tap di luar",
    // dalam bentuk penulisan apa pun.
    if (target.closest(TOGGLE_SELECTOR)) return;

    const sidebar = getSidebar();
    if (sidebar && sidebar.contains(target)) return;

    closeSidebar();
});

/* Tutup dengan tombol ESC */
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && isSidebarOpen()) {
        closeSidebar();
    }
});

/* Reset saat viewport berpindah ke desktop. matchMedia dipakai, bukan
   resize + innerWidth, supaya tidak ikut terpicu saat address bar
   browser mobile muncul/hilang. */
mqDesktop.addEventListener('change', function (e) {
    if (e.matches) closeSidebar();
});

/* Pastikan state awal bersih pada tiga siklus hidup: load pertama,
   navigasi Livewire, dan pemulihan halaman dari bfcache setelah tombol
   back. Kalau salah satu event tidak pernah terjadi di project ini,
   listener-nya cuma menganggur -- tanpa efek samping. */
function resetSidebarState() {
    const sidebar = getSidebar();
    if (!sidebar) return;

    openBeforeInteraction = false;

    if (mqDesktop.matches) {
        sidebar.removeAttribute('aria-hidden');
        document.body.style.overflow = '';

        const backdrop = getBackdrop();
        if (backdrop) {
            backdrop.classList.remove('active');
            backdrop.classList.add('hidden');
        }
        return;
    }

    closeSidebar();
}

document.addEventListener('DOMContentLoaded', resetSidebarState);
document.addEventListener('livewire:navigated', resetSidebarState);
window.addEventListener('pageshow', resetSidebarState);

if (document.readyState !== 'loading') {
    resetSidebarState();
}
