<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/NavigationStyle.css', 'resources/js/app.js','resources/css/AppointmentSectionStyle.css'])

    @include('layouts.navigation')
</head>
<body>
    <div class="content">
            
    <h2> Existing Appointments</h2>
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Barcode</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Reason</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td >{{ $appointment->AppointmentBarcodeID }}</td>
                    <td>{{ $appointment->patient->PatientFirstName }} {{ $appointment->patient->PatientLastName }}</td>
                    <td>Dr. {{ $appointment->doctor->DoctorFirstName }} {{ $appointment->doctor->DoctorLastName }}</td>
                    <td>{{ $appointment->AppointmentDate }}</td>
                    <td>{{ $appointment->AppointmentTime }}</td>
                    <td>{{ $appointment->Reason }}</td>
                    <td>
                        <a href="{{ route('AppointmentEdit', $appointment->AppointmentID) }}">Edit</a>
                        <form action="{{ route('AppointmentDelete', $appointment->AppointmentID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this appointment?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <button id="toggleAppointmentForm" type="button" style="margin-bottom: 15px; padding: 8px 15px; background-color: #43a047; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Show Appointment Management
    </button>

    <div id="appointmentFormContainer" style="display: none;">
        <!-- Your existing appointment form here -->
        <form action="{{ route('AppointmentStore') }}" method="POST">
            @csrf
                <h1>Appointment Management</h1>

        {{-- Success Message --}}
        @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        {{-- Create Appointment Form --}}
        <form action="{{ route('AppointmentStore') }}" method="POST">
            @csrf

            <h3> Select Patient</h3>
            <label>Scan Patient Barcode:</label><br>
            <input type="text" name="barcode_search" id="barcode_search" placeholder="Scan or type barcode..." autofocus oninput="findPatient(this.value)">
            <br><small>or search by name below</small><br>

            <label for="PatientID">Search Patient:</label><br>
            <select name="PatientID" id="PatientID" required>
                <option value="">-- Select Patient --</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->PatientID }}">
                        {{ $patient->PatientFirstName }} {{ $patient->PatientLastName }} ({{ $patient->PatientBarcodeID }})
                    </option>
                @endforeach
            </select>

            <div id="patient_info" style="margin-top: 10px;">
                <strong>Selected Patient Info:</strong><br>
                <span id="patient_name"></span><br>
                <span id="patient_contact"></span><br>
                <span id="patient_id"></span>
            </div>

            <hr>

            <h3> Select Doctor</h3>
            <label for="DoctorID">Choose Doctor:</label><br>
            <select name="DoctorID" id="DoctorID" required>
                <option value="">-- Select Doctor --</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->DoctorID }}">
                        Dr. {{ $doctor->DoctorFirstName }} {{ $doctor->DoctorLastName }} - {{ $doctor->Specialization }} - {{ $doctor->DoctorAvailability }}
                    </option>
                @endforeach
            </select>

            <hr>

            <h3>Pick Date & Time</h3>
            <label for="AppointmentDate">Date:</label><br>
            <input type="date" name="AppointmentDate" id="AppointmentDate" required><br><br>

            <label for="AppointmentTime">Time:</label><br>
            <input type="time" name="AppointmentTime" id="AppointmentTime" required><br><br>

            <label for="Reason">Reason for Appointment:</label><br>
            <textarea name="Reason" id="Reason" rows="3" cols="40" required></textarea>

        <br><br>
        <button type="submit"> Save Appointment</button>
        <a href="{{ route('AppointmentSection') }}"> Cancel</a>
    </form>

    <hr>

    <h2> Existing Appointments</h2>
    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Barcode</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Reason</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td >{{ $appointment->AppointmentBarcodeID }}</td>
                    <td>{{ $appointment->patient->PatientFirstName }} {{ $appointment->patient->PatientLastName }}</td>
                    <td>Dr. {{ $appointment->doctor->DoctorFirstName }} {{ $appointment->doctor->DoctorLastName }}</td>
                    <td>{{ $appointment->AppointmentDate }}</td>
                    <td>{{ $appointment->AppointmentTime }}</td>
                    <td>{{ $appointment->Reason }}</td>
                    <td>
                        <a href="{{ route('AppointmentEdit', $appointment->AppointmentID) }}">Edit</a>
                        <form action="{{ route('AppointmentDelete', $appointment->AppointmentID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this appointment?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

        <script>
            function findPatient(barcode) {
                const select = document.getElementById('PatientID');
                const options = select.options;

                for (let i = 0; i < options.length; i++) {
                    if (options[i].text.includes(barcode.trim())) {
                        select.selectedIndex = i;
                        document.getElementById('patient_name').innerText = options[i].text;
                        document.getElementById('patient_contact').innerText = '';
                        break;
                    }
                }
            }
        </script>
        <a href="{{route('dashboard.index')}}">dashboard</a>
        <a href="{{route('QueueSection')}}">Queue</a>
        </form>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggleAppointmentForm');
        const formContainer = document.getElementById('appointmentFormContainer');

        toggleBtn.addEventListener('click', () => {
            if(formContainer.style.display === 'none') {
                formContainer.style.display = 'block';
                toggleBtn.textContent = 'Hide Appointment Management';
            } else {
                formContainer.style.display = 'none';
                toggleBtn.textContent = 'Show Appointment Management';
            }
        });
    </script>
    </div>



</body>
</html>
