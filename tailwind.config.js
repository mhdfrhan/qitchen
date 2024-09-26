import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Satoshi", ...defaultTheme.fontFamily.sans],
                forum: '"Forum", sans-serif',
            },
            colors: {
                black: "#0a0b0a",
                light: "#efe7d2",
                yellow: "#cfbe91",
                borderColor: "#333330",
                textColor: "#f5f2ea",
            },
        },
    },

    darkMode: "false",

    plugins: [forms, require("tailwind-scrollbar")],
};
