<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Cache\RedisTagSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.news-category.index', [
            "newsCategory" => NewsCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        NewsCategory::create($data);
        toast('Your Category has been Created!', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($categoryNews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = NewsCategory::findOrfail($id);
        return view('admin.news-category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = NewsCategory::findOrfail($id);
        $data = $request->validate([
            'name' => 'required'
        ]);

        $category->update($data);
        toast('Your Category has been Updated!', 'success');
        return Redirect()->route('admin.news-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = NewsCategory::findOrFail($id);
        $data->delete();
        toast('Your Category has been Deleted!', 'success');
        return back();
    }
}
