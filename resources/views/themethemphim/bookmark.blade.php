@extends('themes::themethemphim.layout')

@php
@endphp
@section('content')
<main class="pb-[32px] lg:pb-[100px] mt-[calc(var(--header-height)+16px)] lg:mt-[calc(var(--header-height)+52px)]">
    <section class="container">
        <div class="flex items-center justify-between max-[1132px]:justify-center">
            <h1 class="typography font-title text-[40px] leading-[100%] font-normal max-[1132px]:hidden">Bookmark</h1>

        </div>
    </section>
    <section class="lg:mt-16 container mt-8">
        <div>
            <ul class="grid grid-cols-3 sm:grid-cols-5 lg:grid-cols-7 gap-3 gap-y-5 lg:gap-4 lg:gap-y-7">
               @foreach ($movies as $item)
                    @if ($item->movie)
                        @php
                            $movie = $item->movie;
                        @endphp
                    @include('themes::themethemphim.inc.section_movies_item')
                    @endif
                    @endforeach
                </ul>
            </ul>
            {{ $movies->appends(request()->all())->links('themes::themethemphim.inc.pagination') }}
        </div>
    </section>
</main>
@endsection
