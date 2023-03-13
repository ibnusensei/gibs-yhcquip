<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informations = Information::all();
        return view('admin.information.index', compact('informations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.information.store');
        return view('admin.information.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string|nullable',
            'date' => 'required|date_format:d/m/Y',

        ]);

        $data['slug'] = Str::slug($request->title);
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date']);
        $information = Information::create($data);

        if ($request->hasFile('image')) {
            $information->addMediaFromRequest('image')->toMediaCollection('image');
        }

        toast('Your information has been submitted!', 'success');
        return redirect()->route('admin.information.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Information $information)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Information $information)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Information $information)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Information $information)
    {
        //
    }
}
