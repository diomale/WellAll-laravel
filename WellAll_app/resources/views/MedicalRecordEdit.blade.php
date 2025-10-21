@extends('layouts.app') {{-- remove this line if you’re not using a layout --}}

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">Edit Medical Record</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('medical-record.update', $record->medicalID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Patient Name</label>
                <input type="text" class="form-control" 
                       value="{{ $record->patient->PatientFirstName }} {{ $record->patient->PatientLastName }}" 
                       disabled>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Doctor Name</label>
                <input type="text" class="form-control" 
                       value="Dr. {{ $record->doctor->DoctorFirstName }} {{ $record->doctor->DoctorLastName }}" 
                       disabled>
            </div>

            <div class="mb-3">
                <label for="diagnosis" class="form-label fw-bold">Diagnosis</label>
                <textarea name="diagnosis" id="diagnosis" class="form-control" rows="3" required>{{ $record->diagnosis }}</textarea>
            </div>

            <div class="mb-3">
                <label for="treatment" class="form-label fw-bold">Treatment</label>
                <textarea name="treatment" id="treatment" class="form-control" rows="3">{{ $record->treatment }}</textarea>
            </div>

            <div class="mb-3">
                <label for="prescription" class="form-label fw-bold">Prescription</label>
                <textarea name="prescription" id="prescription" class="form-control" rows="3">{{ $record->prescription }}</textarea>
            </div>

            <div class="text-end">
                <a href="{{ route('MedicalRecordSection') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection
