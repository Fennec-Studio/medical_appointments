<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'age',
        'gender',
        'height',
        'weight',
        'blood_type',
        'allergies',
        'medications'
    ];
}
