import laravel from 'laravel-vite-plugin'
import {defineConfig} from 'vite'

export default defineConfig({
    manifest: true,
    plugins: [
        laravel([
            'resources/sass/app.scss',
            'resources/js/app.js',
        ]),
    ],
    server: {
        https: true
    },
});



// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .webpackConfig(require('./webpack.config'));

// // Core Ui assets...
// mix.js('resources/js/admin-lte.js', 'public/js')
//     .sass('resources/sass/admin-lte.scss', 'public/css');