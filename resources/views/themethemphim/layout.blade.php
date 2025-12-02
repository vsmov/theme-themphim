@extends('themes::layout')

@php
    $menu = \Vsphim\Core\Models\Menu::getTree();
@endphp

@push('header')
    <link rel="stylesheet" href="/themes/themphim/css/app.css" type="text/css">
    <script src="/themes/themphim/js/jquery.min.js?v3.7.1" type="text/javascript"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <link
    rel="stylesheet"
    href="https://unpkg.com/tippy.js@6/animations/scale.css"
    />
    <style>
        .tippy-box[data-theme~='custom'] {
            background-color: transparent;
            border: none;
            width: 110%;
            height: 100%;
            padding: 0;
            margin: 0;
            margin-left: -5%;
        }

        .tippy-box[data-theme~='custom'] .tippy-content {
            padding: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endpush

@section('body')
    <div class="relative">
        @include('themes::themethemphim.inc.header')
        <div class="relative min-h-[100vh]">
            @yield('content')
        </div>
    </div>
    <button class="a-button btn-go-to-top hidden rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] font-content whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 bg-default-400 hover:bg-default-300 h-10 gap-[0.625rem] aspect-square w-auto p-0 max-sm:h-9 fixed right-5 bottom-8 sm:right-14 sm:bottom-20 border border-foreground-600/10 duration-300" type="button" aria-label="To top"><svg width="1em" height="0.667em" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-primary"><path d="M1.41 7.41L6 2.83L10.59 7.41L12 6L6 0L0 6L1.41 7.41Z" fill="currentColor"></path></svg></button>
@endsection

@push('scripts')
@endpush

@section('footer')
    {!! get_theme_option('footer') !!}
    <script src="/themes/themphim/js/app.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $("img.lazy").lazyload({
                effect: "fadeIn"
            });
        });
    </script>
    {!! setting('site_scripts_google_analytics') !!}
@endsection
