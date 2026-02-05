<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'text',
        'image_data',
        'position',
    ];

    // return the best available image: image_data (data URL) or image path
    public function getAvatarAttribute()
    {
        if ($this->image_data) return $this->image_data;
        return '/images/profile1.png';
    }
}
