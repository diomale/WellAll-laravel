<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
    <title>Doctor Details</title>
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
