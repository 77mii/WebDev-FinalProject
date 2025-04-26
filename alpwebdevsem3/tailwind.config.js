import defaultTheme from 'tailwindcss/defaultTheme';
const colors = require('tailwindcss/colors');

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
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                //just add this below and your all other tailwind colors willwork
             ...colors
            },
        },
    },
    plugins: [
        function ({ addUtilities }) {
            const newUtilities = {
                '.writing-mode-vertical-rl': {
                    'writing-mode': 'vertical-rl',
                },
                '.text-orientation-upright': {
                    'text-orientation': 'upright',
                },
            }
            addUtilities(newUtilities, ['responsive', 'hover'])
        },
    ],
};
