<!DOCTYPE html>
<html>
<head>
    <title>Patient List</title>
</head>
<body>
    <h1>All Patients</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Barcode ID</th>
                <th>Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($patientData as $patient)
            <tr>
                <td>{{ $patient->BarcodeID }}</td>
                <td>{{ $patient->FirstName }} {{ $patient->LastName }}</td>
                <td>{{ $patient->DateOfBirth }}</td>
                <td>{{ $patient->Gender }}</td>
                <td>
                    <a href="{{ route('patients.show', $patient->PatientID) }}">View</a> |
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
    <form action="{{ route('patients.store') }}" method="POST">
        @csrf
        <input type="text" name="FirstName" placeholder="First Name" required>
        <input type="text" name="LastName" placeholder="Last Name" required>
        <input type="date" name="DateOfBirth" required>
        <input type="text" name="Gender" placeholder="Gender" required>
        <input type="text" name="ContactNumber" placeholder="Contact Number">
        <input type="text" name="Address" placeholder="Address">
        <input type="text" name="BloodType" placeholder="Blood Type">
        <input type="text" name="Allergies" placeholder="Allergies">
        <input type="text" name="ExistingConditions" placeholder="Existing Conditions">
        <input type="text" name="EmergencyContact" placeholder="Emergency Contact">
        <input type="text" name="EmergencyPhone" placeholder="Emergency Phone">
        <button type="submit">Add Patient</button>
    </form>
</body>
</html>
