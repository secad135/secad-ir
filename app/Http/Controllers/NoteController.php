<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\NoteCategory;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::published()
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->paginate(15);

        $categories = NoteCategory::tree();

        return view('notes.index', compact('notes', 'categories'));
    }

    public function show(Note $note)
    {
        abort_unless($note->is_published, 404);

        return view('notes.show', compact('note'));
    }

    public function byCategory(NoteCategory $category)
    {
        $categoryIds = $category->descendantIds();

        $notes = Note::published()
            ->whereHas('noteCategories', fn ($q) => $q->whereIn('note_categories.id', $categoryIds))
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->paginate(15);

        $ancestors = $category->ancestors();
        $children = $category->children;

        return view('notes.category', compact('category', 'notes', 'ancestors', 'children'));
    }
}
