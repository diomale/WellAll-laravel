import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/NavigationStyle.css',

                'resources/css/DashboardStyle.css', 
                
                'resources/css/PatientSectionStyle.css',
                'resources/css/PatientEditStyle.css', 
                'resources/css/PatientViewStyle.css',
                 
                'resources/css/DoctorSectionStyle.css',
                'resources/css/DoctorViewStyle.css',
                'resources/css/DoctorEditStyle.css',
                 
                'resources/css/AppointmentSectionStyle.css',
                'resources/css/AppointmentEditStyle.css',
                'resources/css/AppointmentViewStyle.css',

                'resources/css/QueueSectionStyle.css',

                'resources/css/CheckInSectionStyle.css',
                'resources/css/CheckInViewStyle.css',

                'resources/css/MedicalRecordSectionStyle.css',
                'resources/css/MedicalRecordAddStyle.css',
                'resources/css/MedicalRecordViewStyle.css',
                'resources/css/MedicalRecordEditStyle.css',

                ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
