<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;

class QueueController extends Controller
{
  // Show the queue list
  public function showQueue()
  {
      $queues = Queue::with(['patient', 'doctor', 'appointment'])
          ->orderBy('QueueNumber', 'asc')
          ->get();

      return view('QueueSection', compact('queues'));
  }

  // Add an appointment to the queue
  public function addToQueue($appointmentID)
  {
      $appointment = Appointment::findOrFail($appointmentID);

     
      $lastQueue = Queue::where('DoctorID', $appointment->DoctorID)
          ->orderBy('QueueNumber', 'desc')
          ->first();

      $nextQueueNumber = $lastQueue ? $lastQueue->QueueNumber + 1 : 1;

      Queue::create([
          'AppointmentID' => $appointment->AppointmentID,
          'DoctorID' => $appointment->DoctorID,
          'PatientID' => $appointment->PatientID,
          'QueueNumber' => $nextQueueNumber,
          'Status' => 'Waiting',
          'TimeAdded' => now(),
      ]);
  }

    
}
