const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

/** JS **/
mix.js('resources/js/app.js', 'public/js').version();

/** CSS - App **/
mix.postCss('resources/css/app.css', 'public/css')
    .options({
        postCss: [
            require('postcss-import'),
            require('postcss-nested'),
            tailwindcss('./tailwind.config.js'),
            require('autoprefixer')
        ]
    })
    .version();

/** CSS - Auth **/
mix.postCss('resources/css/auth.css', 'public/css')
    .options({
        postCss: [
            require('postcss-import'),
            require('postcss-nested'),
            tailwindcss('./tailwind.config.js'),
            require('autoprefixer')
        ]
    })
    .version();

/** Babel **/
mix.babelConfig({
    plugins: ['@babel/plugin-syntax-dynamic-import'],
});


/** Webpack **/
mix.webpackConfig({
    output: {
        chunkFilename: 'js/[name].js?id=[chunkhash]',
    }
});
