<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;

class MedicalRecordController extends Controller
{
    // Show all medical records
    public function index(Request $request)
    {
        $search = $request->input('search');

        $records = MedicalRecord::with(['patient', 'doctor'])
            ->when($search, function ($query, $search) {
                $query->whereHas('patient', function ($q) use ($search) {
                    $q->where('PatientFirstName', 'like', "%$search%")
                      ->orWhere('PatientLastName', 'like', "%$search%");
                })
                ->orWhereHas('doctor', function ($q) use ($search) {
                    $q->where('DoctorFirstName', 'like', "%$search%")
                      ->orWhere('DoctorLastName', 'like', "%$search%");
                });
            })
            ->orderBy('MedicalDateRegistered', 'desc')
            ->get();

        return view('MedicalRecordSection', compact('records'));
    }

    //  View a specific record
    public function view($id)
    {
        $record = MedicalRecord::with(['patient', 'doctor'])->findOrFail($id);
        return view('MedicalRecordView', compact('record'));
    }

    //  Edit form
    public function edit($id)
    {
        $record = MedicalRecord::findOrFail($id);
        return view('MedicalRecordEdit', compact('record'));
    }

    // Update record
    public function update(Request $request, $id)
    {
        $record = MedicalRecord::findOrFail($id);

        $request->validate([
            'diagnosis' => 'required|string',
            'treatment' => 'nullable|string',
            'prescription' => 'nullable|string',
        ]);

        $record->update([
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'prescription' => $request->prescription,
        ]);

        return redirect()->route('MedicalRecordSection')->with('success', 'Medical record updated successfully!');
    }

    // Show form to create new medical record from an appointment
    public function create($appointmentID)
    {
        $appointment = Appointment::with(['patient', 'doctor'])->findOrFail($appointmentID);
        return view('MedicalRecordAdd', compact('appointment'));
    }

    // Store new medical record + mark appointment as done
    public function store(Request $request)
    {
        $request->validate([
            'PatientID' => 'required|integer',
            'DoctorID' => 'required|integer',
            'AppointmentID' => 'required|integer',
            'diagnosis' => 'required|string',
            'treatment' => 'nullable|string',
            'prescription' => 'nullable|string',
        ]);

        $record = MedicalRecord::create([
            'PatientID' => $request->PatientID,
            'DoctorID' => $request->DoctorID,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'prescription' => $request->prescription,
            'MedicalDateRegistered' => now(), 
        ]);

       
        $appointment = Appointment::find($request->AppointmentID);
        if ($appointment) {
            $appointment->Status = 'Done';
            $appointment->save();
        }

        return redirect()->route('MedicalRecordSection')->with('success', '✅ Medical record added and appointment marked as done.');
    }

    // Delete medical record
    public function destroy($id)
    {
        $record = MedicalRecord::findOrFail($id);
        $record->delete();

        return redirect()->route('MedicalRecordSection')->with('success', 'Medical record deleted successfully!');
    }

}
