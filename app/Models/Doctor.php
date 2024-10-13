<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'speciality_id',
        'room',
        'email',
        'password',
        'phone',
        'license',
    ];
}