<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Storage;

trait HasFeaturedImage
{
    public function getFeaturedImageUrlAttribute(): string
    {
        $image = $this->attributes['featured_image'] ?? null;

        if (empty($image)) {
            return asset('images/defaults/' . static::DEFAULT_IMAGE);
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        return Storage::disk('public')->url($image);
    }

    public function hasCustomImage(): bool
    {
        return !empty($this->attributes['featured_image'] ?? null);
    }
}