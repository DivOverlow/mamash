
const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
//
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

mix.postCss('resources/css/main.css', 'public/themes/custom/assets/css', [
    require('tailwindcss'),
])
    .browserSync('mamash-old');





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


// const mix = require("laravel-mix");

if (mix == 'undefined') {
    const { mix } = require("laravel-mix");
}

require("laravel-mix-merge-manifest");

if (mix.inProduction()) {
    // var publicPath = 'packages/Webkul/Shop/publishable/assets';
    var publicPath = __dirname + '/';
} else {
    var publicPath = "public/themes/custom/assets";
}

mix.setPublicPath(publicPath).mergeManifest();
mix.disableNotifications();

mix.js([__dirname + "/resources/assets/js/app.js"], "public/themes/custom/assets/js/shop.js");
    // .sass(__dirname + "/src/Resources/assets/sass/app.scss", "css/shop.css")
    // .options({
    //     processCssUrls: false
    // });

if (mix.inProduction()) {
    mix.version();
}
