<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/DashboardStyle.css'])
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WellAll Dashboard</title>
    
</head>
<body>
    <header>
        <div class="Title">WellAll Healthcare Dashboard</div>
        <p class="subhead">Manage patients and records easily</p>
    </header>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form form action="{{ route('patients.search') }}" method="GET">
                <input type="text" name="patientBarcodeID" placeholder="Enter Barcode ID (e.g., P00012)" required autofocus>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            @if (session('error'))
                <p>{{ session('error') }}</p>
            @endif
        </div>
    </div>

    <nav>
        <div class="row justify-content-center">
            <!-- Patients -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h4 class="card-title">Patients</h4>
                        <a href="{{ route('PatientsSection') }}">Go to Patients</a>
                    </div>
                </div>
            </div>

            <!-- doctors -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h4 class="card-title">Doctors</h4>
                        <a href="{{route('doctors.index')}}">Go to Doctors</a>
                    </div>
                </div>
            </div>

            <div>
                <h3>Go to Appointments</h3>   
                <a href="{{route('appointments.index')}}">Go to Appointments</a>             
            </div>

        </div>
    </nav>
</body>
</html>
