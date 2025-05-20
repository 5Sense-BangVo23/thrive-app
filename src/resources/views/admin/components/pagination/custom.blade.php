
<style>
    .custom-pagination {
    display: inline-flex;
    list-style: none;
    padding: 0;
    border-radius: 6px;
    overflow: hidden;
}

.custom-pagination li {
    margin: 0 4px;
}

.custom-pagination li a,
.custom-pagination li span {
    display: block;
    padding: 8px 14px;
    color: #9c27b0;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
    min-width: 36px;
    text-align: center;
    font-weight: 500;
}

.custom-pagination li a:hover {
    background-color: #9c27b0;
    color: #fff;
}

.custom-pagination li.active span {
    background-color: #9c27b0;
    color: white;
    border-color: #9c27b0;
    cursor: default;
}

.custom-pagination li.disabled span {
    color: #ccc;
    cursor: not-allowed;
}

</style>
@if ($paginator->hasPages())
    <nav>
        <ul class="custom-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>&laquo;</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="disabled"><span>&raquo;</span></li>
            @endif
        </ul>
    </nav>
@endif
