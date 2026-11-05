@extends('layouts.app')

@section('title', 'بلاگ')

@section('content')
    <h1>بلاگ</h1>

    @forelse($posts as $post)
        <article>
            <h2><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h2>
            @if($post->excerpt)<p>{{ $post->excerpt }}</p>@endif
        </article>
    @empty
        <p>هنوز مطلبی منتشر نشده است.</p>
    @endforelse

    {{ $posts->links() }}
@endsection