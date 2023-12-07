@if($paginator->hasPages())
<div class="flex gap-2">
    @if($paginator->onFirstPage())
     

        @else
        <a class="active_page"href="{{ $paginator->previousPageUrl() }}">
            <div class="pagination">
                <i class="bx bx-chevron-left"></i>
            </div>
        </a>
        @endif

        @foreach ($elements as $element)
        @if(is_string($element))
            <a href="">
                {{ $element }}</a>
        @endif
            @if(is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active_page" href="#"> 
                            <div class="pagination active">
                                <i>{{ $page }}</i>
                             </div>
                        </a>
                    @else
                        <a href="{{ $url }}"> 
                            <div class="pagination ">
                            <i>{{ $page }}</i>
                            </div>
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

         


           

            @if($paginator->hasMorePages())
         
            <a href="{{ $paginator->nextPageUrl() }}">  
                <div class="pagination">
                    <i class="bx bx-chevron-right"></i>
                </div>
            </a>
            @else
               
            @endif

         


         

        </div>
@endif   