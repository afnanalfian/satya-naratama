/* =====================================================================
   SIDEBAR DASHBOARD (off-canvas mobile)

   Versi lama gagal menutup lewat backdrop karena tiga kelemahan yang
   saling menutupi:

   1. STATE DISIMPAN DI VARIABEL, BUKAN DI DOM.
      `let sidebarOpen` adalah salinan state. `closeSidebar()` dijaga
      dengan `if (sidebarOpen)`, jadi begitu salinan itu tidak sinkron
      dengan DOM -- karena file ini ter-load dua kali (masing-masing
      punya `sidebarOpen` sendiri, sementara window.closeSidebar
      ditimpa oleh yang terakhir), karena halaman berpindah tanpa
      reload, atau karena ada skrip lain yang mengubah class sidebar --
      fungsi tutup jadi no-op TANPA error apa pun di console. Persis
      gejala "tombolnya hidup, backdrop-nya diam".
      Sekarang state dibaca langsung dari DOM (ada/tidaknya class
      `-translate-x-full`), sehingga mustahil desync.

   2. LISTENER DIPASANG KE ELEMEN, DI DALAM DOMContentLoaded.
      `backdrop.addEventListener(...)` hanya menempel pada objek
      elemen yang ada saat itu. Kalau elemennya diganti belakangan
      (render ulang Livewire, wire:navigate, bfcache setelah tombol
      back), elemen baru tidak membawa listener-nya -- sementara
      `onclick="..."` inline tetap hidup karena ia atribut HTML.
      Itu sebabnya tombol hamburger & tombol X tetap jalan sedangkan
      backdrop mati.
      Sekarang dipakai event delegation di `document`: satu listener,
      berlaku untuk elemen yang ada sekarang maupun yang muncul nanti.

   3. TIDAK ADA JARING PENGAMAN "TAP DI LUAR".
      Kalau ada elemen lain yang kebetulan menutupi backdrop (header
      sticky, tombol melayang, toast), tap tidak pernah sampai ke
      backdrop dan sidebar terkunci terbuka. Sekarang tap di mana pun
      di luar sidebar akan menutupnya, tidak bergantung pada backdrop.

   API lama tetap dipertahankan: window.toggleSidebar() dan
   window.closeSidebar() masih bisa dipanggil dari atribut onclick
   yang sudah ada di blade, jadi tidak ada markup lama yang rusak.
   ===================================================================== */

const SIDEBAR_ID = 'sidebar';
const BACKDROP_ID = 'sidebar-backdrop';
const CLOSED_CLASS = '-translate-x-full';

const mqDesktop = window.matchMedia('(min-width: 768px)');

function getSidebar() {
    return document.getElementById(SIDEBAR_ID);
}

function getBackdrop() {
    return document.getElementById(BACKDROP_ID);
}

/**
 * Satu-satunya sumber kebenaran: kondisi DOM saat ini.
 */
function isSidebarOpen() {
    const sidebar = getSidebar();
    return !!sidebar && !sidebar.classList.contains(CLOSED_CLASS);
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
        // Di desktop sidebar selalu tampil (CSS memaksa translateX(0)),
        // jadi jangan tandai tersembunyi bagi screen reader.
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

    // Selalu dikembalikan, tanpa syarat -- supaya halaman tidak pernah
    // tertinggal dalam keadaan tidak bisa di-scroll.
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
   API global (dipakai atribut onclick di blade)
   --------------------------------------------------------------- */
window.toggleSidebar = toggleSidebar;
window.openSidebar = openSidebar;
window.closeSidebar = closeSidebar;
window.isSidebarOpen = isSidebarOpen;

/* ---------------------------------------------------------------
   Event delegation -- dipasang sekali di document, tidak peduli
   kapan elemennya dibuat atau diganti.
   --------------------------------------------------------------- */
document.addEventListener('click', function (e) {
    const target = e.target instanceof Element ? e.target : null;
    if (!target) return;

    // 1. Tombol/elemen bertanda tutup (backdrop, tombol X)
    if (target.closest('[data-sidebar-close]')) {
        e.preventDefault();
        closeSidebar();
        return;
    }

    // 2. Tombol bertanda toggle (hamburger)
    if (target.closest('[data-sidebar-toggle]')) {
        e.preventDefault();
        toggleSidebar();
        return;
    }

    // 3. Backdrop lama yang belum sempat diberi data-attribute
    if (target.id === BACKDROP_ID) {
        closeSidebar();
        return;
    }

    // 4. Jaring pengaman: tap di mana pun di luar sidebar akan
    //    menutupnya. Berlaku juga kalau backdrop kebetulan tertutupi
    //    elemen lain sehingga tap tidak pernah mengenainya.
    if (mqDesktop.matches || !isSidebarOpen()) return;

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

/* Reset saat viewport berpindah ke desktop.
   matchMedia dipakai, bukan resize + innerWidth, supaya tidak ikut
   terpicu saat address bar browser mobile muncul/hilang. */
mqDesktop.addEventListener('change', function (e) {
    if (e.matches) closeSidebar();
});

/* Pastikan state awal selalu bersih. Dipasang untuk tiga siklus hidup:
   load pertama, navigasi Livewire (wire:navigate), dan pemulihan
   halaman dari bfcache setelah tombol back. Kalau salah satu event ini
   tidak pernah terjadi di project ini, listener-nya cuma menganggur --
   tidak ada efek samping. */
function resetSidebarState() {
    const sidebar = getSidebar();
    if (!sidebar) return;

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

// Jalankan juga langsung, untuk kasus file ini di-load setelah DOM siap.
if (document.readyState !== 'loading') {
    resetSidebarState();
}
