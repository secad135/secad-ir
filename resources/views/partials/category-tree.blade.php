@php
    /**
     * @var array $items
     * @var string $routeName
     * @var string|null $currentSlug
     */
@endphp

<div class="category-tree-nav">
    <a href="{{ $routeName === 'blog.category' ? route('blog.index') : route('notes.index') }}"
       class="category-nav-item {{ empty($currentSlug) ? 'active' : '' }}">
        همه
    </a>

    @foreach($items as $item)
        <div class="category-nav-wrapper">
            <a href="{{ route($routeName, $item) }}"
               class="category-nav-item {{ $currentSlug === $item->slug ? 'active' : '' }}">
                {{ $item->title }}
                @if($item->children->isNotEmpty())
                    <span class="category-arrow">▾</span>
                @endif
            </a>

            @if($item->children->isNotEmpty())
                <div class="category-dropdown">
                    @include('partials.category-tree-items', [
                        'items' => $item->children,
                        'routeName' => $routeName,
                        'currentSlug' => $currentSlug,
                    ])
                </div>
            @endif
        </div>
    @endforeach
</div>
