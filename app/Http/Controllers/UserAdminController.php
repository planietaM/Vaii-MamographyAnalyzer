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
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable','string','max:255'],
            'email' => ['required','email', Rule::unique('users','email')->ignore($user->id)],
            'phone' => ['nullable','string','max:50'],
            'role' => ['sometimes', Rule::in(['admin','doctor','patient'])],
            'dikter_id' => ['nullable','string','max:20', Rule::unique('users','dikter_id')->ignore($user->id)],
            'national_id' => ['nullable','string','max:20', Rule::unique('users','national_id')->ignore($user->id)],
        ]);

        if (array_key_exists('role', $data)) {
            unset($data['role']);
        }

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
