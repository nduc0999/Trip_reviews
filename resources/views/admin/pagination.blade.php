
@if ($paginator->hasPages())
    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link"><i class="bi bi-chevron-double-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link">
                        <span><i class="bi bi-chevron-double-left"></i></span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                        @elseif ($page == $paginator->currentPage() + 3 )
                            <li class="page-item disabled"><span class="page-link"><i class="bi bi-three-dots"></i></span></li>
                        @elseif (($page == $paginator->currentPage() - 1 || $page == $paginator->currentPage() - 2) || $page == 1 )
                            <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                        @elseif ($page == $paginator->currentPage() - 3)
                            <li class="page-item disabled"><span class="page-link"><i class="bi bi-three-dots"></i></span></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link">
                        <span><i class="bi bi-chevron-double-right"></i></span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link"><i class="bi bi-chevron-double-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
    <!-- Pagination -->
@endif
