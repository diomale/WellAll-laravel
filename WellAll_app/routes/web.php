<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



// Redirect root to dashboard
Route::redirect('/', '/dashboard')->name('dashboard.index');

/////////patient routes//////////

// Show all patients
Route::get('/patient', [PatientController::class, 'showAllPatients'])->name('PatientSection');


// Store new patient
Route::post('/patient', [PatientController::class, 'storePatient'])->name('storePatient');

// Show single patient
Route::get('/patient/{id}', [PatientController::class, 'showPatient'])->name('showPatient');

// Delete patient
Route::delete('/patient/{id}', [PatientController::class, 'deletePatient'])->name('deletePatient');

// Edit + update
Route::get('/patient/{id}/editPatient', [PatientController::class, 'editPatient'])->name('editPatient');
Route::put('/patient/{id}', [PatientController::class, 'updatePatient'])->name('updatePatient');



//search sa dashboard
Route::get('/search-patient', [PatientController::class, 'searchByBarcode'])->name('patients.search');


/////////// Doctor routes ////////////

// Show all doctors
Route::get('/doctors', [DoctorController::class, 'showAllDoctors'])->name('DoctorSection');

//store new doctor
Route::post('/doctors', [DoctorController::class, 'storeDoctor'])->name('storeDoctor');

// Show single doctor
Route::get('/doctors/{id}', [DoctorController::class, 'showDoctor'])->name('showDoctor');

// Delete doctor
Route::delete('/doctors/{id}', [DoctorController::class, 'deleteDoctor'])->name('deleteDoctor');

//edit + update
Route::get('/doctors/{id}/editDoctor', [DoctorController::class, 'editDoctor'])->name('editDoctor');
Route::put('/doctors/{id}', [DoctorController::class, 'updateDoctor'])->name('updateDoctor');


//////////Appointment routes//////////////


// Show all appointments
Route::get('/appointments', [AppointmentController::class, 'showAllAppointments'])->name('AppointmentSection');

// Create appointment form
Route::get('/appointments/create', [AppointmentController::class, 'createAppointment'])->name('AppointmentCreate');

// Store new appointment
Route::post('/appointments/store', [AppointmentController::class, 'storeAppointment'])->name('AppointmentStore');

// Edit appointment
Route::get('/appointments/edit/{id}', [AppointmentController::class, 'editAppointment'])->name('AppointmentEdit');

// Update appointment
Route::post('/appointments/update/{id}', [AppointmentController::class, 'updateAppointment'])->name('AppointmentUpdate');

// Delete appointment
Route::delete('/appointments/delete/{id}', [AppointmentController::class, 'deleteAppointment'])->name('AppointmentDelete');
