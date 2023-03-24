<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampusTour;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampusTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campustours = CampusTour::all();
        return view('admin.campustour.index', compact('campustours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.campustour.store');
        return view('admin.campustour.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'string',
        ]);
        $data['slug'] = Str::slug($request->title);
        $campustour = CampusTour::create($data);
        if ($request->hasFile('image')) {
            $campustour->addMediaFromRequest('image')->toMediaCollection('image');
        }

        

        toast('Create Campustour Successfully', 'success');
        return redirect()->route('admin.campustour.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $campustour = CampusTour::findOrFail($id);
        return view('admin.campustour.show', compact('campustour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $campustour = CampusTour::findOrFail($id);
        $url = route('admin.campustour.update', $campustour);
        return view('admin.campustour.form', compact('url', 'campustour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $campustour = CampusTour::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'string|nullable',
        ]);
        $data['slug'] = Str::slug($request->title);
        if ($request->hasFile('image')) { // check if a new image has been uploaded
            if ($campustour->hasMedia('image')) { // check if an existing image exists
                $campustour->getFirstMedia('image')->delete(); // delete the existing image
            }
            $campustour->addMediaFromRequest('image')->toMediaCollection('image'); // add the new image
        } else if ($request->input('delete_image')) { // check if the delete image checkbox is checked
            $campustour->clearMediaCollection('image'); // delete the existing image
        }

        $campustour->update($data);

        toast('Update Campus Tour Successfully', 'success');
        return redirect()->route('admin.campustour.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampusTour $campustour)
    {
        $campustour->delete();
        alert()->success('SuccessAlert','Delete Campus Tour Successfully');
        return redirect()->route('admin.campustour.index');
    }
}
