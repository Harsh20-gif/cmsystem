<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ContentBlock extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'extra_json' => 'array',
    ];

    /* ------------------------------------------------------------------ */
    /*  Scopes                                                            */
    /* ------------------------------------------------------------------ */

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeByPage(Builder $query, string $pageKey): Builder
    {
        return $query->where('page_key', $pageKey);
    }

    public function scopeByType(Builder $query, string $blockType): Builder
    {
        return $query->where('block_type', $blockType);
    }

    /**
     * Convenience: fetch all published blocks for a page, keyed by block_type.
     */
    public static function forPage(string $pageKey): \Illuminate\Support\Collection
    {
        return static::published()
            ->byPage($pageKey)
            ->orderBy('order_position')
            ->get()
            ->groupBy('block_type');
    }
}
