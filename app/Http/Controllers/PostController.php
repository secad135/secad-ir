<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->paginate(10);

        $categories = Category::tree();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        abort_unless($post->is_published, 404);

        return view('blog.show', compact('post'));
    }

    public function byCategory(Category $category)
    {
        $categoryIds = $category->descendantIds();

        $posts = Post::published()
            ->whereHas('categories', fn ($q) => $q->whereIn('categories.id', $categoryIds))
            ->orderByRaw('COALESCE(published_at, created_at) DESC')
            ->paginate(10);

        $ancestors = $category->ancestors();
        $children = $category->children;

        return view('blog.category', compact('category', 'posts', 'ancestors', 'children'));
    }
}
