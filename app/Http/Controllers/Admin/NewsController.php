<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.news.index', [
            "news" => News::latest()->with('user')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.news.store');
        return view('admin.news.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "string|required|unique:news",
            "category" => "string|required",
            "content" => "required"
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = auth()->user()->id;
        $data['publish'] = false;

        $create = News::create($data);
        if ($request->has('images')) {
            $create->addMediaFromRequest('images')
                ->toMediaCollection('news');
        }

        toast('Your Image has been deleted', 'success');
        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {


        return view('admin.news.show', [
            "news" => News::where('slug', $slug)->with('user')->get()->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $url = route('admin.news.update', $id);
        return view('admin.news.form', compact('url', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $news = News::findOrFail($id);
        $data = $request->validate([
            "title" => "string|required",
            "category" => "string|required",
            "content" => "required"
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = auth()->user()->id;
        $data['publish'] = false;

        if ($request->has('images')) {
            $news->clearMediaCollection('news');
            $news->addMediaFromRequest('images')->toMediaCollection('news');
        }
        $news->update($data);

        toast('Your News has been updated!', 'success');
        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->clearMediaCollection('news');
        $news->delete();


        toast('Your News has been deleted', 'success');
        return back();
    }

    public function publis(Request $request)
    {

        $berita = News::findOrFail($request->id);

        if ($berita->publish == 0) {
            $berita->update(['publish' => 1]);
        } else {
            $berita->update(['publish' => 0]);
        }
        
    }
}
