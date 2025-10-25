@extends('layouts.app')

@section('content')
@vite(['resources/css/MedicalRecordAddStyle.css', 'resources/css/NavigationStyle.css'])
<div class="container">
    <h2>Add Medical Record</h2>
    <div class="card mt-3">
        <div class="card-body">
            <h5>Patient: {{ $appointment->patient->PatientFirstName }} {{ $appointment->patient->PatientLastName }}</h5>
            <p>Doctor: {{ $appointment->doctor->DoctorFirstName }} {{ $appointment->doctor->DoctorLastName }}</p>
            <p>Date: {{ $appointment->AppointmentDate }}</p>

            <form action="{{ route('MedicalRecordStore') }}" method="POST">
                @csrf
                <input type="hidden" name="AppointmentID" value="{{ $appointment->AppointmentID }}">
                <input type="hidden" name="PatientID" value="{{ $appointment->PatientID }}">
                <input type="hidden" name="DoctorID" value="{{ $appointment->DoctorID }}">

                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis</label>
                    <textarea name="diagnosis" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="treatment" class="form-label">Treatment</label>
                    <textarea name="treatment" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="prescription" class="form-label">Prescription</label>
                    <textarea name="prescription" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100">💾 Save Medical Record</button>
            </form>
        </div>
    </div>
</div>
@endsection
