@if ($paginator->hasPages())
    <ul class="pagination-list">
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <a href="javascript:void(0)">
                    <i class="lni lni-chevron-left"></i>
                </a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}">
                    <i class="lni lni-chevron-left"></i>
                </a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="{{ $page == $paginator->currentPage() ? 'active' : '' }}">
                        <a href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}">
                    <i class="lni lni-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="disabled">
                <a href="javascript:void(0)">
                    <i class="lni lni-chevron-right"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
