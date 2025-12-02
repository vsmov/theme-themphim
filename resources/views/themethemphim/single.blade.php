@extends('themes::themethemphim.layout')
@php
    $top_movies = \Vsphim\Core\Models\Movie::orderBy('view_total', 'desc')->limit(10)->get();
    use App\Models\Comment;
    $comments = Comment::where('movie_id', $currentMovie->id)->where('parent_id', null)->orderBy('created_at', 'desc')->paginate(5);
    $totalComment = Comment::where('movie_id', $currentMovie->id)->count();

    $checkFollow = false;
    if (auth()->check()) {
        $checkFollow = DB::table('follows')->where('user_id', auth()->id())->where('movie_id', $currentMovie->id)->exists();
    }

    if(auth()->check()){
        $user = auth()->user();
        $checkHistory = DB::table('histories')->where('user_id', $user->id)->where('movie_id', $currentMovie->id)->first();
        if($checkHistory){
            $histories = explode(',', $checkHistory->watch_at);
            if(!in_array($episode->id, $histories)){
                $histories[] = $episode->id;
                DB::table('histories')->where('user_id', $user->id)->where('movie_id', $currentMovie->id)->update([
                    'watch_at' => implode(",", $histories),
                    'updated_at' => now()
                ]);
            }else{
                $key = array_search($episode->id, $histories);
                unset($histories[$key]);
                array_push($histories, $episode->id);
                DB::table('histories')->where('user_id', $user->id)->where('movie_id', $currentMovie->id)->update([
                    'watch_at' => implode(",", $histories),
                    'updated_at' => now()
                ]);
            }
        }else{
            $checkCountHistory = DB::table('histories')->where('user_id', $user->id)->where('movie_id', $currentMovie->id)->count();
            if($checkCountHistory > 45){
                DB::table('histories')->where('user_id', $user->id)->orderBy('updated_at', 'asc')->limit(1)->delete();
            }
            DB::table('histories')->insert([
                'movie_id' => $currentMovie->id,
                'user_id' => $user->id,
                'watch_at' => $episode->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
@endphp
@section('content')
<main class="pb-[32px] lg:pb-[100px] mt-[calc(var(--header-height)+16px)] lg:mt-[calc(var(--header-height)+52px)] sm:container max-lg:mt-[--header-height]">
    <div class="flex items-center opacity-90 mb-4 max-sm:px-4">
        <a href="/"><p class="typography font-content text-[1rem] leading-[24px] font-normal">Trang chủ</p></a>
        <p class="typography font-content text-[1rem] leading-[24px] font-normal mx-2">
            <svg width="0.667em" height="1em" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"><path d="M6.83 5.29001L2.59 1.05001C2.49704 0.956281 2.38644 0.881887 2.26458 0.831118C2.14272 0.780349 2.01202 0.754211 1.88 0.754211C1.74799 0.754211 1.61729 0.780349 1.49543 0.831118C1.37357 0.881887 1.26297 0.956281 1.17 1.05001C0.983753 1.23737 0.879211 1.49082 0.879211 1.75501C0.879211 2.0192 0.983753 2.27265 1.17 2.46001L4.71 6.00001L1.17 9.54001C0.983753 9.72737 0.879211 9.98082 0.879211 10.245C0.879211 10.5092 0.983753 10.7626 1.17 10.95C1.26344 11.0427 1.37426 11.116 1.4961 11.1658C1.61794 11.2155 1.7484 11.2408 1.88 11.24C2.01161 11.2408 2.14207 11.2155 2.26391 11.1658C2.38575 11.116 2.49656 11.0427 2.59 10.95L6.83 6.71001C6.92373 6.61705 6.99813 6.50645 7.04889 6.38459C7.09966 6.26273 7.1258 6.13202 7.1258 6.00001C7.1258 5.868 7.09966 5.73729 7.04889 5.61543C6.99813 5.49357 6.92373 5.38297 6.83 5.29001Z" fill="currentColor"></path></svg>
        </p>
        @if ($currentMovie->categories->count() > 0)
            <a href="{{ $currentMovie->categories->first()->getUrl() }}"><p class="typography font-content text-[1rem] leading-[24px] font-normal">{{ $currentMovie->categories->first()->name }}</p></a>
        @endif
    </div>
    <div>
        <div class="flex max-sm:sticky top-[calc(var(--header-height)-1px)] z-[calc(var(--zContent)+1)] rounded-lg sm:overflow-hidden">
            <div class="grow min-w-0">
                <section class="relative">
                    <div class="w-full aspect-[16/9]" id="player"></div>
                    <div class="absolute z-zContent top-1/2 inset-x-0 -translate-y-1/2 flex justify-around pointer-events-none text-white"></div>
                </section>
                <div class="flex bg-content-1 text-foreground-600 max-sm:pl-2 max-sm:pr-4 px-1 py-1 justify-between flex-wrap gap-y-2 max-sm:hidden">
                    <div class="flex bg-content-1 text-foreground-600 max-sm:pl-2 max-sm:pr-4 px-1 py-1 justify-between flex-wrap gap-y-2 max-sm:hidden">
                        <button class="a-button report rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 lg:h-9 lg:px-4 lg:gap-3 h-7 px-3 gap-1.5 bg-transparent hover:bg-transparent text-[inherit] hover:text-primary text-[14px] sm:text-[18px]" data-variant="textOnly" type="button"><svg width="0.882em" height="1em" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg" class=""><path d="M7.36 2L7.44 2.39L7.76 4H13V10H9.64L9.56 9.61L9.24 8H2V2H7.36ZM9 0H0V17H2V10H7.6L8 12H15V2H9.4L9 0Z" fill="currentColor"></path></svg><span class="max-lg:hidden">Báo lỗi</span></button>
                        <button data-movie_id="{{$currentMovie->id}}" class="a-button follow-btn rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 lg:h-9 lg:px-4 lg:gap-3 h-7 px-3 gap-1.5 bg-transparent hover:bg-transparent text-[inherit] hover:text-primary group/bookmark text-[14px] sm:text-[18px]" data-variant="textOnly" type="button"><svg width="0.7em" height="1em" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-data-[active=true]/bookmark:hidden"><path d="M13 0H1C0.734784 0 0.48043 0.105357 0.292893 0.292893C0.105357 0.48043 2.16531e-09 0.734784 2.16531e-09 1V19C-1.25753e-05 19.1912 0.0547687 19.3783 0.157854 19.5393C0.260939 19.7003 0.408009 19.8284 0.58164 19.9083C0.755271 19.9883 0.948188 20.0169 1.13754 19.9906C1.32688 19.9643 1.50473 19.8843 1.65 19.76L7 15.27L12.29 19.71C12.3834 19.8027 12.4943 19.876 12.6161 19.9258C12.7379 19.9755 12.8684 20.0008 13 20C13.1312 20.0034 13.2613 19.976 13.38 19.92C13.5626 19.845 13.7189 19.7176 13.8293 19.5539C13.9396 19.3901 13.999 19.1974 14 19V1C14 0.734784 13.8946 0.48043 13.7071 0.292893C13.5196 0.105357 13.2652 0 13 0ZM12 16.86L7.64 13.2C7.46031 13.0503 7.23385 12.9684 7 12.9684C6.76615 12.9684 6.53969 13.0503 6.36 13.2L2 16.86V2H12V16.86Z" fill="currentColor"></path></svg><span class="max-lg:hidden">Xem sau</span></button>
                        @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                                <button data-id="{{ $server->id }}"  data-link="{{ $server->link }}" data-type="{{ $server->type }}"
                                    onclick="chooseStreamingServer(this)" class="a-button streaming-server rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 lg:h-9 lg:px-4 h-7 px-3 gap-1.5 bg-transparent hover:bg-transparent text-[inherit] hover:text-primary text-[14px] sm:text-[18px]" data-variant="textOnly" type="button">
                                    <span>#{{ $loop->index + 1 }}</span>
                                </button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="max-lg:hidden shrink-0 w-[320px] bg-content-1 relative p-4 pb-[44px]">
                <div class="absolute h-auto w-full inset-0 flex flex-col p-4 pb-[92px]">
                    <div class="flex items-center gap-2 mb-4">
                        <button class="a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-400 text-primary-foreground h-8 px-4 gap-2 w-1/2" data-variant="default" type="button"><p class="typography font-content text-[1rem] leading-[24px] font-medium">Gợi ý cho bạn</p></button>
                    </div>
                    <div class="grow shrink-0 h-full overflow-y-scroll scrollbar">
                        <section class="flex flex-col">
                            <div class="overflow-auto">
                                <ul>
                                    @foreach ($top_movies as $movie)
                                    <li class="py-2">
                                        <div class="o-videoCardH">
                                            <div class="flex gap-3">
                                                <div class="shrink-0 w-[40%]">
                                                    <a class="block relative w-full aspect-[3/2] rounded-lg overflow-hidden" href="{{$movie->getUrl()}}">
                                                        <img alt="Vương Quốc Của Những Kẻ Phản Diện" loading="lazy" class="object-cover duration-300 hover:scale-[104%]"
                                                        src="{{$movie->getPosterUrl()}}" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                                    </a>
                                                </div>
                                                <div class="grow">
                                                    <a class="block" aria-label="{{$movie->name}}" href="{{$movie->getUrl()}}">
                                                        <p class="typography font-content text-[14px] leading-[normal] font-normal hover:text-primary line-clamp-2 text-foreground-600 break-all">{{$movie->name}}</p>
                                                    </a>
                                                    <div class="flex mt-1">
                                                        <p class="typography font-content text-[14px] leading-[normal] font-normal text-foreground-700">{{$movie->view_total}} lượt xem</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex relative mt-0 sm:mt-4 gap-10">
            <div class="grow min-w-0">
                <div class="flex bg-content-1 text-foreground-600 max-sm:pl-2 max-sm:pr-4 px-1 py-1 justify-between flex-wrap gap-y-2 sm:hidden">
                    <div class="flex items-center [&amp;_button]:px-3">
                        <button class="a-button report rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 lg:h-9 lg:px-4 lg:gap-3 h-7 px-3 gap-1.5 bg-transparent hover:bg-transparent text-[inherit] hover:text-primary text-[14px] sm:text-[18px]" data-variant="textOnly" type="button"><svg width="0.882em" height="1em" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg" class=""><path d="M7.36 2L7.44 2.39L7.76 4H13V10H9.64L9.56 9.61L9.24 8H2V2H7.36ZM9 0H0V17H2V10H7.6L8 12H15V2H9.4L9 0Z" fill="currentColor"></path></svg><span class="max-lg:hidden">Báo lỗi</span></button>
                        <button data-movie_id="{{$currentMovie->id}}" class="a-button rounded-lg follow-btn flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 lg:h-9 lg:px-4 lg:gap-3 h-7 px-3 gap-1.5 bg-transparent hover:bg-transparent text-[inherit] hover:text-primary group/bookmark text-[14px] sm:text-[18px]" data-variant="textOnly" type="button"><svg width="0.7em" height="1em" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-data-[active=true]/bookmark:hidden"><path d="M13 0H1C0.734784 0 0.48043 0.105357 0.292893 0.292893C0.105357 0.48043 2.16531e-09 0.734784 2.16531e-09 1V19C-1.25753e-05 19.1912 0.0547687 19.3783 0.157854 19.5393C0.260939 19.7003 0.408009 19.8284 0.58164 19.9083C0.755271 19.9883 0.948188 20.0169 1.13754 19.9906C1.32688 19.9643 1.50473 19.8843 1.65 19.76L7 15.27L12.29 19.71C12.3834 19.8027 12.4943 19.876 12.6161 19.9258C12.7379 19.9755 12.8684 20.0008 13 20C13.1312 20.0034 13.2613 19.976 13.38 19.92C13.5626 19.845 13.7189 19.7176 13.8293 19.5539C13.9396 19.3901 13.999 19.1974 14 19V1C14 0.734784 13.8946 0.48043 13.7071 0.292893C13.5196 0.105357 13.2652 0 13 0ZM12 16.86L7.64 13.2C7.46031 13.0503 7.23385 12.9684 7 12.9684C6.76615 12.9684 6.53969 13.0503 6.36 13.2L2 16.86V2H12V16.86Z" fill="currentColor"></path></svg><span class="max-lg:hidden">Xem sau</span></button>
                    </div>
                </div>
                <section class="max-sm:container mt-2">
                    <div class="py-2">
                        <h1 class="typography font-title lg:text-[28px] lg:leading-[36px] text-[24px] leading-[32px] font-normal"> {{ $currentMovie->name }} - Tập {{ $episode->name }}</h1>
                    </div>
                    <div class="flex flex-wrap pt-2 lg:pt-4 items-center gap-2">
                        {{-- <div class="flex items-center text-primary text-[14px]">
                            <svg width="1em" height="0.952em" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.6693 7.2074C19.822 7.32633 19.9368 7.48699 20 7.6699C20.0486 7.85278 20.0444 8.0457 19.9877 8.22625C19.9311 8.4068 19.8244 8.56758 19.68 8.6899L15.55 12.6899L16.55 18.3699C16.5857 18.5574 16.567 18.7512 16.4961 18.9284C16.4252 19.1055 16.3051 19.2588 16.15 19.3699C15.9784 19.4941 15.7718 19.5607 15.56 19.5599C15.3988 19.5604 15.2403 19.5191 15.1 19.4399L9.99998 16.7599L4.87998 19.4299C4.71575 19.517 4.5305 19.5566 4.34503 19.5442C4.15955 19.5318 3.98119 19.468 3.82998 19.3599C3.67483 19.2488 3.55473 19.0955 3.48385 18.9184C3.41297 18.7412 3.39428 18.5474 3.42998 18.3599L4.42998 12.6799L0.299977 8.6799C0.171435 8.55163 0.080249 8.39077 0.0362052 8.21459C-0.00783865 8.03842 -0.00307759 7.85358 0.0499774 7.6799C0.107937 7.50218 0.214554 7.34425 0.357728 7.22406C0.500902 7.10386 0.6749 7.02621 0.859977 6.9999L6.54998 6.1599L9.09998 0.999901C9.18186 0.83083 9.30971 0.688243 9.46889 0.588475C9.62806 0.488706 9.81212 0.435791 9.99998 0.435791C10.1878 0.435791 10.3719 0.488706 10.5311 0.588475C10.6902 0.688243 10.8181 0.83083 10.9 0.999901L13.45 6.1699L19.14 6.9999C19.3328 7.0164 19.5167 7.08848 19.6693 7.2074Z" fill="currentColor"></path></svg>
                            <p class="typography font-content text-[1rem] leading-[24px] ml-1 font-medium">{{$movie->rating_star}}</p>
                            <p class="typography font-content text-[14px] leading-[normal] font-normal mx-1 text-foreground-600">({{$movie->rating_count}} đánh giá)</p>
                            <span class="h-1 w-1 rounded-full bg-foreground-600 mx-1"></span>
                            <p class="typography font-content text-[15px] leading-[20px] font-normal ml-1 text-primary cursor-pointer" data-state="closed">Đánh giá</p>
                        </div>
                        <span class="h-1 w-1 rounded-full bg-foreground-600"></span> --}}
                        <p class="typography font-content text-[14px] leading-[normal] font-normal text-foreground-600">{{$movie->view_total}} lượt xem</p>
                    </div>
                </section>
                <section class="mt-4 max-sm:container">
                    <ul class="flex gap-3 flex-wrap">
                        @foreach ($currentMovie->categories as $category)
                            <li>
                                <a class="a-button rounded-lg flex items-center justify-center [&:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap active:scale-[0.98] disabled:active:scale-100 bg-default lg:hover:bg-default-400 h-7 px-3 text-[14px] gap-1.5" href="{{$category->getUrl()}}">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </section>
                <section class="empty:hidden mt-4 max-sm:container">
                    <div class="a-showMoreContent relative" data-more="false">
                        <div data-hasmore="false" data-fullcontent="false" class="relative overflow-hidden mb-6 max-h-[90px]">
                            <ul>
                                <p class="typography font-content text-[14px] mt-2 first:mt-0 leading-[1.5] text-foreground-600 font-normal">
                                    <span class="text-white w-[86px] mr-1">Tên gốc : </span><span>{{$movie->origin_name}}</span>
                                </p>
                                <p class="typography font-content text-[14px] mt-2 first:mt-0 leading-[1.5] text-foreground-600 font-normal">
                                    <span class="text-white w-[86px] mr-1">Nội dung : </span>
                                    <span>{!! $movie->content !!}</span>
                                </p>
                            </ul>
                        </div>
                    </div>
                </section>
                <div class="max-lg:hidden">
                    @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                        <div class="py-4">
                            <p class="typography font-content text-[24px] leading-[32px] font-normal">Danh sách tập {{ $server }}:</p>
                            <div class="relative pt-6">
                                <div class="grid grid-cols-10 gap-3">
                                    @foreach ($data->sortBy('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                                        <a href="{{ $item->sortByDesc('type')->first()->getUrl() }}" title="{{ $name }}"
                                            class="block">
                                            <div class="h-[46px] flex items-center justify-center rounded-lg @if ($item->contains($episode)) text-primary bg-[#FFFFFF30] @else bg-[#FFFFFF10] @endif hover:bg-[#FFFFFF30]">
                                                <p class="typography font-content text-[1rem] leading-[24px] font-normal">Tập {{$name}}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <section class="mt-8 max-sm:container">
                    <div class="embla overflow-hidden w-full">
                        <div class="embla__container flex [&amp;>*]:shrink-0 [&amp;>*]:grow-0" style="transform: translate3d(0px, 0px, 0px);">
                            @foreach ($currentMovie->actors as $actor)
                            <a class="block ml-0.5 lg:ml-2 first:ml-0 p-2 shrink-0 w-[102px] lg:w-[132px]" href="{{$actor->getUrl()}}">
                                <div class="flex group/actor w-full flex-col items-center duration-300 hover:scale-105 cursor-pointer">
                                    <div class="w-full relative aspect-square rounded-lg overflow-hidden">
                                        <img alt="{{$actor->name}}" loading="lazy" class="object-cover lazy" data-original="{{$actor->thumb_url ?? '/themes/themphim/images/default.png'}}" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                        <div class="absolute inset-0 border-2 border-primary opacity-0 duration-300 group-hover/actor:opacity-100 rounded-lg overflow-hidden"></div>
                                    </div>
                                    <p class="typography font-content text-[14px] leading-[normal] font-normal mt-2 group-hover/actor:text-primary duration-300 text-center line-clamp-2">
                                        {{$actor->name}}
                                    </p>
                                    <p class="typography font-content text-[12px] leading-[normal] font-normal mt-1 text-foreground-700 text-center">Diễn viên</p>
                                </div>
                            </a>
                            @endforeach
                            @foreach ($currentMovie->directors as $director)
                                <a class="block ml-0.5 lg:ml-2 first:ml-0 p-2 shrink-0 w-[102px] lg:w-[132px]" href="{{$director->getUrl()}}">
                                    <div class="flex group/actor w-full flex-col items-center duration-300 hover:scale-105 cursor-pointer">
                                        <div class="w-full relative aspect-square rounded-lg overflow-hidden">
                                            <img alt="{{$director->name}}" loading="lazy" class="object-cover lazy" data-original="{{$director->thumb_url ?? '/themes/themphim/images/default.png'}}" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                            <div class="absolute inset-0 border-2 border-primary opacity-0 duration-300 group-hover/actor:opacity-100 rounded-lg overflow-hidden"></div>
                                        </div>
                                        <p class="typography font-content text-[14px] leading-[normal] font-normal mt-2 group-hover/actor:text-primary duration-300 text-center line-clamp-2">
                                            {{$director->name}}
                                        </p>
                                        <p class="typography font-content text-[12px] leading-[normal] font-normal mt-1 text-foreground-700 text-center">Đạo diễn</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>

                <div class="watch-recommend max-lg:hidden">
                    <section class="mt-4 lg:mt-20 max-sm:container max-lg:hidden">
                        <div class="flex items-center justify-between pb-3 lg:pb-6 max-lg:hidden"><div class="flex items-center gap-2 lg:gap-3"><h2 class="typography font-title lg:text-[32px] lg:leading-[normal] text-[24px] leading-[32px] font-normal">Cùng thể loại</h2></div></div>
                        <div>
                            <ul class="grid grid-cols-3 sm:grid-cols-5 gap-3 gap-y-5 lg:gap-4 lg:gap-y-7 lg:grid-cols-6">
                                @foreach ($movie_related as $movie)
                                <li>
                                    <a class="block o-filmCard duration-300 relative group/film" href="{{$movie->getUrl()}}">
                                        <div class="relative aspect-[228/304] overflow-hidden cursor-pointer rounded-lg">
                                            <img alt="{{$movie->name}}" class="object-cover lazy" data-original="{{$movie->getThumbUrl()}}" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                            <div class="absolute inset-x-0 bottom-0" style="background-image: linear-gradient(0deg, rgba(10, 12, 15, 0.8) 0%, rgba(10, 12, 15, 0.74) 4%, rgba(10, 12, 15, 0.59) 17%, rgba(10, 12, 15, 0.4) 34%, rgba(10, 12, 15, 0.31) 55%, rgba(10, 12, 15, 0.1) 78%, rgba(10, 12, 15, 0) 100%);">
                                                <p class="typography font-content text-[12px] leading-[normal] font-normal px-2 pb-2">{{$movie->episode_total}}</p>
                                            </div>
                                        </div>
                                        <div class="mt-4 min-h-[34px] lg:min-h-[53px]">
                                            <h3 class="typography font-content text-[14px] group-hover/film:text-primary duration-300 cursor-pointer line-clamp-2 font-medium leading-[1.5]">{{$movie->name}}</h3>
                                            <p class="typography font-content text-[12px] leading-[normal] font-normal mt-2 max-lg:hidden text-foreground-600/80">{{$movie->origin_name}}</p>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                </div>

                <div class="mt-4 lg:mt-12 max-sm:container max-lg:hidden">
                    <script>
                        var movie_id = {{ $currentMovie->id }};
                    </script>
                    @include('themes::themethemphim.inc.comment')
                </div>
            </div>
            <aside class="max-lg:hidden shrink-0 w-[320px]"><div></div></aside>
        </div>
    </div>
</main>
@endsection

@push('scripts')
    {!! setting('site_scripts_facebook_sdk') !!}
    <script src="/themes/holy/player/js/p2p-media-loader-core.min.js"></script>
    <script src="/themes/holy/player/js/p2p-media-loader-hlsjs.min.js"></script>
    <script src="/js/jwplayer-8.9.3.js"></script>
    <script src="/js/hls.min.js"></script>
    <script src="/js/jwplayer.hlsjs.min.js"></script>
    <script>
        var episode_id = {{ $episode->id }};
        const wrapper = document.getElementById('player');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname.replace(`-${episode_id}`, `-${id}`);

            history.pushState({
                path: newUrl
            }, "", newUrl);
            episode_id = id;


            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('active');
            })
            el.classList.add('active');

            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer" style="height: 100%"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        height: "100%",
                        file: "/themes/holy/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML =
                            `<iframe src="${link}" frameborder="0" style="width:100%; height:100%; position: absolute; top: 0; left: 0;" scrolling="no" allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adSkipped', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML =
                            `<iframe src="${link}" frameborder="0" style="width:100%; height:100%; position: absolute; top: 0; left: 0;" scrolling="no" allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adComplete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML =
                            `<iframe src="${link}" frameborder="0" style="width:100%; height:100%; position: absolute; top: 0; left: 0;" scrolling="no" allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML =
                            `<iframe src="${link}" frameborder="0" style="width:100% !important; height:100%; position: absolute; top: 0; left: 0;" scrolling="no" allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    height: "100%",
                    image: "{{ $currentMovie->getPosterUrl() }}",
                    file: link,
                    playbackRateControls: true,
                    playbackRates: [0.25, 0.75, 1, 1.25],
                    sharing: {
                        sites: [
                            "reddit",
                            "facebook",
                            "twitter",
                            "googleplus",
                            "email",
                            "linkedin",
                        ],
                    },
                    volume: 100,
                    mute: false,
                    autostart: true,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua"
                    }
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                        var engine = new p2pml.hlsjs.Engine(engine_config);
                        player.setup(objSetup);
                        jwplayer_hls_provider.attach();
                        p2pml.hlsjs.initJwPlayer(player, {
                            liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                            maxBufferLength: 300,
                            loader: engine.createLoaderClass(),
                        });
                    } else {
                        player.setup(objSetup);
                    }
                } else {
                    player.setup(objSetup);
                }


                const resumeData = 'OPCMS-PlayerPosition-' + id;
                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const episode = '{{ $episode->id }}';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>

    <script>
        $(".report").click(() => {
            fetch("{{ route('episodes.report', ['movie' => $currentMovie->slug, 'episode' => $episode->slug, 'id' => $episode->id]) }}", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    message: ''
                })
            });
            alert("Báo lỗi thành công!");
            $(".report").prop('disabled', true);
        })
        $('.follow-btn').click(function() {
                $.ajax({
                    url: '{{route('themphim.follow')}}',
                    type: 'POST',
                    data: {
                        movie_id: $(this).data('movie_id'),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.status == 'follow') {
                            alert('Theo dõi phim thành công');
                        } else {
                            alert('Bỏ theo dõi phim thành công');
                        }
                    }, error: function() {
                        alert('Vui lòng đăng nhập để theo dõi phim');
                    }
                });
            });
    </script>
@endpush
