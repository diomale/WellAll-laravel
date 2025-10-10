<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
</head>
<body>
    <h1>Edit Patient: {{ $patient->PatientFirstName }} {{ $patient->PatientLastName }}</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('updatePatient', $patient->PatientID) }}" method="POST">
        @csrf
        @method('PUT')

        <li>First Name</li><input type="text" name="PatientFirstName" value="{{ $patient->PatientFirstName }}" required>
        <li>Last NAme</li><input type="text" name="PatientLastName" value="{{ $patient->PatientLastName }}" required>
        <li>Birth</li><input type="date" name="PatientDateOfBirth" value="{{ $patient->PatientDateOfBirth }}" required>
        <li>Gender</li><input type="text" name="PatientGender" value="{{ $patient->PatientGender }}" required>
        <li>Contact Number</li><input type="text" name="PatientContactNumber" value="{{ $patient->PatientContactNumber }}">
        <li>Address</li><input type="text" name="PatientAddress" value="{{ $patient->PatientAddress }}">
        <li>Blood Type</li><input type="text" name="PatientBloodType" value="{{ $patient->PatientBloodType }}">
        <li>Allergies</li><input type="text" name="PatientAllergies" value="{{ $patient->PatientAllergies }}">
        <li>existing Condition</li><input type="text" name="PatientExistingConditions" value="{{ $patient->PatientExistingConditions }}">
        <li>Emergency Contact</li><input type="text" name="PatientEmergencyContact" value="{{ $patient->PatientEmergencyContact }}">
        <li>Emergency Phone</li><input type="text" name="PatientEmergencyPhone" value="{{ $patient->PatientEmergencyPhone }}">
        
        <button type="submit">Save Changes</button>
    </form>

    <br>
    <a href="{{ route('PatientsSection') }}">Back to list</a>
</body>
</html>
