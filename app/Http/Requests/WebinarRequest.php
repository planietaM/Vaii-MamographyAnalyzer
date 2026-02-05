<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebinarRequest extends FormRequest
{
    public function authorize()
    {
        // allow only authenticated admins
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'short_text' => ['required', 'string'],
            'date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:50'],
        ];
    }
}
