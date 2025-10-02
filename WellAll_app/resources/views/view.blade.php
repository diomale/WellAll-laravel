<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
  <title>View Patient</title>
</head>
<body>
  <h1>Patient Details</h1>
  <div style="text-align: center;">
    <p style="font-family: 'Libre Barcode 39';font-size: 100px; margin: 0%;">{{ $patient->BarcodeID }}</p>
    <p>{{ $patient->BarcodeID}}</p>
  </div>

  <p><strong>First Name:</strong> {{ $patient->FirstName }}</p>
  <p><strong>Last Name:</strong> {{ $patient->LastName }}</p>
  <p><strong>Date of Birth:</strong> {{ $patient->DateOfBirth }}</p>
  <p><strong>Gender:</strong> {{ $patient->Gender }}</p>
  <p><strong>Contact Number:</strong> {{ $patient->ContactNumber }}</p>
  <p><strong>Address:</strong> {{ $patient->Address }}</p>
  <p><strong>Blood Type:</strong> {{ $patient->BloodType }}</p>
  <p><strong>Allergies:</strong> {{ $patient->Allergies }}</p>
  <p><strong>Existing Conditions:</strong> {{ $patient->ExistingConditions }}</p>
  <p><strong>Emergency Contact:</strong> {{ $patient->EmergencyContact }}</p>
  <p><strong>Emergency Phone:</strong> {{ $patient->EmergencyPhone }}</p>
  <p><strong>Date Registered:</strong> {{ $patient->DateRegistered }}</p>

  <a href="{{ route('patients.index') }}">⬅ Back to Patient List</a>
</body>
</html>
