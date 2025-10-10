<!DOCTYPE html>
<html>
<head>
    <title>Appointments</title>
</head>
<body>
    <h1>Appointments</h1>

    @extends('layouts.app')

    @section('content')
    <div>
        <h2>Appointment List</h2>

        {{-- Button to create new appointment --}}
        <div>
            <a href="{{ route('appointments.create') }}">Add Appointment</a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif

        {{-- Table --}}
        <div>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Appointment Date</th>
                            <th>Time</th>
                            <th>Reason</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->AppointmentID }}</td>
                                <td>{{ $appointment->patient->FirstName }} {{ $appointment->patient->LastName }}</td>
                                <td>{{ $appointment->doctor->FirstName }} {{ $appointment->doctor->LastName }}</td>
                                <td>{{ $appointment->AppointmentDate }}</td>
                                <td>{{ $appointment->AppointmentTime }}</td>
                                <td>{{ $appointment->Reason }}</td>
                                <td>
                                    <a href="{{ route('appointments.edit', $appointment->AppointmentID) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('appointments.destroy', $appointment->AppointmentID) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this appointment?')" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No appointments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>
