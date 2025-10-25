@extends('layouts.app') {{-- if you have a layout, otherwise remove this line --}}
@vite(['resources/css/MedicalRecordViewStyle.css', 'resources/css/NavigationStyle.css'])

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Medical Record Details</h2>

    <div class="card p-4 shadow-sm">
        <h4>Patient Information</h4>
        <p><strong>Name:</strong> {{ $record->patient->PatientFirstName }} {{ $record->patient->PatientLastName }}</p>
        <p><strong>Gender:</strong> {{ $record->patient->PatientGender }}</p>
        <p><strong>Contact:</strong> {{ $record->patient->PatientContactNumber }}</p>

        <hr>

        <h4>Doctor Information</h4>
        <p><strong>Name:</strong> Dr. {{ $record->doctor->DoctorFirstName }} {{ $record->doctor->DoctorLastName }}</p>
        <p><strong>Specialization:</strong> {{ $record->doctor->Specialization }}</p>

        <hr>

        <h4>Medical Record</h4>
        <p><strong>Diagnosis:</strong> {{ $record->diagnosis }}</p>
        <p><strong>Treatment:</strong> {{ $record->treatment }}</p>
        <p><strong>Prescription:</strong> {{ $record->prescription }}</p>
        <p>{{ \Carbon\Carbon::parse($record->MedicalDateRegistered ?? $record->created_at)->format('F d, Y') }}</p>
    </div>

    <a href="{{ url('/medical-record') }}" class="btn btn-secondary mt-3">Back to Records</a>
</div>
@endsection
