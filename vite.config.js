import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {config} from 'dotenv/config';
export default defineConfig({
    plugins: [
        laravel([`resources/js/themes/${process.env.APP_THEMES}/js/app.js`,`resources/js/themes/${process.env.APP_THEMES}/css/app.css`,'resources/css/app.css', 'resources/js/app.js','resources/js/public_app.js','public/frontend/default/app.js','public/frontend/default/app.css']),
    ],
});
