<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Patient Details</title>
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>

    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        
        @media print {
            body {
                font-size: 100px;
                font-family: Arial, sans-serif;
                text-align: center;
                margin: 100px auto;
            }

            h1 {
                font-size: 30px;
                margin-bottom: 40px;
            }

            p {
                font-family: 'Libre Barcode 39', monospace;
                font-size: 48px;
                margin-bottom: 0;
            }

            
            ul, a, title {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <h1>Patient:{{ $patient->PatientFirstName }} {{ $patient->PatientLastName }}</h1>
    <p style="font-family: 'Libre Barcode 39';font-size: 48px;">{{ $patient->PatientBarcodeID }}</p>

    <ul>
        <li><strong>Barcode ID:</strong> {{ $patient->PatientBarcodeID }}</li>
        <li><strong>Date of Birth:</strong> {{ $patient->PatientDateOfBirth }}</li>
        <li><strong>Gender:</strong> {{ $patient->PatientGender }}</li>
        <li><strong>Contact:</strong> {{ $patient->PatientContactNumber }}</li>
        <li><strong>Address:</strong> {{ $patient->PatientAddress }}</li>
        <li><strong>Blood Type:</strong> {{ $patient->PatientBloodType }}</li>
        <li><strong>Allergies:</strong> {{ $patient->PatientAllergies }}</li>
        <li><strong>Existing Conditions:</strong> {{ $patient->PatientExistingConditions }}</li>
        <li><strong>Emergency Contact:</strong> {{ $patient->PatientEmergencyContact }}</li>
        <li><strong>Emergency Phone:</strong> {{ $patient->PatientEmergencyPhone }}</li>
        <li><strong>Date Registered:</strong> {{ $patient->PatientDateRegistered }}</li>
    </ul>

    <a href="{{ route('PatientsSection') }}">Back to list</a>
    <a href="{{ route('dashboard') }}">Back to Dashboard</a>
</body>
</html>
