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
        // if speciality is 0 then search by name only
        // if name is null then search by speciality only
        // if both are not null then search by both
        // if speciality isnt 0, then search all doctors in that speciality and return them ordered by name
        // if name isnt null, then search all doctors with that name and return them ordered by name
        // but order by index of name coincidence in the name of the doctor (the more coincidence, the first)
        // Example: name = "a", speciality = 0
        //          return all doctors ordered by name
        // Example: name = "a", speciality = 1
        //          return all doctors in speciality 1 ordered by name

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
