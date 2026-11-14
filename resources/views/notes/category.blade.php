@extends('layouts.app')
@section('title', $category->title)

@section('content')
<section class="content-area">
    <div style="max-width:900px; margin:0 auto;">
        {{-- Breadcrumb --}}
        <nav class="breadcrumb" style="margin-bottom:15px; font-size:0.9rem; color:var(--muted-color);">
            <a href="{{ route('notes.index') }}">یادداشت‌ها</a>
            @foreach($ancestors as $ancestor)
                <span>/</span>
                <a href="{{ route('notes.category', $ancestor) }}">{{ $ancestor->title }}</a>
            @endforeach
            <span>/</span>
            <span>{{ $category->title }}</span>
        </nav>

        <h1>{{ $category->title }}</h1>

        @if($category->description)
            <p style="color:var(--muted-color); margin-bottom:20px;">{{ $category->description }}</p>
        @endif

        @include('partials.category-tree', [
            'items' => \App\Models\NoteCategory::tree(),
            'routeName' => 'notes.category',
            'currentSlug' => $category->slug,
        ])

        @if($children->isNotEmpty())
            <div style="margin: 20px 0; display:flex; flex-wrap:wrap; gap:8px;">
                <strong style="font-size:0.9rem;">زیردسته‌ها:</strong>
                @foreach($children as $child)
                    <a href="{{ route('notes.category', $child) }}" class="tech-filter-item">{{ $child->title }}</a>
                @endforeach
            </div>
        @endif

        @forelse($notes as $note)
            <article class="list-card">
                <img src="{{ $note->featured_image_url }}" alt="{{ $note->title ?? 'یادداشت' }}" class="card-image">
                <h2>
                    <a href="{{ route('notes.show', $note) }}">
                        {{ $note->title ?? 'یادداشت ' . $note->id }}
                    </a>
                </h2>
                <p class="excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($note->body), 150) }}</p>
            </article>
        @empty
            <p>در این دسته یادداشتی منتشر نشده است.</p>
        @endforelse

        {{ $notes->links() }}
    </div>
</section>
@endsection
