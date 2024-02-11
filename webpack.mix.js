const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

const path = require('path');

mix.alias({
    // for Vue
    'zora-js': path.resolve(__dirname, 'vendor/jetstreamlabs/zora/dist/index.js'),
    zora: path.resolve(__dirname, 'vendor/jetstreamlabs/zora/dist/vue.js'),
});

/** JS **/
mix.js('resources/js/app.js', 'public/js')
    .vue()
    .version();

mix.js('resources/js/landlord/app.js', 'public/js/landlord')
    .vue()
    .version();

/** CSS **/
mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('postcss-nested'),
    tailwindcss('./tailwind.config.js'),
    require('autoprefixer')
]).version();

mix.postCss('resources/css/landlord/app.css', 'public/css/landlord', [
    require('postcss-import'),
    require('postcss-nested'),
    tailwindcss('./tailwind.config.js'),
    require('autoprefixer')
]).version();

mix.css('resources/css/tinymce/content.css', 'public/vendor/tinymce/skins/sigi/content.min.css');
mix.css('resources/css/tinymce/skin.css', 'public/vendor/tinymce/skins/sigi/skin.min.css');

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
