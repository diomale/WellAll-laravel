<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Appointment</title>

    @vite(['resources/css/NavigationStyle.css', 'resources/css/AppointmentEditStyle.css', 'resources/js/app.js'])
</head>

<body>
    <div class="content">
        <h1>Edit Appointment</h1>
        <h2>{{ $appointment->patient->PatientFirstName }} {{ $appointment->patient->PatientLastName }}</h2>

        {{-- Show validation errors --}}
        @if($errors->any())
            <div class="error-box">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Edit Form --}}
        <form action="{{ route('AppointmentUpdate', $appointment->AppointmentID) }}" method="POST" class="form-container">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="PatientID">Patient</label>
                <select name="PatientID" id="PatientID" required>
                    <option value="">-- Select Patient --</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->PatientID }}" 
                            {{ $patient->PatientID == $appointment->PatientID ? 'selected' : '' }}>
                            {{ $patient->PatientFirstName }} {{ $patient->PatientLastName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="DoctorID">Doctor</label>
                <select name="DoctorID" id="DoctorID" required>
                    <option value="">-- Select Doctor --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->DoctorID }}" 
                            {{ $doctor->DoctorID == $appointment->DoctorID ? 'selected' : '' }}>
                            Dr. {{ $doctor->DoctorFirstName }} {{ $doctor->DoctorLastName }} 
                            — {{ $doctor->Specialization }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="AppointmentDate">Date</label>
                <input type="date" name="AppointmentDate" id="AppointmentDate" 
                       value="{{ $appointment->AppointmentDate }}" required>
            </div>

            <div class="form-group">
                <label for="AppointmentTime">Time</label>
                <input type="time" name="AppointmentTime" id="AppointmentTime" 
                       value="{{ $appointment->AppointmentTime }}" required>
            </div>

            <div class="form-group">
                <label for="Reason">Reason for Appointment</label>
                <textarea name="Reason" id="Reason" rows="3" required>{{ $appointment->Reason }}</textarea>
            </div>

            <div class="button-group">
                <button type="submit" class="btn-save">💾 Save Changes</button>
                <a href="{{ route('AppointmentSection') }}" class="btn-cancel">← Back</a>
            </div>
        </form>
    </div>
</body>
</html>
