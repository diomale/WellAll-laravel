<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments_table';
    protected $primaryKey = 'AppointmentID';
    public $timestamps = false;

    protected $fillable = [
        'AppointmentBarcodeID',
        'PatientID',
        'DoctorID',
        'AppointmentDate',
        'AppointmentTime',
        'Reason',
        'DateCreated',
    ];

    
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PatientID');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'DoctorID');
    }
}
