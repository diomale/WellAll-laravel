<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//patient routes

// Redirect root to dashboard
Route::redirect('/', '/dashboard')->name('dashboard.index');


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

// Doctor routes

Route::get('/doctor', [DoctorController::class, 'index'])->name('doctors.index');
Route::post('/doctor', [DoctorController::class, 'store'])->name('doctors.store');
Route::get('/doctor/{id}', [DoctorController::class, 'show'])->name('doctors.show');
Route::delete('/doctor/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
Route::get('/doctor/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctors.update');


