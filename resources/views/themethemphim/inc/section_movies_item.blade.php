<li class="max-sm:[&:nth-child(n+10)]:hidden max-lg:[&:nth-child(n+11)]:hidden relative">
    <div class="typpy">
        <a class="block o-filmCard duration-300 relative group/film " title="{{$movie->name}}" href="{{$movie->getUrl()}}">
            <div class="relative aspect-[228/304] overflow-hidden cursor-pointer rounded-lg">
                <img alt="{{$movie->name}}" class="object-cover lazy" data-original="{{$movie->getThumbUrl()}}" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                <div class="absolute inset-x-0 bottom-0" style="background-image: linear-gradient(0deg, rgba(10, 12, 15, 0.8) 0%, rgba(10, 12, 15, 0.74) 4%, rgba(10, 12, 15, 0.59) 17%, rgba(10, 12, 15, 0.4) 34%, rgba(10, 12, 15, 0.31) 55%, rgba(10, 12, 15, 0.1) 78%, rgba(10, 12, 15, 0) 100%);"></div>
            </div>
            <div class="mt-4 min-h-[34px] lg:min-h-[53px]">
                <h3 class="typography font-content text-[14px] group-hover/film:text-primary duration-300 cursor-pointer line-clamp-2 font-medium leading-[1.5]">{{$movie->name}}</h3>
                <p class="typography line-clamp-2 font-content text-[12px] leading-[normal] font-normal mt-2 max-lg:hidden text-foreground-600/80">{{$movie->origin_name}}</p>
            </div>
            <div class="hidden">
                @foreach ($movie->categories as $genre)
                    <a class="genre" href="{{$genre->getUrl()}}">{{$genre->name}}</a>
                @endforeach
                <div class="content">
                    {{$movie->content}}
                </div>
                <div class="publish_year">
                    {{$movie->publish_year}}
                </div>
                <div class="episodes">
                    {{$movie->episode_total}}
                </div>
            </div>
        </a>
    </div>
</li>
