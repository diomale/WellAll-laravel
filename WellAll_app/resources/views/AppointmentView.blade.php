<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Details</title>
    @vite(['resources/css/NavigationStyle.css', 'resources/js/app.js'])
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
</head>
<body>
    @include('layouts.navigation')

    <div class="content">
        <h1>Appointment Details</h1>

        <p style="font-family: 'Libre Barcode 39';font-size: 22px;">{{ $appointment->AppointmentBarcodeID }}</p>

        <p><strong>Barcode:</strong> {{ $appointment->AppointmentBarcodeID }}</p>
        <p><strong>Patient:</strong> {{ $appointment->patient->PatientFirstName }} {{ $appointment->patient->PatientLastName }}</p>
        <p><strong>Doctor:</strong> Dr. {{ $appointment->doctor->DoctorFirstName }} {{ $appointment->doctor->DoctorLastName }}</p>
        <p><strong>Specialization:</strong> {{ $appointment->doctor->Specialization }}</p>
        <p><strong>Date:</strong> {{ $appointment->AppointmentDate }}</p>
        <p><strong>Time:</strong> {{ $appointment->AppointmentTime }}</p>
        <p><strong>Reason:</strong> {{ $appointment->Reason }}</p>

        <hr>
        <a href="{{ route('AppointmentSection') }}">← Back to Appointments</a>
    </div>
</body>
</html>
