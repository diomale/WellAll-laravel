<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Queue;
use App\Models\CheckIn;

class AppointmentController extends Controller
{
    /** 
     * Show all appointments 
     */
    public function showAllAppointments(Request $request)
    {
        $search = $request->input('search');

        $appointments = \App\Models\Appointment::with(['patient', 'doctor'])
            ->when($search, function ($query, $search) {
                $query->whereHas('patient', function ($q) use ($search) {
                    $q->where('PatientFirstName', 'like', "%{$search}%")
                    ->orWhere('PatientLastName', 'like', "%{$search}%");
                });
            })
            ->get();

        $patients = \App\Models\Patient::all();
        $doctors = \App\Models\Doctor::all();

        return view('AppointmentSection', compact('appointments', 'patients', 'doctors', 'search'));
    }

    /** 
     * Show form to create a new appointment 
     */
    public function createAppointment()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $appointments = Appointment::with(['patient', 'doctor'])->get();

        return view('AppointmentSection', compact('patients', 'doctors', 'appointments'));
    }

    /** 
     * Store new appointment 
     */
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'PatientID' => 'required|exists:patients_table,PatientID',
            'DoctorID' => 'required|exists:doctors_table,DoctorID',
            'AppointmentDate' => 'required|date',
            'AppointmentTime' => 'required|date_format:H:i',
            'Reason' => 'required|string|max:255',
        ]);

        // Generate unique barcode
        $lastAppointment = Appointment::orderBy('AppointmentID', 'desc')->first();
        $nextNumber = $lastAppointment
            ? intval(substr($lastAppointment->AppointmentBarcodeID, 2, 5)) + 1
            : 1;
        $AppointmentBarcodeID = '*A' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT) . '*';

        // Create appointment record
        $appointment = Appointment::create([
            'AppointmentBarcodeID' => $AppointmentBarcodeID,
            'PatientID' => $request->PatientID,
            'DoctorID' => $request->DoctorID,
            'AppointmentDate' => $request->AppointmentDate,
            'AppointmentTime' => $request->AppointmentTime,
            'Reason' => $request->Reason,
            'DateCreated' => now(),
        ]);

        //Automatically add to queue and check-in if those controllers exist
        if (class_exists(\App\Http\Controllers\QueueController::class)) {
            app(\App\Http\Controllers\QueueController::class)->addToQueue($appointment->AppointmentID);
        }

        if (class_exists(\App\Http\Controllers\CheckInController::class)) {
            app(\App\Http\Controllers\CheckInController::class)->autoAddCheckIn($appointment->AppointmentID);
        }

        return redirect()->route('AppointmentSection')
            ->with('success', 'Appointment created and automatically added to queue and check-in!');
    }

    /** 
     * Show single appointment 
     */
    public function view($id)
    {
        $appointment = Appointment::with(['patient', 'doctor'])->findOrFail($id);
        return view('AppointmentView', compact('appointment'));
    }

    /** 
     * Edit appointment form 
     */
    public function editAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('AppointmentEdit', compact('appointment', 'patients', 'doctors'));
    }

    /** 
     * Update appointment 
     */
    public function updateAppointment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'PatientID' => 'required|exists:patients_table,PatientID',
            'DoctorID' => 'required|exists:doctors_table,DoctorID',
            'AppointmentDate' => 'required|date',
            'AppointmentTime' => 'required|date_format:H:i',
            'Reason' => 'required|string|max:255',
        ]);

        $appointment->update([
            'PatientID' => $request->PatientID,
            'DoctorID' => $request->DoctorID,
            'AppointmentDate' => $request->AppointmentDate,
            'AppointmentTime' => $request->AppointmentTime,
            'Reason' => $request->Reason,
        ]);

        return redirect()->route('AppointmentSection')
            ->with('success', 'Appointment updated successfully!');
    }

    /** 
     * Delete appointment (with related queue + check-in)
     */
    public function deleteAppointment($id)
    {
        // Delete related records first
        CheckIn::where('AppointmentID', $id)->delete();
        Queue::where('AppointmentID', $id)->delete();

        // Then delete appointment
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->back()
            ->with('success', 'Appointment, queue, and check-in records deleted successfully!');
    }
}
