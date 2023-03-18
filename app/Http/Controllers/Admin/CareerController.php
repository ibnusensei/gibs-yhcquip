<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Career;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;
use Carbon\Carbon;



class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $careers = Career::all();
        return view('admin.career.index', compact('careers'));
    }

    public function create()
    {
        $url = route('admin.career.store');
        $jobs = Job::all();
        return view('admin.career.form', compact('url', 'jobs'));
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
            'jobs' => 'nullable|array',
            'jobs.*' => 'integer|exists:jobs,id',
        ]);
    
        $data['slug'] = Str::slug($request->title);
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date']);
    
        $career = Career::create($data);
    
        if ($request->hasFile('image')) {
            $career->addMediaFromRequest('image')->toMediaCollection('image');
        }
    
        if (isset($data['jobs'])) {
            $career->jobs()->sync($data['jobs']);
        }
    
        toast('Your career has been submitted!', 'success');
        return redirect()->route('admin.career.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $career = Career::findOrFail($id);
        return view('admin.career.show', compact('career'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $career = Career::findOrFail($id);
        $url = route('admin.career.update', $career->id);
        $jobs = Job::all();
        return view('admin.career.form', compact('url', 'career', 'jobs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $career = Career::findOrFail($id);
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string|nullable',
            'date' => 'required|date_format:d/m/Y',
            'jobs' => 'nullable|array',
            'jobs.*' => 'integer|exists:jobs,id',
        ]);
    
        $data['slug'] = Str::slug($request->title);
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date']);
    
        $career->update($data);
    
        if ($request->hasFile('image')) {
            $career->addMediaFromRequest('image')->toMediaCollection('image');
        }
    
        if (isset($data['jobs'])) {
            $career->jobs()->sync($data['jobs']);
        }
    
        toast('Your career has been updated!', 'success');
        return redirect()->route('admin.career.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('admin.career.index');
    }
}