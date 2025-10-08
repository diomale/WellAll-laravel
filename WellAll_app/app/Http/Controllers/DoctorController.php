<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;

class DoctorController extends Controller
{
  public function index()
  {
    $doctors = Doctor::all();
    return view('doctor', compact('doctors'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'FirstName' => 'required',
      'LastName' => 'required',
    ]);

    //check if doctor with same name exists
    $existingDoctor = Doctor::whereRaw('LOWER(FirstName) = ?', [strtolower($request->FirstName)])
    ->whereRaw('LOWER(LastName) = ?', [strtolower($request->LastName)])
    ->first();
    if ($existingDoctor) {
      return redirect()->back()->with('error', 'Doctor already exists in the system!');
    }

    $existingPatient = Patient::where('FirstName', $request->FirstName)
    ->where('LastName', $request->LastName)
    ->first();
    
    //check if patient with same name exists
    if ($existingPatient) {
      return redirect()->back()->with('error', 'A patient with the same name already exists in the system!');
    }

    $lastDoctor = Doctor::orderBy('DoctorID', 'desc')->first();
    $nextNumber = $lastDoctor ? intval(substr($lastDoctor->DoctorCode, 1)) + 1 : 1;
    $doctorCode = '*' . 'D' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT) . '*';

    Doctor::create([
      'DoctorCode' => $doctorCode,
      'FirstName' => $request->FirstName,
      'LastName' => $request->LastName,
      'Specialization' => $request->Specialization,
      'ContactNumber' => $request->ContactNumber,
      'Email' => $request->Email,
      'Address' => $request->Address,
      'DateRegistered' => now()
    ]);

    return redirect()->route('doctors.index')->with('success', 'Doctor added successfully!');
  }

  public function show($id)
  {
    $doctor = Doctor::findOrFail($id);
    return view('viewdoctor', compact('doctor'));
  }

  public function destroy($id)
  {
    $doctor = Doctor::findOrFail($id);
    $doctor->delete();

    return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully!');
  }

  public function edit($id)
  {
    $doctor = Doctor::findOrFail($id);
    return view('editdoctor', compact('doctor'));
  }

  public function update(Request $request, $id)
  {
    $doctor = Doctor::findOrFail($id);

    $request->validate([
      'FirstName' => 'required|string|max:100',
      'LastName' => 'required|string|max:100',
      'Specialization' => 'required|string|max:100',
      'ContactNumber' => 'nullable|string|max:255',
      'Email' => 'nullable|string|max:155',
      'Address' => 'nullable|string|max:255',
    ]);

    $doctor->update($request->only([
      'FirstName',
      'LastName',
      'Specialization',
      'ContactNumber',
      'Email',
      'Address',
    ]));
    return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully!');
  }
}
