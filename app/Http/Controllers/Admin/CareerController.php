<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.career.store');
        return view('admin.career.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'string|nullable',
            'requirements' => 'string|nullable',
            'posisi' => 'string|required',
            'unit' => 'string|required',
        ]);

        $data['slug'] = Str::slug($request->posisi);
        $data['posisi'] = $request->posisi;
        $data['requirements'] = $request->requirements;
        $data['unit'] = $request->unit;
        $data['information_id'] = $request->information_id;
        $career = Career::create($data);

        if ($request->hasFile('image')) {
            $career->addMediaFromRequest('image')->toMediaCollection('image');
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
        return view('admin.career.form', compact('career', 'url'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string|nullable',
            'posisi' => 'string|required',
            'unit' => 'string|required',
            'date' => 'required|date_format:d/m/Y',
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date']);
        $data['posisi'] = $request->posisi;
        $data['unit'] = $request->unit;
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        $career->delete();
        toast('Your career has been deleted!', 'success');
        return redirect()->route('admin.career.index');
    }

    public function imageStore(Request $request, $id)
    {
        $career = Career::findOrFail($id);

        if ($request->hasFile('image')) {
            $career->addMediaFromRequest('image')->toMediaCollection('image');
        }

        toast('Your Image has been uploaded!', 'success');
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
