<?php

namespace App\Http\Controllers\Admin\Program;

use App\Http\Controllers\Controller;
use App\Http\Requests\AchievementRequest;
use App\Models\Achievement;
use App\Models\Gainer;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\DB;



class AchievementController extends Controller
{
    public $levels;
    public $users;

    public function __construct() {
        $this->levels = Level::all();
        $this->users = User::all();

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::with('level','user')->latest()->filter(request())->paginate(10);
        $gainers = Gainer::all();

        // return $books;

        $data = [
            'achievements' => $achievements,
            'gainers' => $gainers,
            'levels' => $this->levels,
            'users' => $this->users,
        ];

        return view('admin.program.achievement.index', $data);
    }

    public function publish($id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement->is_published = !$achievement->is_published;
        $achievement->save();

        if($achievement->is_published == 1 ){
            toast('Your Achievement has been published!','success');
        }
        else {
            toast('Your Achievement was unpublished!','success');
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'url' => route('admin.achievement.store'),
            'levels' => $this->levels,
        ];
        return view('admin.program.achievement.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            DB::beginTransaction();

            $data = $request->all();
            $data['slug'] = Str::slug($request->title);
            $data['user_id'] = Auth()->user()->id;
            $achievement = Achievement::create($data);

             // image
        if($request->hasFile('images')){
            $achievement->addMediaFromRequest('images')->toMediaCollection('images');
        }

            if ($request->name) {
                foreach ($data['name'] as $item => $value) {
                    $data2 = array(
                        'achievement_id' => $achievement->id,
                        'name' => $data['name'][$item],
                        'from' => $data['from'][$item],
                    );
                    Gainer::create($data2);
                };
            };



            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }

        //return succes
        toast('Your Achievement has been created!','success');
        return to_route('admin.achievement.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement = Achievement::where('id', $id)->first();
        return view('admin.program.achievement.show', compact('achievement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $achievement = Achievement::findOrFail($id);
        $url = route('admin.achievement.update', $achievement->id);
        $levels = Level::all();

        return view('admin.program.achievement.update', compact('achievement', 'levels', 'url'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            DB::beginTransaction();

            $achievement = Achievement::with('gainer')->find($id);
            Gainer::where('achievement_id', $id)->delete();

            $data = $request->all();
            $data['levels'] = Level::All();
            $data['slug'] = Str::slug($request->title);
            $data['user_id'] = Auth()->user()->id;

            $achievement->update($data);

            if($request->hasFile('images')){
                if($achievement->hasMedia('images')){
                    $achievement->getFirstMedia('images')->delete();
                }
                $achievement->addMediaFromRequest('images')->toMediaCollection('images');
            }

            if ($request->name) {
                foreach ($data['name'] as $item => $value) {
                    $data2 = array(
                        'achievement_id' => $achievement->id,
                        'name' => $data['name'][$item],
                        'from' => $data['from'][$item],
                    );
                    Gainer::create($data2);
                };
            };

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }

        // return success
        toast('Your Achievement has been updated!','success');
        return to_route('admin.achievement.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gainer::where('achievement_id', $id)->delete();
        Achievement::destroy($id);

        toast('Your Achievement has been deleted!','success');
        return back();
    }

    public function imageStore(Request $request, $id)
    {
        // dd($request->all());
        $achievement = Achievement::findOrFail($id);

        if ($request->has('images')) {
            $achievement->addMultipleMediaFromRequest(['images'])
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
