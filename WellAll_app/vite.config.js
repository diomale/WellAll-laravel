import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Base
                'resources/css/app.css',
                'resources/css/NavigationStyle.css',

                // Dashboard
                'resources/css/DashboardStyle.css',

                // Patient
                'resources/css/PatientSectionStyle.css',
                'resources/css/PatientEditStyle.css',
                'resources/css/PatientViewStyle.css',

                // Doctor
                'resources/css/DoctorSectionStyle.css',
                'resources/css/DoctorViewStyle.css',
                'resources/css/DoctorEditStyle.css',

                // Appointment
                'resources/css/AppointmentSectionStyle.css',
                'resources/css/AppointmentEditStyle.css',
                'resources/css/AppointmentViewStyle.css',

                // Queue
                'resources/css/QueueSectionStyle.css',

                // Check-In
                'resources/css/CheckInSectionStyle.css',
                'resources/css/CheckInViewStyle.css',

                // Medical Record
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
