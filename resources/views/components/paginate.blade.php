<ul class="pagination">
    @if ($paginator->onFirstPage())
        <li class="pa-dis">
            <a href="#" disabled><i class="bi bi-chevron-left"></i></a>
        </li>
    @else
        <li class="pa-left">
            <a href="{{ $paginator->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a>
        </li>
    @endif
    @foreach ($elements as $element)
        @if (is_string($element))
            <li><span>{{ $element }}</span></li>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="pa-left">
                        <a class="active" href="#0">{{ $page }}</a>
                    </li>
                @else
                    <li>
                        <a href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
        <li class="pa-left">
            <a href="{{ $paginator->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a>
        </li>
    @else
        <li class="pa-dis">
            <a href="#"><i class="bi bi-chevron-right"></i></a>
        </li>
    @endif
</ul>
