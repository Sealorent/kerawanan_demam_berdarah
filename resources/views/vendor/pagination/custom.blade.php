@if ($paginator->hasPages())
<div class="d-flex justify-content-end" style="margin-right: 14px !important;">
    <nav class="mt-2" aria-label="Page navigation">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
            <li class="page-item prev disabled">
                <a class="page-link"><i class="tf-icon bx bx-chevron-left"></i></a>
            </li>
            @else
            <li class="page-item prev">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i
                        class="tf-icon bx bx-chevron-left"></i></a>
            </li>
            @endif

            @foreach ($elements as $element)
            @if (is_string($element))
            <li class="page-item disabled">
                <a class="page-link">{{ $element }}</a>
            </li>
            @endif
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="page-item active">
                <a class="page-link">{{ $page }}</a>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $url }}">{{ $page}}</a>
            </li>
            @endif
            @endforeach
            @endif
            @endforeach

            @if ($paginator->hasMorePages())
            <li class="page-item next">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <i class="tf-icon bx bx-chevron-right"></i>
                </a>
            </li>
            @else
            <li class="page-item next disabled">
                <a class="page-link">
                    <i class="tf-icon bx bx-chevron-right"></i>
                </a>
            </li>
            @endif
        </ul>
    </nav>
</div>
@endif
