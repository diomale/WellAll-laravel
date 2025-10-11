<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    // Show all appointments (with create form)
    public function showAllAppointments()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->get();
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('AppointmentSection', compact('appointments', 'patients', 'doctors'));
    }

    // Show form to create a new appointment (optional)
    public function createAppointment()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $appointments = Appointment::with(['patient', 'doctor'])->get();

        return view('AppointmentSection', compact('patients', 'doctors', 'appointments'));
    }

    // Store new appointment
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'PatientID' => 'required|exists:patients_table,PatientID',
            'DoctorID' => 'required|exists:doctors_table,DoctorID',
            'AppointmentDate' => 'required|date',
            'AppointmentTime' => 'required|date_format:H:i',
            'Reason' => 'required|string|max:255',
        ]);

        // Generate barcode ID
        $lastAppointment = Appointment::orderBy('AppointmentID', 'desc')->first();
        $nextNumber = $lastAppointment ? intval(substr($lastAppointment->AppointmentBarcodeID, 2, 5)) + 1 : 1;
        $AppointmentBarcodeID = '*' . 'A' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT) . '*';

        Appointment::create([
            'AppointmentBarcodeID' => $AppointmentBarcodeID,
            'PatientID' => $request->PatientID,
            'DoctorID' => $request->DoctorID,
            'AppointmentDate' => $request->AppointmentDate,
            'AppointmentTime' => $request->AppointmentTime,
            'Reason' => $request->Reason,
            'DateCreated' => now(),
        ]);

        return redirect()->route('AppointmentSection')->with('success', 'Appointment created successfully!');
    }

    // Edit appointment
    public function editAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('AppointmentEdit', compact('appointment', 'patients', 'doctors'));
    }

    // Update appointment
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

        $appointment->update($request->only([
            'PatientID',
            'DoctorID',
            'AppointmentDate',
            'AppointmentTime',
            'Reason',
        ]));

        return redirect()->route('AppointmentSection')->with('success', 'Appointment updated successfully!');
    }

    // Delete appointment
    public function deleteAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Appointment deleted successfully.');
    }
}
