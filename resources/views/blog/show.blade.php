@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article>
        <h1>{{ $post->title }}</h1>
        <div>{!! nl2br(e($post->body)) !!}</div>
    </article>

    <a href="{{ route('blog.index') }}">بازگشت به بلاگ</a>
@endsection