<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Gainer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'from', 'achievement_id'];

    public function achievement(): BelongsTo
    {
        return $this->belongsTo(Achievement::class);
    }
}
