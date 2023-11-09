import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import filesForBuild from "./viteGeneratorFilePaths/file-paths.js";
import { esbuildCommonjs } from '@originjs/vite-plugin-commonjs'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...filesForBuild,
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
