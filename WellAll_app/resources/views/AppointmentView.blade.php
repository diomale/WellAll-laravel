<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Details</title>
    @vite(['resources/css/NavigationStyle.css','resources/css/AppointmentViewStyle.css', 'resources/js/app.js'])
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
</head>
<body>

     <div class="content" id="printArea">
        <h1>Appointment Details</h1>

        <p style="font-family: 'Libre Barcode 39';font-size: 22px;">{{ $appointment->AppointmentBarcodeID }}</p>

        <p><strong>Barcode:</strong> {{ $appointment->AppointmentBarcodeID }}</p>
        <p><strong>Patient:</strong> {{ $appointment->patient->PatientFirstName }} {{ $appointment->patient->PatientLastName }}</p>
        <p><strong>Doctor:</strong> Dr. {{ $appointment->doctor->DoctorFirstName }} {{ $appointment->doctor->DoctorLastName }}</p>
        <p><strong>Specialization:</strong> {{ $appointment->doctor->Specialization }}</p>
        <p><strong>Date:</strong> {{ $appointment->AppointmentDate }}</p>
        <p><strong>Time:</strong> {{ $appointment->AppointmentTime }}</p>
        <p><strong>Reason:</strong> {{ $appointment->Reason }}</p>

        <hr>

        <div class="button-group">
            <a href="{{ route('AppointmentSection') }}" class="btn-back">← Back to Appointments</a>
            <button type="button" onclick="printAppointment()" class="btn-print">🖨 Print</button>
        </div>
    </div>

    <script>
        function printAppointment() {
            const printContents = document.getElementById('printArea').innerHTML;
            const originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // reload to restore event handlers
        }
    </script>
</body>
</html>