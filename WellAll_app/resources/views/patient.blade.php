<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient List</title>
</head>
<body>
  <h1>Patient Management</h1>

  {{-- Success Message --}}
  @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
  @endif

  {{-- Add Patient Form --}}
  <h2>Add Patient</h2>
  <form action="{{ route('patients.store') }}" method="POST">
    @csrf
    <label>First Name:</label>
    <input type="text" name="FirstName" required>

    <label>Last Name:</label>
    <input type="text" name="LastName" required>

    <label>Date of Birth:</label>
    <input type="date" name="DateOfBirth" required>

    <label>Gender:</label>
    <select name="Gender" required>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>

    <label>Contact Number:</label>
    <input type="text" name="ContactNumber">

    <label>Address:</label>
    <input type="text" name="Address">

    <label>Blood Type:</label>
    
    <select name="BloodType" required>
      <option value="O">O</option>
      <option value="A">A</option>
      <option value="B">B</option>
      <option value="AB">AB</option>
    </select>

    <label>Allergies:</label>
    <input type="text" name="Allergies">

    <label>Existing Conditions:</label>
    <input type="text" name="ExistingConditions">

    <label>Emergency Contact:</label>
    <input type="text" name="EmergencyContact">

    <label>Emergency Phone:</label>
    <input type="text" name="EmergencyPhone">

    <button type="submit"> Add Patient</button>
  </form>

  <hr>

  {{-- Patient Table --}}
  <h2>Patient List</h2>
  <table border="1" cellpadding="6" cellspacing="0">
    <thead>
      <tr>
        <th>BarcodeID</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>DateOfBirth</th>
        <th>Gender</th>
        <th>ContactNumber</th>
        <th>Address</th>
        <th>BloodType</th>
        <th>Allergies</th>
        <th>ExistingConditions</th>
        <th>EmergencyContact</th>
        <th>EmergencyPhone</th>
        <th>DateRegistered</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($patientData as $patient)
        <tr>
          <td>{{ $patient->BarcodeID }}</td>
          <td>{{ $patient->FirstName }}</td>
          <td>{{ $patient->LastName }}</td>
          <td>{{ $patient->DateOfBirth }}</td>
          <td>{{ $patient->Gender }}</td>
          <td>{{ $patient->ContactNumber }}</td>
          <td>{{ $patient->Address }}</td>
          <td>{{ $patient->BloodType }}</td>
          <td>{{ $patient->Allergies }}</td>
          <td>{{ $patient->ExistingConditions }}</td>
          <td>{{ $patient->EmergencyContact }}</td>
          <td>{{ $patient->EmergencyPhone }}</td>
          <td>{{ $patient->DateRegistered }}</td>
          <td>
            {{-- Edit --}}
            <a href="{{ route('editPatient', $patient->PatientID) }}">Edit</a>
            {{-- View Link --}}
            <a href="{{ route('patients.show', $patient->PatientID) }}">View</a>
            
            {{-- Delete Form --}}
            <form action="{{ route('deletePatient', $patient->PatientID) }}" 
              method="POST" 
              style="display:inline;"
              onsubmit="return confirm('Are you sure you want to delete this patient?');">
              @csrf
              @method('DELETE')
              <button type="submit">Delete</button>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="13">No Patient Found</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
