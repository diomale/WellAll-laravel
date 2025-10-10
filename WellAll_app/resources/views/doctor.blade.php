<!DOCTYPE html>
<html>
<head>
    <title>Doctors</title>
</head>
<body>
    <h1>Doctors</h1>

    <form action="{{ route('doctors.store') }}" method="POST">
        @csrf
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif

        <input type="text" name="FirstName" placeholder="First Name" required>
        <input type="text" name="LastName" placeholder="Last Name" required>
        <input type="text" name="Specialization" placeholder="Specialization">
        <input type="text" name="ContactNumber" placeholder="Contact Number">
        <input type="email" name="Email" placeholder="Email">
        <input type="text" name="Address" placeholder="Address">
        <button type="submit">Add Doctor</button>
    </form>

    <h2>Doctor List</h2>
    <table border="1">
        <tr>
            <th>Doctor Code</th>
            <th>Name</th>
            <th>Specialization</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>
        @foreach($doctors as $doctor)
        <tr>
            <td>{{ $doctor->DoctorCode }}</td>
            <td> Dr. {{ $doctor->FirstName }} {{ $doctor->LastName }}</td>
            <td>{{ $doctor->Specialization }}</td>
            <td>{{ $doctor->ContactNumber }}</td>
            <td>
                <a href="{{ route('doctors.show', $doctor->DoctorID) }}">View</a>
                <a href="{{ route('editDoctor', $doctor->DoctorID) }}">Edit</a>
                <form action="{{ route('deleteDoctor', $doctor->DoctorID) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <a href="{{ route('dashboard.index') }}">Back to Dashboard</a>
</body>
</html>
