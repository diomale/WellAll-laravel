<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Show all patients
    public function showAllPatients()
    {
        $patientData = Patient::all();
        return view('patient', compact('patientData'));
    }

    // Store new patient
    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|string|max:100',
            'LastName' => 'required|string|max:100',
            'DateOfBirth' => 'required|date',
            'Gender' => 'required|string',
            'ContactNumber' => 'nullable|string|max:20',
            'Address' => 'nullable|string|max:255',
            'BloodType' => 'nullable|string|max:3',
            'Allergies' => 'nullable|string|max:255',
            'ExistingConditions' => 'nullable|string|max:255',
            'EmergencyContact' => 'nullable|string|max:100',
            'EmergencyPhone' => 'nullable|string|max:20',
        ]);

        // Generate BarcodeID
        $lastPatient = Patient::orderBy('PatientID', 'desc')->first();
        $nextNumber = $lastPatient ? intval(substr($lastPatient->BarcodeID, 1)) + 1 : 1;
        $barcodeID = 'P' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        Patient::create([
            'BarcodeID' => $barcodeID,
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'DateOfBirth' => $request->DateOfBirth,
            'Gender' => $request->Gender,
            'ContactNumber' => $request->ContactNumber,
            'Address' => $request->Address,
            'BloodType' => $request->BloodType,
            'Allergies' => $request->Allergies,
            'ExistingConditions' => $request->ExistingConditions,
            'EmergencyContact' => $request->EmergencyContact,
            'EmergencyPhone' => $request->EmergencyPhone,
            'DateRegistered' => now(),
        ]);

        return redirect()->back()->with('success', 'Patient added successfully with ID: ' . $barcodeID);
    }

    // Show single patient
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('view', compact('patient'));
    }

    // Delete patient
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->back()->with('success', 'Patient deleted successfully.');
    }

    // Edit form
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('edit', compact('patient'));
    }

    // Update patient
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'FirstName' => 'required|string|max:100',
            'LastName' => 'required|string|max:100',
            'DateOfBirth' => 'required|date',
            'Gender' => 'required|string',
            'ContactNumber' => 'nullable|string|max:20',
            'Address' => 'nullable|string|max:255',
            'BloodType' => 'nullable|string|max:3',
            'Allergies' => 'nullable|string|max:255',
            'ExistingConditions' => 'nullable|string|max:255',
            'EmergencyContact' => 'nullable|string|max:100',
            'EmergencyPhone' => 'nullable|string|max:20',
        ]);

        $patient->update($request->only([
            'FirstName',
            'LastName',
            'DateOfBirth',
            'Gender',
            'ContactNumber',
            'Address',
            'BloodType',
            'Allergies',
            'ExistingConditions',
            'EmergencyContact',
            'EmergencyPhone',
        ]));

        return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
    }
}
