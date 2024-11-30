<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Speciality;

class DoctorController extends Controller
{
    public function index() {
        $doctors = Doctor::all();
        foreach ($doctors as $doctor) {
            $speciality = Speciality::find($doctor->speciality_id);
            $doctor->speciality = $speciality->name;

            $schedule = [];
            for ($i = 8; $i < 18; $i++) {
                $time = $i < 10 ? '0'.$i.':00' : $i.':00';
                $available = rand(0, 1) == 1 ? true : false;
                $schedule[] = [
                    'time' => $time,
                    'available' => $available
                ];
            }
            $doctor->schedule = $schedule;
        }
        return response()->json($doctors);
    }

    public function show($id) {
        $doctor = Doctor::find($id);
        $speciality = Speciality::find($doctor->speciality_id);
        $doctor->speciality = $speciality->name;
        return response()->json($doctor);
    }

    public function store(Request $request) {
        $doctor = new Doctor();
        $doctor->first_name = $request->first_name;
        $doctor->last_name = $request->last_name;
        $doctor->speciality_id = $request->speciality_id;
        $doctor->room = $request->room;
        $doctor->email = $request->email;
        $doctor->password = $request->password;
        $doctor->phone = $request->phone;
        $doctor->license = $request->license;
        $doctor->save();
        return response()->json($doctor);
    }

    public function update(Request $request, $id) {
        $doctor = Doctor::find($id);
        $doctor->first_name = $request->first_name;
        $doctor->last_name = $request->last_name;
        $doctor->speciality_id = $request->speciality_id;
        $doctor->room = $request->room;
        $doctor->email = $request->email;
        $doctor->password = $request->password;
        $doctor->phone = $request->phone;
        $doctor->license = $request->license;
        $doctor->save();
        return response()->json($doctor);
    }

    public function destroy($id) {
        $doctor = Doctor::find($id);
        $doctor->delete();
        return response()->json($doctor);
    }

    public function search($name, $speciality) {
        if ($speciality == 0) {
            if ($name == null) {
                $doctors = Doctor::all()->sortBy('first_name');
                foreach ($doctors as $doctor) {
                    $speciality = Speciality::find($doctor->speciality_id);
                    $doctor->speciality = $speciality->name;
                }
                return response()->json($doctors);
            } else {
                $doctors = Doctor::where('first_name', 'like', '%'.$name.'%')->get();
                $doctors = $doctors->sortBy(function($doctor) use ($name) {
                    return strpos($doctor->first_name, $name);
                });
                foreach ($doctors as $doctor) {
                    $speciality = Speciality::find($doctor->speciality_id);
                    $doctor->speciality = $speciality->name;
                }
                return response()->json($doctors);
            }
        } else {
            if ($name == null) {
                $doctors = Doctor::where('speciality_id', $speciality)->get();
                $doctors = $doctors->sortBy('first_name');
                foreach ($doctors as $doctor) {
                    $speciality = Speciality::find($doctor->speciality_id);
                    $doctor->speciality = $speciality->name;
                }
                return response()->json($doctors);
            } else {
                $doctors = Doctor::where('speciality_id', $speciality)->where('first_name', 'like', '%'.$name.'%')->get();
                $doctors = $doctors->sortBy(function($doctor) use ($name) {
                    return strpos($doctor->first_name, $name);
                });
                foreach ($doctors as $doctor) {
                    $speciality = Speciality::find($doctor->speciality_id);
                    $doctor->speciality = $speciality->name;
                }
                return response()->json($doctors);
            }
        }
    }

}
