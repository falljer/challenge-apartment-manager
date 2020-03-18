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
mix.setPublicPath('public');

/*
|--------------------------------------------------------------------------
| Webpack Config
|--------------------------------------------------------------------------
*/
mix.webpackConfig({
    resolve: {
        modules: [
            path.resolve(__dirname, 'node_modules/bootstrap/dist'),
            path.resolve(__dirname, 'node_modules/vue-router/dist'),
            path.resolve(__dirname, 'node_modules/axios/dist'),
            path.resolve(__dirname, 'node_modules/lodash'),
            path.resolve(__dirname, 'node_modules/setimmediate'),
            path.resolve(__dirname, 'node_modules/@websanova/vue-auth')
        ],
        alias: {
            'vue$': path.resolve(__dirname, 'node_modules/vue/dist/vue.esm.js'),
            'vue-axios$': path.resolve(__dirname, 'node_modules/vue-axios/dist/vue-axios.es5.js'),
            '@websanova': path.resolve(__dirname, 'node_modules/@websanova'),
            '@babel/runtime/regenerator': path.resolve(__dirname, 'node_modules/@babel/runtime/regenerator/index.js'),
            'regenerator-runtime$': path.resolve(__dirname, 'node_modules/regenerator-runtime/runtime.js'),
            '@models': path.resolve(__dirname, 'resources/js/models/'),
            '@services': path.resolve(__dirname, 'resources/js/services/'),
            '@sections': path.resolve(__dirname, 'resources/js/sections/'),
            '@components': path.resolve(__dirname, 'resources/js/components/'),
        },
        extensions: ['*', '.js', '.vue', '.json']
    }
});

/*
|--------------------------------------------------------------------------
| Mix App Resources
|--------------------------------------------------------------------------
| app.js | Application Javascript file
| app.scss | Application SCSS file
*/
mix
    .js(['resources/js/app.js'], 'public/js')
    .sourceMaps();
    //.sass('resources/sass/app.scss', 'public/css');

/*
|--------------------------------------------------------------------------
| Mix In Production
|--------------------------------------------------------------------------
*/
if (mix.inProduction() || process.env.npm_lifecycle_event !== 'hot') {
    mix.version();
}
