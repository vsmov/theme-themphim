@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp
<header class="group/header fixed inset-x-0 top-0 h-[--header-height] z-zHeader border-b border-transparent duration-300 data-[top=false]:border-foreground-700/20">
    <div class="absolute inset-0" style="background-image:linear-gradient(to top, transparent, hsl(var(--color-background) / 80%)"></div>
    <div class="absolute inset-0 duration-300 bg-transparent" id="overlay_header"></div>
    <div class="flex relative items-center justify-between container h-full">
        <div class="flex items-center">
            <div class="flex items-center">
                <div class="shrink-0 sm:hidden -ml-2 pr-2">
                    <button class="a-button rounded-lg btn-toggle-sidebar flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 lg:hover:bg-default-400 h-8 gap-2 bg-transparent aspect-square w-auto p-0" data-variant="text" type="button" aria-label="Hamburger icon">
                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20 2.88885H0V0.666626H20V2.88885Z" fill="currentColor"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M20 10.1111H0V7.88892H20V10.1111Z" fill="currentColor"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M20 17.3333H0V15.1111H20V17.3333Z" fill="currentColor"></path></svg>
                    </button>
                </div>
                <a class="block w-[120px] lg:w-[180px] relative aspect-[524/81]" aria-label="Home" href="/">
                    <div aria-label="logo" class="w-full relative aspect-[524/81]">
                        @if ($logo)
                            {!! $logo !!}
                        @else
                            {!! $brand !!}
                        @endif
                    </div>
                </a>
            </div>
            <ul class="flex justify-center items-center gap-8 ml-10 max-sm:hidden">
                @foreach ($menu as $item)
                    @if (count($item['children']))
                    <li class="relative menu-item">
                        <div class="data-[state=open]:text-primary">
                            <a class="flex gap-2 items-center hover:text-primary cursor-pointer" aria-label="{{ $item['name'] }}" href="{{$item['link']}}">
                                <p class="typography font-content lg:text-[1rem] lg:leading-[24px] text-[14px] leading-[normal] font-normal">{{ $item['name'] }}</p>
                                <svg width="1em" height="0.667em" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[12px]"><path d="M11 1.17C10.8126 0.983749 10.5592 0.879208 10.295 0.879208C10.0308 0.879208 9.77736 0.983749 9.58999 1.17L5.99999 4.71L2.45999 1.17C2.27263 0.983749 2.01918 0.879208 1.75499 0.879208C1.49081 0.879208 1.23736 0.983749 1.04999 1.17C0.956266 1.26296 0.881872 1.37356 0.831103 1.49542C0.780334 1.61728 0.754196 1.74799 0.754196 1.88C0.754196 2.01201 0.780334 2.14272 0.831103 2.26458C0.881872 2.38644 0.956266 2.49704 1.04999 2.59L5.28999 6.83C5.38296 6.92373 5.49356 6.99812 5.61542 7.04889C5.73728 7.09966 5.86798 7.1258 5.99999 7.1258C6.13201 7.1258 6.26271 7.09966 6.38457 7.04889C6.50643 6.99812 6.61703 6.92373 6.70999 6.83L11 2.59C11.0937 2.49704 11.1681 2.38644 11.2189 2.26458C11.2697 2.14272 11.2958 2.01201 11.2958 1.88C11.2958 1.74799 11.2697 1.61728 11.2189 1.49542C11.1681 1.37356 11.0937 1.26296 11 1.17Z" fill="currentColor"></path></svg>
                            </a>
                        </div>
                        <div class="absolute hidden menu-item-children rounded-lg border border-foreground/10 bg-content-1 shadow-md outline-none data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2 p-0" style="top: 140%; left: -330%">
                            <div class="w-screen max-w-[600px] max-h-[60vh] overflow-auto">
                                <ul class="grid grid-cols-4 gap-3 p-4">
                                    @foreach ($item['children'] as $children)
                                        <li>
                                            <a rel="nofollow noreferrer" class="block cursor-pointer text-foreground-600 hover:text-primary relative px-2" href="{{ $children['link'] }}">
                                                <p class="typography font-content text-[14px] leading-[normal] font-normal">{{ $children['name'] }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                    @else
                    <li>
                        <a class="flex gap-2 items-center hover:text-primary relative" aria-label="{{ $item['name'] }}" href="{{$item['link']}}">
                            <p class="typography font-content lg:text-[1rem] lg:leading-[24px] text-[14px] leading-[normal] font-normal">{{ $item['name'] }}</p>
                        </a>
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="flex items-center gap-[0.625rem]">
            <div style="--mobile-size:1132px">
                <form action="/" class="relative">
                    <input name="search" class="block input-search w-full a-input outline-none font-content border-default h-9 px-4 text-[1rem] relative z-zContent max-[1132px]:hidden duration-300 bg-default-400/80 pr-10 group-data-[top=true]/header:bg-default-400/70 rounded-lg" placeholder="Tên phim, diễn viên">
                    <button class="a-button btn-search rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 h-9 gap-3 bg-transparent hover:bg-transparent aspect-square w-auto p-0 hover:text-primary absolute z-zContent right-0 top-1/2 -translate-y-1/2 text-foreground-600/90 min-[1132px]:text-foreground-700" data-variant="textOnly" type="button" aria-label="Search"><svg width="1em" height="1em" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" class=""><path d="M7.67077 14.3415C11.3549 14.3415 14.3415 11.3549 14.3415 7.67077C14.3415 3.98661 11.3549 1 7.67077 1C3.98661 1 1 3.98661 1 7.67077C1 11.3549 3.98661 14.3415 7.67077 14.3415Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M16.9999 17.0002L12.3845 12.3848" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg><div class="absolute border-l h-[60%] w-[1px] border-[currentColor] left-0 opacity-80"></div></button>
                </form>
            </div>
            <div class="relative">
                @if (!auth()->check())
                <button class="a-button btn-toggle-modal-auth rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 bg-default-400 hover:bg-default-300 h-9 px-4 gap-3" type="button">Đăng nhập</button>
                @else
                <button type="button" class="btn-toggle-profile-menu">
                    <div class="outline-none">
                        <div class="relative ring-primary rounded-full cursor-pointer data-[state=open]:ring-[2px] lg:w-10 lg:h-10 h-9 w-9" style="width: 2.25rem">
                            <span style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                                <img title="avatar" alt="avatar"src="{{auth()->user()->avatar ??  '/themes/themphim/images/default.png'}}" class="rounded-full"
                                    style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%; object-fit: cover;">
                            </span>
                        </div>
                    </div>
                </button>
                <div style="top: 110%" class="absolute right-0 hidden" id="profile-menu">
                    <div class="w-[280px] border border-default outline-none shadow-[rgba(26,26,29,0.06)_2px_2px_8px_3px] will-change-[transform,opacity] data-[state=open]:data-[side=top]:animate-slideDownAndFade data-[state=open]:data-[side=bottom]:animate-slideUpAndFade data-[state=open]:data-[side=right]:animate-slideLeftAndFade data-[state=open]:data-[side=left]:animate-slideRightAndFade rounded-lg bg-default">
                        <div>
                            <div class="">
                                <a href="{{route('themphim.profile')}}" class="flex items-center justify-start gap-4 px-4 hover:bg-default-400 py-3">
                                    <div class="flex flex-col gap-1">
                                        <p class="typography font-sans-text text-[1rem] font-semibold leading-[normal]">{{auth()->user()->name}}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="flex flex-col p-4 py-2 px-0">
                                <div class="w-full">
                                    <a href="{{route('themphim.bookmark')}}" class="rounded-xl bg-primary-comment cursor-pointer hover:bg-default-400 h-[52px] lg:h-[48px] px-4 flex items-center justify-between lg:rounded-none">
                                        <div class="flex items-center gap-4">
                                            <span class="h-10 lg:h-8 w-10 lg:w-8 rounded-lg bg-primary-btn flex items-center justify-center">
                                                <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" font-size="18"><path d="M16 2H8.00001C7.20436 2 6.4413 2.31607 5.87869 2.87868C5.31608 3.44129 5.00001 4.20435 5.00001 5V21C4.99931 21.1762 5.04518 21.3495 5.13299 21.5023C5.22079 21.655 5.3474 21.7819 5.50001 21.87C5.65203 21.9578 5.82447 22.004 6.00001 22.004C6.17554 22.004 6.34799 21.9578 6.50001 21.87L12 18.69L17.5 21.87C17.6524 21.9564 17.8248 22.0012 18 22C18.1752 22.0012 18.3476 21.9564 18.5 21.87C18.6526 21.7819 18.7792 21.655 18.867 21.5023C18.9548 21.3495 19.0007 21.1762 19 21V5C19 4.20435 18.6839 3.44129 18.1213 2.87868C17.5587 2.31607 16.7957 2 16 2ZM17 19.27L12.5 16.67C12.348 16.5822 12.1755 16.536 12 16.536C11.8245 16.536 11.652 16.5822 11.5 16.67L7.00001 19.27V5C7.00001 4.73478 7.10536 4.48043 7.2929 4.29289C7.48044 4.10536 7.73479 4 8.00001 4H16C16.2652 4 16.5196 4.10536 16.7071 4.29289C16.8947 4.48043 17 4.73478 17 5V19.27Z" fill="currentColor"></path></svg>
                                            </span>
                                            <p class="typography font-sans-text text-[14px]">Bookmark</p>
                                        </div>
                                        <button class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-8 h-8 bg-transparent hover:bg-primary-btn-hover text-primary-text rounded-full min-w-8" aria-label="button">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 11.2899L10.59 7.04995C10.497 6.95622 10.3864 6.88183 10.2646 6.83106C10.1427 6.78029 10.012 6.75415 9.88 6.75415C9.74799 6.75415 9.61729 6.78029 9.49543 6.83106C9.37357 6.88183 9.26297 6.95622 9.17 7.04995C8.98375 7.23731 8.87921 7.49076 8.87921 7.75495C8.87921 8.01913 8.98375 8.27259 9.17 8.45995L12.71 11.9999L9.17 15.5399C8.98375 15.7273 8.87921 15.9808 8.87921 16.2449C8.87921 16.5091 8.98375 16.7626 9.17 16.9499C9.26344 17.0426 9.37426 17.116 9.4961 17.1657C9.61794 17.2155 9.7484 17.2407 9.88 17.2399C10.0116 17.2407 10.1421 17.2155 10.2639 17.1657C10.3857 17.116 10.4966 17.0426 10.59 16.9499L14.83 12.7099C14.9237 12.617 14.9981 12.5064 15.0489 12.3845C15.0997 12.2627 15.1258 12.132 15.1258 11.9999C15.1258 11.8679 15.0997 11.7372 15.0489 11.6154C14.9981 11.4935 14.9237 11.3829 14.83 11.2899Z" fill="currentColor"></path></svg>
                                        </button>
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a href="{{route('themphim.history')}}" class="rounded-xl bg-primary-comment cursor-pointer hover:bg-default-400 h-[52px] lg:h-[48px] px-4 flex items-center justify-between lg:rounded-none">
                                        <div class="flex items-center gap-4">
                                            <span class="h-10 lg:h-8 w-10 lg:w-8 rounded-lg bg-primary-btn flex items-center justify-center">
                                                <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" font-size="18"><path d="M16 14H8C7.73478 14 7.48043 14.1054 7.29289 14.2929C7.10536 14.4804 7 14.7348 7 15C7 15.2652 7.10536 15.5196 7.29289 15.7071C7.48043 15.8946 7.73478 16 8 16H16C16.2652 16 16.5196 15.8946 16.7071 15.7071C16.8946 15.5196 17 15.2652 17 15C17 14.7348 16.8946 14.4804 16.7071 14.2929C16.5196 14.1054 16.2652 14 16 14ZM16 10H10C9.73478 10 9.48043 10.1054 9.29289 10.2929C9.10536 10.4804 9 10.7348 9 11C9 11.2652 9.10536 11.5196 9.29289 11.7071C9.48043 11.8946 9.73478 12 10 12H16C16.2652 12 16.5196 11.8946 16.7071 11.7071C16.8946 11.5196 17 11.2652 17 11C17 10.7348 16.8946 10.4804 16.7071 10.2929C16.5196 10.1054 16.2652 10 16 10ZM20 4H17V3C17 2.73478 16.8946 2.48043 16.7071 2.29289C16.5196 2.10536 16.2652 2 16 2C15.7348 2 15.4804 2.10536 15.2929 2.29289C15.1054 2.48043 15 2.73478 15 3V4H13V3C13 2.73478 12.8946 2.48043 12.7071 2.29289C12.5196 2.10536 12.2652 2 12 2C11.7348 2 11.4804 2.10536 11.2929 2.29289C11.1054 2.48043 11 2.73478 11 3V4H9V3C9 2.73478 8.89464 2.48043 8.70711 2.29289C8.51957 2.10536 8.26522 2 8 2C7.73478 2 7.48043 2.10536 7.29289 2.29289C7.10536 2.48043 7 2.73478 7 3V4H4C3.73478 4 3.48043 4.10536 3.29289 4.29289C3.10536 4.48043 3 4.73478 3 5V19C3 19.7956 3.31607 20.5587 3.87868 21.1213C4.44129 21.6839 5.20435 22 6 22H18C18.7956 22 19.5587 21.6839 20.1213 21.1213C20.6839 20.5587 21 19.7956 21 19V5C21 4.73478 20.8946 4.48043 20.7071 4.29289C20.5196 4.10536 20.2652 4 20 4ZM19 19C19 19.2652 18.8946 19.5196 18.7071 19.7071C18.5196 19.8946 18.2652 20 18 20H6C5.73478 20 5.48043 19.8946 5.29289 19.7071C5.10536 19.5196 5 19.2652 5 19V6H7V7C7 7.26522 7.10536 7.51957 7.29289 7.70711C7.48043 7.89464 7.73478 8 8 8C8.26522 8 8.51957 7.89464 8.70711 7.70711C8.89464 7.51957 9 7.26522 9 7V6H11V7C11 7.26522 11.1054 7.51957 11.2929 7.70711C11.4804 7.89464 11.7348 8 12 8C12.2652 8 12.5196 7.89464 12.7071 7.70711C12.8946 7.51957 13 7.26522 13 7V6H15V7C15 7.26522 15.1054 7.51957 15.2929 7.70711C15.4804 7.89464 15.7348 8 16 8C16.2652 8 16.5196 7.89464 16.7071 7.70711C16.8946 7.51957 17 7.26522 17 7V6H19V19Z" fill="currentColor"></path></svg>
                                            </span>
                                            <p class="typography font-sans-text text-[14px]">Nhật ký</p>
                                        </div>
                                        <button class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-8 h-8 bg-transparent hover:bg-primary-btn-hover text-primary-text rounded-full min-w-8" aria-label="button">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 11.2899L10.59 7.04995C10.497 6.95622 10.3864 6.88183 10.2646 6.83106C10.1427 6.78029 10.012 6.75415 9.88 6.75415C9.74799 6.75415 9.61729 6.78029 9.49543 6.83106C9.37357 6.88183 9.26297 6.95622 9.17 7.04995C8.98375 7.23731 8.87921 7.49076 8.87921 7.75495C8.87921 8.01913 8.98375 8.27259 9.17 8.45995L12.71 11.9999L9.17 15.5399C8.98375 15.7273 8.87921 15.9808 8.87921 16.2449C8.87921 16.5091 8.98375 16.7626 9.17 16.9499C9.26344 17.0426 9.37426 17.116 9.4961 17.1657C9.61794 17.2155 9.7484 17.2407 9.88 17.2399C10.0116 17.2407 10.1421 17.2155 10.2639 17.1657C10.3857 17.116 10.4966 17.0426 10.59 16.9499L14.83 12.7099C14.9237 12.617 14.9981 12.5064 15.0489 12.3845C15.0997 12.2627 15.1258 12.132 15.1258 11.9999C15.1258 11.8679 15.0997 11.7372 15.0489 11.6154C14.9981 11.4935 14.9237 11.3829 14.83 11.2899Z" fill="currentColor"></path></svg>
                                        </button>
                                    </a>
                                </div>
                                <div class="w-full">
                                    <a href="{{route('themphim.logout')}}" class="rounded-xl bg-primary-comment cursor-pointer hover:bg-default-400 h-[52px] lg:h-[48px] px-4 flex items-center justify-between lg:rounded-none">
                                        <div class="flex items-center gap-4">
                                            <span class="h-10 lg:h-8 w-10 lg:w-8 rounded-lg bg-primary-btn flex items-center justify-center">
                                                <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" font-size="18"><path d="M12.59 13L10.29 15.29C10.1963 15.3829 10.1219 15.4935 10.0711 15.6154C10.0203 15.7373 9.9942 15.868 9.9942 16C9.9942 16.132 10.0203 16.2627 10.0711 16.3846C10.1219 16.5064 10.1963 16.617 10.29 16.71C10.383 16.8037 10.4936 16.8781 10.6154 16.9289C10.7373 16.9796 10.868 17.0058 11 17.0058C11.132 17.0058 11.2627 16.9796 11.3846 16.9289C11.5064 16.8781 11.617 16.8037 11.71 16.71L15.71 12.71C15.801 12.6149 15.8724 12.5027 15.92 12.38C16.02 12.1365 16.02 11.8634 15.92 11.62C15.8724 11.4972 15.801 11.3851 15.71 11.29L11.71 7.28998C11.6168 7.19674 11.5061 7.12278 11.3842 7.07232C11.2624 7.02186 11.1319 6.99589 11 6.99589C10.8681 6.99589 10.7376 7.02186 10.6158 7.07232C10.4939 7.12278 10.3832 7.19674 10.29 7.28998C10.1968 7.38322 10.1228 7.49391 10.0723 7.61573C10.0219 7.73755 9.99591 7.86812 9.99591 7.99998C9.99591 8.13184 10.0219 8.26241 10.0723 8.38423C10.1228 8.50605 10.1968 8.61674 10.29 8.70998L12.59 11H3C2.73478 11 2.48043 11.1053 2.29289 11.2929C2.10536 11.4804 2 11.7348 2 12C2 12.2652 2.10536 12.5195 2.29289 12.7071C2.48043 12.8946 2.73478 13 3 13H12.59ZM12 1.99998C10.1311 1.99163 8.29724 2.50719 6.70647 3.48817C5.11569 4.46915 3.83165 5.87629 3 7.54998C2.88065 7.78867 2.86101 8.065 2.94541 8.31818C3.0298 8.57135 3.21131 8.78063 3.45 8.89998C3.68869 9.01932 3.96502 9.03896 4.2182 8.95457C4.47137 8.87018 4.68065 8.68867 4.8 8.44998C5.43219 7.1733 6.39383 6.0886 7.58555 5.30797C8.77727 4.52733 10.1558 4.0791 11.5788 4.00957C13.0017 3.94004 14.4174 4.25175 15.6795 4.91249C16.9417 5.57322 18.0045 6.55901 18.7581 7.76797C19.5118 8.97694 19.9289 10.3652 19.9664 11.7894C20.0039 13.2135 19.6605 14.6218 18.9715 15.8688C18.2826 17.1158 17.2731 18.1561 16.0475 18.8824C14.8219 19.6087 13.4246 19.9945 12 20C10.5089 20.0064 9.04615 19.5923 7.77969 18.8052C6.51323 18.0181 5.49435 16.8899 4.84 15.55C4.72065 15.3113 4.51137 15.1298 4.2582 15.0454C4.00502 14.961 3.72869 14.9806 3.49 15.1C3.25131 15.2193 3.0698 15.4286 2.98541 15.6818C2.90101 15.935 2.92065 16.2113 3.04 16.45C3.83283 18.0455 5.03752 19.4002 6.52947 20.374C8.02142 21.3478 9.74645 21.9054 11.5261 21.989C13.3058 22.0726 15.0755 21.6792 16.6521 20.8495C18.2288 20.0198 19.5552 18.784 20.4941 17.2698C21.433 15.7556 21.9503 14.0181 21.9925 12.237C22.0347 10.4558 21.6003 8.69577 20.7342 7.13881C19.8682 5.58185 18.6018 4.28454 17.0663 3.38108C15.5307 2.47762 13.7816 2.00081 12 1.99998Z" fill="currentColor"></path></svg>
                                            </span>
                                            <p class="typography font-sans-text text-[14px]">Đăng xuất</p>
                                        </div>
                                        <button class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-8 h-8 bg-transparent hover:bg-primary-btn-hover text-primary-text rounded-full min-w-8" aria-label="button"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 11.2899L10.59 7.04995C10.497 6.95622 10.3864 6.88183 10.2646 6.83106C10.1427 6.78029 10.012 6.75415 9.88 6.75415C9.74799 6.75415 9.61729 6.78029 9.49543 6.83106C9.37357 6.88183 9.26297 6.95622 9.17 7.04995C8.98375 7.23731 8.87921 7.49076 8.87921 7.75495C8.87921 8.01913 8.98375 8.27259 9.17 8.45995L12.71 11.9999L9.17 15.5399C8.98375 15.7273 8.87921 15.9808 8.87921 16.2449C8.87921 16.5091 8.98375 16.7626 9.17 16.9499C9.26344 17.0426 9.37426 17.116 9.4961 17.1657C9.61794 17.2155 9.7484 17.2407 9.88 17.2399C10.0116 17.2407 10.1421 17.2155 10.2639 17.1657C10.3857 17.116 10.4966 17.0426 10.59 16.9499L14.83 12.7099C14.9237 12.617 14.9981 12.5064 15.0489 12.3845C15.0997 12.2627 15.1258 12.132 15.1258 11.9999C15.1258 11.8679 15.0997 11.7372 15.0489 11.6154C14.9981 11.4935 14.9237 11.3829 14.83 11.2899Z" fill="currentColor"></path></svg></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</header>
<aside class="hidden lg:hidden sidebar-mobile">
    <div class="fixed inset-0 bg-black/50 z-zDialog flex items-center justify-start duration-300">
        <div class="relative bg-content-1 outline-none w-[85vw] h-full duration-300">
            <div class="h-full flex flex-col">
                <div class="shrink-0 relative flex justify-center items-center py-3 px-3">
                    <p class="typography font-content text-[20px] leading-[28px] font-semibold">Menu</p>
                    <div class="absolute top-3 left-4">
                        <button class="btn-toggle-sidebar ta-button rounded-lg flex items-center justify-center [&:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 bg-default-400 hover:bg-default-300 h-8 gap-2 aspect-square w-auto p-0" type="button"><svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.17006 5.29001L5.41006 1.05001C5.50302 0.956281 5.61362 0.881887 5.73548 0.831118C5.85734 0.780349 5.98805 0.754211 6.12006 0.754211C6.25207 0.754211 6.38277 0.780349 6.50463 0.831118C6.62649 0.881887 6.73709 0.956281 6.83006 1.05001C7.01631 1.23737 7.12085 1.49082 7.12085 1.75501C7.12085 2.0192 7.01631 2.27265 6.83006 2.46001L3.29006 6.00001L6.83006 9.54001C7.01631 9.72737 7.12085 9.98082 7.12085 10.245C7.12085 10.5092 7.01631 10.7626 6.83006 10.95C6.73662 11.0427 6.6258 11.116 6.50396 11.1658C6.38213 11.2155 6.25166 11.2408 6.12006 11.24C5.98845 11.2408 5.85799 11.2155 5.73615 11.1658C5.61431 11.116 5.5035 11.0427 5.41006 10.95L1.17006 6.71001C1.07633 6.61705 1.00194 6.50645 0.951166 6.38459C0.900397 6.26273 0.874259 6.13202 0.874259 6.00001C0.874259 5.868 0.900397 5.73729 0.951166 5.61543C1.00194 5.49357 1.07633 5.38297 1.17006 5.29001Z" fill="currentColor"></path></svg></button>
                    </div>
                </div>
                <ul class="flex flex-col gap-2 p-2 px-4 grow overflow-auto mb-3">
                    @foreach ($menu as $item)
                        <li>
                            @if (count($item['children']))
                            <div class="w-full group-menuItem">
                                <div class="flex justify-between items-center toggle-dropdown-menu">
                                    <div class="grow min-w-0">
                                        <a href="{{ $item['link'] }}" class="block py-3 px-1">
                                            <p class="typography font-content text-[1rem] leading-[24px] font-normal">{{ $item['name'] }}</p>
                                        </a>
                                    </div>
                                    <h3 class="flex">
                                        <button class="a-button a-button rounded-lg flex items-center justify-center [&:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 bg-default lg:hover:bg-default-400 h-8 gap-2 aspect-square w-auto p-0 font-medium transition-all hover:underline [&[data-state=open]>svg]:rotate-180" type="button"><svg width="1em" height="0.59em" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="duration-200 group-data-[state=open]/trigger:rotate-180"><path d="M11 1.17C10.8126 0.983749 10.5592 0.879208 10.295 0.879208C10.0308 0.879208 9.77736 0.983749 9.58999 1.17L5.99999 4.71L2.45999 1.17C2.27263 0.983749 2.01918 0.879208 1.75499 0.879208C1.49081 0.879208 1.23736 0.983749 1.04999 1.17C0.956266 1.26296 0.881872 1.37356 0.831103 1.49542C0.780334 1.61728 0.754196 1.74799 0.754196 1.88C0.754196 2.01201 0.780334 2.14272 0.831103 2.26458C0.881872 2.38644 0.956266 2.49704 1.04999 2.59L5.28999 6.83C5.38296 6.92373 5.49356 6.99812 5.61542 7.04889C5.73728 7.09966 5.86798 7.1258 5.99999 7.1258C6.13201 7.1258 6.26271 7.09966 6.38457 7.04889C6.50643 6.99812 6.61703 6.92373 6.70999 6.83L11 2.59C11.0937 2.49704 11.1681 2.38644 11.2189 2.26458C11.2697 2.14272 11.2958 2.01201 11.2958 1.88C11.2958 1.74799 11.2697 1.61728 11.2189 1.49542C11.1681 1.37356 11.0937 1.26296 11 1.17Z" fill="currentColor"></path></svg></button>
                                    </h3>
                                </div>
                                <div class="dropdown-menu text-sm overflow-hidden hidden">
                                    <div class="pt-2">
                                        <ul class="flex flex-col gap-3">
                                            @foreach ($item['children'] as $children)
                                                <li>
                                                    <a class="block cursor-pointer text-foreground-600 hover:text-primary relative py-1 px-1 pl-3" href="{{ $children['link'] }}">
                                                        <p class="typography font-content text-[14px] leading-[normal] font-normal">{{ $children['name'] }}</p>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div>
                                <a class="flex py-3 px-1 justify-between items-center" aria-label="{{ $item['name'] }}" type="button"
                                    href="{{ $item['link'] }}">
                                    <p class="typography font-content text-[1rem] leading-[24px] font-normal">{{ $item['name'] }}</p>
                                </a>
                            </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</aside>
<div class="hidden fixed inset-0 bg-black/50 z-zDialog flex justify-center items-start" id="search-container">
    <div class="relative bg-content-1 outline-none w-full h-full">
        <div class="flex flex-col max-h-full">
            <div class="container">
                <div class="pt-3">
                    <div class="flex items-center gap-3">
                        <form action="/" class="grow min-w-0 relative">
                            <input name="search" class="block w-full a-input outline-none font-content border-default h-10 px-4 text-[1rem] relative z-zContent duration-300 bg-default-400/80 pr-10 rounded-lg" placeholder="Tên phim, diễn viên" value="">
                            <button class="a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 h-11 text-[1rem] gap-[0.625rem] bg-transparent hover:bg-transparent aspect-square w-auto p-0 hover:text-primary absolute z-zContent right-0 top-1/2 -translate-y-1/2 text-foreground-700" data-variant="textOnly" type="submit">
                                <svg width="1em" height="1em" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.67077 14.3415C11.3549 14.3415 14.3415 11.3549 14.3415 7.67077C14.3415 3.98661 11.3549 1 7.67077 1C3.98661 1 1 3.98661 1 7.67077C1 11.3549 3.98661 14.3415 7.67077 14.3415Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M16.9999 17.0002L12.3845 12.3848" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                <div class="absolute border-l h-[60%] w-[1px] border-foreground-700/60 left-0"></div>
                            </button>
                        </form>
                        <div class="">
                            <button class="a-button btn-search rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 h-8 gap-2 bg-transparent hover:bg-transparent text-[inherit] hover:text-primary px-1" data-variant="textOnly" type="button">Huỷ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-auth" class="fixed inset-0 bg-black/50 z-zDialog flex items-center justify-center hidden">
    <div class="relative bg-content-1 outline-none w-[calc(100%-32px)] sm:max-w-[450px] rounded-lg overflow-hidden">
        <div class="p-5">
            <div class="flex items-center gap-3">
                <button class="a-button btn-login rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-400 text-primary-foreground h-10 px-4 gap-[0.625rem]" type="button">Đăng nhập</button>
                <button class="a-button btn-register rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 bg-default lg:hover:bg-default-400 h-10 px-4 gap-[0.625rem]" type="button">Đăng ký</button>
            </div>
            <div class="mt-6 pb-2">
                <div id="form-login">
                    <div class="flex flex-col gap-3">
                        <a href="{{route('loginGoogle')}}" class="a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 h-12 px-6 text-[1rem] gap-[0.625rem] font-semibold w-full bg-[#4285f4] hover:bg-[#4285f4]/90" type="button" aria-label="google login">
                            <div class="flex justify-center items-center w-5 h-5 rounded-full bg-white">
                                <svg width="1.25em" height="1.25em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_781_4801)"><path d="M11.9995 6.16667C13.3468 6.16667 14.5838 6.62794 15.5714 7.39505L18.6023 4.50341C16.8401 2.94996 14.5333 2 11.9995 2C8.15979 2 4.83002 4.1666 3.1543 7.34154L6.52466 10.0023C7.3411 7.76614 9.48069 6.16667 11.9995 6.16667Z" fill="#F44336"></path><path d="M21.9134 13.2516C21.9655 12.8419 22 12.424 22 12.0001C22 11.2852 21.9219 10.5891 21.7794 9.91675H12V14.0834H17.4052C16.9679 15.2199 16.1894 16.1815 15.1983 16.8496L18.5812 19.5203C20.3745 17.9463 21.6016 15.742 21.9134 13.2516Z" fill="#2196F3"></path><path d="M6.16667 12C6.16667 11.2971 6.29738 10.6264 6.5252 10.0023L3.15484 7.34155C2.42028 8.73336 2 10.3168 2 12C2 13.6644 2.41255 15.2303 3.13185 16.6108L6.50648 13.9466C6.29036 13.337 6.16667 12.6837 6.16667 12Z" fill="#FFC107"></path><path d="M12.001 17.8333C9.46302 17.8333 7.30965 16.2095 6.50745 13.9465L3.13281 16.6107C4.80034 19.8111 8.14248 21.9999 12.001 21.9999C14.5241 21.9999 16.8249 21.0626 18.5822 19.5202L15.1993 16.8495C14.2853 17.4657 13.1913 17.8333 12.001 17.8333Z" fill="#00B060"></path><path opacity="0.1" d="M11.9994 21.7917C9.05638 21.7917 6.41004 20.5774 4.53906 18.6428C6.37057 20.6982 9.02983 22.0001 11.9994 22.0001C14.9416 22.0001 17.5788 20.7239 19.4062 18.7007C17.5408 20.6039 14.9145 21.7917 11.9994 21.7917Z" fill="black"></path><path opacity="0.1" d="M12 13.875V14.0833H17.4052L17.4896 13.875H12Z" fill="black"></path><path d="M21.9961 12.1226C21.9968 12.0816 22.0008 12.0413 22.0008 12.0001C22.0008 11.9885 21.9989 11.9772 21.9989 11.9656C21.9983 12.0181 21.9957 12.0699 21.9961 12.1226Z" fill="#E6E6E6"></path><path opacity="0.2" d="M12 9.91675V10.1251H21.8213C21.8082 10.0563 21.7939 9.98501 21.7794 9.91675H12Z" fill="white"></path><path d="M21.7794 9.91667H12V14.0833H17.4052C16.5646 16.268 14.481 17.8333 12 17.8333C8.77836 17.8333 6.16667 15.2216 6.16667 12C6.16667 8.77831 8.77836 6.16667 12 6.16667C13.1682 6.16667 14.2449 6.52555 15.1571 7.11724C15.2967 7.20798 15.4408 7.29317 15.5719 7.39505L18.6029 4.50341L18.5345 4.45082C16.7808 2.93089 14.5029 2 12 2C6.47713 2 2 6.47713 2 12C2 17.5228 6.47713 22 12 22C17.0981 22 21.2962 18.1823 21.9134 13.2515C21.9655 12.8418 22 12.4239 22 12C22 11.2851 21.9219 10.589 21.7794 9.91667Z" fill="url(#paint0_linear_781_4801)"></path><path opacity="0.1" d="M15.1564 6.90892C14.2443 6.31723 13.1676 5.95834 11.9993 5.95834C8.77771 5.95834 6.16602 8.56999 6.16602 11.7917C6.16602 11.8268 6.16649 11.8543 6.1671 11.8893C6.2233 8.71627 8.81286 6.16668 11.9993 6.16668C13.1676 6.16668 14.2443 6.52556 15.1564 7.11725C15.2961 7.20799 15.4401 7.29318 15.5713 7.39506L18.6022 4.50342L15.5713 7.18673C15.4401 7.08485 15.2961 6.99965 15.1564 6.90892Z" fill="black"></path><path opacity="0.2" d="M12 2.20833C14.4792 2.20833 16.7358 3.12366 18.4827 4.618L18.6029 4.50341L18.5112 4.42356C16.7575 2.90363 14.5029 2 12 2C6.47713 2 2 6.47713 2 12C2 12.0351 2.00488 12.0691 2.00524 12.1042C2.0617 6.62987 6.51228 2.20833 12 2.20833Z" fill="white"></path></g><defs><linearGradient id="paint0_linear_781_4801" x1="2" y1="12" x2="22" y2="12" gradientUnits="userSpaceOnUse"><stop stop-color="white" stop-opacity="0.2"></stop><stop offset="1" stop-color="white" stop-opacity="0"></stop></linearGradient><clipPath id="clip0_781_4801"><rect width="20" height="20" fill="white" transform="translate(2 2)"></rect></clipPath></defs></svg>
                            </div>
                            <span>Google</span>
                        </a>
                        {{-- <button class="a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 bg-tertiary text-tertiary-foreground hover:bg-tertiary-400 h-12 px-6 text-[1rem] gap-[0.625rem] font-semibold w-full" type="button" aria-label="google login"><svg width="0.8em" height="1em" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[20px]"><path d="M15.87 6.59998C15.7955 6.42869 15.6745 6.2817 15.5207 6.17566C15.367 6.06961 15.1866 6.00875 15 5.99998H10.42L11.69 1.25998C11.7304 1.11165 11.7362 0.955997 11.7067 0.80511C11.6772 0.654223 11.6133 0.512165 11.52 0.389976C11.4268 0.268961 11.3072 0.170891 11.1703 0.103287C11.0333 0.0356838 10.8827 0.000343209 10.73 -2.38712e-05H3.73C3.50424 -0.00775711 3.28251 0.0611759 3.10092 0.195548C2.91934 0.32992 2.7886 0.521814 2.73 0.739976L0.0499995 10.74C0.00955166 10.8883 0.00384791 11.044 0.0333317 11.1948C0.0628154 11.3457 0.126692 11.4878 0.219999 11.61C0.314184 11.7323 0.435425 11.8312 0.57422 11.8989C0.713015 11.9665 0.865594 12.0011 1.02 12H4.89L3.08 18.74C3.0207 18.9573 3.03652 19.1883 3.1249 19.3955C3.21329 19.6028 3.36905 19.7741 3.56696 19.8817C3.76487 19.9893 3.99332 20.027 4.2153 19.9886C4.43728 19.9501 4.63979 19.8379 4.79 19.67L15.69 7.66998C15.8198 7.52786 15.9058 7.35131 15.9377 7.16151C15.9697 6.97171 15.9461 6.77674 15.87 6.59998ZM6.08 15.28L7.15 11.28C7.19045 11.1317 7.19615 10.976 7.16667 10.8251C7.13718 10.6742 7.07331 10.5322 6.98 10.41C6.88684 10.289 6.7672 10.1909 6.63026 10.1233C6.49332 10.0557 6.34272 10.0203 6.19 10.02H2.35L4.49 1.99998H9.42L8.15 6.73998C8.10923 6.89103 8.10447 7.04955 8.1361 7.20278C8.16774 7.35601 8.23489 7.49968 8.33216 7.62223C8.42942 7.74479 8.55409 7.84281 8.69613 7.90841C8.83817 7.97402 8.99363 8.00538 9.15 7.99998H12.72L6.08 15.28Z" fill="currentColor"></path></svg><span>Đăng ký nhanh</span></button> --}}
                    </div>
                    <div class="flex justify-center items-center py-4"><p class="typography font-content text-[14px] leading-[normal] font-normal text-foreground-600">Hoặc</p></div>
                    <form class="flex flex-col gap-3" id="login-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input class="block w-full a-input outline-none font-content bg-default border-default h-11 px-4 text-[1rem]" placeholder="Tài khoản" value="" name="username">
                        <input class="block w-full a-input outline-none font-content bg-default border-default h-11 px-4 text-[1rem]" placeholder="Mật khẩu" type="password" value="" name="password">
                        <button class="a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 bg-default-400 hover:bg-default-300 h-11 px-5 text-[1rem] gap-[0.625rem]" type="submit">Đăng nhập</button>
                    </form>
                </div>
                <form id="form-register" class="hidden">
                    <div class="flex flex-col gap-3">
                        <input class="block w-full a-input outline-none font-content bg-default border-default h-11 px-4 text-[1rem]" placeholder="Tên hiển thị" value="" name="name">
                        <input class="block w-full a-input outline-none font-content bg-default border-default h-11 px-4 text-[1rem]" placeholder="Email" value="" name="email">
                        <input class="block w-full a-input outline-none font-content bg-default border-default h-11 px-4 text-[1rem]" placeholder="Mật khẩu" type="password" value="" name="password">
                        <input class="block w-full a-input outline-none font-content bg-default border-default h-11 px-4 text-[1rem]" placeholder="Xác nhận mật khẩu" type="password" value="" name="confirmPassword">
                        <button class="a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 bg-default-400 hover:bg-default-300 h-11 px-5 text-[1rem] gap-[0.625rem]" type="submit">Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
        <button class="a-button btn-toggle-modal-auth rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 lg:hover:bg-default-400 h-8 gap-2 bg-transparent aspect-square w-auto p-0 absolute top-2 right-2" data-variant="text" type="button"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"><path d="M7.40994 5.99994L11.7099 1.70994C11.8982 1.52164 12.004 1.26624 12.004 0.999941C12.004 0.73364 11.8982 0.478245 11.7099 0.289941C11.5216 0.101638 11.2662 -0.00415039 10.9999 -0.00415039C10.7336 -0.00415039 10.4782 0.101638 10.2899 0.289941L5.99994 4.58994L1.70994 0.289941C1.52164 0.101638 1.26624 -0.00415039 0.999939 -0.00415039C0.733637 -0.00415039 0.478243 0.101638 0.289939 0.289941C0.101635 0.478245 -0.00415277 0.73364 -0.00415277 0.999941C-0.00415278 1.26624 0.101635 1.52164 0.289939 1.70994L4.58994 5.99994L0.289939 10.2899C0.196211 10.3829 0.121816 10.4935 0.0710478 10.6154C0.0202791 10.7372 -0.00585938 10.8679 -0.00585938 10.9999C-0.00585938 11.132 0.0202791 11.2627 0.0710478 11.3845C0.121816 11.5064 0.196211 11.617 0.289939 11.7099C0.382902 11.8037 0.493503 11.8781 0.615362 11.9288C0.737221 11.9796 0.867927 12.0057 0.999939 12.0057C1.13195 12.0057 1.26266 11.9796 1.38452 11.9288C1.50638 11.8781 1.61698 11.8037 1.70994 11.7099L5.99994 7.40994L10.2899 11.7099C10.3829 11.8037 10.4935 11.8781 10.6154 11.9288C10.7372 11.9796 10.8679 12.0057 10.9999 12.0057C11.132 12.0057 11.2627 11.9796 11.3845 11.9288C11.5064 11.8781 11.617 11.8037 11.7099 11.7099C11.8037 11.617 11.8781 11.5064 11.9288 11.3845C11.9796 11.2627 12.0057 11.132 12.0057 10.9999C12.0057 10.8679 11.9796 10.7372 11.9288 10.6154C11.8781 10.4935 11.8037 10.3829 11.7099 10.2899L7.40994 5.99994Z" fill="currentColor"></path></svg></button>
    </div>
</div>
