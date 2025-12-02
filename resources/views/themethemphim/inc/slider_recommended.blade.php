<section class="xl:pb-0 lg:pb-[76px] pb-0">
    <div class="relative">
        <div class="swiper-recommended swiper">
            <div class="swiper-wrapper">
                @foreach ($recommendations as $movie)
                    <div class="swiper-slide w-full">
                        <div class="flex items-center relative min-[1700px]:aspect-[1920/850] min-[1800px]:aspect-[1920/800] xl:aspect-[1920/1000] lg:aspect-[1920/1000]">
                            <div class="absolute inset-0 blur-[50px] max-lg:hidden" style="transform:translate3d(0, 0, 0)">
                                <img alt="{{$movie->name}}" class="object-cover lazy" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" data-original="{{$movie->getPosterUrl()}}">
                            </div>
                            <div class="absolute inset-0" style="background-image:linear-gradient(to right, hsl(var(--color-background) / 80%), transparent, hsl(var(--color-background) / 60%)"></div>
                            <div class="absolute inset-0" style="background-image:linear-gradient(to bottom, transparent, transparent 80%, hsl(var(--color-background) / 95%)"></div>
                            <div class="w-full relative lg:container">
                                <div class="flex items-center">
                                    <div class="flex flex-col shrink-0 max-lg:hidden w-[36%] xl:w-[23%]">
                                        <h3 class="typography font-alumniSans xl:text-[62px] xl:leading-[70px] text-[56px] leading-[60px] font-normal drop-shadow-placeOn line-clamp-3 !leading-[100%] !font-medium">{{$movie->name}}</h3>
                                        <div class="flex mt-4 xl:mt-6 item-center">
                                            <div class="justify-center items-center px-2 h-[32px] gap-1 bg-primary text-primary-foreground flex rounded-lg"><svg width="1em" height="0.952em" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg" font-size="18" class="pb-[2px]"><path d="M19.6693 7.2074C19.822 7.32633 19.9368 7.48699 20 7.6699C20.0486 7.85278 20.0444 8.0457 19.9877 8.22625C19.9311 8.4068 19.8244 8.56758 19.68 8.6899L15.55 12.6899L16.55 18.3699C16.5857 18.5574 16.567 18.7512 16.4961 18.9284C16.4252 19.1055 16.3051 19.2588 16.15 19.3699C15.9784 19.4941 15.7718 19.5607 15.56 19.5599C15.3988 19.5604 15.2403 19.5191 15.1 19.4399L9.99998 16.7599L4.87998 19.4299C4.71575 19.517 4.5305 19.5566 4.34503 19.5442C4.15955 19.5318 3.98119 19.468 3.82998 19.3599C3.67483 19.2488 3.55473 19.0955 3.48385 18.9184C3.41297 18.7412 3.39428 18.5474 3.42998 18.3599L4.42998 12.6799L0.299977 8.6799C0.171435 8.55163 0.080249 8.39077 0.0362052 8.21459C-0.00783865 8.03842 -0.00307759 7.85358 0.0499774 7.6799C0.107937 7.50218 0.214554 7.34425 0.357728 7.22406C0.500902 7.10386 0.6749 7.02621 0.859977 6.9999L6.54998 6.1599L9.09998 0.999901C9.18186 0.83083 9.30971 0.688243 9.46889 0.588475C9.62806 0.488706 9.81212 0.435791 9.99998 0.435791C10.1878 0.435791 10.3719 0.488706 10.5311 0.588475C10.6902 0.688243 10.8181 0.83083 10.9 0.999901L13.45 6.1699L19.14 6.9999C19.3328 7.0164 19.5167 7.08848 19.6693 7.2074Z" fill="currentColor"></path></svg><p class="typography font-content text-[14px] leading-[normal] font-semibold mt-[2px]">{{$movie->rating_star}}</p></div>
                                            <ul class="flex items-center [&amp;_li:last-child]:border-r-0"><li class="px-3 border-r"><p class="typography font-content text-[14px] leading-[normal] font-semibold">{{$movie->publish_year}}</p></li></ul>
                                        </div>
                                        <ul class="flex gap-2 flex-wrap empty:hidden mt-6">
                                            @foreach($movie->categories as $category)
                                            <li>
                                                <a class="a-button rounded-lg flex items-center justify-center [&:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 bg-default-400 hover:bg-default-300 h-6 px-2.5 text-[14px]" href="{{$category->getUrl()}}">
                                                    {{$category->name}}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <div class="mt-6">
                                            <p class="typography font-content text-[1rem] leading-[24px] font-normal line-clamp-4">
                                                {!! $movie->content !!}
                                            </p>
                                            <div class="flex mt-6 items-center gap-6">
                                                <a class="a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-400 text-primary-foreground h-12 px-6 text-[1rem] gap-[0.625rem] font-semibold" href="{{$movie->getUrl()}}">
                                                    <svg width="0.9em" height="1em" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.70651 19.8698L17.2865 10.8698C17.4404 10.7826 17.5684 10.6561 17.6575 10.5033C17.7465 10.3504 17.7935 10.1767 17.7935 9.99982C17.7935 9.82293 17.7465 9.6492 17.6575 9.49636C17.5684 9.34352 17.4404 9.21704 17.2865 9.12982L1.70651 0.129824C1.55449 0.0420552 1.38205 -0.00415111 1.20651 -0.00415112C1.03097 -0.00415112 0.858528 0.0420552 0.706509 0.129824C0.553904 0.217928 0.42729 0.344792 0.339487 0.497569C0.251684 0.650347 0.205809 0.823613 0.206509 0.999823L0.206508 18.9998C0.205808 19.176 0.251683 19.3493 0.339486 19.5021C0.427289 19.6549 0.553903 19.7817 0.706508 19.8698C0.858527 19.9576 1.03097 20.0038 1.20651 20.0038C1.38204 20.0038 1.55449 19.9576 1.70651 19.8698Z" fill="currentColor"></path></svg>Xem
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="min-w-0 lg:ml-[2.6%] ml-0 xl:w-[59%] max-xl:grow">
                                        <div class="aspect-[920/644] sm:aspect-[988/456] lg:aspect-[920/644] w-full relative rounded-lg overflow-hidden">
                                            <img alt="{{$movie->name}}" class="object-cover lazy" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" data-original="{{$movie->getPosterUrl()}}">
                                        </div>
                                        <div class="absolute inset-0 lg:hidden" style="background-image:linear-gradient(to bottom, hsl(var(--color-background) / 80%), transparent 15%, transparent 70%, hsl(var(--color-background) / 100%)">
                                        </div>
                                    </div>
                                    <div class="py-3 lg:hidden absolute bottom-0 inset-x-0">
                                        <div class="absolute inset-0 lg:hidden" style="background-image:linear-gradient(to bottom, transparent, hsl(var(--color-background) / 100%)"></div>
                                        <div class="flex container relative items-end gap-3">
                                            <div class="grow min-w-0 min-h-[38px]">
                                                <h3 class="typography font-alumniSans text-[40px] leading-[100%] font-medium line-clamp-2 drop-shadow-placeOn">{{$movie->name}}</h3>
                                                <p class="typography font-content text-[1rem] leading-[24px] font-normal max-sm:hidden line-clamp-4">
                                                    {!! $movie->content !!}
                                                </p>
                                                <div class="flex items-center gap-2 mt-2">
                                                    <div class="flex items-center gap-1 text-primary">
                                                        <svg width="1em" height="0.952em" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[10px]"><path d="M19.6693 7.2074C19.822 7.32633 19.9368 7.48699 20 7.6699C20.0486 7.85278 20.0444 8.0457 19.9877 8.22625C19.9311 8.4068 19.8244 8.56758 19.68 8.6899L15.55 12.6899L16.55 18.3699C16.5857 18.5574 16.567 18.7512 16.4961 18.9284C16.4252 19.1055 16.3051 19.2588 16.15 19.3699C15.9784 19.4941 15.7718 19.5607 15.56 19.5599C15.3988 19.5604 15.2403 19.5191 15.1 19.4399L9.99998 16.7599L4.87998 19.4299C4.71575 19.517 4.5305 19.5566 4.34503 19.5442C4.15955 19.5318 3.98119 19.468 3.82998 19.3599C3.67483 19.2488 3.55473 19.0955 3.48385 18.9184C3.41297 18.7412 3.39428 18.5474 3.42998 18.3599L4.42998 12.6799L0.299977 8.6799C0.171435 8.55163 0.080249 8.39077 0.0362052 8.21459C-0.00783865 8.03842 -0.00307759 7.85358 0.0499774 7.6799C0.107937 7.50218 0.214554 7.34425 0.357728 7.22406C0.500902 7.10386 0.6749 7.02621 0.859977 6.9999L6.54998 6.1599L9.09998 0.999901C9.18186 0.83083 9.30971 0.688243 9.46889 0.588475C9.62806 0.488706 9.81212 0.435791 9.99998 0.435791C10.1878 0.435791 10.3719 0.488706 10.5311 0.588475C10.6902 0.688243 10.8181 0.83083 10.9 0.999901L13.45 6.1699L19.14 6.9999C19.3328 7.0164 19.5167 7.08848 19.6693 7.2074Z" fill="currentColor"></path></svg>
                                                        <p class="typography font-content text-[12px] font-bold leading-[100%]">{{$movie->rating_star}}</p>
                                                    </div>
                                                    <p class="typography font-content text-[12px] leading-[normal] font-normal border-l border-foreground-700 pl-2">{{$movie->publish_year}}</p>
                                                    <p class="typography font-content text-[12px] leading-[normal] font-normal border-l border-foreground-700 pl-2">{{$movie->episode_total}}</p>
                                                </div>
                                                <ul class="flex mt-2 gap-2 flex-wrap empty:hidden">
                                                    @foreach ($movie->categories as $category)
                                                        <li>
                                                            <a class="a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 bg-default-400 hover:bg-default-300 h-5 px-2 text-[12px]" href="{{$category->getUrl()}}">{{$category->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="flex flex-col items-center gap-3">
                                                <div>
                                                    <a class="a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-400 text-primary-foreground h-9 gap-3 aspect-square w-auto p-0" href="{{$movie->getUrl()}}">
                                                        <svg width="0.9em" height="1em" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.70651 19.8698L17.2865 10.8698C17.4404 10.7826 17.5684 10.6561 17.6575 10.5033C17.7465 10.3504 17.7935 10.1767 17.7935 9.99982C17.7935 9.82293 17.7465 9.6492 17.6575 9.49636C17.5684 9.34352 17.4404 9.21704 17.2865 9.12982L1.70651 0.129824C1.55449 0.0420552 1.38205 -0.00415111 1.20651 -0.00415112C1.03097 -0.00415112 0.858528 0.0420552 0.706509 0.129824C0.553904 0.217928 0.42729 0.344792 0.339487 0.497569C0.251684 0.650347 0.205809 0.823613 0.206509 0.999823L0.206508 18.9998C0.205808 19.176 0.251683 19.3493 0.339486 19.5021C0.427289 19.6549 0.553903 19.7817 0.706508 19.8698C0.858527 19.9576 1.03097 20.0038 1.20651 20.0038C1.38204 20.0038 1.55449 19.9576 1.70651 19.8698Z" fill="currentColor"></path></svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="absolute container flex items-center pointer-events-none max-lg:hidden bottom-0 xl:inset-0 justify-end max-xl:translate-y-2/3 thumbs-slider">
            <ul class="flex flex-row xl:flex-col pointer-events-auto justify-between w-full xl:w-[13.9%] xl:aspect-[204/605] gap-5 xl:gap-0">
                @foreach ($recommendations as $movie)
                        <li class="max-xl:aspect-[16/9] max-xl:w-1/5 item-thumb">
                            <div class="aspect-[16/9] bg-default relative cursor-pointer hover:brightness-110 duration-300 rounded-lg overflow-hidden">
                                <img alt="{{$movie->name}}" class="object-cover lazy" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" data-original="{{$movie->getPosterUrl()}}">
                                <div class="absolute thumb-overlay inset-0 pointer-events-none border-2 border-primary opacity-0 duration-300 rounded-lg overflow-hidden"></div>
                            </div>
                        </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

