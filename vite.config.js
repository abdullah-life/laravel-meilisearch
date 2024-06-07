import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            hotFile: 'public/vendor/laravel-meilisearch/laravel-meilisearch.hot',
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            buildDirectory: 'vendor/laravel-meilisearch',
        }),

        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),

    ],

    resolve: {
        alias: {
            'root': '../../../../',
            '@': '/resources/js'
        },
    },
});
