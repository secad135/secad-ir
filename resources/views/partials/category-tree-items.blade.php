@foreach($items as $item)
    <a href="{{ route($routeName, $item) }}"
       class="category-nav-item {{ $currentSlug === $item->slug ? 'active' : '' }}">
        {{ $item->title }}
    </a>

    @if($item->children->isNotEmpty())
        <div class="category-subgroup">
            @include('partials.category-tree-items', [
                'items' => $item->children,
                'routeName' => $routeName,
                'currentSlug' => $currentSlug,
            ])
        </div>
    @endif
@endforeach
