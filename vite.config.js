import {defineConfig, splitVendorChunkPlugin} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue2';
import path from 'path';


export default defineConfig({
    build: {
        chunkSizeWarningLimit: 800
    },
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/landlord/app.js',
            ],
            refresh: true,
        }),
        vue(),
        splitVendorChunkPlugin()
    ],
    resolve: {
        alias: {
            // for vue
            'zora-js': path.resolve(__dirname, 'vendor/jetstreamlabs/zora/dist/index.js'),
            zora: path.resolve(__dirname, 'vendor/jetstreamlabs/zora/dist/vue.js'),
        },
    },
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost'
        }
    },
    commonjsOptions: {
        transformMixedEsModules: true
    }
});
