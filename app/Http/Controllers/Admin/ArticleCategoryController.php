<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryArticle;
use App\Http\Controllers\Controller;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryArticle::all();
        // Return response
        return view ('admin.article-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $categories = CategoryArticle::all();
      $url = route('admin.article-category.store');
      // Return hasil
      return view('admin.article-category.form', compact('url', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // return $request;
      $data = $request->validate([
        'name' => 'required | string',
      ]);

      $data['slug'] = Str::slug($request->name);
      $category = CategoryArticle::create($data);

      toast('Create category Success', 'success');
      return redirect()->route('admin.article-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
