<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Doctor</title>
    @vite(['resources/css/DoctorEditStyle.css'])
</head>
<body>
    <main>
        <h1>Edit Doctor: {{ $doctor->DoctorFirstName }} {{ $doctor->DoctorLastName }}</h1>

        {{-- Error messages --}}
        @if($errors->any())
            <ul class="error-list">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {{-- Form --}}
        <form action="{{ route('updateDoctor', $doctor->DoctorID) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Specialization</label>
            <input type="text" name="Specialization" value="{{ $doctor->Specialization }}" required>

            <label>Availability</label>
            <input type="text" name="DoctorAvailability" value="{{ $doctor->DoctorAvailability }}" required>

            <label>Contact Number</label>
            <input type="text" name="DoctorContactNumber" value="{{ $doctor->DoctorContactNumber }}" required>

            <label>Email</label>
            <input type="text" name="DoctorEmail" value="{{ $doctor->DoctorEmail }}" required>

            <label>Address</label>
            <input type="text" name="DoctorAddress" value="{{ $doctor->DoctorAddress }}" required>

            <button type="submit">Save Changes</button>
        </form>

        <a href="{{ route('DoctorSection') }}"> Back to list</a>
    </main>
</body>
</html>
