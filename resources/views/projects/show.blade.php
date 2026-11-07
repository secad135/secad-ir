@extends('layouts.app')
@section('title', $project->title)

@section('content')
<section class="content-area">
    <article style="max-width:900px; margin:0 auto; background:var(--card-bg); padding:30px; border-radius:10px; border:1px solid var(--border-color);">
        <h1 style="margin-top:0;">{{ $project->title }}</h1>

        @if($project->tech_stack)
            <div style="display:flex; flex-wrap:wrap; gap:6px; margin:15px 0;">
                @foreach($project->tech_stack as $tech)
                    <span style="background:var(--bg-color); border:1px solid var(--border-color); border-radius:20px; padding:3px 10px; font-size:0.85rem;">{{ $tech }}</span>
                @endforeach
            </div>
        @endif

        @if($project->client)<p><strong>کارفرما:</strong> {{ $project->client }}</p>@endif
        @if($project->url)<p><strong>لینک:</strong> <a href="{{ $project->url }}" target="_blank" rel="noopener">{{ $project->url }}</a></p>@endif
        @if($project->body)
        <div style="margin-top:20px;"><div class="rich-body">{!! $project->body !!}</div></div>
        @endif

        <p style="margin-top:30px;"><a href="{{ route('projects.index') }}">→ بازگشت به نمونه‌کارها</a></p>
    </article>
</section>
@endsection