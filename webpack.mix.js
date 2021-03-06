const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/user/pages/friends.js', 'public/js/user/pages')
    .js('resources/js/user/pages/profile.js', 'public/js/user/pages');

mix.sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/user/main.scss', 'public/css/user')
    .sass('resources/sass/user/rounds/index.scss', 'public/css/user/rounds')
    // .sass('resources/sass/user/pages/profile.scss', 'public/css/user/pages')
    .less('resources/sass/user/pages/friends.less', 'public/css/user/pages');
