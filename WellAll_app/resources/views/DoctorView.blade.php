<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctor Details</title>
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
    @vite(['resources/css/DoctorViewStyle.css'])
</head>
<body>
    <main>
        <h1>Doctor: {{ $doctor->DoctorFirstName }} {{ $doctor->DoctorLastName }}</h1>

        <p class="barcode">{{ $doctor->DoctorBarcode }}</p>

        <div class="doctor-info">
            <ul>
                <li><strong>Doctor Code:</strong> {{ $doctor->DoctorBarcode }}</li>
                <li><strong>Specialization:</strong> {{ $doctor->Specialization }}</li>
                <li><strong>Contact:</strong> {{ $doctor->DoctorContactNumber }}</li>
                <li><strong>Email:</strong> {{ $doctor->DoctorEmail }}</li>
                <li><strong>Address:</strong> {{ $doctor->DoctorAddress }}</li>
                <li><strong>Date Registered:</strong> {{ $doctor->DoctorDateRegistered }}</li>
            </ul>
        </div>

        <a href="{{ route('DoctorSection') }}">Back to list</a>
    </main>
</body>
</html>
