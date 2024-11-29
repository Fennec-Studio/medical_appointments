<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use Illuminate\Http\Request;

class MedicalHistoryController extends Controller
{
    public function index() {
        $medicalHistories = MedicalHistory::all();
        return response()->json($medicalHistories);
    }

    public function store(Request $request) {
        $medicalHistory = MedicalHistory::create($request->all());
        return response()->json($medicalHistory);
    }

    public function show($id) {
        $medicalHistory = MedicalHistory::find($id);
        return response()->json($medicalHistory);
    }

    public function update(Request $request, $id) {
        $medicalHistory = MedicalHistory::find($id);
        $medicalHistory->update($request->all());
        return response()->json($medicalHistory);
    }

    public function destroy($id) {
        $medicalHistory = MedicalHistory::find($id);
        $medicalHistory->delete();
        return response()->json(['message' => 'Medical history deleted']);
    }

    public function showByPatient($patient_id) {
        $medicalHistories = MedicalHistory::where('patient_id', $patient_id)->get();
        return response()->json($medicalHistories);
    }
}
