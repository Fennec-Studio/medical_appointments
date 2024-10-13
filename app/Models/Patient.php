<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'curp',
        'first_name',
        'last_name',
        'birthdate',
        'email',
        'phone',
        'address'
    ];


    public function medicalHistory()
    {
        return $this->hasOne(MedicalHistory::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
