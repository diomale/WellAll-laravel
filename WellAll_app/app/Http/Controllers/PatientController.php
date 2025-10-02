<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
  public function showAllPatients()
  {
      $patientData = Patient::all();
      return view('patient', compact('patientData'));
  }

  public function store(Request $request)
  {
    // Validate input
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
    // Get last patient for BarcodeID
    $lastPatient = Patient::orderBy('PatientID', 'desc')->first();
    $nextNumber = $lastPatient ? intval(substr($lastPatient->BarcodeID, 1)) + 1 : 1;

    // Format like P00001
    $barcodeID = 'P' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

    // Create new patient
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

  public function show($id)
  {
    $patient = Patient::findOrFail($id);
    return view('view', compact('patient'));
  }

  public function destroy($id)
  {
    $patient = Patient::findOrFail($id);
    $patient->delete();
    return redirect()->back()->with('success', 'Patient deleted successfully.');
  }

  // Show the edit form
  public function edit($id)
  {
    $patient = Patient::findOrFail($id);
    return view('edit', compact('patient'));
  }

  // Update patient in database
  public function update(Request $request, $id)
  {
    $patient = Patient::findOrFail($id);

    $request->validate([
        'FirstName' => 'required|string|max:255',
        'LastName' => 'required|string|max:255',
        'DateOfBirth' => 'required|date',
        'Gender' => 'required|string',
        'ContactNumber' => 'required|string|max:15',
        'Address' => 'required|string',
        'BloodType' => 'nullable|string',
        'Allergies' => 'nullable|string',
        'ExistingConditions' => 'nullable|string',
        'EmergencyContact' => 'nullable|string',
        'EmergencyPhone' => 'nullable|string|max:15',
    ]);

    $patient->update($request->all());

    return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
  }


}
