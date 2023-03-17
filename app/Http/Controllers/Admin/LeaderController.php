<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaders = Leader::all();
        return view('admin.leader.index', compact('leaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url= route('admin.leader.store');
        return view('admin.leader.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
        ]);
        Leader::create($data);
        toast('Create Leader Successfully','success');
        return redirect()->route('admin.leader.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leader = Leader::findOrFail($id);
        return view('admin.leader.show', compact('leader'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leader = Leader::findOrFail($id);
        $url = route('admin.leader.update', $leader);
        return view('admin.leader.form', compact('url', 'leader'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $leader = Leader::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
        ]);
        $leader->update($data);
        toast('Update Leader Successfully', 'success');
        return redirect()->route('admin.leader.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function imageStore(Request $request, $id)
    {
        // dd($request->all());
        $leader = Leader::findOrFail($id);

        if ($request->has('images')) {
            $leader->addMultipleMediaFromRequest(['images'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('images');
            });
        }

        toast('Your Image has been uploaded!','success');
        return redirect()->back();

    }

    public function imageDestroy($id)
    {
        $media = Media::findOrFail($id); 
        $media->delete();

        toast('Your Image has been deleted', 'success');
        return redirect()->back();
    }
}
