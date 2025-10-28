<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/PatientViewStyle.css', 'resources/js/app.js'])

    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
    <title>Patient Details</title>

    <style>
        /* ==== ID PRINT LAYOUT ==== */
        @media print {
            body * {
                visibility: hidden;
            }

            #id-card, #id-card * {
                visibility: visible;
            }

            #id-card {
                position: absolute;
                top: 0;
                left: 0;
                width: 3.5in;
                height: 2.2in;
                border: 2px solid #2e7d32;
                border-radius: 12px;
                padding: 10px 15px;
                text-align: center;
                background-color: #f0fff4;
                font-family: Arial, sans-serif;
                box-shadow: 0 0 10px rgba(0,0,0,0.15);
            }

            #id-card h2 {
                margin: 0;
                font-size: 16px;
                color: #1b5e20;
                font-weight: bold;
            }

            #id-card p {
                margin: 4px 0;
                font-size: 14px;
            }

            #id-card .barcode {
                font-family: 'Libre Barcode 39', cursive;
                font-size: 40px;
                margin: 8px 0;
                color: #2e7d32;
            }

            #id-card .blood {
                font-weight: bold;
                color: #1b5e20;
                font-size: 15px;
            }

            /* Hide buttons */
            button, a {
                display: none !important;
            }
        }

        /* Normal layout styling */
        .btn-primary {
            background-color: #43a047;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            border: none;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #2e7d32;
        }

        .barcode {
            font-family: 'Libre Barcode 39', cursive;
            font-size: 45px;
            color: #2e7d32;
        }
    </style>
</head>
<body>
    <main class="main-content">
        <div class="container">
            <h2>Patient: {{ $patient->PatientFirstName }} {{ $patient->PatientLastName }}</h2>
            <p class="barcode">*{{ $patient->PatientBarcodeID }}*</p>

            <div class="card">
                <p><strong>Date of Birth:</strong> {{ $patient->PatientDateOfBirth }}</p>
                <p><strong>Gender:</strong> {{ $patient->PatientGender }}</p>
                <p><strong>Contact:</strong> {{ $patient->PatientContactNumber }}</p>
                <p><strong>Address:</strong> {{ $patient->PatientAddress }}</p>
                <p><strong>Blood Type:</strong> {{ $patient->PatientBloodType }}</p>
                <p><strong>Allergies:</strong> {{ $patient->PatientAllergies }}</p>
                <p><strong>Existing Conditions:</strong> {{ $patient->PatientExistingConditions }}</p>
                <p><strong>Emergency Contact:</strong> {{ $patient->PatientEmergencyContact }}</p>
                <p><strong>Emergency Phone:</strong> {{ $patient->PatientEmergencyPhone }}</p>
                <p><strong>Date Registered:</strong> {{ $patient->PatientDateRegistered }}</p>
            </div>

            <div style="margin-top: 20px;">
                <a href="{{ route('PatientSection') }}" class="btn-secondary">Back to Patient List</a>
                <button onclick="window.print()" class="btn-primary">Print ID</button>
            </div>
        </div>
    </main>

    <!-- ID PRINT CONTENT -->
    <div id="id-card">
        <h2>{{ $patient->PatientFirstName }} {{ $patient->PatientLastName }}</h2>
        <p class="barcode">*{{ $patient->PatientBarcodeID }}*</p>
        <p class="blood">Blood Type: {{ $patient->PatientBloodType }}</p>
    </div>

    <style>
        /* ==== ID PRINT LAYOUT ==== */
        #id-card {
            display: none; /* 🔹 Hidden by default */
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #id-card, #id-card * {
                visibility: visible;
            }

            #id-card {
                display: block; /* 🔹 Show only during print */
                position: absolute;
                top: 0;
                left: 0;
                width: 3.5in;
                height: 2.2in;
                border: 2px solid #2e7d32;
                border-radius: 12px;
                padding: 10px 15px;
                text-align: center;
                background-color: #f0fff4;
                font-family: Arial, sans-serif;
                box-shadow: 0 0 10px rgba(0,0,0,0.15);
            }

            #id-card h2 {
                margin: 0;
                font-size: 16px;
                color: #1b5e20;
                font-weight: bold;
            }

            #id-card p {
                margin: 4px 0;
                font-size: 14px;
            }

            #id-card .barcode {
                font-family: 'Libre Barcode 39', cursive;
                font-size: 40px;
                margin: 8px 0;
                color: #2e7d32;
            }

            #id-card .blood {
                font-weight: bold;
                color: #1b5e20;
                font-size: 15px;
            }

            /* Hide buttons and normal content */
            button, a, .main-content, .container {
                display: none !important;
            }
        }

        /* Normal layout styling */
        .btn-primary {
            background-color: #43a047;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            border: none;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #2e7d32;
        }

        .barcode {
            font-family: 'Libre Barcode 39', cursive;
            font-size: 45px;
            color: #2e7d32;
        }
    </style>


</body>
</html>
