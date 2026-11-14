@extends('layouts.app')
@section('title', 'نمونه‌کارها')

@section('content')
<section class="content-area">
    <div style="max-width:1000px; margin:0 auto;">
        <h1>نمونه‌کارها</h1>

        @if($allTechs->isNotEmpty())
            <div class="tech-filter">
                <a href="{{ route('projects.index') }}"
                   class="tech-filter-item {{ !$selectedTech ? 'active' : '' }}">
                    همه
                </a>
                @foreach($allTechs as $tech)
                    <a href="{{ route('projects.index', ['tech' => $tech]) }}"
                       class="tech-filter-item {{ $selectedTech === $tech ? 'active' : '' }}">
                        {{ $tech }}
                    </a>
                @endforeach
            </div>
        @endif

        @forelse($projects as $project)
        <article style="background:var(--card-bg); padding:20px; border-radius:10px; border:1px solid var(--border-color); margin-bottom:15px;">
            <img src="{{ $project->featured_image_url }}" alt="{{ $project->title }}" class="card-image">
            <h2 style="margin-top:0;">
                <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
            </h2>
            @if($project->excerpt)<p>{{ $project->excerpt }}</p>@endif
            @if($project->tech_stack)
            <div style="display:flex; flex-wrap:wrap; gap:6px; margin-top:10px;">
                @foreach($project->tech_stack as $tech)
                <span style="background:var(--bg-color); border:1px solid var(--border-color); border-radius:20px; padding:3px 10px; font-size:0.85rem;">{{ $tech }}</span>
                @endforeach
            </div>
            @endif
        </article>
        @empty
        <p>هنوز نمونه‌کاری ثبت نشده است.</p>
        @endforelse

        @if($selectedTech && $projects->isEmpty())
            <p style="color:var(--muted-color); padding:20px 0;">
                پروژه‌ای با تکنولوژی «{{ $selectedTech }}» یافت نشد.
                <a href="{{ route('projects.index') }}">پاک کردن فیلتر</a>
            </p>
        @endif

        {{ $projects->links() }}
    </div>
</section>
@endsection
