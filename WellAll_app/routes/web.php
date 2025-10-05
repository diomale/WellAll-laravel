<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Redirect root to dashboard
Route::redirect('/', '/dashboard');

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
