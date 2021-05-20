const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                '144': '36rem',
                'card': '55rem',
            },
        },
    },

    darkMode: 'class',

    variants: {

        extend: {
            gap: ['hover', 'focus', 'first'],
            borderWidth: ['first', 'dark'],
            ringWidth: ['dark'],
            padding: ['first'],
            transitionProperty: ['dark'],
            transitionDuration: ['dark'],
            transitionTimingFunction: ['dark'],
            transitionDelay: ['dark'],
            opacity: ['dark'],
            justifyContent: ['responsive', 'first', 'last'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
