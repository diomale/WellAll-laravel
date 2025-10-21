<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $table = 'medical_records_table';
    protected $primaryKey = 'medicalID'; // ✅ Correct primary key name
    public $timestamps = false; // ✅ because your table doesn’t have created_at/updated_at columns

    protected $fillable = [
        'PatientID',
        'DoctorID',
        'diagnosis',
        'treatment',
        'prescription',
        'MedicalDateRegistered'
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
