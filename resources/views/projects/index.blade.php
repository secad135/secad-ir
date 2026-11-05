@extends('layouts.app')

@section('title', 'نمونه‌کارها')

@section('content')
    <h1>نمونه‌کارها</h1>

    @forelse($projects as $project)
        <article>
            <h2><a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a></h2>
            @if($project->excerpt)<p>{{ $project->excerpt }}</p>@endif
            @if($project->tech_stack)
                <ul>
                    @foreach($project->tech_stack as $tech)
                        <li>{{ $tech }}</li>
                    @endforeach
                </ul>
            @endif
        </article>
    @empty
        <p>هنوز نمونه‌کاری ثبت نشده است.</p>
    @endforelse

    {{ $projects->links() }}
@endsection