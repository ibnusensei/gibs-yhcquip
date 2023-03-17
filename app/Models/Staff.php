<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Staff extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable =  [
        'name',
        'position'
    ];

    
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
        ->addMediaConversion('preview')
        ->fit(Manipulations::FIT_CROP, 300, 300)
        ->nonQueued();
    }

    public function scopeFilter($query, array $filters) {
        if(isset($filters['search']) ? $filters['search'] : false) {
           return $query->where('name', 'like', '%' . $filters['search'] . '%')
           ->orWhere('position', 'like', '%' . $filters['search'] . '%');
        }
    }
}
