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
        return view('PatientSection', compact('patientData'));
    }

    // Store new patient
    public function store(Request $request)
    {
        $request->validate([
            'PatientFirstName' => 'required|string|max:100',
            'PatientLastName' => 'required|string|max:100',
            'PatientDateOfBirth' => 'required|date',
            'PatientGender' => 'required|string',
            'PatientContactNumber' => 'nullable|string|max:20',
            'PatientAddress' => 'nullable|string|max:255',
            'PatientBloodType' => 'nullable|string|max:3',
            'PatientAllergies' => 'nullable|string|max:255',
            'PatientExistingConditions' => 'nullable|string|max:255',
            'PatientEmergencyContact' => 'nullable|string|max:100',
            'PatientEmergencyPhone' => 'nullable|string|max:20',
        ]);

        $existingPatient = Patient::where('PatientFirstName', $request->PatientFirstName)
        ->where('PatientLastName', $request->PatientLastName)
        ->first();
        
        //check if patient with same name exists
        if ($existingPatient) {
        return redirect()->back()->with('error', 'A patient with the same name already exists in the system!');
        }

        // Generate BarcodeID
        $lastPatient = Patient::orderBy('PatientID', 'desc')->first();

        if ($lastPatient) {
            $numericPart = (int) filter_var($lastPatient->PatientBarcodeID, FILTER_SANITIZE_NUMBER_INT);
            $nextNumber = $numericPart + 1;
        } else {
            $nextNumber = 1;
        }

        $PatientBarcodeCore = 'P' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        $patientBarcodeID = '*' . $PatientBarcodeCore . '*';



        Patient::create([
            'PatientBarcodeID' => $patientBarcodeID,
            'PatientFirstName' => $request->PatientFirstName,
            'PatientLastName' => $request->PatientLastName,
            'PatientDateOfBirth' => $request->PatientDateOfBirth,
            'PatientGender' => $request->PatientGender,
            'PatientContactNumber' => $request->PatientContactNumber,
            'PatientAddress' => $request->PatientAddress,
            'PatientBloodType' => $request->PatientBloodType,
            'PatientAllergies' => $request->PatientAllergies,
            'PatientExistingConditions' => $request->PatientExistingConditions,
            'PatientEmergencyContact' => $request->PatientEmergencyContact,
            'PatientEmergencyPhone' => $request->PatientEmergencyPhone,
            'PatientDateRegistered' => now(),
        ]);

        return redirect()->back()->with('success', 'Patient added successfully with ID: ' . $patientBarcodeID);
    }

    // Show single patient
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('PatientView', compact('patient'));
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
        return view('PatientEdit', compact('patient'));
    }

    // Update patient
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'PatientFirstName' => 'required|string|max:100',
            'PatientLastName' => 'required|string|max:100',
            'PatientDateOfBirth' => 'required|date',
            'PatientGender' => 'required|string',
            'PatientContactNumber' => 'nullable|string|max:20',
            'PatientAddress' => 'nullable|string|max:255',
            'PatientBloodType' => 'nullable|string|max:3',
            'PatientAllergies' => 'nullable|string|max:255',
            'PatientExistingConditions' => 'nullable|string|max:255',
            'PatientEmergencyContact' => 'nullable|string|max:100',
            'PatientEmergencyPhone' => 'nullable|string|max:20',
        ]);

        $patient->update($request->only([
            'PatientFirstName',
            'PatientLastName',
            'PatientDateOfBirth',
            'PatientGender',
            'PatientContactNumber',
            'PatientAddress',
            'PatientBloodType',
            'PatientAllergies',
            'PatientExistingConditions',
            'PatientEmergencyContact',
            'PatientEmergencyPhone',
        ]));

        return redirect()->route('PatientsSection')->with('success', 'Patient updated successfully.');
    }

    //search lets go
    public function searchByBarcode(Request $request)
    {
        $patientBarcodeID = trim($request->input('patientBarcodeID'));

        
        $cleanBarcode = str_replace('*', '', $patientBarcodeID);

        
        if (empty($cleanBarcode)) {
            return redirect()->back()->with('error', 'Please enter a Barcode ID.');
        }

        
        $patient = Patient::where('patientBarcodeID', $cleanBarcode)
            ->orWhere('patientBarcodeID', "*{$cleanBarcode}*")
            ->first();

        
        if ($patient) {
            return redirect()->route('patientShow', ['id' => $patient->PatientID]);
        } else {
            return redirect()->back()->with('error', 'No patient found with that Barcode ID.');
        }
    }


}
