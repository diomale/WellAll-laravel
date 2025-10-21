<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patient Section</title>
    @vite(['resources/css/NavigationStyle.css', 'resources/css/PatientSectionStyle.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        {{-- Sidebar --}}
        @include('layouts.navigation')

        {{-- Main content beside sidebar --}}
        <div class="main-content">
            <h1>All Patients</h1>

            {{-- Search Bar --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('patients.search') }}" method="GET">
                        <input type="text" name="patientBarcodeID" placeholder="Enter Barcode ID (e.g., P00012)" required autofocus>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
            
            {{-- Flash Messages --}}
            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif
            @if(session('error'))
                <p style="color: red;">{{ session('error') }}</p>
            @endif

            {{-- Table --}}
            <div class="table-container">
                <table class="patient-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date Of Birth</th>
                            <th>Gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($patientData as $patient)
                        <tr>
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
            </div>

            <hr>
            <button id="toggleAddPatientBtn" class="add-btn">➕ Add New Patient</button>

            <form id="addPatientForm" action="{{ route('storePatient') }}" method="POST">
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
        </div>
    </div>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

</body>
</html>
