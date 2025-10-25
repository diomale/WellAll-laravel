<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $table = 'check_in_table';
    protected $primaryKey = 'CheckInID';
    public $timestamps = false;

    protected $fillable = [
        'PatientID',
        'DoctorID',
        'AppointmentID',
        'CheckInTime',
        'CheckInRemarks',
        'CheckInDateCreated',
        'Status'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PatientID');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'DoctorID');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'AppointmentID');
    }
}
