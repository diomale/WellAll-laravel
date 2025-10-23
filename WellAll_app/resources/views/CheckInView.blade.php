@extends('layouts.app')

@section('content')
@vite(['resources/css/CheckInViewStyle.css', 'resources/css/NavigationStyle.css'])
<div class="container mt-4">
    <h2 class="mb-4 text-success text-center">Check-In Confirmation</h2>

    {{--  Flash message --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(isset($appointment))
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="card-title mb-3 text-success">Patient Details</h4>
                <p><strong>Patient Name:</strong> {{ $appointment->patient->PatientFirstName }} {{ $appointment->patient->PatientLastName }}</p>
                <p><strong>Barcode ID:</strong> {{ $appointment->patient->PatientBarcodeID }}</p>
                <p><strong>Doctor:</strong> Dr. {{ $appointment->doctor->DoctorFirstName }} {{ $appointment->doctor->DoctorLastName }}</p>
                <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->AppointmentDate)->format('F d, Y') }}</p>
                <p><strong>Status:</strong>
                    <span class="badge 
                        @if($appointment->Status === 'Checked-In') bg-success
                        @elseif($appointment->Status === 'Done') bg-primary
                        @else bg-secondary
                        @endif">
                        {{ $appointment->Status }}
                    </span>
                </p>
            </div>
        </div>

        {{--  Actions based on appointment status --}}
        @if($appointment->Status === 'Pending')
            <form action="{{ route('appointments.checkin.confirm', $appointment->AppointmentID) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success w-100">
                     Confirm Check-In
                </button>
            </form>

        @elseif($appointment->Status === 'Checked-In')
            <div class="alert alert-info text-center">
                This patient is already checked in.
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('MedicalRecordAdd', $appointment->AppointmentID) }}" class="btn btn-primary">
                     Add Medical Record
                </a>
            </div>

        @elseif($appointment->Status === 'Done')
            <div class="alert alert-secondary text-center">
                 Medical record completed for this appointment.
            </div>
        @endif

    @else
        <div class="alert alert-warning text-center">
             No appointment found for this barcode.
        </div>
    @endif
</div>
@endsection
