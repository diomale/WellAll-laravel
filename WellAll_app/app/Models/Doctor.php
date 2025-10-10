<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
  use HasFactory;

  protected $table = 'doctors_table';
  protected $primaryKey = 'DoctorID';
  public $timestamps = false;

  protected $fillable = [
      'DoctorBarcode',
      'DoctorFirstName',
      'DoctorLastName',
      'Specialization',
      'DoctorContactNumber',
      'DoctorEmail',
      'DoctorAddress',
      'DoctorDateRegistered',
      'DoctorAvailability'
  ];
}