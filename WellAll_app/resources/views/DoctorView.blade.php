<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
    <title>Doctor Details</title>
    @vite(['resources/css/NavigationStyle.css', 'resources/js/app.js'])

    @include('layouts.navigation')
</head>
<body>
    <h1>Doctor: {{ $doctor->DoctorFirstName }} {{ $doctor->DoctorLastName }}</h1>
    <p style="font-family: 'Libre Barcode 39'; font-size: 40px;">{{ $doctor->DoctorBarcode }}</p>

    <ul>
        <li><strong>Doctor Code:</strong> {{ $doctor->DoctorBarcode }}</li>
        <li><strong>Specialization:</strong> {{ $doctor->Specialization }}</li>
        <li><strong>Contact:</strong> {{ $doctor->DoctorContactNumber }}</li>
        <li><strong>Email:</strong> {{ $doctor->DoctorEmail }}</li>
        <li><strong>Address:</strong> {{ $doctor->DoctorAddress }}</li>
        <li><strong>Date Registered:</strong> {{ $doctor->DoctorDateRegistered }}</li>
    </ul>

    <a href="{{ route('DoctorSection') }}">Back to list</a>
    <a href="{{ route('dashboard.index') }}">Back to Dashboard</a>
</body>
</html>
