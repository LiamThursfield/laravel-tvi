/*
** TailwindCSS Configuration File
**
** Docs: https://tailwindcss.com/docs/configuration
** Default: https://github.com/tailwindcss/tailwindcss/blob/master/stubs/defaultConfig.stub.js
*/

// load default theme settings
const defaultTheme = require('tailwindcss/defaultTheme');

const additionalSpacing = {
    '14': '3.5rem',
    '84': '21rem',
};

module.exports = {
    experimental: {
        applyComplexClasses: true,
        defaultLineHeights: true,
        extendedFontSizeScale: true,
        extendedSpacingScale: true,
        uniformColorPalette: true,
    },
    future: {
        purgeLayersByDefault: true,
        removeDeprecatedGapUtilities: true,
    },
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.html',
        './resources/**/*.vue',
    ],
    theme: {
        fontFamily: {
            'sans': ['Poppins', ...defaultTheme.fontFamily.sans],
        },
        extend: {
            animation: {
                'spin-slow': 'spin 1.5s linear infinite',
            },
            boxShadow: {
                'outline-blue'      : '0 0 0 3px rgba(63, 141, 248, 0.5)',
                'outline-cyan'      : '0 0 0 3px rgba(0, 188, 212, 0.5)',
                'outline-green'     : '0 0 0 3px rgba(31, 152, 63, 0.5)',
                'outline-indigo'    : '0 0 0 3px rgba(90, 103, 216, 0.5)',
                'outline-primary'   : 'var(--shadow-outline-primary)',
                'outline-white'     : '0 0 0 3px rgba(255, 255, 255, 0.5)',
                'subtle'            : '0px 0px 32px 0px rgba(136, 152, 170, 0.15)',
            },
            borderRadius: {
                'xl':  '1rem',
                '2xl':  '2rem',
            },
            colors: {
                theme: {
                    'base'                      : 'var(--color-base)',
                    'base-contrast'             : 'var(--color-base-contrast)',
                    'base-subtle'               : 'var(--color-base-subtle)',
                    'base-subtle-contrast'      : 'var(--color-base-subtle-contrast)',
                    'card'                      : 'var(--color-card)',
                    'card-contrast'             : 'var(--color-card-contrast)',
                    'danger'                    : 'var(--color-danger)',
                    'danger-contrast'           : 'var(--color-danger-contrast)',
                    'danger-hover'              : 'var(--color-danger-hover)',
                    'danger-hover-contrast'     : 'var(--color-danger-hover-contrast)',
                    'info'                      : 'var(--color-info)',
                    'info-contrast'             : 'var(--color-info-contrast)',
                    'info-hover'                : 'var(--color-info-hover)',
                    'info-hover-contrast'       : 'var(--color-info-contrast-hover)',
                    'primary'                   : 'var(--color-primary)',
                    'primary-contrast'          : 'var(--color-primary-contrast)',
                    'primary-hover'             : 'var(--color-primary-hover)',
                    'primary-hover-contrast'    : 'var(--color-primary-hover-contrast)',
                    'primary-subtle'            : 'var(--color-primary-subtle)',
                    'primary-subtle-contrast'   : 'var(--color-primary-subtle-contrast)',
                    'success'                   : 'var(--color-success)',
                    'success-contrast'          : 'var(--color-success-contrast)',
                    'success-hover'             : 'var(--color-success-hover)',
                    'success-hover-contrast'    : 'var(--color-success-hover-contrast)',
                    'warning'                   : 'var(--color-warning)',
                    'warning-contrast'          : 'var(--color-warning-contrast)',
                    'warning-hover'             : 'var(--color-warning-hover)',
                    'warning-hover-contrast'    : 'var(--color-warning-hover-contrast)',
                },
                gray: {
                    ...defaultTheme.colors.gray,
                    '150': '#F4F7FA',
                    '850': '#222938'
                },
                mono: {
                    100: '#E5E5E5',
                    200: '#CCCCCC',
                    300: '#B2B2B2',
                    400: '#999999',
                    500: '#807F7F',
                    600: '#666666',
                    700: '#4D4D4D',
                    800: '#333333',
                    900: '#1A1A1A',
                },
                navy: {
                    100: '#E6E7EA',
                    200: '#C2C4CC',
                    300: '#999CAA',
                    400: '#707487',
                    500: '#51576E',
                    600: '#323954',
                    700: '#2D334D',
                    800: '#262C43',
                    850: '#1F243A',
                    900: '#131729',
                },
                cyan: {
                    100: '#E0F7FA',
                    200: '#B2EBF2',
                    300: '#80DEEA',
                    400: '#4DD0E1',
                    500: '#26C6DA',
                    600: '#00bcd4',
                    700: '#00ACC1',
                    800: '#0097A7',
                    850: '#00838F',
                    900: '#006064',
                }
            },
            margin: {
                'px': '1px'
            },
            minWidth: {
                ...defaultTheme.spacing,
                ...additionalSpacing
            },
            spacing: additionalSpacing,
            transitionProperty: {
                'height': 'height',
                'spacing': 'margin, padding',
            }
        },
    },
    variants: {
        accessibility: ['responsive', 'focus'],
        alignContent: ['responsive'],
        alignItems: ['responsive'],
        alignSelf: ['responsive'],
        appearance: ['responsive'],
        backgroundAttachment: ['responsive'],
        backgroundClip: ['responsive'],
        backgroundColor: ['responsive', 'hover', 'focus'],
        backgroundImage: ['responsive'],
        gradientColorStops: ['responsive', 'hover', 'focus'],
        backgroundOpacity: ['responsive', 'hover', 'focus'],
        backgroundPosition: ['responsive'],
        backgroundRepeat: ['responsive'],
        backgroundSize: ['responsive'],
        borderCollapse: ['responsive'],
        borderColor: ['responsive', 'hover', 'focus', 'focus-within'],
        borderOpacity: ['responsive', 'hover', 'focus'],
        borderRadius: ['responsive', 'hover'],
        borderStyle: ['responsive'],
        borderWidth: ['responsive', 'hover'],
        boxShadow: ['responsive', 'hover', 'focus'],
        boxSizing: ['responsive'],
        container: ['responsive'],
        cursor: ['responsive'],
        display: ['responsive'],
        divideColor: ['responsive'],
        divideOpacity: ['responsive'],
        divideStyle: ['responsive'],
        divideWidth: ['responsive'],
        fill: ['responsive'],
        flex: ['responsive'],
        flexDirection: ['responsive'],
        flexGrow: ['responsive'],
        flexShrink: ['responsive'],
        flexWrap: ['responsive'],
        float: ['responsive'],
        clear: ['responsive'],
        fontFamily: ['responsive'],
        fontSize: ['responsive'],
        fontSmoothing: ['responsive'],
        fontVariantNumeric: ['responsive'],
        fontStyle: ['responsive'],
        fontWeight: ['responsive', 'hover', 'focus'],
        height: ['responsive'],
        inset: ['responsive'],
        justifyContent: ['responsive'],
        justifyItems: ['responsive'],
        justifySelf: ['responsive'],
        letterSpacing: ['responsive'],
        lineHeight: ['responsive'],
        listStylePosition: ['responsive'],
        listStyleType: ['responsive'],
        margin: ['responsive', 'hover'],
        maxHeight: ['responsive'],
        maxWidth: ['responsive'],
        minHeight: ['responsive'],
        minWidth: ['responsive'],
        objectFit: ['responsive'],
        objectPosition: ['responsive'],
        opacity: ['responsive', 'hover', 'focus'],
        order: ['responsive'],
        outline: ['responsive', 'focus'],
        overflow: ['responsive'],
        overscrollBehavior: ['responsive'],
        padding: ['responsive', 'hover'],
        placeContent: ['responsive'],
        placeItems: ['responsive'],
        placeSelf: ['responsive'],
        placeholderColor: ['responsive', 'focus'],
        placeholderOpacity: ['responsive', 'focus'],
        pointerEvents: ['responsive'],
        position: ['responsive'],
        resize: ['responsive'],
        space: ['responsive'],
        stroke: ['responsive'],
        strokeWidth: ['responsive'],
        tableLayout: ['responsive'],
        textAlign: ['responsive'],
        textColor: ['responsive', 'hover', 'focus', 'focus-within'],
        textOpacity: ['responsive', 'hover', 'focus'],
        textDecoration: ['responsive', 'hover', 'focus'],
        textTransform: ['responsive'],
        userSelect: ['responsive'],
        verticalAlign: ['responsive'],
        visibility: ['responsive'],
        whitespace: ['responsive'],
        width: ['responsive'],
        wordBreak: ['responsive'],
        zIndex: ['responsive'],
        gap: ['responsive'],
        gridAutoFlow: ['responsive'],
        gridTemplateColumns: ['responsive'],
        gridColumn: ['responsive'],
        gridColumnStart: ['responsive'],
        gridColumnEnd: ['responsive'],
        gridTemplateRows: ['responsive'],
        gridRow: ['responsive'],
        gridRowStart: ['responsive'],
        gridRowEnd: ['responsive'],
        transform: ['responsive'],
        transformOrigin: ['responsive'],
        scale: ['responsive', 'hover', 'focus'],
        rotate: ['responsive', 'hover', 'focus'],
        translate: ['responsive', 'hover', 'focus'],
        skew: ['responsive', 'hover', 'focus'],
        transitionProperty: ['responsive'],
        transitionTimingFunction: ['responsive'],
        transitionDuration: ['responsive'],
        transitionDelay: ['responsive'],
        animation: ['responsive'],
    },
    plugins: []
};
