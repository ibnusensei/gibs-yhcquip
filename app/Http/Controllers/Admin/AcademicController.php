<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $academics = Academic::latest()->filter(request(['search']))->paginate(5)->withQueryString('search');

            // data gallery
        // $academics = Academic::all();
        // return response()->json($galleries);
        return view('admin.academic.index', compact('academics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.academic.store');
        return view('admin.academic.form', compact('url'));
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
        $data['is_published'] = $request->has('is_published') ? true : false;
        $academic = Academic::create($data);

        // image
        if($request->hasFile('image')){
            $academic->addMediaFromRequest('image')->toMediaCollection('image');
        }

        toast('Your Academic as been submited!','success');
        return redirect()->route('admin.academic.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $academic = Academic::findOrFail($id);
        return view('admin.academic.show', compact('academic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $academic = Academic::findOrFail($id);
        $url = route('admin.academic.update', $academic);
        // $data = [
        //     'academic' => Academic::findOrFail($id),
        //     'url' => route('admin.academic.update', $academic)
        // ];
        return view('admin.academic.form', compact('url', 'academic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $academic = Academic::findOrFail($id);
        $data = $request->validate([
            'name' => 'string|required',
            'description' => 'string|nullable'
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['is_published'] = $request->has('is_published') ? true : false;
        $academic->update($data);

        if($request->hasFile('image')){
            if($academic->hasMedia('image')){
                $academic->getFirstMedia('image')->delete();
            }
            $academic->addMediaFromRequest('image')->toMediaCollection('image');
        }

        toast('Your Academic has been updated!','success');
        return redirect()->route('admin.academic.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academic $academic)
    {
        $academic->delete();
        return redirect()->route('admin.academic.index');
    }

    public function imageStore(Request $request, $id)
    {
        // dd($request->all());
        $academic = Academic::findOrFail($id);

        if ($request->has('images')) {
            $academic->addMultipleMediaFromRequest(['images'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('images');
            });
        }

        toast('Your Image has been uploaded!','success');
        return redirect()->back();

    }

    public function imageDestroy($image)
    {
        $media = Media::findOrFail($image); 
        $media->delete();

        toast('Your Image has been deleted', 'success');
        return redirect()->back();
    }

}


