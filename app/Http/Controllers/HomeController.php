<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Post;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::published()
            ->featured()
            ->orderBy('sort_order')
            ->latest('created_at')
            ->limit(3)
            ->get();

        $latestPosts = Post::published()
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->limit(3)
            ->get();

        $latestNotes = Note::published()
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->limit(3)
            ->get();

        return view('home', compact('featuredProjects', 'latestPosts', 'latestNotes'));
    }
}