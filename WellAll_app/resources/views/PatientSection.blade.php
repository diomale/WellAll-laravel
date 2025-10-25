@extends('layouts.app')
@include('layouts.navigation')
@section('content')
@vite(['resources/css/PatientSectionStyle.css', 'resources/css/NavigationStyle.css'])
<div class="container">
    {{-- Main content beside sidebar --}}
    <div class="main-content">
        <h1 class="allp">All Patients</h1>

        {{-- Search Bar --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('patients.search') }}" method="GET" class="search-form">
                    <input 
                        type="text" 
                        name="patientBarcodeID" 
                        placeholder="Enter Barcode ID (e.g., P00012)" 
                        required 
                        autofocus
                    >
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <h1>All Patients</h1>
        
        {{-- Flash Messages --}}
        @if(session('success'))
            <p class="flash-success">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p class="flash-error">{{ session('error') }}</p>
        @endif

        {{-- Table Section --}}
        <div class="table-container">
            <table class="patient-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($patientData as $patient)
                    <tr>
                        <td>{{ $patient->PatientFirstName }} {{ $patient->PatientLastName }}</td>
                        <td>{{ $patient->PatientDateOfBirth }}</td>
                        <td>{{ $patient->PatientGender }}</td>
                        <td class="actions">
                            <a href="{{ route('showPatient', $patient->PatientID) }}" class="btn-action view">View</a>
                            <a href="{{ route('editPatient', $patient->PatientID) }}" class="btn-action edit">Edit</a>
                            <form 
                                action="{{ route('deletePatient', $patient->PatientID) }}" 
                                method="POST" 
                                style="display:inline;"
                            >
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit" 
                                    class="btn-action delete"
                                    onclick="return confirm('Are you sure you want to delete this patient?')"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:#777;">
                            No patients found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <hr>

        {{-- Add Patient Button --}}
        <button id="toggleAddPatientBtn" class="add-btn">➕ Add New Patient</button>

        {{-- Add Patient Form (Collapsible) --}}
        <div id="addPatientFormContainer" class="form-container">
            <form id="addPatientForm" action="{{ route('storePatient') }}" method="POST">
                @csrf
                <input type="text" name="PatientFirstName" placeholder="First Name" required>
                <input type="text" name="PatientLastName" placeholder="Last Name" required>
                <input type="date" name="PatientDateOfBirth" required>
                <select name="PatientGender" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                <input type="text" name="PatientContactNumber" placeholder="Contact Number">
                <input type="text" name="PatientAddress" placeholder="Address">
                <select name="PatientBloodType" required>
                    <option value="" disabled selected>Select Blood Type</option>
                    <option value="A+">A+</option>
                    <option value="A-">A−</option>
                    <option value="B+">B+</option>
                    <option value="B-">B−</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB−</option>
                    <option value="O+">O+</option>
                    <option value="O-">O−</option>
                </select>

                <input type="text" name="PatientAllergies" placeholder="Allergies">
                <input type="text" name="PatientExistingConditions" placeholder="Existing Conditions">
                <input type="text" name="PatientEmergencyContact" placeholder="Emergency Contact">
                <input type="text" name="PatientEmergencyPhone" placeholder="Emergency Phone">
                <button type="submit">Add Patient</button>
            </form>
        </div>
    </div>
</div>

{{-- Fallback Flash Error --}}
@if(session('error'))
    <p class="flash-error">{{ session('error') }}</p>
@endif

<script>
    // Toggle form visibility with animation
    document.getElementById('toggleAddPatientBtn').addEventListener('click', () => {
        const container = document.getElementById('addPatientFormContainer');
        container.classList.toggle('open');
    });
</script>
@endsection
