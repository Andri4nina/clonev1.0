{{--  @if($paginator->hasPages())


<div class="mb-4 mr-4 justify-between pagination">
    @if($paginator->onFirstPage())
        <a href="#" disabled>&laquo;</a>
    @else
        <a class="active_page"href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
    @endif

    @foreach ($elements as $element)
        @if(is_string($element))
            <a href="">{{ $element }}</a>
        @endif
            @if(is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active_page" href="#">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
    @endforeach


     



    @if($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
    @else
        <a href="#">&raquo;</a>  
    @endif






</div>


@endif  --}}



<div class="flex gap-2">
    <div class="pagination">
        <i class="bx bx-chevrons-left"></i>
    </div>

    <div class="pagination">
        <i class="bx bx-chevron-left"></i>
    </div>


    <div class="pagination">
        <i>1</i>
    </div>


    <div class="pagination">
        <i class="bx bx-chevron-right"></i>
    </div>


    <div class="pagination">
        <i class="bx bx-chevrons-right"></i>
    </div>


</div>