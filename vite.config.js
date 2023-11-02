import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import inject from "@rollup/plugin-inject"

export default defineConfig({
    plugins: [
        inject({
            $: 'jquery',
            jQuery: 'jquery',
        }),
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/scss/swiper-thumbs.scss',
                'resources/js/app.js',
                'resources/js/show_page_view.js',
                'resources/js/functions.js',
            ],
            refresh: true,
        }),
    ],
});
