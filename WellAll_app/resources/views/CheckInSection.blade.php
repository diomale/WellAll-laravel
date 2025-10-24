@extends('layouts.app')
@include('layouts.navigation')
@section('content')
@vite(['resources/css/CheckInSectionStyle.css', 'resources/css/NavigationStyle.css'])
<div class="container mt-4">
    <h2 class="mb-3 text-center text-success">Check-In Section</h2>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Barcode Search --}}
    <form action="{{ route('checkin.search') }}" method="POST" class="d-flex justify-content-center mb-4">
        @csrf
        <input type="text" name="barcode" class="form-control w-50 me-2" placeholder="Scan or enter appointment barcode..." required autofocus>
        <button type="submit" class="btn btn-success">Search</button>
    </form>

    <hr>

    {{-- Check-In Table --}}
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-success">
            <tr>
                <th>CheckIn ID</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Check-In Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($checkins as $checkin)
                @php
                    // Use the appointment's Status instead of the check-in table
                    $status = $checkin->appointment->Status ?? 'N/A';
                @endphp
                <tr>
                    <td>{{ $checkin->CheckInID }}</td>
                    <td>{{ $checkin->patient->PatientFirstName }} {{ $checkin->patient->PatientLastName }}</td>
                    <td>Dr. {{ $checkin->doctor->DoctorFirstName }} {{ $checkin->doctor->DoctorLastName }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($checkin->CheckInTime)->format('F d, Y - h:i A') }}
                    </td>
                    <td>
                        @if($status === 'Pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($status === 'Checked-In')
                            <span class="badge bg-info text-dark">Checked-In</span>
                        @elseif($status === 'Done')
                            <span class="badge bg-success">Done</span>
                        @else
                            <span class="badge bg-secondary">{{ $status }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No check-ins found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
    .badge {
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 0.9rem;
    }
</style>
@endsection
