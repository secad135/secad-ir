<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->paginate(10);

        return view('blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        abort_unless($post->is_published, 404);

        return view('blog.show', compact('post'));
    }
}