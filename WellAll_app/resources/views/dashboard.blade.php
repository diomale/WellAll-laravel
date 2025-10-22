@extends('layouts.app')
@include('layouts.navigation')
@vite(['resources/css/DashboardStyle.css', 'resources/css/NavigationStyle.css'])
@section('content')


<div class="search_patient">
    <div class="card-body">
        <h2>Search A Patient</h2>
        <form form action="{{ route('patients.search') }}" method="GET">
            <input type="text" name="patientBarcodeID" placeholder="Enter Barcode ID (e.g., P00012)" required autofocus>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</div>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif
@endsection
