<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctors Section</title>
    @vite(['resources/css/NavigationStyle.css', 'resources/js/app.js', 'resources/css/DoctorSectionStyle.css'])

    @include('layouts.navigation')
</head>
<body>
    <div class="main-container">
        <div class="header">
            <h1>Doctors</h1>
            <button id="toggleDoctorForm" class="add-btn">+ Add Doctor</button>
        </div>

        <form id="doctorForm" action="{{ route('storeDoctor') }}" method="POST" class="doctor-form" style="display: none;">
            @csrf
            @if(session('success'))
                <p class="success">{{ session('success') }}</p>
            @endif
            @if(session('error'))
                <p class="error">{{ session('error') }}</p>
            @endif

            <div class="form-grid">
                <input type="text" name="DoctorFirstName" placeholder="First Name" required>
                <input type="text" name="DoctorLastName" placeholder="Last Name" required>
                <input type="text" name="Specialization" placeholder="Specialization">
                <input type="text" name="DoctorAvailability" placeholder="Availability">
                <input type="text" name="DoctorContactNumber" placeholder="Contact Number">
                <input type="email" name="DoctorEmail" placeholder="Email">
                <input type="text" name="DoctorAddress" placeholder="Address">
            </div>
            <button type="submit" class="submit-btn">Add Doctor</button>
        </form>

        <div class="table-container">
            <h2>Doctor List</h2>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Doctor Code</th>
                        <th>Name</th>
                        <th>Specialization</th>
                        <th>Availability</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->DoctorBarcode }}</td>
                        <td>Dr. {{ $doctor->DoctorFirstName }} {{ $doctor->DoctorLastName }}</td>
                        <td>{{ $doctor->Specialization }}</td>
                        <td>{{ $doctor->DoctorAvailability }}</td>
                        <td>{{ $doctor->DoctorContactNumber }}</td>
                        <td>
                            <a href="{{ route('showDoctor', $doctor->DoctorID) }}" class="view-btn">View</a>
                            <a href="{{ route('editDoctor', $doctor->DoctorID) }}" class="edit-btn">Edit</a>
                            <form action="{{ route('deleteDoctor', $doctor->DoctorID) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('toggleDoctorForm').addEventListener('click', function() {
            const form = document.getElementById('doctorForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</body>
</html>
