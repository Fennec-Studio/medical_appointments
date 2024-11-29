<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        foreach ($patients as $patient) {
            $medical_history = MedicalHistory::where('patient_id', $patient->id)->first();
            $patient->medical_history = $medical_history;
        }

        return response()->json($patients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $patient = new Patient();
        $patient->curp = $request->curp;
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->birthdate = $request->birthdate;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->address = $request->address;
        $patient->save();

        return response()->json($patient);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        $medical_history = MedicalHistory::where('patient_id', $patient->id)->first();
        $patient->medical_history = $medical_history;

        return response()->json($patient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient->curp = $request->curp;
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->birthdate = $request->birthdate;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->address = $request->address;
        $patient->save();

        return response()->json($patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();

        return response()->json(null, 204);
    }

    /**
     * Display the specified resource.
     */
    public function showMedicalHistory($id)
    {
        $medical_history = MedicalHistory::where('patient_id', $id)->first();

        return response()->json($medical_history);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateMedicalHistory(Request $request, $id)
    {
        $medical_history = MedicalHistory::where('patient_id', $id)->first();
        if (!$medical_history) {
            $medical_history = new MedicalHistory();
            $medical_history->patient_id = $id;
        }
        $medical_history->age = $request->age;
        $medical_history->gender = $request->gender;
        $medical_history->height = $request->height;
        $medical_history->weight = $request->weight;
        $medical_history->blood_type = $request->blood_type;
        $medical_history->allergies = $request->allergies;
        $medical_history->medications = $request->medications;
        $medical_history->save();

        return response()->json($medical_history);
    }
}
