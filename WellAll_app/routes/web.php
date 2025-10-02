<?php

use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

// Redirect root to patient list
Route::redirect('/', '/patient');

// Show all patients
Route::get('/patient', [PatientController::class, 'showAllPatients'])->name('patients.index');

// Store new patient
Route::post('/patient', [PatientController::class, 'store'])->name('patients.store');
// routes/web.php

Route::get('/patient/{id}', [PatientController::class, 'show'])->name('patients.show');

//delete patient
Route::delete('/patient/{id}', [PatientController::class, 'destroy'])->name('deletePatient');

Route::get('/patient/{id}/edit', [PatientController::class, 'edit'])->name('editPatient');
Route::put('/patient/{id}', [PatientController::class, 'update'])->name('updatePatient');