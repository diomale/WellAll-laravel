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

/////////patient routes

// Show all patients
Route::get('/patient', [PatientController::class, 'showAllPatients'])->name('patients.index');

// Store new patient
Route::post('/patient', [PatientController::class, 'store'])->name('patients.store');

// Show single patient
Route::get('/patient/{id}', [PatientController::class, 'show'])->name('patients.show');

// Delete patient
Route::delete('/patient/{id}', [PatientController::class, 'destroy'])->name('deletePatient');

// Edit + update
Route::get('/patient/{id}/edit', [PatientController::class, 'edit'])->name('editPatient');
Route::put('/patient/{id}', [PatientController::class, 'update'])->name('updatePatient');

//search sa dashboard
Route::get('/search-patient', [PatientController::class, 'searchByBarcode'])->name('patients.search');

/////////// Doctor routes

Route::get('/doctor', [DoctorController::class, 'index'])->name('doctors.index');

//store new doctor
Route::post('/doctor', [DoctorController::class, 'store'])->name('doctors.store');

// Show single doctor
Route::get('/doctor/{id}', [DoctorController::class, 'show'])->name('doctors.show');

// Delete doctor
Route::delete('/doctor/{id}', [DoctorController::class, 'destroy'])->name('deleteDoctor');

//edit + update
Route::get('/doctor/{id}/edit', [DoctorController::class, 'edit'])->name('editDoctor');
Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('updateDoctor');


//////////Appointment routes

Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointments.index');

Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointments.store');

Route::get('/appointment/{id}', [AppointmentController::class, 'show'])->name('doctors.show');


Route::delete('/appointment/{id}', [AppointmentController::class, 'destroy'])->name('deleteAppointment');


Route::get('/appointment/{id}/edit', [AppointmentController::class, 'edit'])->name('editAppointment');
Route::put('/appointment/{id}', [AppointmentController::class, 'update'])->name('updateAppointment');


