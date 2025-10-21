<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WellAll Dashboard</title>
    @vite(['resources/css/DashboardStyle.css', 'resources/js/app.js'])
    @vite(['resources/css/NavigationStyle.css', 'resources/js/app.js'])

    @include('layouts.navigation')
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="Title">WellAll Healthcare Dashboard</div>
        <p class="subhead">Manage patients and records easily</p>
    </header>

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

</body>
</html>
