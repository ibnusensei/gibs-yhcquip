<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Streams extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'is_published', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function scopeFilter($query, $params)
    {
        if (@$params['search']) {
            $query->where('name', 'like', '%'.$params['search'].'%');
        }
    }


}
