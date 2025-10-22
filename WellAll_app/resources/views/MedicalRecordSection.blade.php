@extends('layouts.app')

@section('content')
<div class="medical-section-container">
    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('MedicalRecordSection') }}" class="search-bar">
        <input type="text" name="search" placeholder="Search by patient or doctor..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    {{-- Medical Records Table --}}
    <table class="medical-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Patient Name</th>
                <th>Doctor</th>
                <th>Diagnosis</th>
                <th>Treatment</th>
                <th>Prescription</th>
                <th>Date Recorded</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr>
                    <td>{{ $record->RecordID }}</td>
                    <td>{{ $record->patient->PatientFirstName }} {{ $record->patient->PatientLastName }}</td>
                    <td>Dr. {{ $record->doctor->DoctorFirstName }} {{ $record->doctor->DoctorLastName }}</td>
                    <td>{{ Str::limit($record->diagnosis, 40) }}</td>
                    <td>{{ Str::limit($record->treatment, 40) }}</td>
                    <td>{{ Str::limit($record->prescription, 40) }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->MedicalDateRegistered ?? $record->created_at)->format('F d, Y') }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('MedicalRecordView', $record->medicalID) }}" class="btn view">View</a>
                        <a href="{{ route('medical-record.edit', $record->medicalID) }}" class="btn edit">Edit</a>
                        <form action="{{ route('medical-record.destroy', $record->medicalID) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">No medical records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
.medical-section-container {
    max-width: 1100px;
    margin: 30px auto;
    background: #fff;
    padding: 25px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
h2 {
    color: #2e7d32;
}
.alert {
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
}
.alert.success { background: #e8f5e9; color: #2e7d32; }
.alert.error { background: #ffebee; color: #c62828; }
.search-bar {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 15px;
}
.search-bar input {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 8px 0 0 8px;
    width: 250px;
}
.search-bar button {
    padding: 8px 15px;
    border: none;
    background: #43a047;
    color: white;
    border-radius: 0 8px 8px 0;
    cursor: pointer;
}
.search-bar button:hover { background: #2e7d32; }
.medical-table {
    width: 100%;
    border-collapse: collapse;
}
.medical-table th, .medical-table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}
.medical-table th {
    background: #e8f5e9;
    color: #1b5e20;
}
.action-buttons {
    display: flex;
    gap: 5px;
}
.btn {
    padding: 5px 10px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    color: white;
    border: none;
}
.btn.add { background: #43a047; }
.btn.view { background: #1976d2; }
.btn.edit { background: #2e7d32; }
.btn.delete { background: #c62828; }
.btn.add:hover { background: #2e7d32; }
.btn.view:hover { background: #1565c0; }
.btn.edit:hover { background: #1b5e20; }
.btn.delete:hover { background: #b71c1c; }
</style>
@endsection
