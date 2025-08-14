import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
    server: {
        host: '0.0.0.0', 
        port: parseInt(process.env.VITE_PORT) || 5174,
        strictPort: true,
        hmr: {
            host: process.env.VITE_HOST || 'localhost',
            protocol: 'ws',
        },
    },
    plugins: [
        vue(),
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
    ],
})
