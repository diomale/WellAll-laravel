<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WellAll Dashboard</title>
    
</head>
<body>
    <header>
        <h1 class="fw-bold">WellAll Healthcare Dashboard</h1>
        <p class="text-muted">Manage patients and records easily</p>
    </header>
    <nav>
        <div class="row justify-content-center">
            <!-- Patients -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h4 class="card-title">Patients</h4>
                        <a href="{{ route('patients.index') }}">Go to Patients</a>
                    </div>
                </div>
            </div>

            <!-- Appointments -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h4 class="card-title">Appointments</h4>
                        <button disabled>Go to Appointments</button>
                    </div>
                </div>
            </div>

        </div>
    </nav>
</body>
</html>
