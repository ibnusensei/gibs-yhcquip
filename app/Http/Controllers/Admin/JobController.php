<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;
use Carbon\Carbon;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all();
        return view('admin.job.index', compact('jobs'));
    }

    public function publish($id)
    {
        $job = Job::find($id);
        $job->is_published = !$job->is_published;
        $job->save();

        if ($job->is_published) {
            toast('Item has been published', 'success');
        } else {
            toast('Item has been published', 'info');
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.job.store');
        return view('admin.job.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'string|nullable',
            'posisi' => 'string|required',
            'unit' => 'string|required',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',
        ]);

        $data['slug'] = Str::slug($request->posisi);
        $data['posisi'] = $request->posisi;
        $data['unit'] = $request->unit;
        $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date']);
        $data['end_date'] = Carbon::createFromFormat('d/m/Y', $data['end_date']);
        $job = Job::create($data);

        if ($request->hasFile('image')) {
            $job->addMediaFromRequest('image')->toMediaCollection('image');
        }

        toast('Your job has been submitted!', 'success');
        return redirect()->route('admin.job.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $job = Job::findOrFail($id);
        return view('admin.job.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $job = Job::findOrFail($id);
        $url = route('admin.job.update', $job->id);
        return view('admin.job.form', compact('job', 'url'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $job = Job::findOrFail($id);
        $data = $request->validate([
            'description' => 'string|nullable',
            'posisi' => 'string|required',
            'unit' => 'string|required',
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y',
        ]);

        $data['slug'] = Str::slug($request->posisi);
        $data['posisi'] = $request->posisi;
        $data['unit'] = $request->unit;
        $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date']);
        $data['end_date'] = Carbon::createFromFormat('d/m/Y', $data['end_date']);
        $job->update($data);

        if ($request->hasFile('image')) { // check if a new image has been uploaded
            if ($job->hasMedia('image')) { // check if an existing image exists
                $job->getFirstMedia('image')->delete(); // delete the existing image
            }
            $job->addMediaFromRequest('image')->toMediaCollection('image'); // add the new image
        } else if ($request->input('delete_image')) { // check if the delete image checkbox is checked
            $job->clearMediaCollection('image'); // delete the existing image
        }

        toast('Your job has been updated!','success');
        return redirect()->route('admin.job.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        toast('Your job has been deleted!', 'success');
        return redirect()->route('admin.job.index');
    }
}
