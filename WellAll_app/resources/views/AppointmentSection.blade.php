@extends('layouts.app')
@include('layouts.navigation')
@section('content')
@vite(['resources/css/AppointmentSectionStyle.css', 'resources/css/NavigationStyle.css'])


<div class="form-search">
    <form action="{{ route('AppointmentSection') }}" method="GET" style="margin-bottom: 15px;">
        <input type="text" name="search" placeholder="Search by patient name..." value="{{ request('search') }}"
            style="padding: 6px; width: 250px;">
        <button type="submit" style="padding: 6px 12px; background-color: #43a047; color: white; border: none; border-radius: 5px;">
            Search
        </button>
        <a href="{{ route('AppointmentSection') }}" style="margin-left: 10px; color: #43a047; text-decoration: none;">Clear</a>
    </form>
</div>

<div class="content">
    <h2>Existing Appointments</h2>
    <div class="table-container">
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
                        <td>{{ $appointment->AppointmentBarcodeID }}</td>
                        <td>{{ $appointment->patient->PatientFirstName }} {{ $appointment->patient->PatientLastName }}</td>
                        <td>Dr. {{ $appointment->doctor->DoctorFirstName }} {{ $appointment->doctor->DoctorLastName }}</td>
                        <td>{{ $appointment->AppointmentDate }}</td>
                        <td>{{ $appointment->AppointmentTime }}</td>
                        <td>{{ $appointment->Reason }}</td>
                        <td class="actions-cell">
                            <a href="{{ route('AppointmentView', $appointment->AppointmentID) }}" class="btn-action btn-view">View</a>
                            <a href="{{ route('AppointmentEdit', $appointment->AppointmentID) }}" class="btn-action btn-edit">Edit</a>

                            <form action="{{ route('AppointmentDelete', $appointment->AppointmentID) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Delete this appointment?')">Delete</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
            @if($appointments->isEmpty())
                <tr>
                    <td colspan="7" style="text-align:center; color:gray;">No appointments found.</td>
                </tr>
            @endif

        </table>
    </div>
 <br><br><br><br>
 <br>

    <button id="toggleAppointmentForm" type="button" style="margin-bottom: 15px; padding: 8px 15px; background-color: #43a047; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Make a appointment
    </button>

    <div id="appointmentFormContainer" style="display: none;">
        <form action="{{ route('AppointmentStore') }}" method="POST">
            @csrf
            <h1>Appointment Management</h1>

            {{-- Success Message --}}
            @if(session('success'))
                <div style="color: green;">{{ session('success') }}</div>
            @endif

            <h3>Select Patient</h3>
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

            <h3>Select Doctor</h3>
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
            <button type="submit">Save Appointment</button>
            <a href="{{ route('AppointmentSection') }}">Cancel</a>
        </form>
    </div>
</div>

<script>
    function findPatient(barcode) {
        const select = document.getElementById('PatientID');
        const options = select.options;

        for (let i = 0; i < options.length; i++) {
            if (options[i].text.includes(barcode.trim())) {
                select.selectedIndex = i;
                document.getElementById('patient_name').innerText = options[i].text;
                break;
            }
        }
    }

    const toggleBtn = document.getElementById('toggleAppointmentForm');
    const formContainer = document.getElementById('appointmentFormContainer');

    toggleBtn.addEventListener('click', () => {
        if(formContainer.style.display === 'none') {
            formContainer.style.display = 'block';
            toggleBtn.textContent = 'Make a appointment';
        } else {
            formContainer.style.display = 'none';
            toggleBtn.textContent = 'Make a appointment';
        }
    });
</script>

