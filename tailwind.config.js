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

        // colors: {
        //     azwara: {
        //         darkest:  "#0B2A45", // Navy sangat gelap (background utama / header)
        //         darker:   "#123A5A", // Navy tua elegan
        //         medium:   "#1E5A7A", // Biru navy medium (primary action)
        //         light:    "#C9A24D", // Gold elegan (accent / CTA / highlight)
        //         lighter:  "#E6D3A3", // Gold pastel lembut (badge / subtle accent)
        //         lightest: "#F2EFE7", // Krem lembut (TETAP, sesuai request)
        //     },

        //     primary:   "#1E5A7A",   // Navy medium
        //     secondary: "#C9A24D",   // Gold elegan
        // },
        // backgroundImage: {
        //     "brand-gradient":
        //         "linear-gradient(135deg, #0B2A45 0%, #123A5A 70%, #1E5A7A 100%)",
        // },
    // colors: {
    //     azwara: {
    //         darkest:  "#012A36", // Hijau teal sangat gelap
    //         darker:   "#014F56", // Teal tua elegan
    //         medium:   "#027373", // Teal medium, segar & profesional
    //         light:    "#38A3A5", // Teal terang untuk hover
    //         lighter:  "#A9D6D6", // Teal pastel lembut
    //         lightest: "#F2EFE7", // Sangat terang, hampir putih
    //     },

    //     primary:   "#027373",   // Teal medium
    //     secondary: "#014F56",   // Teal tua elegan
    // },

    // backgroundImage: {
    //     "brand-gradient":
    //         `linear-gradient(135deg, #012A36 0%, #014F56 80%, #027373 100%)`,
    // },



        },
    },

    plugins: [
        require("@tailwindcss/forms"),
    ],
};
