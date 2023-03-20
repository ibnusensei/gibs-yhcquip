<?php

namespace App\Http\Controllers\Admin\Program;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Excul;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\DB;


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

    }

    public function publish($id)
    {
        $excul = Excul::findOrFail($id);
        $excul->is_published = !$excul->is_published;
        $excul->save();

        if($excul->is_published == 1 ){
            toast('Your Excule has been published!','success');
        }
        else {
            toast('Your Excule was unpublished!','success');
        }
        return redirect()->back();
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

        try {

            DB::beginTransaction();

            $data = $request->validate([
                'name' => 'string|required',
                'description' => 'string|nullable'
            ]);

            $data['slug'] = Str::slug($request->name);
            $data['user_id'] = Auth()->user()->id;
            $exculs = Excul::create($data);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }

        toast('Your excul has been created!','success');
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
        return view('admin.program.excul.form', compact('url', 'exculs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        try {

            DB::beginTransaction();
            $exculs = Excul::findOrFail($id);
            $data = $request->validate([
                'name' => 'string|required',
                'description' => 'string|nullable'
            ]);

            $data['slug'] = Str::slug($request->name);
            $data['user_id'] = Auth()->user()->id;
            $exculs->update($data);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }

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
