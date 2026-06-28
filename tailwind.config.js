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
        //     colors: {
        //         azwara: {
        //             darkest:  "#210405", // Maroon super gelap mendekati hitam (sangat cocok untuk sidebar/header)
        //             darker:   "#3D0B0D", // Maroon tua/gelap (background sekunder / kartu)
        //             medium:   "#5C1317", // Maroon medium (Warna UI Utama / Elemen Dominan)
        //             light:    "#E2A51E", // Emas/Gold Terang (Warna aksen / tombol utama / hover)
        //             lighter:  "#F5C842", // Kuning/Gold cerah (Border / teks penegas / highlight)
        //             lightest: "#FFFFFF", // Putih Bersih untuk teks utama di atas background gelap (TETAP)
        //         },

        //         // Mapping ulang alias untuk mempermudah penggunaan
        //         primary:   "#5C1317",   // Maroon medium sebagai identitas utama
        //         secondary: "#E2A51E",   // Emas/Gold sebagai aksen/aksentuasi (menggantikan peran navy tua)
        //         accent:    "#F5C842",   // Kuning emas terang
        //     },
        //     backgroundImage: {
        //         // Gradient mewah khas poster (dari maroon super gelap ke maroon medium)
        //         "brand-gradient":
        //             "linear-gradient(135deg, #210405 0%, #3D0B0D 60%, #5C1317 100%)",
        //     },
        // },

    plugins: [
        require("@tailwindcss/forms"),
    ],
}};
