<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ExaminationController extends Controller
{
    public function indexForPatient(User $patient)
    {
        $exams = Examination::with('doctor')
            ->where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Map to include doctor's name and photo_url is appended by the model
        $mapped = $exams->map(function ($e) {
            return [
                'id' => $e->id,
                'created_at' => $e->created_at,
                'result' => $e->result,
                'notes' => $e->notes,
                'photo_url' => $e->photo_url,
                'doctor' => $e->doctor ? [ 'id' => $e->doctor->id, 'name' => $e->doctor->name, 'surname' => $e->doctor->surname ] : null,
            ];
        });

        return response()->json($mapped);
    }

    public function indexForDoctor(User $doctor)
    {
        $exams = Examination::with('patient')
            ->where('doctor_id', $doctor->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $mapped = $exams->map(function ($e) {
            return [
                'id' => $e->id,
                'created_at' => $e->created_at,
                'result' => $e->result,
                'notes' => $e->notes,
                'photo_url' => $e->photo_url,
                'patient' => $e->patient ? [ 'id' => $e->patient->id, 'name' => $e->patient->name, 'surname' => $e->patient->surname ] : null,
            ];
        });

        return response()->json($mapped);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'photo' => ['required', 'file', 'image', 'max:5120'], // max 5MB
            'result' => ['required', Rule::in(['positive','negative'])],
            'notes' => ['nullable','string'],
        ]);

        // take doctor_id from authenticated user if available, else from request
        $doctorId = $request->user()->id ?? $request->input('doctor_id');

        if (! $doctorId) {
            return response()->json(['message' => 'Doctor not identified'], 422);
        }

        $path = $request->file('photo')->store('examinations', 'public');

        $exam = Examination::create([
            'doctor_id' => $doctorId,
            'patient_id' => $data['patient_id'],
            'photo' => $path,
            'result' => $data['result'],
            'notes' => $data['notes'] ?? null,
        ]);

        return response()->json(['message' => 'Examination created', 'examination' => $exam], 201);
    }

    public function update(Request $request, Examination $examination)
    {
        $this->authorize('update', $examination);

        $data = $request->validate([
            'photo' => ['nullable', 'file', 'image', 'max:5120'],
            'result' => [ 'nullable', Rule::in(['positive','negative'])],
            'notes' => ['nullable','string'],
        ]);

        if ($request->hasFile('photo')) {
            // delete old
            if ($examination->photo) {
                Storage::disk('public')->delete($examination->photo);
            }
            $examination->photo = $request->file('photo')->store('examinations', 'public');
        }

        if (isset($data['result'])) {
            $examination->result = $data['result'];
        }
        if (isset($data['notes'])) {
            $examination->notes = $data['notes'];
        }

        $examination->save();

        return response()->json(['message' => 'Examination updated', 'examination' => $examination]);
    }

    public function show(Examination $examination)
    {
        return response()->json($examination);
    }

    public function destroy(Examination $examination)
    {
        $this->authorize('delete', $examination);
        if ($examination->photo) {
            Storage::disk('public')->delete($examination->photo);
        }
        $examination->delete();
        return response()->json(['message' => 'Examination deleted']);
    }
}
