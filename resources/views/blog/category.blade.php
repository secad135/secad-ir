@extends('layouts.app')
@section('title', $category->title)

@section('content')
<section class="content-area">
    <div style="max-width:900px; margin:0 auto;">
        {{-- Breadcrumb --}}
        <nav class="breadcrumb" style="margin-bottom:15px; font-size:0.9rem; color:var(--muted-color);">
            <a href="{{ route('blog.index') }}">بلاگ</a>
            @foreach($ancestors as $ancestor)
                <span>/</span>
                <a href="{{ route('blog.category', $ancestor) }}">{{ $ancestor->title }}</a>
            @endforeach
            <span>/</span>
            <span>{{ $category->title }}</span>
        </nav>

        <h1>{{ $category->title }}</h1>

        @if($category->description)
            <p style="color:var(--muted-color); margin-bottom:20px;">{{ $category->description }}</p>
        @endif

        @include('partials.category-tree', [
            'items' => \App\Models\Category::tree(),
            'routeName' => 'blog.category',
            'currentSlug' => $category->slug,
        ])

        @if($children->isNotEmpty())
            <div style="margin: 20px 0; display:flex; flex-wrap:wrap; gap:8px;">
                <strong style="font-size:0.9rem;">زیردسته‌ها:</strong>
                @foreach($children as $child)
                    <a href="{{ route('blog.category', $child) }}" class="tech-filter-item">{{ $child->title }}</a>
                @endforeach
            </div>
        @endif

        @forelse($posts as $post)
            <article class="list-card">
                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="card-image">
                <h2><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h2>
                @if($post->excerpt)<p class="excerpt">{{ $post->excerpt }}</p>@endif
            </article>
        @empty
            <p>در این دسته مطلبی منتشر نشده است.</p>
        @endforelse

        {{ $posts->links() }}
    </div>
</section>
@endsection
