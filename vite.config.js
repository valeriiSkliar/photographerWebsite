import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import arr from "./viteGeneratorFilePaths/file-paths.js";
// console.log(arr);
// import inject from "@rollup/plugin-inject"
import { esbuildCommonjs } from '@originjs/vite-plugin-commonjs'

export default defineConfig({
    plugins: [
        // inject({
        //     $: 'jquery',
        //     jQuery: 'jquery',
        // }),
        laravel({
            input: [
                // 'resources/scss/app.scss',
                // 'resources/scss/swiper-thumbs.scss',
                // 'resources/js/app.js',
                // 'resources/js/admin_gallery.js',
                ...arr,
            ],
            refresh: ['resources/views/**', "resources/scss/**", "resources/js/**"],
        }),
    ],
    optimizeDeps:{
        esbuildOptions:{
            plugins:[
                esbuildCommonjs(['jquery','jquery-ui-dist/jquery-ui'])
            ]
        }
    }
});
