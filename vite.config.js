import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      hotFile: 'public/vendor/abdullah-k/laravel-meilisearch.hot', // Most important lines
      buildDirectory: 'abdullah-k/laravel-meilisearch', // Most important lines
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
});