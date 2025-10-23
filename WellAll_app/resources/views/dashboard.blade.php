@extends('layouts.app')
@include('layouts.navigation')
@vite(['resources/css/DashboardStyle.css', 'resources/css/NavigationStyle.css'])

@section('content')

<div class="dashboard-container">
    
    <!-- ====== Search Section ====== -->
    <div class="search_patient">
        <div class="card-body">
            <h2>Search A Patient</h2>
            <form action="{{ route('patients.search') }}" method="GET">
                <input type="text" name="patientBarcodeID" placeholder="Enter Barcode ID (e.g., P00012)" required autofocus>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
    <!-- ====== Header ====== -->
    <h1 class="dashboard-title">Dashboard Overview</h1>

    <!-- ====== Stats Cards ====== -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Patients</h3>
            <p class="stat-value">{{ $totalPatients }}</p>
        </div>

        <div class="stat-card">
            <h3>Appointments Today</h3>
            <p class="stat-value">{{ $appointmentsToday }}</p>
        </div>

        <div class="stat-card">
            <h3>Total Doctors</h3>
            <p class="stat-value">{{ $totalDoctors }}</p>
        </div>

        <div class="stat-card">
            <h3>Active Queues</h3>
            <p class="stat-value">{{ $activeQueues }}</p>
        </div>
    </div>

    <!-- ====== Messages ====== -->
    @if(session('success'))
        <p class="message success">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p class="message error">{{ session('error') }}</p>
    @endif

</div>

@endsection
