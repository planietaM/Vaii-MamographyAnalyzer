<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserAdminController extends Controller
{
    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        // Validate common fields; role is not allowed to be changed via this endpoint
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable','string','max:255'],
            'email' => ['required','email', Rule::unique('users','email')->ignore($user->id)],
            'phone' => ['nullable','string','max:50'],
            // role intentionally OPTIONAL and will be ignored to prevent accidental changes
            'role' => ['sometimes', Rule::in(['admin','doctor','patient'])],
            // dikter_id only validated if present in the payload (and uniqueness ignored for current user)
            'dikter_id' => ['nullable','string','max:20', Rule::unique('users','dikter_id')->ignore($user->id)],
            // national_id only validated if present
            'national_id' => ['nullable','string','max:20', Rule::unique('users','national_id')->ignore($user->id)],
        ]);

        // Ensure role cannot be changed through this endpoint: keep existing role
        if (isset($data['role'])) {
            unset($data['role']);
        }

        // If dikter_id is provided but the user's role is not doctor, reject it
        if (array_key_exists('dikter_id', $data) && $data['dikter_id'] !== null && $user->role !== 'doctor') {
            // prevent assigning a dokter id to non-doctor via admin update endpoint
            return response()->json(['message' => 'Only users with role "doctor" may have a dikter_id'], 422);
        }

        // If national_id provided but user's role is not patient, reject it
        if (array_key_exists('national_id', $data) && $data['national_id'] !== null && $user->role !== 'patient') {
            return response()->json(['message' => 'Only users with role "patient" may have a national_id'], 422);
        }

        // Fill and save allowed attributes only
        $user->fill($data);
        $user->save();

        return response()->json(['message' => 'User updated', 'user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
