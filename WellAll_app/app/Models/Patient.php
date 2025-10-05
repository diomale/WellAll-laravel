<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patient_table'; 
    protected $primaryKey = 'PatientID';
    public $timestamps = false; 

    protected $fillable = [
        'BarcodeID',
        'FirstName',
        'LastName',
        'DateOfBirth',
        'Gender',
        'ContactNumber',
        'Address',
        'BloodType',
        'Allergies',
        'ExistingConditions',
        'EmergencyContact',
        'EmergencyPhone',
        'DateRegistered',
    ];
}
