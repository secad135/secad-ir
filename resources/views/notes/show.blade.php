@extends('layouts.app')
@section('title', $note->title ?? 'یادداشت ' . $note->id)

@section('content')
<section class="content-area">
    <article style="max-width:900px; margin:0 auto; background:var(--card-bg); padding:30px; border-radius:10px; border:1px solid var(--border-color);">
        <h1 style="margin-top:0;">{{ $note->title ?? 'یادداشت ' . $note->id }}</h1>
        <div class="rich-body">{!! $note->body !!}</div>
        <p style="margin-top:30px;"><a href="{{ route('notes.index') }}">→ بازگشت به یادداشت‌ها</a></p>
    </article>
</section>
@endsection