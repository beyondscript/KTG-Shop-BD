<ul id="pagination" class="reviews-pagination">
    @if ($paginator->hasPages())
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @elseif ($paginator->currentPage() == 1 && ($page == ($paginator->currentPage() + 1) || $page == ($paginator->currentPage() + 2)))
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @elseif ($paginator->currentPage() == $paginator->lastPage() && ($page == ($paginator->currentPage() - 1) || $page == ($paginator->currentPage() - 2)))
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @elseif (($paginator->currentPage() != 1 || $paginator->currentPage() != $paginator->lastPage()) && ($page == ($paginator->currentPage() + 1) || $page == ($paginator->currentPage() - 1)))
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif
</ul>