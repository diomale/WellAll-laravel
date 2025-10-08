<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Doctor</title>
</head>
<body>
    <h1>Edit Doctor: {{ $doctor->FirstName }} {{ $doctor->LastName }}</h1>

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

        <input type="text" name="FirstName" value="{{ $doctor->FirstName }}" required>
        <input type="text" name="LastName" value="{{ $doctor->LastName }}" required>
        <input type="text" name="Specialization" value="{{ $doctor->Specialization }}">
        <input type="text" name="ContactNumber" value="{{ $doctor->ContactNumber }}">
        <input type="text" name="Email" value="{{ $doctor->Email }}">
        <input type="text" name="Address" value="{{ $doctor->Address }}">
        <button type="submit">Save Changes</button>
    </form>

    <br>
    <a href="{{ route('doctors.index') }}">Back to list</a>
</body>
</html>