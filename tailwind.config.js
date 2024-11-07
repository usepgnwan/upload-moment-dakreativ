const { addDynamicIconSelectors } = require('@iconify/tailwind');
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    mode: 'jit',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                italiano: ['Italianno'],
            },
        },
    },
    plugins: [
        require('flowbite/plugin'),
        addDynamicIconSelectors({
            prefix: 'icon', // This should match the prefix in your HTML
        }),
    ],
};
