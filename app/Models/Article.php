<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
  use HasFactory;
  use InteractsWithMedia;

  protected $fillable = ['slug', 'title', 'description', 'author', 'comment', 'category_id'];

  public function categoryArticle(): BelongsTo
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
