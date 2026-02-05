<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use App\Http\Requests\WebinarRequest;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    public function index()
    {
        // return JSON list for admin panel listing or a blade view if needed
        $webinars = Webinar::orderBy('date', 'asc')->get();
        return response()->json($webinars);
    }

    public function show(Webinar $webinar)
    {
        return response()->json($webinar);
    }

    public function store(WebinarRequest $request)
    {
        $data = $request->validated();
        $webinar = Webinar::create($data);
        return response()->json(['message' => 'Webinár vytvorený', 'webinar' => $webinar], 201);
    }

    public function update(WebinarRequest $request, Webinar $webinar)
    {
        $data = $request->validated();
        $webinar->update($data);
        return response()->json(['message' => 'Webinár aktualizovaný', 'webinar' => $webinar]);
    }

    public function destroy(Request $request, Webinar $webinar)
    {
        $webinar->delete();
        return response()->json(['message' => 'Webinár vymazaný']);
    }
}
