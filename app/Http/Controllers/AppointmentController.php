<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // Admin can view all appointments
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return Appointment::all();
        } else {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    }

    // Patients can view their own appointments
    public function patientAppointments()
    {
        $user = Auth::user();
        return Appointment::where('patient_id', $user->id)->get();
    }

    // Doctors can view their own appointments
    public function doctorAppointments()
    {
        $user = Auth::user();
        return Appointment::where('doctor_id', $user->id)->get();
    }

    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'admin' || $appointment->patient_id === $user->id || $appointment->doctor_id === $user->id) {
            return $appointment;
        } else {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'reason' => 'nullable|string',
        ]);

        $user = Auth::user();
        if ($user->role === 'admin' || $user->id == $validated['patient_id']) {
            return Appointment::create($validated);
        } else {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $validated = $request->validate([
            'appointment_date' => 'required|date',
            'reason' => 'nullable|string',
        ]);

        $user = Auth::user();
        if ($user->role === 'admin' || $appointment->patient_id === $user->id || $appointment->doctor_id === $user->id) {
            $appointment->update($validated);
            return $appointment;
        } else {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'admin' || $appointment->patient_id === $user->id || $appointment->doctor_id === $user->id) {
            $appointment->delete();
            return response()->noContent();
        } else {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    }
}
