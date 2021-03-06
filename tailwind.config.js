module.exports = {
    important: true,
    darkMode: false, // or 'media' or 'class'
    theme: {
        //  stroke: theme => ({
        //   // current: 'currentColor',
        //   white: theme('colors.white'),
        //   gray : theme('colors.text-gray-dark'),
        //   // orange: theme('colors.text-yellow'),
        // }),

        fontFamily: {
            sans: [
                'Lora',
            ],
            serif: ['Montserrat'],
        },
        fontSize: {
            xs: '0.75rem',
            sm: '0.875rem',
            base: '1rem',
            lg: '1.125rem',
            xl: '1.25rem',
            '2xl': '1.5rem',
            '3xl': '1.875rem',
            '4xl': '2.25rem',
            '5xl': '3rem',
            '6xl': '4rem',
            '7xl': '5rem',
        },
        //
        // borderWidth: {
        //     default: '1px',
        //     '0': '0',
        //     '2': '2px',
        //     '4': '4px',
        // },
        height: {
            px: '1px',
            '0': '0',
            '1': '0.25rem',
            '2': '0.5rem',
            '3': '0.75rem',
            '4': '1rem',
            '5': '1.25rem',
            '6': '1.5rem',
            '8': '2rem',
            '10': '2.5rem',
            '12': '3rem',
            '16': '4rem',
            '20': '5rem',
            '24': '6rem',
            '28': '7rem',
            '32': '8rem',
            '40': '10rem',
            '48': '12rem',
            '56': '14rem',
            '64': '16rem',
            '80': '20rem',
            '88': '22rem',
            '96': '24rem',
            '112': '28rem',
            '120': '30rem',
            '132': '34rem',
            '140': '36rem',
            '264': '68rem',
            'screen': '100vh',
        },

        extend: {
            colors: {
                'gray-grey': '#242424',
                'gray-dark': '#212121',
                'gray-dark-light': '#2f2f2f',
                'gray-dark-grey': '#353535',
                'gray-silver': '#747474',
                'gray-cloud': '#969696',
                'gray-light': '#a3a3a3',
                'gray-snow': '#e8e8e8',
                'gray-dim': '#686868',
                gold: '#dfa46d',
                'yellow-unclean': '#352e27',
                chocolate: '#dfa36d',
                'rosy-brown': '#bc786b',
                white: '#fff',
                'ghost-white': '#f8f8f8',
                'old-lace': '#fdfdfd',
                'orange-light': "#f5f5f5",
                'orange-orange': "#eba057",
                scarlet: '#f91154',
                'semi-75': 'rgba(0, 0, 0, 0.75)',
                //new color in desine
                'gray-black': '#0F0F0F',
                'platinum': '#E5E5E5',
                'pale-sand': '#D3BDAA', // category bg
                'perl-white': '#EAE0D6', // bg its you section
                'lite-pale-sand': '#D9B5A5', //bg its you section image block
                'pale-chestnut': '#DBB1A1', //bg you skin uniquire
                'black-red': '#DBB1A1', //bg menu
                'lite-crimsont-red': '#BE3248', // bg btn cart
                'dark-brown': '#7B645C', // bg cart block
                'white-antique': '#F2E6DB', //bg alert
                'brownish-pink': '#C49C78', // text gold
            },
            spacing: {
                '96': '24rem',
                '128': '32rem',
            },
            transitionProperty: {
                'height': 'height',
                'spacing': 'margin, padding',
            },
        },
    },
    purge: {
        content: [
            './app/**/*.php',
            './resources/**/*.html',
            './resources/**/*.js',
            './resources/**/*.jsx',
            './resources/**/*.ts',
            './resources/**/*.tsx',
            './resources/**/*.php',
            './resources/**/*.vue',
            './resources/**/*.twig',
        ],
        options: {
            defaultExtractor: content => content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    variants: {
        width: ['responsive', 'focus'],
    },
}