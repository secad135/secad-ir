@extends('layouts.app')

@section('title', $note->title ?? 'یادداشت ' . $note->id)

@section('content')
    <article>
        <h1>{{ $note->title ?? 'یادداشت ' . $note->id }}</h1>
        <div>{!! nl2br(e($note->body)) !!}</div>
    </article>

    <a href="{{ route('notes.index') }}">بازگشت به یادداشت‌ها</a>
@endsection