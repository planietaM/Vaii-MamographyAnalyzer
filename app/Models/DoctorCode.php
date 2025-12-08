<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorCode extends Model
{
    protected $table = 'doctor_codes';
    protected $fillable = ['code'];
}

