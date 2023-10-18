import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'public/frontend/css/style.css',
                'public/frontend/css/main.css',
                'public/css/typography.css',
                'public/css/default-css.css',
                'public/css/styles.css',
                'public/css/responsive.css',
                'public/css/app.css',
                'public/css/logo.css',
                'public/css/style.css',
                'public/frontend/js/main.js',
                'resources/js/app.js',
                'public/js/off-canvas.js',
                'public/js/hoverable-collapse.js',
                'public/js/misc.js',
                'public/js/settings.js',
                'public/js/dashboard_1.js',
                'public/js/bt-maxLength.js',
                'public/js/data-table.js'
            ],
            refresh: true
        })
    ],
    build: {
        rollupOptions: {
            output:{
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return id.toString().split('node_modules/')[1].split('/')[0].toString()
                    }
                }
            }
        }
    }
})
