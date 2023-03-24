<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ArticleController extends Controller
{

  public function category()
  {
    return view('admin.article.category');
  }

  public function comment()
  {
    return view('admin.article.comment');
  }

  public function index()
  {
    // Data Articles
    $articles = Article::all();
    // Return response
    return view('admin.article.index', compact('articles'));
  }

  public function create()
  {
    $url = route('admin.article.store');
    // ss
    return view('admin.article.form', compact('url'));
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'title' => 'required | string',
      'description' => 'nullable | string',
      'author' => 'required | string',
    ]);

    $data['slug'] = Str::slug($request->title);

    $article = Article::create($data);
    if ($request->hasFile('image')) {
      $article->addMediaFromRequest('image')->toMediaCollection('image');
    }

    toast('Create article Success', 'success');
    return redirect()->route('admin.article.index');
  }

  public function show(string $id)
  {
    $article = Article::findOrFail($id);
    return view('admin.article.show', compact('article'));
  }

  
  public function edit(string $id)
  {
    $article = Article::findOrFail($id);
    $url = route('admin.article.update', $article);

    return view('admin.article.form', compact('article', 'url'));
  }

  public function update(Request $request, string $id)
  {
    $article = Article::findOrFail($id);
    $data = $request->validate([
      'title' => 'required | string',
      'description' => 'nullable | string',
      'author' => 'required | string',
    ]);

    $data['slug'] = Str::slug($request->title);
    $article->update($data);

    toast('Your Gallery has been updated!', 'success');
    return redirect()->route('admin.article.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Article $article)
  {
    $article->delete();
    return redirect()->route('admin.article.index');
  }

  public function imageDestroy($id)
  {
    $media = Media::findOrFail($id);
    $media->delete();

    toast('Your Image has been deleted', 'success');
    return redirect()->back();
  }
}
