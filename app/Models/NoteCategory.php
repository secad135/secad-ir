<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NoteCategory extends Model
{
    use HasSlug;

    protected $table = 'note_categories';

    protected $fillable = ['parent_id', 'title', 'slug', 'description', 'sort_order'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NoteCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(NoteCategory::class, 'parent_id')->orderBy('sort_order');
    }

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'category_note', 'note_category_id', 'note_id');
    }

    public function ancestors(): array
    {
        $ancestors = [];
        $current = $this->parent;
        while ($current) {
            array_unshift($ancestors, $current);
            $current = $current->parent;
        }

        return $ancestors;
    }

    public function descendantIds(): array
    {
        $ids = [$this->id];
        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->descendantIds());
        }

        return $ids;
    }

    public static function tree(): array
    {
        return static::whereNull('parent_id')
            ->with('children')
            ->orderBy('sort_order')
            ->get()
            ->all();
    }
}
