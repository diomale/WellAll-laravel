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
Route::get('/patient/{id}/edit', [PatientController::class, 'editPatient'])->name('editPatient');
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


//////////Appointment routes

Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointments.index');

Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointments.store');

Route::get('/appointment/{id}', [AppointmentController::class, 'show'])->name('doctors.show');


Route::delete('/appointment/{id}', [AppointmentController::class, 'destroy'])->name('deleteAppointment');


Route::get('/appointment/{id}/edit', [AppointmentController::class, 'edit'])->name('editAppointment');
Route::put('/appointment/{id}', [AppointmentController::class, 'update'])->name('updateAppointment');


