<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/PatientViewStyle.css'])
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">
    <title>Patient Details</title>
</head>
<body>
    <main id="print-section">
        <h1>Patient: {{ $patient->PatientFirstName }} {{ $patient->PatientLastName }}</h1>
        <p class="barcode">{{ $patient->PatientBarcodeID }}</p>

        <div class="patient-info">
            <ul>
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
        </div>



        <a href="{{ route('PatientSection') }}">Back to Patient List</a>
    </main>

<script>
function printSection(sectionId) {
    const printContent = document.getElementById(sectionId).innerHTML;
    const originalContent = document.body.innerHTML;

    // Add the font link to the print content
    const fontLink = `<link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">`;
    document.body.innerHTML = fontLink + printContent;

    window.print();
    document.body.innerHTML = originalContent;
}
</script>
</body>
</html>
