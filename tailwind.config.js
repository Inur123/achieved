import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',

    ],
    theme: {
        extend: {
            colors: {
                'peta-red': '#be2c13',
            },
            fontFamily: {
                'poppins': ['Poppins', 'sans-serif'],
                'sub': ['Verdana', 'Geneva', 'Tahoma', 'sans-serif'],
            },
        },
    },
    plugins: [],
};
