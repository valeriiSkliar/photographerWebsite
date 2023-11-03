import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import arr from "./viteGeneratorFilePaths/file-paths.js";
// console.log(arr);
export default defineConfig({
    plugins: [
        laravel({
            input: [
                // 'resources/scss/app.scss',
                // 'resources/scss/swiper-thumbs.scss',
                // 'resources/js/app.js',
                // 'resources/js/admin_gallery.js',
                ...arr,
            ],
            refresh: true,
        }),
    ],
});
