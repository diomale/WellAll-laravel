<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients_table'; 
    protected $primaryKey = 'PatientID';
    public $timestamps = false; 

    protected $fillable = [
        'PatientBarcodeID',
        'PatientFirstName',
        'PatientLastName',
        'PatientDateOfBirth',
        'PatientGender',
        'PatientContactNumber',
        'PatientAddress',
        'PatientBloodType',
        'PatientAllergies',
        'PatientExistingConditions',
        'PatientEmergencyContact',
        'PatientEmergencyPhone',
        'PatientDateRegistered',
    ];
}
