<div class="sidebar">
    <a href="{{ route('dashboard.index') }}" class="nav-box {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
        Dashboard
    </a>

    <a href="{{ route('PatientSection') }}" class="nav-box {{ request()->routeIs('PatientSection', 'showPatient', 'editPatient') ? 'active' : '' }}">
        Patients
    </a>

    <a href="{{ route('DoctorSection') }}" class="nav-box {{ request()->routeIs('DoctorSection', 'showDoctor', 'editDoctor') ? 'active' : '' }}">
        Doctors
    </a>

    <a href="{{ route('AppointmentSection') }}" class="nav-box {{ request()->routeIs('AppointmentSection', 'AppointmentEdit') ? 'active' : '' }}">
        Appointments
    </a>

    <a href="{{ route('QueueSection') }}" 
        class="nav-box {{ request()->routeIs('QueueSection') ? 'active' : '' }}">
        Queue
    </a>


    <a href="{{ route('CheckInSection') }}" 
        class="nav-box {{ request()->routeIs('CheckInSection') ? 'active' : '' }}">
        Check-In
    </a>

    <a href="{{ route('MedicalRecordSection') }}" 
        class="nav-box {{ request()->routeIs('medical_records.*') ? 'active' : '' }}">
        Medical Records
    </a>
</div>

<style>
    .sidebar {
        width: 200px;
        background-color: #43a047;
        padding: 20px;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .nav-box {
        color: white;
        text-decoration: none;
        padding: 10px 15px;
        margin-bottom: 10px;
        border-radius: 5px;
        transition: background 0.3s;
    }

    .nav-box:hover {
        background-color: #2e7d32;
    }

    .nav-box.active {
        background-color: #1b5e20;
        font-weight: bold;
    }
</style>
