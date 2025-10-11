<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Patient;

class DoctorController extends Controller
{
    
  public function showAllDoctors()
  {
      
    $doctors = Doctor::all();

    
    return view('DoctorSection', compact('doctors'));
  }

  
  public function storeDoctor(Request $request)
  {
      
    $request->validate([
        'DoctorFirstName' => 'required|string|max:100',
        'DoctorLastName' => 'required|string|max:100',
        'DoctorSpecialization' => 'required|string|max:100',
        'DoctorContactNumber' => 'nullable|string|max:20',
        'DoctorEmail' => 'nullable|email|max:150',
        'DoctorAddress' => 'nullable|string|max:255',
        'DoctorAvailability' => 'nullable|string|max:100',
    ]);

    
    $existingDoctor = Doctor::whereRaw('LOWER(DoctorFirstName) = ?', [strtolower($request->DoctorFirstName)])
        ->whereRaw('LOWER(DoctorLastName) = ?', [strtolower($request->DoctorLastName)])
        ->first();

    if ($existingDoctor) {
        return redirect()->back()->with('error', 'Doctor already exists in the system!');
    }

    
    $lastDoctor = Doctor::orderBy('DoctorID', 'desc')->first();
    $nextNumber = $lastDoctor ? intval(substr($lastDoctor->DoctorBarcode, 2, 5)) + 1 : 1;
    $DoctorBarcode = '*' . 'D' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT) . '*';

    
    Doctor::create([
        'DoctorBarcode' => $DoctorBarcode,
        'DoctorFirstName' => $request->DoctorFirstName,
        'DoctorLastName' => $request->DoctorLastName,
        'DoctorSpecialization' => $request->DoctorSpecialization,
        'DoctorAvailability' => $request->DoctorAvailability,
        'DoctorContactNumber' => $request->DoctorContactNumber,
        'DoctorEmail' => $request->DoctorEmail,
        'DoctorAddress' => $request->DoctorAddress,
        'DoctorDateRegistered' => now(),
    ]);

    
    return redirect()->back()->with('success', 'Doctor added successfully with ID: ' . $DoctorBarcode);
  }

  
  public function showDoctor($id)
  {
      
    $doctor = Doctor::findOrFail($id);

    
    return view('doctorView', compact('doctor'));
  }

  
  public function deleteDoctor($id)
  {
    $doctor = Doctor::findOrFail($id);
    $doctor->delete();

    
    return redirect()->route('DoctorSection')->with('success', 'Doctor deleted successfully!');
  }

  
  public function editDoctor($id)
  {
    $doctor = Doctor::findOrFail($id);

    
    return view('doctorEdit', compact('doctor'));
  }

  
  public function updateDoctor(Request $request, $id)
  {
    $doctor = Doctor::findOrFail($id);

    
    $request->validate([
        'DoctorFirstName' => 'required|string|max:100',
        'DoctorLastName' => 'required|string|max:100',
        'DoctorSpecialization' => 'required|string|max:100',
        'DoctorContactNumber' => 'nullable|string|max:20',
        'DoctorEmail' => 'nullable|email|max:150',
        'DoctorAddress' => 'nullable|string|max:255',
        'DoctorAvailability' => 'nullable|string|max:100',
    ]);

    
    $doctor->update($request->only([
        'DoctorFirstName',
        'DoctorLastName',
        'DoctorSpecialization',
        'DoctorContactNumber',
        'DoctorEmail',
        'DoctorAddress',
        'DoctorAvailability',
    ]));

    
    return redirect()->route('DoctorSection')->with('success', 'Doctor updated successfully!');
  }
}
