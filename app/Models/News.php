<?php

namespace App\Models;

use App\Models\User;
use App\Models\NewsCategory;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class News extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class);
    }
}
