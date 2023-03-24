<?php

namespace App\Http\Controllers\Admin\Program;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Streams;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\DB;


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
    }


    public function publish($id)
    {
        $stream = Streams::findOrFail($id);
        $stream->is_published = !$stream->is_published;
        $stream->save();

        if($stream->is_published == 1 ){
            toast('Your Stream has been published!','success');
        }
        else {
            toast('Your Stream was unpublished!','success');
        }
        return redirect()->back();
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

        try {

            DB::beginTransaction();

            $data = $request->validate([
                'name' => 'string|required',
                'description' => 'string|nullable'
            ]);

            $data['slug'] = Str::slug($request->name);
            $data['user_id'] = Auth()->user()->id;
            $streams = Streams::create($data);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }

        toast('Your Streams has been created!','success');
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

        return view('admin.program.streams.form', compact('url', 'streams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        try {

            DB::beginTransaction();

            $streams = Streams::findOrFail($id);
            $data = $request->validate([
                'name' => 'string|required',
                'description' => 'string|nullable'
            ]);

            $data['slug'] = Str::slug($request->name);
            $data['user_id'] = Auth()->user()->id;
            $streams->update($data);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }

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
