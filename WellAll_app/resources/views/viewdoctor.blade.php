<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
    <title>Doctor Details</title>
</head>
<body>
    <h1>Doctor: {{ $doctor->FirstName }} {{ $doctor->LastName }}</h1>
    <p style="font-family: 'Libre Barcode 39'; font-size: 40px;">{{ $doctor->DoctorCode }}</p>

    <ul>
        <li><strong>Doctor Code:</strong> {{ $doctor->DoctorCode }}</li>
        <li><strong>Specialization:</strong> {{ $doctor->Specialization }}</li>
        <li><strong>Contact:</strong> {{ $doctor->ContactNumber }}</li>
        <li><strong>Email:</strong> {{ $doctor->Email }}</li>
        <li><strong>Address:</strong> {{ $doctor->Address }}</li>
        <li><strong>Date Registered:</strong> {{ $doctor->DateRegistered }}</li>
    </ul>

    <a href="{{ route('doctors.index') }}">Back to list</a>
    <a href="{{ route('dashboard.index') }}">Back to Dashboard</a>
</body>
</html>
