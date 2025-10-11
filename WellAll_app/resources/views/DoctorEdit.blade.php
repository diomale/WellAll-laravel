<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Doctor</title>
</head>
<body>
    <h1>Edit Doctor: {{ $doctor->DoctorFirstName }} {{ $doctor->DoctorLastName }}</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('updateDoctor', $doctor->DoctorID) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="DoctorFirstName" value="{{ $doctor->FirstName }}" required>
        <input type="text" name="DoctorLastName" value="{{ $doctor->LastName }}" required>
        <input type="text" name="Specialization" value="{{ $doctor->Specialization }}">
        <input type="text" name="DoctorAvailability" value="{{ $doctor->DoctorAvailability }}">
        <input type="text" name="DoctorContactNumber" value="{{ $doctor->ContactNumber }}">
        <input type="text" name="DoctorEmail" value="{{ $doctor->Email }}">
        <input type="text" name="DoctorAddress" value="{{ $doctor->Address }}">
        <button type="submit">Save Changes</button>
    </form>

    <br>
    <a href="{{ route('DoctorSection') }}">Back to list</a>
</body>
</html>