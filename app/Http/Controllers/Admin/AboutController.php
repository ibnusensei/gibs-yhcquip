<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::all();
        return view('admin.about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.about.store');
        return view('admin.about.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'string|nullable',
        ]); 
        $data['slug'] = Str::slug($request->title);
        $about = About::create($data);

        toast('Created About Successfully', 'success');
        return redirect()->route('admin.about.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $about = About::findOrFail($id);
        return view('admin.about.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $about = About::findOrFail($id);
        $url = route('admin.about.update', $about);
        return view('admin.about.form', compact('url', 'about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $about = About::findOrFail($id);
        $data = $request->validate([
            'title' =>  'required|string',
            'description' => 'string|nullable'
        ]);
        $data['slug'] = Str::slug($request->name);
        $about->update($data);

        toast('Update About Succesfully', 'success');

        return redirect()->route('admin.about.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $about->delete();
        toast('Delete About Successfully', 'success');
        return redirect()->route('admin.about.index');
    }

    public function imageStore(Request $request, $id)
    {
        $gallery = About::findOrFail($id);

        if ($request->has('images')) {
            $gallery->addMultipleMediaFromRequest(['images'])
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
