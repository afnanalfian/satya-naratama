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
        colors: {
            azwara: {
                darkest:  "#0B1F33", // Navy sangat gelap (sidebar / header)
                darker:   "#102F4A", // Navy tua (secondary background)
                medium:   "#1E4E6D", // Navy medium (PRIMARY UI color)
                light:    "#3A6F8F", // Biru lembut untuk hover / active
                lighter:  "#BFD3E0", // Biru abu pastel (border / subtle bg)
                lightest: "#F2EFE7", // Krem lembut (TETAP)
            },

            primary:   "#1E4E6D",   // Navy medium
            secondary: "#102F4A",   // Navy tua (BUKAN gold)
        },
        backgroundImage: {
            "brand-gradient":
                "linear-gradient(135deg, #0B1F33 0%, #102F4A 60%, #1E4E6D 100%)",
        },

        },

    plugins: [
        require("@tailwindcss/forms"),
    ],
}};
