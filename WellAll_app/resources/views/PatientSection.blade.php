<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/PatientSectionStyle.css'])
    <title>Patient Section</title>
</head>
<body>
    <h1>All Patients</h1>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form form action="{{ route('patients.search') }}" method="GET">
                <input type="text" name="patientBarcodeID" placeholder="Enter Barcode ID (e.g., P00012)" required autofocus>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            @if (session('error'))
                <p>{{ session('error') }}</p>
            @endif
        </div>
    </div>
    
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif


    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table class="table" >
        <thead>
            <tr>
                <th>Barcode ID</th>
                <th>Name</th>
                <th>Date Of Birth</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($patientData as $patient)
            <tr>
                <td>{{ $patient->PatientBarcodeID }}</td>
                <td>{{ $patient->PatientFirstName }} {{ $patient->PatientLastName }}</td>
                <td>{{ $patient->PatientDateOfBirth }}</td>
                <td>{{ $patient->PatientGender }}</td>
                <td>
                    <a href="{{ route('showPatient', $patient->PatientID) }}">View</a> |
                    <a href="{{ route('editPatient', $patient->PatientID) }}">Edit</a> |
                    <form action="{{ route('deletePatient', $patient->PatientID) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <hr>
    <h2>Add New Patient</h2>
    <form action="{{ route('storePatient') }}" method="POST">
        @csrf
        <input type="text" name="PatientFirstName" placeholder="First Name" required>
        <input type="text" name="PatientLastName" placeholder="Last Name" required>
        <input type="date" name="PatientDateOfBirth" required>
        <input type="text" name="PatientGender" placeholder="Gender" required>
        <input type="text" name="PatientContactNumber" placeholder="Contact Number">
        <input type="text" name="PatientAddress" placeholder="Address">
        <input type="text" name="PatientBloodType" placeholder="Blood Type">
        <input type="text" name="PatientAllergies" placeholder="Allergies">
        <input type="text" name="PatientExistingConditions" placeholder="Existing Conditions">
        <input type="text" name="PatientEmergencyContact" placeholder="Emergency Contact">
        <input type="text" name="PatientEmergencyPhone" placeholder="Emergency Phone">
        <button type="submit">Add Patient</button>
    </form>

    <hr>
    <a href="{{ route('dashboard') }}">Back to Dashboard</a>
</body>
</html>
