<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Appointment</title>
    @vite(['resources/css/NavigationStyle.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h1 {
            color: #333;
        }

        label {
            font-weight: bold;
        }

        input, select, textarea {
            width: 300px;
            padding: 8px;
            margin: 6px 0 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #0066cc;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-box {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Edit Appointment for: {{ $appointment->patient->PatientFirstName }} {{ $appointment->patient->PatientLastName }}</h1>

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
    <form action="{{ route('AppointmentUpdate', $appointment->AppointmentID) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- patient Selection --}}
        <label for="PatientID">Choose Patient:</label><br>
        <select name="PatientID" id="PatientID" required>
            <option value="">-- Select Patient --</option>
            @foreach($patients as $patient)
                <option value="{{ $patient->PatientID }}" 
                    {{ $patient->PatientID == $appointment->PatientID ? 'selected' : '' }}>
                    {{ $patient->PatientFirstName }} {{ $patient->PatientLastName }} - 
                </option>
            @endforeach
        </select>
        <br>

        {{-- Doctor Selection --}}
        <label for="DoctorID">Choose Doctor:</label><br>
        <select name="DoctorID" id="DoctorID" required>
            <option value="">-- Select Doctor --</option>
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->DoctorID }}" 
                    {{ $doctor->DoctorID == $appointment->DoctorID ? 'selected' : '' }}>
                    Dr. {{ $doctor->DoctorFirstName }} {{ $doctor->DoctorLastName }} - 
                    {{ $doctor->Specialization }} - {{ $doctor->DoctorAvailability }}
                </option>
            @endforeach
        </select>
        <br>

        {{-- Appointment Date --}}
        <label for="AppointmentDate">Date:</label><br>
        <input type="date" name="AppointmentDate" id="AppointmentDate" 
               value="{{ $appointment->AppointmentDate }}" required><br>

        {{-- Appointment Time --}}
        <label for="AppointmentTime">Time:</label><br>
        <input type="time" name="AppointmentTime" id="AppointmentTime" 
               value="{{ $appointment->AppointmentTime }}" required><br>

        {{-- Reason --}}
        <label for="Reason">Reason for Appointment:</label><br>
        <textarea name="Reason" id="Reason" rows="3" cols="40" required>{{ $appointment->Reason }}</textarea><br>

        {{-- Submit --}}
        <button type="submit">Save Changes</button>
    </form>

    {{-- Back Links --}}
    <br>
    <a href="{{ route('AppointmentSection') }}">Back to Appointments</a><br>
</body>
</html>
