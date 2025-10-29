<div class="wellall-sidebar">
    <nav class="wellall-sidebar-menu">

        <a href="{{ route('dashboard') }}" 
           class="wellall-menu-item {{ request()->routeIs('dashboard') ? 'is-active' : '' }}">
            <i class="fa-solid fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('PatientSection') }}" 
           class="wellall-menu-item {{ request()->routeIs('PatientSection', 'showPatient', 'editPatient') ? 'is-active' : '' }}">
            <i class="fa-solid fa-user"></i>
            <span>Patients</span>
        </a>

        <a href="{{ route('DoctorSection') }}" 
           class="wellall-menu-item {{ request()->routeIs('DoctorSection', 'showDoctor', 'editDoctor') ? 'is-active' : '' }}">
            <i class="fa-solid fa-user-md"></i>
            <span>Doctors</span>
        </a>

        <a href="{{ route('AppointmentSection') }}" 
           class="wellall-menu-item {{ request()->routeIs('AppointmentSection', 'AppointmentEdit') ? 'is-active' : '' }}">
            <i class="fa-solid fa-calendar-check"></i>
            <span>Appointments</span>
        </a>

        <a href="{{ route('QueueSection') }}" 
           class="wellall-menu-item {{ request()->routeIs('QueueSection') ? 'is-active' : '' }}">
            <i class="fa-solid fa-list-ol"></i>
            <span>Queue</span>
        </a>

        <a href="{{ route('CheckInSection') }}" 
           class="wellall-menu-item {{ request()->routeIs('CheckInSection') ? 'is-active' : '' }}">
            <i class="fa-solid fa-sign-in-alt"></i>
            <span>Check-In</span>
        </a>

        <a href="{{ route('MedicalRecordSection') }}" 
           class="wellall-menu-item {{ request()->routeIs('medical_records.*') ? 'is-active' : '' }}">
            <i class="fa-solid fa-notes-medical"></i>
            <span>Medical Records</span>
        </a>
    </nav>
</div>
