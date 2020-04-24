const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');


/** App **/
mix.js('resources/js/app.js', 'public/js').version();
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
