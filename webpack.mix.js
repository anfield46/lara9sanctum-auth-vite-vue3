// webpack.mix.js

const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.styles([
        'public/assets/plugins/global/plugins.bundle.css',
        'public/assets/css/style.bundle.css',
    ],'public/css/template.css').version();

mix.scripts([
        'public/assets/plugins/global/plugins.bundle.js',
        'public/assets/js/scripts.bundle.js'
    ], 'public/js/template.js').version();