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

            
            ul, a {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <h1>Patient:{{ $patient->FirstName }} {{ $patient->LastName }}</h1>
    <p style="font-family: 'Libre Barcode 39';font-size: 48px;">{{ $patient->BarcodeID }}</p>

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
    <a href="{{ route('dashboard') }}">Back to Dashboard</a>
</body>
</html>
