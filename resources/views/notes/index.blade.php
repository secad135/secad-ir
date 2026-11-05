@extends('layouts.app')

@section('title', 'یادداشت‌ها')

@section('content')
    <h1>یادداشت‌ها</h1>

    @forelse($notes as $note)
        <article>
            <h2>
                <a href="{{ route('notes.show', $note) }}">
                    {{ $note->title ?? 'یادداشت ' . $note->id }}
                </a>
            </h2>
            <p>{{ \Illuminate\Support\Str::limit(strip_tags($note->body), 150) }}</p>
        </article>
    @empty
        <p>هنوز یادداشتی ثبت نشده است.</p>
    @endforelse

    {{ $notes->links() }}
@endsection