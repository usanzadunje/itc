import { defineConfig } from 'vite';
import vue              from '@vitejs/plugin-vue';
import path             from 'path';

export default defineConfig({
    base: '',

    publicDir: false,

    build: {
        manifest: true,
        outDir: 'public/dist',
        rollupOptions: {
            input: 'resources/js/app.js',
        },
    },

    server: {
        host: '0.0.0.0',
        strictPort: true,
        port: 3001,
    },

    resolve: {
        alias: {
            '@': path.resolve('./resources/js'),
        },
    },


    optimizeDeps: {
        include: [
            'vue',
            'axios',
        ],
    },

    plugins: [vue()],
});