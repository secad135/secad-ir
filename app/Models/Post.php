<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSlug;
use App\Models\Concerns\HasFeaturedImage;
class Post extends Model
{
    use HasFactory, HasSlug, HasFeaturedImage;

    public const DEFAULT_IMAGE = 'default-post.webp';
    
    protected $fillable = [
        'title', 'slug', 'excerpt', 'body', 'is_published', 'published_at','title', 'slug', 'featured_image',
    ];

    protected $casts = [
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
}