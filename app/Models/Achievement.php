<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Achievement extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['achiev', 'title', 'slug', 'location', 'year', 'level_id', 'user_id', 'is_published'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
        // return $this->belongsTo(User::class);

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gainer()
    {
        return $this->hasMany('App\Models\Gainer', 'achievement_id');
    }

    /**
     * Scope a query to only include Filter
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $params)
    {
        if (@$params['search']) {
            $query->where('title', 'like', '%'.$params['search'].'%');
        }

        if (@$params['level']) {
            $query->whereRelation('level', 'slug', $params['level']);
        }
    }
}
