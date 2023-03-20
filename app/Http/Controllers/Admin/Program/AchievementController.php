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

class AchievementController extends Controller
{
    public $levels;
    public $users;
    // public $gainers;

    public function __construct() {
        $this->levels = Level::all();
        $this->users = User::all();
        // $this->gainers = Gainer::all();

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
        // return $request;
        // insert data
        // $data['achievement_id'] = $request->id;
        // return $achievement_id->id;
        // $data = $request ->validate ([
        //     'achiev' => 'string|required',
        //     'title' => 'string|required',
        //     'location' => 'string|required',
        //     'year' => 'required',
        //     'name' => 'string|required',
        //     'from' => 'string|required',
        //     'level_id' => 'required',

        // ]);


        // $data['slug'] = Str::slug($request->title);
        // $data['user_id'] = Auth()->user()->id;

        // foreach($request->from as $value){
        //   Achievement::create([
        //     'achiev' => $request->achiev,
        //     'title' => $request->title,
        //     'location' => $request->location,
        //     'year' => $request->year,
        //     'name' => $request->name,
        //     'from' => $value,
        //     'level_id' => $request->level_id,
        //     'slug' => Str::slug($request->title),
        //     'user_id' => Auth()->user()->id,
        // ]);
        // }

        // $achievement = Achievement::create($data);

        // return $request->id;
        // return($request);
        // Achievement::create([
        //     'achiev' => $data['achiev'],
        //     'title' => $data['title'],
        //     'location' => $data['location'],
        //     'year' => $data['year'],
        //     'level_id' => $data['level_id'],
        //     'slug' => $data['slug'],
        //     'user_id' => $data['user_id'],
        // ]);

        // $achievement_id = Achievement::latest()->first();
        // $data['achievement_id'] = $achievement_id->id;

        // $gainer = Gainer::create($data);
        // return $achievement_id->id;

        // foreach ($data = $request->name as $value) {
        //     Gainer::create([
        //         'name' => $value,
        //         'from' => $data['from'],
        //         'achievement_id' => $data['achievement_id'],
        //     ]);
        // }

        // for ($i = 1; $i<count($request->name); $i++) {
        //     Gainer::create([
        //         'name' => $request->name[$i],
        //         'from' => $request->from[$i],
        //         'achievement_id' => $achievement_id->id,
        //     ]);
        // }

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = Auth()->user()->id;
        // dd($data);
        // $achievement = new Achievement;
        // $achievement->achiev = $data['achiev'];
        // $achievement->title = $data['title'];
        // $achievement->location = $data['location'];
        // $achievement->year = $data['year'];
        // $achievement->level_id = $data['level_id'];
        // $achievement->slug = $data['slug'];
        // $achievement->user_id = $data['user_id'];
        // $achievement->save();
        $achievement = Achievement::create($data);

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


        //return succes
        // flash('Book was stored!');
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
        // $gainer = Gainer::findOrFail($id);
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
        // $data = [
        //     'url' => route('admin.achievement.update', $achievement->id),
        //     'levels' => Level::all(),
        //     'achievement' => $achievement,
        // ];
        return view('admin.program.achievement.update', compact('achievement', 'levels', 'url'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // update data
        // $achievements = Achievement::findOrFail($id);
        // $gainers = Gainer::findOrFail($id);

        $achievements = Achievement::with('gainer')->find($id);
        Gainer::where('achievement_id', $id)->delete();


        $data = $request->all();
        $data['levels'] = Level::All();

        // $data= $request->validate ([
        //     'achiev' => 'string|required',
        //     'title' => 'string|required',
        //     'location' => 'string|required',
        //     'name' => 'string|required',
        //     'from' => 'string|required',
        //     'level_id' => 'required',
        // ]);

        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = Auth()->user()->id;
        // $data['achievement_id'] = Str::slug($request->title);

        $achievements->update($data);

        if ($request->name) {
            foreach ($data['name'] as $item => $value) {
                $data2 = array(
                    'achievement_id' => $achievements->id,
                    'name' => $data['name'][$item],
                    'from' => $data['from'][$item],
                );
                Gainer::create($data2);
            };
        };


        // return success
        // flash('Book was updated!');
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
