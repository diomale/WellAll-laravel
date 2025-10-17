<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $table = 'queue_table';
    protected $primaryKey = 'QueueID';
    public $timestamps = false;

    protected $fillable = [
        'AppointmentID',
        'DoctorID',
        'PatientID',
        'QueueNumber',
        'Status',
        'TimeAdded',
    ];

    
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'AppointmentID');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'DoctorID');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PatientID');
    }
}
