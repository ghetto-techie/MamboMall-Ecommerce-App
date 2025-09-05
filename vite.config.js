import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',  // allow LAN access
        port: 5173,       // default Vite port
        hmr: {
            host: '192.168.100.3', // your PC’s local IP
        },
    },
});
