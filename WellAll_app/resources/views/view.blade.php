<!DOCTYPE html>
<html>
<head>
    <title>Patient Details</title>
</head>
<body>
    <h1>Patient: {{ $patient->FirstName }} {{ $patient->LastName }}</h1>

    <ul>
        <li><strong>Barcode ID:</strong> {{ $patient->BarcodeID }}</li>
        <li><strong>Date of Birth:</strong> {{ $patient->DateOfBirth }}</li>
        <li><strong>Gender:</strong> {{ $patient->Gender }}</li>
        <li><strong>Contact:</strong> {{ $patient->ContactNumber }}</li>
        <li><strong>Address:</strong> {{ $patient->Address }}</li>
        <li><strong>Blood Type:</strong> {{ $patient->BloodType }}</li>
        <li><strong>Allergies:</strong> {{ $patient->Allergies }}</li>
        <li><strong>Existing Conditions:</strong> {{ $patient->ExistingConditions }}</li>
        <li><strong>Emergency Contact:</strong> {{ $patient->EmergencyContact }}</li>
        <li><strong>Emergency Phone:</strong> {{ $patient->EmergencyPhone }}</li>
        <li><strong>Date Registered:</strong> {{ $patient->DateRegistered }}</li>
    </ul>

    <a href="{{ route('patients.index') }}">Back to list</a>
</body>
</html>
