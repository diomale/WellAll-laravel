import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                 'resources/js/app.js', 
                 'resources/css/PatientEditStyle.css', 
                 'resources/css/DashboardStyle.css', 
                 'resources/css/PatientSectionStyle.css',
                 'resources/css/NavigationStyle.css',
                 'resources/css/PatientViewStyle.css'
                ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
