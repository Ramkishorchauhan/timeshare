@if ($paginator->hasPages())
<ul class="ts-pagination">
        @if ($paginator->onFirstPage())
        <li class="disabled" id="example_previous">
            <a href="#" aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
        </li>
        @else
        <li class="active" id="example_previous">
            <a href="{{ $paginator->previousPageUrl() }}" aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
        </li>
        @endif
      
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled">{{ $element }}</li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active">
                            <a class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        @if ($paginator->hasMorePages())
            <li class="active" id="example_next">
                <a href="{{ $paginator->nextPageUrl() }}" aria-controls="example" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
            </li>
        @else
            <li class="disabled">
                <a class="page-link" href="#">Next</a>
            </li>
        @endif
    </ul>
@endif

