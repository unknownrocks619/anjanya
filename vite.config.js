import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {config} from 'dotenv/config';
export default defineConfig({
    plugins: [
        laravel([`resources/js/themes/${process.env.APP_THEMES}/js/app.js`,'resources/css/app.css', 'resources/js/app.js']),
    ],
});
