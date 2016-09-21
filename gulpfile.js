const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var adminLTE = '../../../node_modules/admin-lte/build/less/';
var assetCss = './public/assets/css';

elixir(mix => {
    mix.sass('app.scss')
        // adminLTE
        .less(adminLTE +'AdminLTE.less', assetCss)
        .less(adminLTE + 'skins/_all-skins.less', assetCss)
        .less(adminLTE + 'skins/skin-black-light.less', assetCss)
        .less(adminLTE + 'skins/skin-black.less', assetCss)
        .less(adminLTE + 'skins/skin-blue-light.less', assetCss)
        .less(adminLTE + 'skins/skin-blue.less', assetCss)
        .less(adminLTE + 'skins/skin-green-light.less', assetCss)
        .less(adminLTE + 'skins/skin-green.less', assetCss)
        .less(adminLTE + 'skins/skin-purple-light.less', assetCss)
        .less(adminLTE + 'skins/skin-purple.less', assetCss)
        .less(adminLTE + 'skins/skin-red-light.less', assetCss)
        .less(adminLTE + 'skins/skin-red.less', assetCss)
        .less(adminLTE + 'skins/skin-yellow-light.less', assetCss)
        .less(adminLTE + 'skins/skin-yellow.less', assetCss)

        // Application javascript
        .webpack('app.js');
});
