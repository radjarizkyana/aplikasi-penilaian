const mix = require('laravel-mix');

// Compile JavaScript and Sass
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sourceMaps(); // Optional: for source maps
