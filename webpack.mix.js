const mix = require('laravel-mix');
mix.sass('resources/sass/app.scss','public/css/app.css')
.sass('resources/sass/admin_account.scss','public/css/admin_account.css')
.sass('resources/sass/home.scss','public/css/home.css')
.sass('resources/sass/profile.scss','public/css/profile.css')
.sass('resources/sass/settings.scss','public/css/settings.css')
.sass('resources/sass/chat.scss','public/css/chat.css');

mix.js('resources/js/app.js', 'public/js')
    .vue();