// Theme init (run immediately)
(function () {
    const storedTheme = localStorage.getItem('theme');

    if (
        storedTheme === 'dark' ||
        (!storedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
    }
})();

// Toggle function
window.toggleTheme = function () {
    const html = document.documentElement;
    const isDark = html.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
};
