<?php

namespace App\Models;

use App\Models\Concerns\HasFeaturedImage;
use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory, HasFeaturedImage, HasSlug;

    public const DEFAULT_IMAGE = 'default-note.webp';

    protected $fillable = [
        'title', 'slug', 'body', 'is_published', 'published_at', 'title', 'slug', 'featured_image',
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

    public function noteCategories(): BelongsToMany
    {
        return $this->belongsToMany(NoteCategory::class, 'category_note', 'note_id', 'note_category_id');
    }
}
