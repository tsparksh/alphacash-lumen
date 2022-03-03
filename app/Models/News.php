<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class News extends Model
{
    protected $casts = [
        'published_at' => 'datetime'
    ];

    protected $guarded = [];

    public function source(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function scopePublishedBetween(Builder $query, $date_from, $date_to): Builder
    {
        return $query->where('published_at', '>=', Carbon::parse($date_from))
            ->where('published_at', '<=', Carbon::parse($date_to));
    }
}
