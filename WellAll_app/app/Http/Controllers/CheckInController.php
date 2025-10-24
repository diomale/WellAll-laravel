<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\CheckIn;
use App\Models\Patient;
use App\Models\Doctor;
use Carbon\Carbon;

class CheckInController extends Controller
{
    //show all check-ins
    public function showAll()
    {
        $checkins = CheckIn::with(['patient', 'doctor', 'appointment'])
            ->orderBy('CheckInID', 'desc')
            ->get();

        return view('CheckInSection', compact('checkins'));
    }

   
    public function searchByBarcode(Request $request)
    {
        $barcode = trim($request->input('barcode'));
        $cleanBarcode = str_replace('*', '', $barcode);

        if (empty($cleanBarcode)) {
            return redirect()->route('CheckInSection')
                ->with('error', 'Please enter a barcode.');
        }

        
        $appointment = Appointment::with(['patient', 'doctor'])
            ->where('AppointmentBarcodeID', $barcode)
            ->orWhere('AppointmentBarcodeID', "*{$cleanBarcode}*")
            ->first();

        if (!$appointment) {
            return redirect()->route('CheckInSection')
                ->with('error', 'No appointment found with that barcode.');
        }

        
        return view('CheckInView', compact('appointment'));
    }


    // Confirm check-in 
    public function confirmCheckIn($appointmentID)
    {
        $appointment = Appointment::with(['patient', 'doctor'])->findOrFail($appointmentID);

        
        $existingCheckIn = CheckIn::where('AppointmentID', $appointmentID)->first();
        if ($existingCheckIn) {
            return redirect()->route('MedicalRecordAdd', ['appointmentID' => $appointmentID])
                ->with('info', 'This appointment was already checked in. Redirecting to medical record entry.');
        }

        
        CheckIn::create([
            'PatientID' => $appointment->PatientID,
            'DoctorID' => $appointment->DoctorID,
            'AppointmentID' => $appointment->AppointmentID,
            'CheckInTime' => now(),
            'CheckInDateCreated' => now(),
            'CheckInRemarks' => 'Checked in via barcode',
        ]);

        
        return redirect()->route('MedicalRecordAdd', ['appointmentID' => $appointmentID])
            ->with('success', 'Patient checked in successfully! Proceed to add medical record.');
    }


    
    public function autoAddCheckIn($appointmentID)
    {
        $appointment = Appointment::find($appointmentID);
        if (!$appointment) return;

        CheckIn::firstOrCreate(
            ['AppointmentID' => $appointment->AppointmentID],
            [
                'PatientID' => $appointment->PatientID,
                'DoctorID' => $appointment->DoctorID,
                'CheckInTime' => now(),
                'CheckInDateCreated' => now(),
                'CheckInRemarks' => 'Auto check-in',
            ]
        );
    }

    
    public static function deleteCheckInByAppointment($appointmentID)
    {
        CheckIn::where('AppointmentID', $appointmentID)->delete();
    }
}
