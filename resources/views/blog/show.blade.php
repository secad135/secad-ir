@extends('layouts.app')
@section('title', $post->title)

@section('content')
<section class="content-area">
    <article style="max-width:900px; margin:0 auto; background:var(--card-bg); padding:30px; border-radius:10px; border:1px solid var(--border-color);">
        <h1 style="margin-top:0;">{{ $post->title }}</h1>
        <div>{!! nl2br(e($post->body)) !!}</div>
        <p style="margin-top:30px;"><a href="{{ route('blog.index') }}">→ بازگشت به بلاگ</a></p>
    </article>
</section>
@endsection