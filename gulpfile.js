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

var adminLTE = '../../../node_modules/admin-lte/';
var assetCss = './public/assets/css';
var assetJs  = './public/assets/js';

elixir(mix => {
    mix.sass('app.scss')
        // adminLTE css + themes. 
        .less(adminLTE + 'build/less/AdminLTE.less', assetCss)
        .less(adminLTE + 'build/less/skins/_all-skins.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-black-light.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-black.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-blue-light.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-blue.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-green-light.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-green.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-purple-light.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-purple.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-red-light.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-red.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-yellow-light.less', assetCss)
        .less(adminLTE + 'build/less/skins/skin-yellow.less', assetCss)

        // adminLTE iCheck
        .copy('./node_modules/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js', assetJs + '/jquery.slimscroll.min.js')
        .copy('./node_modules/admin-lte/plugins/fastclick/fastclick.js', assetJs + '/fastclick.js')
        .copy('./node_modules/admin-lte/plugins/iCheck/square/blue.css', assetCss + '/icheck-blue.css')
        .copy('./node_modules/admin-lte/plugins/iCheck/square/blue.png', assetCss + '/blue.png')
        .scripts(adminLTE + 'plugins/iCheck/icheck.min.js', assetJs + '/icheck.min.js')
        
        // custom css
        .webpack('app.js')
        .scripts('vue-settings.js', assetJs + '/vue-settings.js');
});
