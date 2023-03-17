<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model
{
  use HasFactory;
  protected $fillable = ['slug', 'title', 'description', 'author', 'comment',];

  public function category_article(): BelongsTo
  {
    return $this->belongsTo(CategoryArticle::class);
  }

  public function registerMediaConversions(Media $media = null): void
  {
    $this
      ->addMediaConversion('preview')
      ->fit(Manipulations::FIT_CROP, 300, 300)
      ->nonQueued();
  }
}
