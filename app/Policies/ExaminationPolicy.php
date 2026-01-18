<?php

namespace App\Policies;

use App\Models\Examination;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExaminationPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Examination $examination)
    {
        // allow if user is the doctor who created the exam or is admin
        return $user->id === $examination->doctor_id || $user->role === 'admin';
    }

    public function delete(User $user, Examination $examination)
    {
        return $user->id === $examination->doctor_id || $user->role === 'admin';
    }
}

