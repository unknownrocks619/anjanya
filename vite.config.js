import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/public_app.css', 'resources/js/public_app.js', 'public/frontend/default/app.css', 'public/frontend/default/app.js'],
            refresh: true,
        }),
    ],
});
