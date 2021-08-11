@if ($paginator->lastPage() > 1)

<ul>
    <li><a class="next {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}" href="{{ $paginator->url($paginator->currentPage()-1) }}"><i class="fa fa-chevron-left"></i></a></li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li>
            <a href="{{ $paginator->url($i) }}"><span class="{{ ($paginator->currentPage() == $i) ? ' current' : '' }}">{{ $i }}</span></a>
        </li>
    @endfor

    <li><a class="next {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" href="{{ $paginator->url($paginator->currentPage()+1) }}"><i class="fa fa-chevron-right"></i></a></li>
</ul>

@endif
