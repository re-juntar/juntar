@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="bg-white-ghost rounded">
        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span
                            class="relative block py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-gray-800 focus:shadow-none"
                            aria-hidden="true">
                            &laquo;
                        </span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="page-link relative block py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-awesome hover:bg-gray-200 focus:shadow-none"
                        aria-label="{{ __('pagination.previous') }}">
                        &laquo;
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span
                                class="relative block py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-gray-800 focus:shadow-none">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    <span
                                        class="relative block py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-gray-800 focus:shadow-none">{{ $page }}</span>
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="hidden sm:block page-link relative py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-awesome hover:bg-gray-200 focus:shadow-none"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="page-link relative block py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-awesome hover:bg-gray-200 focus:shadow-none"
                        aria-label="{{ __('pagination.next') }}">
                        &raquo;
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span
                            class="relative block py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-gray-800 focus:shadow-none"
                            aria-hidden="true">
                            &raquo;
                        </span>
                    </span>
                @endif
            </span>
        </div>
    </nav>
@endif
