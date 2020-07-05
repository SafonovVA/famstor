const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').sourceMaps()
    .js('resources/js/admin.js', 'public/js').sourceMaps()
    .sass('resources/sass/app.scss', 'public/css').sourceMaps()
    .sass('resources/sass/admin.scss', 'public/css').sourceMaps();

