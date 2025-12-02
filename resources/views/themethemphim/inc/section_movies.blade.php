<section class="mt-10 lg:mt-16 container">
    <div class="flex items-center justify-between pb-3 lg:pb-6">
        <a class="flex items-center gap-2 lg:gap-3" href="{{$item['link']}}">
            <h2 class="typography font-title lg:text-[32px] lg:leading-[normal] text-[24px] leading-[32px] font-normal">{{$item['label']}}</h2>
            <div class="cursor-pointer flex items-center gap-[8px] text-[16px] lg:text-[24px] pt-1 lg:pt-2">
                <svg width="0.66em" height="1em" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.83 5.29001L2.59 1.05001C2.49704 0.956281 2.38644 0.881887 2.26458 0.831118C2.14272 0.780349 2.01202 0.754211 1.88 0.754211C1.74799 0.754211 1.61729 0.780349 1.49543 0.831118C1.37357 0.881887 1.26297 0.956281 1.17 1.05001C0.983753 1.23737 0.879211 1.49082 0.879211 1.75501C0.879211 2.0192 0.983753 2.27265 1.17 2.46001L4.71 6.00001L1.17 9.54001C0.983753 9.72737 0.879211 9.98082 0.879211 10.245C0.879211 10.5092 0.983753 10.7626 1.17 10.95C1.26344 11.0427 1.37426 11.116 1.4961 11.1658C1.61794 11.2155 1.7484 11.2408 1.88 11.24C2.01161 11.2408 2.14207 11.2155 2.26391 11.1658C2.38575 11.116 2.49656 11.0427 2.59 10.95L6.83 6.71001C6.92373 6.61705 6.99813 6.50645 7.04889 6.38459C7.09966 6.26273 7.1258 6.13202 7.1258 6.00001C7.1258 5.868 7.09966 5.73729 7.04889 5.61543C6.99813 5.49357 6.92373 5.38297 6.83 5.29001Z" fill="currentColor"></path></svg>
            </div>
        </a>
    </div>
    <div>
        <ul class="grid grid-cols-3 sm:grid-cols-5 lg:grid-cols-7 gap-3 gap-y-5 lg:gap-4 lg:gap-y-7">
            @foreach ($item['data'] as $movie)
                @include('themes::themethemphim.inc.section_movies_item')
            @endforeach
        </ul>
    </div>
</section>
