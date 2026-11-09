import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/**
 * Satya Naratama — "Garnet & Saffron"
 * Diambil dari logo elang (merah marun + emas), dibuat lebih hidup:
 *  ink     : ungu-gelap pekat untuk sidebar, hero, teks utama
 *  garnet  : merah-raspberry sebagai warna aksi utama
 *  saffron : emas-kunyit untuk sorotan, badge, ilustrasi
 *  lagoon  : toska segar untuk status sukses/informasi
 *  cream   : latar hangat (bukan putih polos)
 */
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './app/Livewire/**/*.php',
        './app/View/**/*.php',
        './app/Support/**/*.php',
        './app/Models/**/*.php',
    ],
    safelist: [
        { pattern: /^(bg|text|ring|border)-(lagoon|saffron|garnet|ink|sky|rose|amber|emerald|slate|violet)-(50|100|200|300|400|500|600|700|800)$/ },
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                display: ['"Bricolage Grotesque"', '"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                mono: ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
            },
            colors: {
                ink: {
                    50: '#f6f3fa',
                    100: '#ece6f4',
                    200: '#d8cce8',
                    300: '#b9a6d4',
                    400: '#9479b9',
                    500: '#75589f',
                    600: '#5d4384',
                    700: '#4b356b',
                    800: '#352650',
                    900: '#22173a',
                    950: '#150d26',
                },
                garnet: {
                    50: '#fff1f3',
                    100: '#ffe1e6',
                    200: '#ffc7d1',
                    300: '#ff9caf',
                    400: '#fb6484',
                    500: '#f13562',
                    600: '#d81b4d',
                    700: '#b5123f',
                    800: '#96133b',
                    900: '#7f1438',
                    950: '#47051a',
                },
                saffron: {
                    50: '#fffbeb',
                    100: '#fff3c6',
                    200: '#ffe588',
                    300: '#ffd24a',
                    400: '#ffbe20',
                    500: '#f99c07',
                    600: '#dd7402',
                    700: '#b75006',
                    800: '#943d0c',
                    900: '#7a330d',
                },
                lagoon: {
                    50: '#ecfdf9',
                    100: '#d1faef',
                    200: '#a7f3e1',
                    300: '#6ee7cf',
                    400: '#33d1b6',
                    500: '#0fb59e',
                    600: '#079282',
                    700: '#0a756a',
                    800: '#0d5d56',
                    900: '#0f4d48',
                },
                cream: '#fff9f1',
            },
            boxShadow: {
                soft: '0 1px 2px rgba(34,23,58,.05), 0 10px 30px -14px rgba(34,23,58,.22)',
                lift: '0 2px 6px rgba(34,23,58,.06), 0 22px 46px -20px rgba(34,23,58,.42)',
                glow: '0 10px 30px -10px rgba(216,27,77,.55)',
                'glow-gold': '0 10px 30px -10px rgba(249,156,7,.6)',
                pop: '4px 4px 0 0 #22173a',
            },
            borderRadius: {
                '4xl': '2rem',
            },
            backgroundImage: {
                'grid-ink': 'linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px)',
                'grid-soft': 'linear-gradient(rgba(34,23,58,.05) 1px, transparent 1px), linear-gradient(90deg, rgba(34,23,58,.05) 1px, transparent 1px)',
                'sunrise': 'linear-gradient(135deg, #d81b4d 0%, #f13562 40%, #f99c07 100%)',
            },
            keyframes: {
                marquee: { from: { transform: 'translateX(0)' }, to: { transform: 'translateX(-50%)' } },
                float: { '0%,100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-10px)' } },
                'fade-up': { from: { opacity: 0, transform: 'translateY(14px)' }, to: { opacity: 1, transform: 'none' } },
                wiggle: { '0%,100%': { transform: 'rotate(-3deg)' }, '50%': { transform: 'rotate(3deg)' } },
                'spin-slow': { to: { transform: 'rotate(360deg)' } },
            },
            animation: {
                marquee: 'marquee 38s linear infinite',
                float: 'float 6s ease-in-out infinite',
                'fade-up': 'fade-up .6s cubic-bezier(.2,.7,.2,1) both',
                wiggle: 'wiggle 2.4s ease-in-out infinite',
                'spin-slow': 'spin-slow 22s linear infinite',
            },
        },
    },
    plugins: [forms],
};
