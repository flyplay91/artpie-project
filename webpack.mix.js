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

mix.js('resources/js/front/app.js', 'public/js/front')
 .sass('resources/sass/front/app.scss', 'public/css/front');

 mix.js('resources/js/admin/app.js', 'public/js/admin')
 .sass('resources/sass/admin/app.scss', 'public/css/admin');