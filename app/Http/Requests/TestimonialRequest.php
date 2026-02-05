<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize()
    {
        // only admin can manage testimonials
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'text' => 'required|string',
            'image_file' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:5120', // up to 5MB
            'position' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ];
    }
}
