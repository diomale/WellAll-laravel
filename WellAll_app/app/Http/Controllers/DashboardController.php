<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Queue;
use App\Models\CheckIn;


class DashboardController extends Controller
{
  public function index()
{
    $totalPatients = \App\Models\Patient::count();
    $appointmentsToday = \App\Models\Appointment::whereDate('AppointmentDate', now()->toDateString())->count();
    $totalDoctors = \App\Models\Doctor::count();
    $activeQueues = \App\Models\Queue::where('Status', '!=', 'Completed')->count();

    return view('dashboard', compact('totalPatients', 'appointmentsToday', 'totalDoctors', 'activeQueues'));
}
}