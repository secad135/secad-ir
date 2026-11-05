@extends('layouts.app')
@section('title', 'یادداشت‌ها')

@section('content')
<section class="content-area">
    <div style="max-width:900px; margin:0 auto;">
        <h1>یادداشت‌ها</h1>

        @forelse($notes as $note)
            <article style="background:var(--card-bg); padding:20px; border-radius:10px; border:1px solid var(--border-color); margin-bottom:15px;">
                <h2 style="margin-top:0;">
                    <a href="{{ route('notes.show', $note) }}">
                        {{ $note->title ?? 'یادداشت ' . $note->id }}
                    </a>
                </h2>
                <p style="margin-bottom:0;">{{ \Illuminate\Support\Str::limit(strip_tags($note->body), 150) }}</p>
            </article>
        @empty
            <p>هنوز یادداشتی ثبت نشده است.</p>
        @endforelse

        {{ $notes->links() }}
    </div>
</section>
@endsection