<?php

namespace App\Http\Controllers;

use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::published()
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->paginate(15);

        return view('notes.index', compact('notes'));
    }

    public function show(Note $note)
    {
        abort_unless($note->is_published, 404);

        return view('notes.show', compact('note'));
    }
}