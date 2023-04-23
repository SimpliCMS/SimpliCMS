let mix = require('laravel-mix');

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
mix.js('resources/js/app.js', 'themes/default/assets/js')
        .js('vendor/konekt/appshell/src/resources/assets/js/appshell.standalone.js', 'themes/admin/assets/js/appshell.js')
        .sass('vendor/konekt/appshell/src/resources/assets/sass/appshell.sass', 'themes/admin/assets/css')
        .sass('resources/sass/app.scss', 'themes/default/assets/css');

// Use this option if vendor/konekt/appshell is a symlink:
// mix.webpackConfig({ resolve: { symlinks: false } });
