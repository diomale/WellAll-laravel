<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WellAll Dashboard</title>
    
</head>
<body>
    <header>
        <div class="Title">WellAll Healthcare Dashboard</div>
        <p class="subhead">Manage patients and records easily</p>
    </header>

    <nav>
        <div class="row justify-content-center">
            <!-- Patients -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h4 class="card-title">Patients</h4>
                        <a href="{{ route('PatientSection') }}">Go to Patients</a>
                    </div>
                </div>
            </div>

            <!-- doctors -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <h4 class="card-title">Doctors</h4>
                        <a href="{{route('DoctorSection')}}">Go to Doctors</a>
                    </div>
                </div>
            </div>

            <div>
                <h3>Go to Appointments</h3>   
                <a href="{{route('AppointmentSection')}}">Go to Appointments</a>             
            </div>

            <div>
                <h3>Go to Queue Section</h3>   
                <a href="{{route('QueueSection')}}">Go to Queue Section</a>
            </div>
        </div>
    </nav>
</body>
</html>
