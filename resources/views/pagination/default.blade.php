@if ($paginator->currentPage() != 1)
<a href="{{ $paginator->url($paginator->currentPage()-1) }}">
  <span aria-hidden="true">&lt;</span>
  {{-- Previous --}}
</a>
@endif
@for ($i = 1; $i <= $paginator->lastPage(); $i++)
  @if ($paginator->currentPage() === $i)
  <div class="div-active page-link">{{ $i }}</div>
  @else
  <a class="page-link"href="{{ $paginator->url($i) }}">{{ $i }}</a>
  @endif
  @endfor
  @if ($paginator->currentPage() != $paginator->lastPage())
  <a class='page-link' href="{{ $paginator->url($paginator->currentPage()+1) }}">
    <span aria-hidden="true">&gt;</span>
    {{-- Next --}}
  </a>
  @endif