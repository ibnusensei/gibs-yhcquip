<?php

namespace App\Http\Controllers\Admin\Program;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Excul;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ExculController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $users;

    public function __construct() {
        $this->users = User::all();
    }

    public function index()
    {
        // dd($request->all());
        $exculs = Excul::with('user')->latest()->filter(request())->paginate(3);

        // return $books;

        $data = [
            'exculs' => $exculs,
            'users' => $this->users,
        ];

        return view('admin.program.excul.index', $data);
        // data gallery
        // $exculs = Excul::all();
        // return response()->json($galleries);
        // return view('admin.program.excul.index', compact('exculs'))->with('user');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.excul.store');
        return view('admin.program.excul.form', compact('url'));
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
        $data['user_id'] = Auth()->user()->id;
        $exculs = Excul::create($data);

        // if ($request->has('images')) {
        //     $exculs->addMediaFromRequest(['images'])
        //     ->each(function ($fileAdder) {
        //         $fileAdder->toMediaCollection('images');
        //     });
        // }

        // if ($request->hasFile('images')) {
        //     $exculs->addMediaFromRequest('images')->toMediaCollection('images');
        // }

        // image

        toast('Your excul has been submited!','success');
        return redirect()->route('admin.excul.index');
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $exculs = Excul::findOrFail($id);
        return view('admin.program.excul.show', compact('exculs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exculs = Excul::findOrFail($id);
        $url = route('admin.excul.update', $exculs);
        // $data = [
        //     'gallery' => Gallery::findOrFail($id),
        //     'url' => route('admin.gallery.update', $gallery)
        // ];
        return view('admin.program.excul.form', compact('url', 'exculs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $exculs = Excul::findOrFail($id);
        $data = $request->validate([
            'name' => 'string|required',
            'description' => 'string|nullable'
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = Auth()->user()->id;
        $exculs->update($data);

        // if ($request->hasFile('images')) { // check if a new image has been uploaded
        //     if ($exculs->hasMedia('images')) { // check if an existing image exists
        //         $exculs->getFirstMedia('images')->delete(); // delete the existing image
        //     }
        //     $exculs->addMediaFromRequest('images')->toMediaCollection('images'); // add the new image
        // } else if ($request->input('delete_images')) { // check if the delete image checkbox is checked
        //     $exculs->clearMediaCollection('images'); // delete the existing image
        // }

        toast('Your excul has been updated!','success');
        return redirect()->route('admin.excul.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Excul $excul)
    {
        // Excul::destroy($exculs);
        $excul->delete();
        toast('Your excul has been deleted', 'success');
        return redirect()->route('admin.excul.index');

    }

    public function imageStore(Request $request, $id)
    {
        // dd($request->all());
        $exculs = Excul::findOrFail($id);

        if ($request->has('images')) {
            $exculs->addMultipleMediaFromRequest(['images'])
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
