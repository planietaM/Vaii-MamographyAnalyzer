<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    public function index(Request $request)
    {
        // načítame používateľov podľa role
        $admins = User::where('role', 'admin')->orderBy('id')->get();
        $doctors = User::where('role', 'doctor')->orderBy('id')->get();
        $patients = User::where('role', 'patient')->orderBy('id')->get();

        return view('users_list', [
            'admins' => $admins,
            'doctors' => $doctors,
            'patients' => $patients,
        ]);
    }
}

