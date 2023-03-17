<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  
  public function index()
  {
    // Data Articles
    $articles = Article::all();
    // Return response
    return view('admin.article.index', compact('articles'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.article.form');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
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


  public function category()
  {
    return view('admin.article.category');
  }
}
