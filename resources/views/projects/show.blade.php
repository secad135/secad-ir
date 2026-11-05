@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <article>
        <h1>{{ $project->title }}</h1>

        @if($project->tech_stack)
            <ul>
                @foreach($project->tech_stack as $tech)
                    <li>{{ $tech }}</li>
                @endforeach
            </ul>
        @endif

        @if($project->client)<p>کارفرما: {{ $project->client }}</p>@endif
        @if($project->url)<p><a href="{{ $project->url }}" target="_blank" rel="noopener">مشاهده پروژه</a></p>@endif
        @if($project->body)<div>{!! nl2br(e($project->body)) !!}</div>@endif
    </article>

    <a href="{{ route('projects.index') }}">بازگشت به نمونه‌کارها</a>
@endsection