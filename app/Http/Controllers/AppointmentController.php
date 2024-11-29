<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index() {
        $appointments = Appointment::orderBy('status')->orderBy('date')->get();
        foreach ($appointments as $appointment) {
            $doctor = Doctor::find($appointment->doctor_id);
            $patient = Patient::find($appointment->patient_id);
            $appointment->doctor = $doctor;
            $appointment->patient = $patient;
        }

        return response()->json($appointments);
    }

    public function store(Request $request) {
        $appointment = Appointment::create($request->all());
        return response()->json($appointment);
    }

    public function show($id) {
        $appointment = Appointment::find($id);
        return response()->json($appointment);
    }

    public function update(Request $request, $id) {
        $appointment = Appointment::find($id);
        $appointment->update($request->all());
        return response()->json($appointment);
    }

    public function destroy($id) {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted']);
    }

    public function updateStatus(Request $request, $id) {
        $appointment = Appointment::find($id);
        $appointment->status = $request->status;
        $appointment->save();
        return response()->json($appointment);
    }
}
