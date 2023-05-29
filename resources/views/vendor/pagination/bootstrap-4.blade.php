@if ($paginator->hasPages())
        <nav>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item page-navigation__item page-navigation__next">
                        <a class="page-link page-navigation__link" aria-label="Previous">
                            <span aria-hidden="true">
                               <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#f27319" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="bevel"><circle cx="12" cy="12" r="10"/><path d="M12 8l-4 4 4 4M16 12H9"/></svg>
                            </span>
                        </a>
                    </li>
                @else
                    <li class="page-item page-navigation__item page-navigation__prev">
                        <a class="page-link page-navigation__link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#f27319" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="bevel"><circle cx="12" cy="12" r="10"/><path d="M12 8l-4 4 4 4M16 12H9"/></svg>
                            </span>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item page-navigation__item"><a class="page-link page-navigation__link">{{ $element }}</a></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item page-navigation__item"><a class="page-link page-navigation__link active">{{ $page }}</a></li>
                            @else
                                <li class="page-item page-navigation__item"><a href="{{ $url }}" class="page-link page-navigation__link">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item page-navigation__item page-navigation__next">
                        <a class="page-link page-navigation__link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                           <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#f27319" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="bevel"><circle cx="12" cy="12" r="10"/><path d="M12 8l4 4-4 4M8 12h7"/></svg>
                        </a>
                    </li>
                @else
                    <li class="page-item page-navigation__item page-navigation__prev">
                        <a class="page-link page-navigation__link" aria-label="Next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#f27319" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="bevel"><circle cx="12" cy="12" r="10"/><path d="M12 8l4 4-4 4M8 12h7"/></svg>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
