@if ($paginator->hasPages())
    <nav class="pagination-wrapper" role="navigation" aria-label="صفحه‌بندی">
        {{-- دکمه قبلی --}}
        @if ($paginator->onFirstPage())
            <span class="disabled"><span>→ قبلی</span></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">→ قبلی</a>
        @endif

        {{-- شماره صفحات --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="disabled"><span>{{ $element }}</span></span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"><span>{{ $page }}</span></span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- دکمه بعدی --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">بعدی ←</a>
        @else
            <span class="disabled"><span>بعدی ←</span></span>
        @endif
    </nav>
@endif