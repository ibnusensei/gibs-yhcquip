<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryArticle extends Model
{
  use HasFactory;
  protected $fillable = ['slug', 'name'];
  
  protected $guarded = ['id'];
  // public $timestamps = false;

  // public function article(): HasMany
  // {
  //   return $this->hasMany(Article::class);
  // }
}
