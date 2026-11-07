<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSlug;

class Project extends Model
{
    use HasFactory, HasSlug;
    protected $fillable = [
        'title', 'slug', 'excerpt', 'body', 'client', 'url',
        'tech_stack', 'featured', 'sort_order', 'is_published', 'published_at',
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where(function (Builder $q) {
                $q->whereNull('published_at')
                  ->orWhere('published_at', '<=', now());
            });
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }
}