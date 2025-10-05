<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient</title>
</head>
<body>
    <h1>Edit Patient: {{ $patient->FirstName }} {{ $patient->LastName }}</h1>

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

        <input type="text" name="FirstName" value="{{ $patient->FirstName }}" required>
        <input type="text" name="LastName" value="{{ $patient->LastName }}" required>
        <input type="date" name="DateOfBirth" value="{{ $patient->DateOfBirth }}" required>
        <input type="text" name="Gender" value="{{ $patient->Gender }}" required>
        <input type="text" name="ContactNumber" value="{{ $patient->ContactNumber }}">
        <input type="text" name="Address" value="{{ $patient->Address }}">
        <input type="text" name="BloodType" value="{{ $patient->BloodType }}">
        <input type="text" name="Allergies" value="{{ $patient->Allergies }}">
        <input type="text" name="ExistingConditions" value="{{ $patient->ExistingConditions }}">
        <input type="text" name="EmergencyContact" value="{{ $patient->EmergencyContact }}">
        <input type="text" name="EmergencyPhone" value="{{ $patient->EmergencyPhone }}">
        
        <button type="submit">Save Changes</button>
    </form>

    <br>
    <a href="{{ route('patients.index') }}">Back to list</a>
</body>
</html>
