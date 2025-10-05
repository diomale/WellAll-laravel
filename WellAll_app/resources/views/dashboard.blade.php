<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WellAll Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">WellAll Healthcare Dashboard</h1>
            <p class="text-muted">Manage patients and records easily</p>
        </div>

        <div class="row justify-content-center">
            <!-- Patients -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h4 class="card-title">Patients</h4>
                        <p class="card-text">View and manage all registered patients.</p>
                        <a href="{{ route('patients.index') }}" class="btn btn-primary">Go to Patients</a>
                    </div>
                </div>
            </div>

            <!-- Appointments -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h4 class="card-title">Appointments</h4>
                        <p class="card-text">Schedule and track appointments (coming soon).</p>
                        <button class="btn btn-secondary" disabled>Coming Soon</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
