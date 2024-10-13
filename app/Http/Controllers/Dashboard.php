<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $patients = Patient::count();
        $users = User::count();
        $doctors = Doctor::count();
        $specialties = Speciality::count();

        return response()->json([
            'status' => 'success',
            'data' => [
                'patients' => $patients,
                'users' => $users,
                'doctors' => $doctors,
                'specialties' => $specialties
            ],
            'message' => 'Dashboard data retrieved successfully',
            'status_code' => 200
        ]);
    }
}
