@if ($paginator->hasPages())
    
    <style>
        li{
            list-style: none;
        }
    </style>

    


    <nav class="mt-4 mr-4 float-right">
        <ul class="btn-group">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="btn btn-outline-light">Précédent</a>
            @else
                <a class="btn btn-outline-light"  href="{{ $paginator->previousPageUrl()}}" rel="Prev">Précédent</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a  class="btn btn-outline-light ">{{ $element }}</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a  class="btn btn-outline-light active">{{ $page }}</a>
                        @else
                            <a class="btn btn-outline-light"  href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="btn btn-outline-light"  href="{{ $paginator->nextPageUrl() }}" rel="Next">Suivant</a>
            @else
                <a class="btn btn-outline-light">Suivant</a>
            @endif
        </ul>
    </nav>
@endif
