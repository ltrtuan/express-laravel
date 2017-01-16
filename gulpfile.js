const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
	mix.styles([
        'vendors/bootstrap/bootstrap-flex.min.css',
        'vendors/tether/tether.min.css'
    ], 'public/css/vendors.css');

    mix.sass('app.scss');

    mix.scripts([
        'vendors/jquery.min.js',
        'vendors/tether.min.js',
    ], 'public/js/vendors.js');

    mix.scripts([
        'app.js',
        'ajax-helper.js',
    ], '', 'public/js');

   	mix.webpack('app.js');
});
