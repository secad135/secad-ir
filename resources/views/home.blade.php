@extends('layouts.app')

@section('title', 'صفحه اصلی')
@section('description', 'سایت شخصی — مدرس کامپیوتر، توسعه‌دهنده وب و تولیدکننده محتوای آموزشی')

@section('content')
<section class="landing-container" style="height:auto; min-height:calc(100vh - 60px);">
    <div id="code-background"></div>

    <div class="landing-grid">
        <div class="hero-section">
            <div class="logo-container">
                <img src="{{ asset('images/profile.jpg') }}" alt="عکس پروفایل" class="hero-logo">
            </div>
            <h1 class="hero-title">سجاد اسماعیلی</h1>
            <p class="hero-subtitle">
                مدرس کامپیوتر، توسعه‌دهنده وب و تولیدکننده محتوای آموزشی.
                اینجا خانه دیجیتال من است — نمونه‌کارها، یادداشت‌ها و مطالبی که ارزش خواندن دارند.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('projects.index') }}" class="hero-btn primary-btn">مشاهده نمونه‌کارها</a>
                <a href="{{ route('blog.index') }}" class="hero-btn secondary-btn">مطالب بلاگ</a>
            </div>
        </div>

        <div class="features-section">
            <div class="feature-card">
                <div class="feature-icon">💻</div>
                <div>
                    <h3>توسعه وب</h3>
                    <p>ساخت وب‌اپلیکیشن‌های مدرن با Laravel و تکنولوژی‌های روز</p>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎓</div>
                <div>
                    <h3>آموزش</h3>
                    <p>تولید محتوای آموزشی برنامه‌نویسی و کامپیوتر</p>
                </div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">✍️</div>
                <div>
                    <h3>نوشتن</h3>
                    <p>یادداشت‌های شخصی و مقالات فنی</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="landing-footer">
        <span>↓ برای دیدن نمونه‌کارها و مطالب اسکرول کنید</span>
    </footer>
</section>

<section class="content-area">
    <div style="max-width:1200px; margin:0 auto;">
        <h2>نمونه‌کارهای برجسته</h2>
        @forelse($featuredProjects as $project)
            <article style="background:var(--card-bg); padding:20px; border-radius:10px; border:1px solid var(--border-color); margin-bottom:15px;">
                <h3 style="margin-top:0;">
                    <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                </h3>
                @if($project->excerpt)
                    <p style="margin-bottom:0;">{{ $project->excerpt }}</p>
                @endif
            </article>
        @empty
            <p>هنوز نمونه‌کار برجسته‌ای ثبت نشده است.</p>
        @endforelse
        <a href="{{ route('projects.index') }}" class="hero-btn secondary-btn" style="margin-top:10px; display:inline-block;">همه نمونه‌کارها</a>

        <h2 style="margin-top:50px;">آخرین مطالب بلاگ</h2>
        @forelse($latestPosts as $post)
            <article style="background:var(--card-bg); padding:20px; border-radius:10px; border:1px solid var(--border-color); margin-bottom:15px;">
                <h3 style="margin-top:0;">
                    <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                </h3>
                @if($post->excerpt)
                    <p style="margin-bottom:0;">{{ $post->excerpt }}</p>
                @endif
            </article>
        @empty
            <p>هنوز مطلبی منتشر نشده است.</p>
        @endforelse
        <a href="{{ route('blog.index') }}" class="hero-btn secondary-btn" style="margin-top:10px; display:inline-block;">همه مطالب</a>

        <h2 style="margin-top:50px;">آخرین یادداشت‌ها</h2>
        @forelse($latestNotes as $note)
            <article style="background:var(--card-bg); padding:20px; border-radius:10px; border:1px solid var(--border-color); margin-bottom:15px;">
                <h3 style="margin-top:0;">
                    <a href="{{ route('notes.show', $note) }}">
                        {{ $note->title ?? 'یادداشت ' . $note->id }}
                    </a>
                </h3>
            </article>
        @empty
            <p>هنوز یادداشتی ثبت نشده است.</p>
        @endforelse
        <a href="{{ route('notes.index') }}" class="hero-btn secondary-btn" style="margin-top:10px; display:inline-block;">همه یادداشت‌ها</a>
    </div>
</section>
@endsection