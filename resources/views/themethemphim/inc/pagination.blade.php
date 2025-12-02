@if ($paginator->hasPages())
    <div class="text-center flex flex-wrap justify-center items-center gap-2 mt-6">
        @if ($paginator->onFirstPage())
        @else
            <a class="bg-[#FFFFFF10] hover:bg-[#FFFFFF30] px-4 py-2 rounded-md" href="{{ $paginator->previousPageUrl() }}" title="Prev page">←</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                {{ $element }}
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="hover:bg-[#FFFFFF30] text-primary bg-[#FFFFFF30] px-4 py-2 rounded-md">{{ $page }}</a>
                    @else
                        <a class="bg-[#FFFFFF10] hover:bg-[#FFFFFF30] px-4 py-2 rounded-md" href="{{ $url }}" title="View page {{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a class="bg-[#FFFFFF10] hover:bg-[#FFFFFF30] px-4 py-2 rounded-md" href="{{ $paginator->nextPageUrl() }}" title="View next page">→</a>
        @else
        @endif
    </div>
@endif
