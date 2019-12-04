@if ($paginator->hasPages())
    <ul class="kt-pagination__links">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        @else
            @if($paginator->currentPage() == 2)
                <li class="kt-pagination__link--next"><a class="" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-angle-left kt-font-primary"></i></a></li>
            @else
                <li class="kt-pagination__link--next"><a href="{{ $paginator->url(1) }}"><i class="fa fa-angle-double-left kt-font-primary"></i></a></li>
                <li class="kt-pagination__link--next"><a class="" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-angle-left kt-font-primary"></i></a></li>
            @endif
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span class="">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="kt-pagination__link--active"><a class="">{{ $page }}</a></li>
                    @else
                        <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            @if( $paginator->currentPage() == $paginator->lastPage() - 1 )
                <li class="kt-pagination__link--prev"><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right kt-font-primary"></i></a></li>
            @else 
                <li class="kt-pagination__link--prev"><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right kt-font-primary"></i></a></li>
                <li class="kt-pagination__link--prev"><a href="{{ $paginator->url( $paginator->lastPage() ) }}"><i class="fa fa-angle-double-right kt-font-primary"></i></a></li>
            @endif
        @endif

    </ul>
@endif
