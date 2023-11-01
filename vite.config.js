import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/scss/swiper-thumbs.scss',
                'resources/js/app.js',
                'resources/js/admin_gallery.js',
            ],
            refresh: true,
        }),
    ],
});
