/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",

    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/**/*.tsx",
        "./resources/**/*.ts",
        "./resources/**/*.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", "ui-sans-serif", "system-ui"],
            },
        // colors: {
            // azwara: {
            //     darkest:  "#0B1F33", // Navy sangat gelap (sidebar / header)
            //     darker:   "#102F4A", // Navy tua (secondary background)
            //     medium:   "#1E4E6D", // Navy medium (PRIMARY UI color)
            //     light:    "#3A6F8F", // Biru lembut untuk hover / active
            //     lighter:  "#BFD3E0", // Biru abu pastel (border / subtle bg)
            //     lightest: "#F2EFE7", // Krem lembut (TETAP)
            // },

            // primary:   "#1E4E6D",   // Navy medium
            // secondary: "#102F4A",   // Navy tua (BUKAN gold)
        //     primary: "#1E4E6D",      // Navy Blue
        //     secondary: "#0B2B3C",    // Dark Navy
        //     accent: "#2A7F9F",       // Soft Blue
        //     gold: "#C9A84C",         // Gold Muted
        //     'azwara': {
        //         lightest: "#F0F4F8",
        //         lighter: "#E2E8F0",
        //         light: "#CBD5E1",
        //         medium: "#1E4E6D",
        //         dark: "#0B2B3C",
        //         darkest: "#0A1A2B",
        //     }
        // },
        // backgroundImage: {
        //     "brand-gradient":
        //         "linear-gradient(135deg, #0B1F33 0%, #102F4A 60%, #1E4E6D 100%)",
        // },
        // backgroundImage: {
        //     'brand-gradient': 'linear-gradient(135deg, #1E4E6D 0%, #0B2B3C 100%)',
        //     'hero-gradient': 'linear-gradient(135deg, #0A1A2B 0%, #1E4E6D 50%, #0A1A2B 100%)',
        // },
        colors: {
            // Primary - Deep Forest Green
            primary: {
                50:  "#ECF3EC",
                100: "#D9E7D9",
                200: "#B3CFB3",
                300: "#8DB78D",
                400: "#679F67",
                500: "#418741",    // Sage Green
                600: "#346C34",
                700: "#275127",
                800: "#1A361A",
                900: "#0D1B0D",
                950: "#0A1A0A",
                DEFAULT: "#418741",
            },

            // Secondary - Warm Stone
            secondary: {
                50:  "#F5F2EE",
                100: "#EBE5DD",
                200: "#D7CBBC",
                300: "#C3B19B",
                400: "#AF977A",
                500: "#9B7D59",    // Taupe
                600: "#7C6447",
                700: "#5D4B35",
                800: "#3E3223",
                900: "#1F1911",
                DEFAULT: "#9B7D59",
            },

            // Accent - Terracotta
            accent: {
                50:  "#F6EDE8",
                100: "#EDDBD1",
                200: "#DBB7A3",
                300: "#C99375",
                400: "#B76F47",
                500: "#A54B19",    // Rust Orange
                600: "#843C14",
                700: "#632D0F",
                800: "#421E0A",
                900: "#210F05",
                DEFAULT: "#A54B19",
            },

            // Neutral - Cool Gray
            neutral: {
                50:  "#F8F9FA",
                100: "#F1F2F4",
                200: "#E3E5E8",
                300: "#D5D8DC",
                400: "#C7CBD0",
                500: "#B9BEC4",
                600: "#94989D",
                700: "#6F7276",
                800: "#4A4C4F",
                900: "#252628",
                DEFAULT: "#B9BEC4",
            },

            // Gold - Mustard
            gold: {
                50:  "#F8F4E8",
                100: "#F1E9D1",
                200: "#E3D3A3",
                300: "#D5BD75",
                400: "#C7A747",
                500: "#B99119",    // Mustard Gold
                600: "#947414",
                700: "#6F570F",
                800: "#4A3A0A",
                900: "#251D05",
                DEFAULT: "#B99119",
            },
        },

        backgroundImage: {
            'brand-gradient': 'linear-gradient(135deg, #418741 0%, #346C34 100%)',
            'hero-gradient': 'linear-gradient(135deg, #1A361A 0%, #418741 50%, #1A361A 100%)',
            'accent-gradient': 'linear-gradient(135deg, #A54B19 0%, #843C14 100%)',
        },

        },

    plugins: [
        require("@tailwindcss/forms"),
    ],
}};
