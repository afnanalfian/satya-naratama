// Theme init (run immediately)
// (function () {
//     const storedTheme = localStorage.getItem('theme');

//     if (
//         storedTheme === 'dark' ||
//         (!storedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)
//     ) {
//         document.documentElement.classList.add('dark');
//     }
// })();

// Toggle function
// window.toggleTheme = function () {
//     const html = document.documentElement;
//     const isDark = html.classList.toggle('dark');
//     localStorage.setItem('theme', isDark ? 'dark' : 'light');
// };

// Theme init (run immediately)
(function () {
    // HAPUS ATAU COMMENT SEMUA KODE INI:
    /*
    const storedTheme = localStorage.getItem('theme');

    if (
        storedTheme === 'dark' ||
        (!storedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
    }
    */
    
    // TAMBAHKAN: Selalu set ke light
    document.documentElement.classList.remove('dark');
    localStorage.setItem('theme', 'light');
})();

// Toggle function (tetap ada untuk user yang mau pindah ke dark)
window.toggleTheme = function () {
    const html = document.documentElement;
    const isDark = html.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
};