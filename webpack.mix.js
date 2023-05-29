const mix = require('laravel-mix');
require('laravel-mix-purgecss');

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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

// 'public/backend/plugins/fontawesome-free/css/all.min.css',
mix.combine([
        'public/backend/dist/css/adminlte-variable.min.css',
        'public/backend/plugins/toastr/toastr.min.css',
        'public/backend/plugins/flagicon/dist/css/flag-icon.min.css',
        'public/backend/plugins/flagicon/dist/css/bootstrap-iconpicker.min.css',
        'public/backend/css/google-font.css',
        'public/backend/css/zakirsoft.css'
    ],
    'public/backend/css/combined.css'
).purgeCss({
    enabled: true,
});

mix.js('resources/js/app.js', 'public/frontend/js/chat.js')
  .vue();

mix.combine([
    'public/backend/plugins/jquery/jquery.min.js',
    'public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'public/backend/plugins/toastr/toastr.min.js',
    'public/backend/dist/js/adminlte.min.js',
], 'public/backend/js/combined.js'); {
    /* <script defer src="{{ asset('backend') }}/plugins/alpinejs/alpine.min.js"></script> */
}
