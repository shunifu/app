
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
        https: false,
        host: env('APP_URL'),
    },
});


