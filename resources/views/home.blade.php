@extends('layouts.app')

@section('title', 'صفحه اصلی')

@section('content')
    <section>
        <h1>{{ config('app.name') }}</h1>
        <p>مدرس کامپیوتر، توسعه‌دهنده وب و تولیدکننده محتوای آموزشی</p>
        <a href="{{ route('projects.index') }}">مشاهده نمونه‌کارها</a>
    </section>

    <section>
        <h2>نمونه‌کارهای برجسته</h2>
        @forelse($featuredProjects as $project)
            <article>
                <h3><a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a></h3>
                @if($project->excerpt)<p>{{ $project->excerpt }}</p>@endif
            </article>
        @empty
            <p>هنوز نمونه‌کار برجسته‌ای ثبت نشده است.</p>
        @endforelse
        <a href="{{ route('projects.index') }}">همه نمونه‌کارها</a>
    </section>

    <section>
        <h2>آخرین مطالب بلاگ</h2>
        @forelse($latestPosts as $post)
            <article>
                <h3><a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a></h3>
                @if($post->excerpt)<p>{{ $post->excerpt }}</p>@endif
            </article>
        @empty
            <p>هنوز مطلبی منتشر نشده است.</p>
        @endforelse
        <a href="{{ route('blog.index') }}">همه مطالب</a>
    </section>

    <section>
        <h2>آخرین یادداشت‌ها</h2>
        @forelse($latestNotes as $note)
            <article>
                <h3>
                    <a href="{{ route('notes.show', $note) }}">
                        {{ $note->title ?? 'یادداشت ' . $note->id }}
                    </a>
                </h3>
            </article>
        @empty
            <p>هنوز یادداشتی ثبت نشده است.</p>
        @endforelse
        <a href="{{ route('notes.index') }}">همه یادداشت‌ها</a>
    </section>
@endsection