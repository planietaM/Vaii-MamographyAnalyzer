<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // list for admin (JSON)
    public function index()
    {
        return Testimonial::orderBy('position')->get();
    }

    public function store(TestimonialRequest $req)
    {
        $data = $req->validated();

        // handle uploaded file if present
        if ($req->hasFile('image_file')) {
            $file = $req->file('image_file');
            $contents = base64_encode(file_get_contents($file->getRealPath()));
            $mime = $file->getMimeType();
            $data['image_data'] = "data:{$mime};base64,{$contents}";
        }

        $testimonial = Testimonial::create($data);
        return response()->json($testimonial, 201);
    }

    public function show(Testimonial $testimonial)
    {
        return $testimonial;
    }

    public function update(TestimonialRequest $req, Testimonial $testimonial)
    {
        $data = $req->validated();

        if ($req->hasFile('image_file')) {
            $file = $req->file('image_file');
            $contents = base64_encode(file_get_contents($file->getRealPath()));
            $mime = $file->getMimeType();
            $data['image_data'] = "data:{$mime};base64,{$contents}";
        }

        $testimonial->update($data);
        return response()->json($testimonial);
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
