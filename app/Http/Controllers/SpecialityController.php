<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use App\Models\Doctor;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialities = Speciality::all();
        foreach ($specialities as $speciality) {
            $doctors = Doctor::where('speciality_id', $speciality->id)->get();
            $speciality->doctors = count($doctors);
        }
        return response()->json($specialities);
    }

    public function show($id)
    {
        $speciality = Speciality::find($id);
        return response()->json($speciality);
    }

    public function store(Request $request)
    {
        $speciality = new Speciality();
        $speciality->name = $request->name;
        $speciality->save();
        return response()->json($speciality);
    }

    public function update(Request $request, $id)
    {
        $speciality = Speciality::find($id);
        $speciality->name = $request->name;
        $speciality->save();
        return response()->json($speciality);
    }

    public function destroy($id)
    {
        $speciality = Speciality::find($id);
        $speciality->delete();
        return response()->json($speciality);
    }

    public function getCountDoctors($id) {
        $speciality = Speciality::find($id);
        $doctors = Doctor::where('speciality_id', $speciality->id)->get();
        return response()->json(count($doctors));
    }
}
