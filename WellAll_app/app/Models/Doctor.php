<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
  use HasFactory;

  protected $table = 'doctor_table';
  protected $primaryKey = 'DoctorID';
  public $timestamps = false;

  protected $fillable = [
      'DoctorCode',
      'FirstName',
      'LastName',
      'Specialization',
      'ContactNumber',
      'Email',
      'Address',
      'DateRegistered'
  ];
}