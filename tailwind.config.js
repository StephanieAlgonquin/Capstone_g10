import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'palette': {
                    'light': '#CDCBD6',
                    'orange': '#D96846',
                    'olive': '#596235',
                    'dark': '#2F3020',
                },
                'dark': {
                    'bg': '#1A1B23',
                    'sidebar': '#252732',
                    'card': '#2D2E3A',
                    'hover': '#353642',
                    'text': '#FFFFFF',
                    'text-muted': '#A0A0B0',
                    'border': '#3A3B47',
                },
            },
        },
    },

    plugins: [forms],
};
