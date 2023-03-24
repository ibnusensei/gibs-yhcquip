<?php

namespace App\Http\Controllers\Admin\Program;

use App\Http\Controllers\Controller;
use App\Models\ProgramCategory;
use App\Models\Unggulan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\DB;


class UnggulanController extends Controller
{
    public $program_categories;
    public $users;

    public function __construct() {
        $this->program_categories = ProgramCategory::all();
        $this->users = User::all();

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unggulans = Unggulan::with('program_category','user')->latest()->filter(request())->paginate(3);

        // return $books;

        $data = [
            'unggulans' => $unggulans,
            'program_categories' => $this->program_categories,
            'users' => $this->users,
        ];

        return view('admin.program.unggulan.index', $data);
    }

    public function publish($id)
    {
        $unggulan = Unggulan::findOrFail($id);
        $unggulan->is_published = !$unggulan->is_published;
        $unggulan->save();

        if($unggulan->is_published == 1 ){
            toast('Your Program has been published!','success');
        }
        else {
            toast('Your Program was unpublished!','success');
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'url' => route('admin.unggulan.store'),
            'program_categories' => $this->program_categories,

        ];
        return view('admin.program.unggulan.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // insert data

        try {

            DB::beginTransaction();

            $data= $request->validate ([
                'title' => 'string|required',
                'superiority' => 'string|required',
                'program_category_id' => 'required',

            ]);



            $data['slug'] = Str::slug($request->title);
            $data['user_id'] = Auth()->user()->id;

            $unggulan = Unggulan::create($data);

            // image
        if($request->hasFile('images')){
            $unggulan->addMediaFromRequest('images')->toMediaCollection('images');
        }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }


        //return succes
        toast('Your Program has been created!','success');
        return to_route('admin.unggulan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unggulans = Unggulan::findOrFail($id);
        return view('admin.program.unggulan.show', compact('unggulans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unggulan $unggulan)
    {
        $data = [
            'url' => route('admin.unggulan.update', $unggulan->id),
            'program_categories' => ProgramCategory::all(),
            'unggulan' => $unggulan,
        ];
        return view('admin.program.unggulan.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {

            DB::beginTransaction();

            // update data
            $unggulans = Unggulan::findOrFail($id);

            $data= $request->validate ([
                'title' => 'string|required',
                'superiority' => 'string|required',
                'program_category_id' => 'required',
            ]);

            $data['slug'] = Str::slug($request->title);
            $data['user_id'] = Auth()->user()->id;
            $unggulans->update($data);

            if($request->hasFile('images')){
                if($unggulans->hasMedia('images')){
                    $unggulans->getFirstMedia('images')->delete();
                }
                $unggulans->addMediaFromRequest('images')->toMediaCollection('images');
            }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }

        // return success
        toast('Your Program has been updated!','success');
        return to_route('admin.unggulan.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Unggulan::destroy($id);
        toast('Your Program has been deleted!','success');
        return back();
    }

    public function imageStore(Request $request, $id)
    {
        // dd($request->all());
        $unggulan = Unggulan::findOrFail($id);

        if ($request->has('images')) {
            $unggulan->addMultipleMediaFromRequest(['images'])
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


    public function home() {
        return view('pages.welcome');
    }
}
