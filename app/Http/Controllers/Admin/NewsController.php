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
use App\Models\NewsCategory;
use Carbon\Carbon;
use Illuminate\Queue\Events\Looping;
use Illuminate\Support\Carbon as SupportCarbon;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        return view('admin.news.index', [
            "news" =>  News::latest()->with('user')->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = NewsCategory::all();
        $url = route('admin.news.store');
        return view('admin.news.form', compact(['url', 'category']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $data = $request->validate([
            "title" => "string|required|unique:news",
            "content" => "required",
            "news_category_id" => "required"
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = auth()->user()->id;
        $data['published_at'] = now();

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
        $category = NewsCategory::all();
        return view('admin.news.form', compact('url', 'news', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $news = News::findOrFail($id);
        $data = $request->validate([
            "title" => "string|required|",
            "content" => "required",
            "news_category_id" => "required"
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = auth()->user()->id;
        $data['published_at'] = now();

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
        if ($berita->is_publish == 0) {
            $berita->update(['is_publish' => 1, 'published_at' => now()]);
        } else {
            $berita->update(['is_publish' => 0]);
        }
        $status = $berita->id;

        return response($status);
    }

    public function ajax(Request $request)
    {
        $output = "";
        $output .= "$request->data";
        return response($request->output);
    }


    public function search(Request $request)
    {
        $data = News::where('title', 'like', '%' . $request->search . '%')->with('user')->paginate(5);
        $output = "";
        $i = 1;
        foreach ($data as $item) {

            $status = "";
            if($item->is_publish ==true){
                $status ="checked";
            }
            $output .=         '<tr>
                                    <td>'
                . $i++ .
                '</td>
                                    <td>' . $item->title . '</td>
                                    <td>' . $item->newsCategory->name . '</td>
                                    <td>' . $item->user->name . '</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input published-checkbox" type="checkbox"
                                                name="publish" role="switch" id="publish" '.$status.'
                                                onclick="publisNews(' . $item->id . ')"
                                                >
                                        </div>
                                    </td>
                                    <td>
                                        <a name="" id="" class="btn btn-outline-primary btn-sm"
                                            href="/admin/news/' . $item->id . '/edit">Edit</a>
                                        <a name="" id="" class="btn btn-outline-info btn-sm"
                                            href="/admin/news/' . $item->slug . '">Show</a>
                                        <form action="news-publis-delete/' . $item->id . '" method="POST"
                                            class="d-inline">
                                            <input type="hidden" name="_token" value=" ' . csrf_token() . '"   />
                                            <button class="btn btn-outline-danger btn-sm delete-btn">Delete</button>
                                        </form>
                                    </td>

                                </tr>';
        }

        return response($output);
    }
}
