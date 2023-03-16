<?php

namespace App\Http\Controllers\Admin\Program;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Streams;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class StreamsController extends Controller
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
        $streams = Streams::with('user')->latest()->filter(request())->paginate(3);

        // return $books;

        $data = [
            'streams' => $streams,
            'users' => $this->users,
        ];

        return view('admin.program.streams.index', $data);
        // data gallery
        // $streams = Streams::all();
        // return response()->json($galleries);
        // return view('admin.program.streams.index', compact('streams'))->with('user');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.streams.store');
        return view('admin.program.streams.form', compact('url'));
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
        $streams = Streams::create($data);

        // if ($request->has('images')) {
        //     $streams->addMediaFromRequest(['images'])
        //     ->each(function ($fileAdder) {
        //         $fileAdder->toMediaCollection('images');
        //     });
        // }

        // if ($request->hasFile('images')) {
        //     $streams->addMediaFromRequest('images')->toMediaCollection('images');
        // }

        // image

        toast('Your Streams has been submited!','success');
        return redirect()->route('admin.streams.index');
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $streams = Streams::findOrFail($id);
        return view('admin.program.streams.show', compact('streams'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $streams = Streams::findOrFail($id);
        $url = route('admin.streams.update', $streams);
        // $data = [
        //     'gallery' => Gallery::findOrFail($id),
        //     'url' => route('admin.gallery.update', $gallery)
        // ];
        return view('admin.program.streams.form', compact('url', 'streams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $streams = Streams::findOrFail($id);
        $data = $request->validate([
            'name' => 'string|required',
            'description' => 'string|nullable'
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['user_id'] = Auth()->user()->id;
        $streams->update($data);

        // if ($request->hasFile('images')) { // check if a new image has been uploaded
        //     if ($streams->hasMedia('images')) { // check if an existing image exists
        //         $streams->getFirstMedia('images')->delete(); // delete the existing image
        //     }
        //     $streams->addMediaFromRequest('images')->toMediaCollection('images'); // add the new image
        // } else if ($request->input('delete_images')) { // check if the delete image checkbox is checked
        //     $streams->clearMediaCollection('images'); // delete the existing image
        // }

        toast('Your Streams has been updated!','success');
        return redirect()->route('admin.streams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Streams $stream)
    {
        // Streams::destroy($streams);
        $stream->delete();
        toast('Your streams has been deleted', 'success');
        return redirect()->route('admin.streams.index');

    }

    public function imageStore(Request $request, $id)
    {
        // dd($request->all());
        $streams = Streams::findOrFail($id);

        if ($request->has('images')) {
            $streams->addMultipleMediaFromRequest(['images'])
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
