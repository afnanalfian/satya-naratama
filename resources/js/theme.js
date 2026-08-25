// Theme init (run immediately)
(function () {
    const storedTheme = localStorage.getItem('theme');

    // Jika user sudah punya preferensi, pakai itu
    if (storedTheme === 'dark') {
        document.documentElement.classList.add('dark');
    } else if (storedTheme === 'light') {
        document.documentElement.classList.remove('dark');
    } else {
        // Default ke light mode
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    }
})();

// Toggle function
window.toggleTheme = function () {
    const html = document.documentElement;
    const isDark = html.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
};
