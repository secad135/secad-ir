@extends('layouts.app')
@section('title', 'بلاگ')

@section('content')
<section class="content-area">
    <div style="max-width:900px; margin:0 auto;">
        <h1>بلاگ</h1>

        @forelse($posts as $post)
            <article style="background:var(--card-bg); padding:20px; border-radius:10px; border:1px solid var(--border-color); margin-bottom:15px;">
                <h2 style="margin-top:0;">
                    <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                </h2>
                @if($post->excerpt)<p style="margin-bottom:0;">{{ $post->excerpt }}</p>@endif
            </article>
        @empty
            <p>هنوز مطلبی منتشر نشده است.</p>
        @endforelse

        {{ $posts->links() }}
    </div>
</section>
@endsection