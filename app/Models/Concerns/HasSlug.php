<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug();
            }
        });
    }

    public function generateUniqueSlug(): string
    {
        $title = (string) ($this->title ?? '');

        // ابتدا تلاش می‌کنیم از متن لاتین slug بسازیم
        $base = Str::slug($title);

        // اگر متن فارسی بود (slug خالی)، متن فارسی را URL-encode می‌کنیم
        if ($base === '') {
            $transliterated = trim(preg_replace('/\s+/u', '-', $title));
            $base = $transliterated !== '' ? $transliterated : '';
        }

        // اگر هنوز خالی بود، از رشته تصادفی استفاده می‌کنیم
        if ($base === '') {
            $base = 'item-' . Str::lower(Str::random(6));
        }

        // حداکثر طول slug
        $base = mb_substr($base, 0, 100);

        // بررسی یکتا بودن
        $slug = $base;
        $i = 2;
        while (static::query()->where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug', $value)->first()
            ?? $this->where('id', $value)->first()
            ?? abort(404);
    }
}