@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>

<style>
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin-top: 1rem;
        flex-wrap: wrap; /* Allow pagination items to wrap */
    }

    .pagination li {
        margin-right: 0.5rem;
    }

    .pagination li a,
    .pagination li span,
    .pagination li button  {
        display: inline-block;
        text-decoration: none;
        padding: 0.25rem 0.5rem ;
        border: 1px solid #ddd;
        border-radius: 0.25rem;
        color: #333;
        font-size: 1rem;
        cursor: pointer;
        background-color: transparent;
    }

    .pagination li a:hover,
    .pagination li span:hover,
    .pagination li button:hover{
        opacity: 0.7 !important;
    }

    .pagination .active a {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .pagination .inactive a {
        background-color: #fff;
        color: #333;
        border-color: #ddd;
        cursor: not-allowed;
    }

    /* Style for the current page link */
    .pagination .active span {
        background-color: #2A4C4E; 
        color: #007bff;
        cursor: default;
    }

    .page-link{
        background-color: #fff !important;
    }

    @media only screen and (max-width: 600px) {
        .pagination li {
            margin-right: 0;
            margin-bottom: 0.5rem; /* Add space between pagination items on small screens */
        }
    }
</style>


@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <button type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="@lang('pagination.previous')">&lsaquo;</button>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}"><button type="button" class="page-link inactive" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}">{{ $page }}</button></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="page-link" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="@lang('pagination.next')">&rsaquo;</button>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
</div>
