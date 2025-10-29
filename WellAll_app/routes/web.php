<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MedicalRecordController;

// Redirect root to login page
Route::redirect('/', '/login');

// ===== AUTH ROUTES ===== //
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

// Logout (available only when logged in)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ===== PROTECTED ROUTES (Require Login) ===== //
Route::middleware(['auth', 'prevent-back-history'])->group(function () {

    // ===== DASHBOARD ===== //
    Route::middleware(['auth', 'prevent-back-history'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });


    // ===== PATIENT ROUTES ===== //
    Route::get('/patient', [PatientController::class, 'showAllPatients'])->name('PatientSection');
    Route::post('/patient', [PatientController::class, 'storePatient'])->name('storePatient');
    Route::get('/patient/{id}', [PatientController::class, 'showPatient'])->name('showPatient');
    Route::delete('/patient/{id}', [PatientController::class, 'deletePatient'])->name('deletePatient');
    Route::get('/patient/{id}/editPatient', [PatientController::class, 'editPatient'])->name('editPatient');
    Route::put('/patient/{id}', [PatientController::class, 'updatePatient'])->name('updatePatient');
    Route::get('/search-patient', [PatientController::class, 'searchByBarcode'])->name('patients.search');

    // ===== DOCTOR ROUTES ===== //
    Route::get('/doctors', [DoctorController::class, 'showAllDoctors'])->name('DoctorSection');
    Route::post('/doctors', [DoctorController::class, 'storeDoctor'])->name('storeDoctor');
    Route::get('/doctors/{id}', [DoctorController::class, 'showDoctor'])->name('showDoctor');
    Route::delete('/doctors/{id}', [DoctorController::class, 'deleteDoctor'])->name('deleteDoctor');
    Route::get('/doctors/{id}/editDoctor', [DoctorController::class, 'editDoctor'])->name('editDoctor');
    Route::put('/doctors/{id}', [DoctorController::class, 'updateDoctor'])->name('updateDoctor');

    // ===== APPOINTMENT ROUTES ===== //
    Route::get('/appointments', [AppointmentController::class, 'showAllAppointments'])->name('AppointmentSection');
    Route::get('/appointments/view/{id}', [AppointmentController::class, 'view'])->name('AppointmentView');
    Route::get('/appointments/create', [AppointmentController::class, 'createAppointment'])->name('AppointmentCreate');
    Route::post('/appointments/store', [AppointmentController::class, 'storeAppointment'])->name('AppointmentStore');
    Route::get('/appointments/edit/{id}', [AppointmentController::class, 'editAppointment'])->name('AppointmentEdit');
    Route::put('/appointments/update/{id}', [AppointmentController::class, 'updateAppointment'])->name('AppointmentUpdate');
    Route::delete('/appointments/delete/{id}', [AppointmentController::class, 'deleteAppointment'])->name('AppointmentDelete');

    // ===== QUEUE ROUTES ===== //
    Route::get('/queue', [QueueController::class, 'showQueue'])->name('QueueSection');
    Route::post('/queue/update/{id}', [QueueController::class, 'updateStatus'])->name('queue.update');

    // ===== CHECK-IN ROUTES ===== //
    Route::get('/check-in', [CheckInController::class, 'showAll'])->name('CheckInSection');
    Route::post('/check-in/search', [CheckInController::class, 'searchByBarcode'])->name('checkin.search');
    Route::post('/appointments/checkin/{id}/confirm', [CheckInController::class, 'confirmCheckIn'])->name('appointments.checkin.confirm');
    Route::post('/check-in/confirm/{appointmentID}', [CheckInController::class, 'confirmCheckIn'])->name('confirmCheckIn');

    // ===== MEDICAL RECORD ROUTES ===== //
    Route::get('/medical-record', [MedicalRecordController::class, 'index'])->name('MedicalRecordSection');
    Route::get('/medical-record/add/{appointmentID}', [MedicalRecordController::class, 'create'])->name('MedicalRecordAdd');
    Route::post('/medical-record/store', [MedicalRecordController::class, 'store'])->name('MedicalRecordStore');
    Route::get('/medical-record/view/{id}', [MedicalRecordController::class, 'view'])->name('MedicalRecordView');
    Route::get('/medical-record/edit/{id}', [MedicalRecordController::class, 'edit'])->name('medical-record.edit');
    Route::put('/medical-record/update/{id}', [MedicalRecordController::class, 'update'])->name('medical-record.update');
    Route::delete('/medical-record/{id}/delete', [MedicalRecordController::class, 'destroy'])->name('medical-record.destroy');
    Route::get('/medical-record/create', [MedicalRecordController::class, 'create'])->name('medical-record.create');
});
