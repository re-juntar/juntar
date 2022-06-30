const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                'hind-madurai': 'Hind Madurai, sans-serif',
                'mada': 'Mada, sans-serif',
                'montserrat': 'Montserrat, sans-serif'
            },
            colors: {
                awesome: "#fe1355",
                fogra: {
                    dark: "#050714",
                    darkish: "#0b0d19",
                },
                white: {
                    ghost: "#f8f9fa",
                },
            },
            backgroundImage: {
                "gradient-radial":
                    "radial-gradient(ellipse at center, #0B0D19 10%, #FE1355 100%)",
                "gradient-cards":
                    "linear-gradient(270deg, #15c1ca, #f32676);",
            },
            animation: {
                "gradient-anima": "super_bg 11s ease infinite"
            },
            keyframes: {
                super_bg: {
                    '0%': {
                        backgroundPosition: '0% 50%'
                    },
                    '50%': {
                        backgroundPosition: '100% 50%'
                    },
                    '100%': {
                        backgroundPosition: '0% 50%'
                    }
                }
            }
        },
    },

    darkMode: 'class',

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
