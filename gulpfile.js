var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.sass('app.scss');

    mix.styles('bootstrap-horizon.css');
	mix.styles('bootstrap-navbar-cart.css');
    mix.stylesIn("public/css");

    mix.scripts(['rent.js'], 'public/js/rent.js')
    mix.scripts(['removeRent.js'], 'public/js/removeRent.js')
    mix.scripts(['profile.js'], 'public/js/profile.js')

    mix.version(['public/css/all.css', 'public/js/rent.js', 'public/js/removeRent.js', 'public/js/profile.js']);
});
