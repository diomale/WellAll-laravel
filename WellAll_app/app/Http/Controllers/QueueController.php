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

        // Find the last queue number for this doctor
        $lastQueue = Queue::where('DoctorID', $appointment->DoctorID)
            ->orderBy('QueueNumber', 'desc')
            ->first();

        // Generate next queue number
        $nextQueueNumber = $lastQueue ? $lastQueue->QueueNumber + 1 : 1;

        // Create new queue entry
        Queue::create([
            'AppointmentID' => $appointment->AppointmentID,
            'DoctorID' => $appointment->DoctorID,
            'PatientID' => $appointment->PatientID,
            'QueueNumber' => $nextQueueNumber,
            'Status' => 'Waiting',
            'TimeAdded' => now(),
        ]);

        return redirect()->back()->with('success', 'Appointment added to queue successfully!');
    }

    // Manually update the status
    public function updateStatus(Request $request, $id)
    {
        $queue = Queue::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:Waiting,In Progress,Done,Cancelled',
        ]);

        $queue->Status = $request->status;
        $queue->save();

        return redirect()->back()->with('success', 'Queue status updated successfully!');
    }
}
