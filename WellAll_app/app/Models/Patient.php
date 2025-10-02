<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $timestamps = false;
    protected $table = 'patient_table';
    protected $primaryKey = 'PatientID';

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
        'DateRegistered'
    ];
}
