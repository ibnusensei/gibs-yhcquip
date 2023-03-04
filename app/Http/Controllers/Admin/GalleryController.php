<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // data gallery
        $galleries = Gallery::all();
        // return response()->json($galleries);
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.gallery.store');
        return view('admin.gallery.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'string|required',
            'description' => 'string|nullable'
        ]);

        $data['slug'] = Str::slug($request->name);
        $gallery = Gallery::create($data);

        // image

        toast('Your Gallery as been submited!','success');
        return redirect()->route('admin.gallery.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        $url = route('admin.gallery.update', $gallery);
        // $data = [
        //     'gallery' => Gallery::findOrFail($id),
        //     'url' => route('admin.gallery.update', $gallery)
        // ];
        return view('admin.gallery.form', compact('url', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $gallery = Gallery::findOrFail($id);
        $data = $request->validate([
            'name' => 'string|required',
            'description' => 'string|nullable'
        ]);

        $data['slug'] = Str::slug($request->name);
        $gallery->update($data);

        return redirect()->route('admin.gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index');

    }
}
