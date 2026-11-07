<?php

use App\Models\Note;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        foreach ([Project::class, Note::class, Post::class] as $modelClass) {
            $modelClass::query()
                ->where(function ($q) {
                    $q->whereNull('slug')->orWhere('slug', '');
                })
                ->each(function ($record) {
                    $record->slug = $record->generateUniqueSlug();
                    $record->saveQuietly();
                });
        }
    }

    public function down(): void
    {
        // نیازی به بازگشت نیست
    }
};