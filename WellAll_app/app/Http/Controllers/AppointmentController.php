<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;

class AppointmentController extends Controller
{

    // Show all appointments
    public function showAllAppointments()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->get();
        return view('appointment', compact('appointmentData'));
    }

    // Show form to create a new appointment
    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('appointments.create', compact('patients', 'doctors'));
    }

    // Store new appointment
    public function store(Request $request)
    {
        $request->validate([
            'PatientID' => 'required|exists:patient_table,PatientID',
            'DoctorID' => 'required|exists:doctor_table,DoctorID',
            'AppointmentDate' => 'required|date',
            'AppointmentTime' => 'required',
            'Reason' => 'required|string',
        ]);

        // Generate Appointment Code
        $lastAppointment = Appointment::orderBy('AppointmentID', 'desc')->first();

        if ($lastAppointment) {
            $numericPart = (int) filter_var($lastAppointment->AppointmentCode, FILTER_SANITIZE_NUMBER_INT);
            $nextNumber = $numericPart + 1;
        } else {
            $nextNumber = 1;
        }

        $barcodeCore = 'A' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        $appointmentCode = '*' . $barcodeCore . '*';

        Appointment::create([
            'AppointmentCode' => $appointmentCode,
            'PatientID' => $request->PatientID,
            'DoctorID' => $request->DoctorID,
            'AppointmentDate' => $request->AppointmentDate,
            'AppointmentTime' => $request->AppointmentTime,
            'Reason' => $request->Reason,
            'Status' => 'Scheduled',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully!');
    }


    // Edit appointment
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }


    // Update appointment
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    
    // Delete appointment
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
    }
}
