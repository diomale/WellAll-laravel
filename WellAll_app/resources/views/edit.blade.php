<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
</head>
<body>
    <h1>Edit Patient</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('updatePatient', $patient->PatientID) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="FirstName">First Name:</label>
        <input type="text" id="FirstName" name="FirstName" value="{{ old('FirstName', $patient->FirstName) }}"><br><br>

        <label for="LastName">Last Name:</label>
        <input type="text" id="LastName" name="LastName" value="{{ old('LastName', $patient->LastName) }}"><br><br>

        <label for="DateOfBirth">Date of Birth:</label>
        <input type="date" id="DateOfBirth" name="DateOfBirth" value="{{ old('DateOfBirth', $patient->DateOfBirth) }}"><br><br>

        <label for="Gender">Gender:</label>
        <input type="text" id="Gender" name="Gender" value="{{ old('Gender', $patient->Gender) }}"><br><br>

        <label for="ContactNumber">Contact Number:</label>
        <input type="text" id="ContactNumber" name="ContactNumber" value="{{ old('ContactNumber', $patient->ContactNumber) }}"><br><br>

        <label for="Address">Address:</label>
        <input type="text" id="Address" name="Address" value="{{ old('Address', $patient->Address) }}"><br><br>

        <label for="BloodType">Blood Type:</label>
        <input type="text" id="BloodType" name="BloodType" value="{{ old('BloodType', $patient->BloodType) }}"><br><br>

        <label for="Allergies">Allergies:</label>
        <input type="text" id="Allergies" name="Allergies" value="{{ old('Allergies', $patient->Allergies) }}"><br><br>

        <label for="ExistingConditions">Existing Conditions:</label>
        <input type="text" id="ExistingConditions" name="ExistingConditions" value="{{ old('ExistingConditions', $patient->ExistingConditions) }}"><br><br>

        <label for="EmergencyContact">Emergency Contact:</label>
        <input type="text" id="EmergencyContact" name="EmergencyContact" value="{{ old('EmergencyContact', $patient->EmergencyContact) }}"><br><br>

        <label for="EmergencyPhone">Emergency Phone:</label>
        <input type="text" id="EmergencyPhone" name="EmergencyPhone" value="{{ old('EmergencyPhone', $patient->EmergencyPhone) }}"><br><br>

        <button type="submit">Update</button>
        <a href="{{ url('/patient') }}">Cancel</a>
    </form>
</body>
</html>
