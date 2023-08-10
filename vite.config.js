import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'node_modules/','resources/js/app.js'],
            refresh: true,
        }),
    ],
});
