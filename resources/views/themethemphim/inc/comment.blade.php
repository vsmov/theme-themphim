<div class="flex items-center justify-between pb-3 lg:pb-6 max-lg:hidden"><div class="flex items-center gap-2 lg:gap-3"><h2 class="typography font-title lg:text-[32px] lg:leading-[normal] text-[24px] leading-[32px] font-normal">Bình luận</h2></div></div>
<div>
    <form class="form-comment py-3 px-4 bg-default duration-200 rounded-md [&:has([contenteditable=true]:focus)]:bg-default-400">
        <div class="relative !leading-[normal] text-[16px]">
            <textarea rows="3" required class="text-[1em] focus:outline-none bg-transparent w-full text-foreground-600/60 text-white" placeholder="Thêm bình luận ..."></textarea>
        </div>
        <div class="mt-2 flex justify-end gap-3">
            <button class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-400 text-primary-foreground h-8 gap-2 opacity-70 aspect-square w-auto p-0 rounded-full" type="submit">
                <svg width="1em" height="1em" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.34 7.32001L4.34 0.320006C3.78749 0.0450154 3.16362 -0.0528833 2.55344 0.0396579C1.94326 0.132199 1.37646 0.410676 0.930335 0.837122C0.484207 1.26357 0.180456 1.81723 0.060496 2.42262C-0.059464 3.02801 0.0102046 3.65566 0.260003 4.22001L2.66 9.59001C2.71446 9.71984 2.74251 9.85922 2.74251 10C2.74251 10.1408 2.71446 10.2802 2.66 10.41L0.260003 15.78C0.0567034 16.2367 -0.029241 16.737 0.00998036 17.2354C0.0492018 17.7337 0.212345 18.2144 0.484585 18.6337C0.756825 19.053 1.12953 19.3976 1.56883 19.6362C2.00812 19.8748 2.50009 19.9999 3 20C3.46823 19.9953 3.92949 19.886 4.35 19.68L18.35 12.68C18.8466 12.4302 19.264 12.0473 19.5557 11.5741C19.8474 11.1009 20.0018 10.5559 20.0018 10C20.0018 9.44411 19.8474 8.89915 19.5557 8.42593C19.264 7.9527 18.8466 7.56982 18.35 7.32001H18.34ZM17.45 10.89L3.45 17.89C3.26617 17.9783 3.05973 18.0082 2.85839 17.9759C2.65705 17.9435 2.47041 17.8503 2.32352 17.7089C2.17662 17.5674 2.07648 17.3844 2.03653 17.1844C1.99658 16.9845 2.01873 16.777 2.1 16.59L4.49 11.22C4.52094 11.1483 4.54766 11.0748 4.57 11H11.46C11.7252 11 11.9796 10.8946 12.1671 10.7071C12.3546 10.5196 12.46 10.2652 12.46 10C12.46 9.73479 12.3546 9.48044 12.1671 9.2929C11.9796 9.10536 11.7252 9.00001 11.46 9.00001H4.57C4.54766 8.92517 4.52094 8.85172 4.49 8.78001L2.1 3.41001C2.01873 3.22297 1.99658 3.01556 2.03653 2.81558C2.07648 2.6156 2.17662 2.43261 2.32352 2.29115C2.47041 2.1497 2.65705 2.05654 2.85839 2.02416C3.05973 1.99178 3.26617 2.02174 3.45 2.11001L17.45 9.11001C17.6138 9.19392 17.7513 9.32142 17.8473 9.47845C17.9433 9.63548 17.994 9.81596 17.994 10C17.994 10.1841 17.9433 10.3645 17.8473 10.5216C17.7513 10.6786 17.6138 10.8061 17.45 10.89Z" fill="currentColor"></path></svg>
            </button>
        </div>
    </form>
</div>
<div class="mt-4">
    <ul class="flex flex-col gap-4">
        @foreach ($comments as $comment)
        <li>
            <div>
                <div class="flex gap-2">
                    <div class="shrink-0">
                        <div>
                            <div class="relative w-8 aspect-square rounded-full ring-[2px] ring-default-200">
                                <img alt="{{$comment->user->name}}" loading="lazy" class="object-cover rounded-full" src="{{$comment->user->avatar ?? '/themes/themphim/images/default.png'}}" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                            </div>
                        </div>
                    </div>
                    <div class="grow min-w-0">
                        <div class="bg-default-200/80 py-2 px-3 rounded-lg w-[max-content] max-w-full">
                            <div class="">
                                <p class="typography font-content text-[14px] font-semibold leading-[100%]">{{$comment->user->name}}</p>
                            </div>
                            <div class="mt-2">
                                <p class="typography font-content text-[14px] leading-[normal] font-normal break-words">{!! $comment->content !!}</p>
                            </div>
                        </div>
                        <div class="mt-1">
                            <div class="flex items-center gap-2 text-foreground-600">
                                <p class="typography font-content text-[12px] leading-[normal] font-normal">{{$comment->created_at->diffForHumans()}}</p>
                                <p data-id="{{$comment->id}}" class="typography btn-reply font-content text-[12px] leading-[normal] font-semibold hover:underline cursor-pointer">Phản hồi</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <ul class="flex flex-col gap-4">
                        @foreach ($comment->replies as $reply)
                        <li>
                            <div class="animate-scaleIn lg:animate-scaleInLg">
                                <div>
                                    <div class="flex gap-2">
                                        <div class="shrink-0">
                                            <div class="pl-[40px]">
                                                <div class="relative w-8 aspect-square rounded-full ring-[2px] ring-default-200">
                                                    <img alt="{{$reply->user->name}}" loading="lazy" class="object-cover rounded-full" src="{{$reply->user->avatar ?? '/themes/themphim/images/default.png'}}" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grow min-w-0">
                                            <div class="bg-default-200/80 py-2 px-3 rounded-lg w-[max-content] max-w-full">
                                                <div class="">
                                                    <p class="typography font-content text-[14px] font-semibold leading-[100%]">{{$reply->user->name}}</p>
                                                </div>
                                                <div class="mt-2">
                                                    <p class="typography font-content text-[14px] leading-[normal] font-normal break-words">{!! $reply->content !!}</p>
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <div class="flex items-center gap-2 text-foreground-600">
                                                    <p class="typography font-content text-[12px] leading-[normal] font-normal">{{$reply->created_at->diffForHumans()}}</p>
                                                    <p data-id="{{$comment->id}}" class="typography btn-reply font-content text-[12px] leading-[normal] font-semibold hover:underline cursor-pointer">Phản hồi</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="animate-scaleIn lg:animate-scaleInLg mt-3 pl-[40px] hidden" id="form-{{$comment->id}}">
                    <form data-parent="{{$comment->id}}" class="form-comment py-3 px-4 bg-default duration-200 rounded-md [&:has([contenteditable=true]:focus)]:bg-default-400">
                        <div class="relative !leading-[normal] text-[16px]">
                            <textarea rows="2" required class="text-[1em] focus:outline-none bg-transparent w-full text-foreground-600/60 text-white" placeholder="Thêm bình luận ..."></textarea>
                        </div>
                        <div class="mt-2 flex justify-end gap-3">
                            <button class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-400 text-primary-foreground h-8 gap-2 opacity-70 aspect-square w-auto p-0 rounded-full" type="submit">
                                <svg width="1em" height="1em" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.34 7.32001L4.34 0.320006C3.78749 0.0450154 3.16362 -0.0528833 2.55344 0.0396579C1.94326 0.132199 1.37646 0.410676 0.930335 0.837122C0.484207 1.26357 0.180456 1.81723 0.060496 2.42262C-0.059464 3.02801 0.0102046 3.65566 0.260003 4.22001L2.66 9.59001C2.71446 9.71984 2.74251 9.85922 2.74251 10C2.74251 10.1408 2.71446 10.2802 2.66 10.41L0.260003 15.78C0.0567034 16.2367 -0.029241 16.737 0.00998036 17.2354C0.0492018 17.7337 0.212345 18.2144 0.484585 18.6337C0.756825 19.053 1.12953 19.3976 1.56883 19.6362C2.00812 19.8748 2.50009 19.9999 3 20C3.46823 19.9953 3.92949 19.886 4.35 19.68L18.35 12.68C18.8466 12.4302 19.264 12.0473 19.5557 11.5741C19.8474 11.1009 20.0018 10.5559 20.0018 10C20.0018 9.44411 19.8474 8.89915 19.5557 8.42593C19.264 7.9527 18.8466 7.56982 18.35 7.32001H18.34ZM17.45 10.89L3.45 17.89C3.26617 17.9783 3.05973 18.0082 2.85839 17.9759C2.65705 17.9435 2.47041 17.8503 2.32352 17.7089C2.17662 17.5674 2.07648 17.3844 2.03653 17.1844C1.99658 16.9845 2.01873 16.777 2.1 16.59L4.49 11.22C4.52094 11.1483 4.54766 11.0748 4.57 11H11.46C11.7252 11 11.9796 10.8946 12.1671 10.7071C12.3546 10.5196 12.46 10.2652 12.46 10C12.46 9.73479 12.3546 9.48044 12.1671 9.2929C11.9796 9.10536 11.7252 9.00001 11.46 9.00001H4.57C4.54766 8.92517 4.52094 8.85172 4.49 8.78001L2.1 3.41001C2.01873 3.22297 1.99658 3.01556 2.03653 2.81558C2.07648 2.6156 2.17662 2.43261 2.32352 2.29115C2.47041 2.1497 2.65705 2.05654 2.85839 2.02416C3.05973 1.99178 3.26617 2.02174 3.45 2.11001L17.45 9.11001C17.6138 9.19392 17.7513 9.32142 17.8473 9.47845C17.9433 9.63548 17.994 9.81596 17.994 10C17.994 10.1841 17.9433 10.3645 17.8473 10.5216C17.7513 10.6786 17.6138 10.8061 17.45 10.89Z" fill="currentColor"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>
{{ $comments->links('themes::themethemphim.inc.pagination') }}
<script>
    $(document).on('submit', '.form-comment', function(e) {
        e.preventDefault();
        var comment = $(this).find('textarea').val();
        var parent_id = $(this).data('parent');
        $.ajax({
            type: 'POST',
            url: '{{ route('themphim.comment') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'content': comment,
                'movie_id': movie_id,
                'parent_id': parent_id
            },
            success: function(response) {
                if (response.status == 'success') {
                    window.location.reload();
                }else{
                    alert(response.message);
                }
            },
            error: function(response) {
                alert('Lỗi khi bình luận');
            }
        });
    });
    $(document).on('click', '.btn-reply', function() {
        var id = $(this).data('id');
        $('.reply-form').addClass('hidden');
        $('#form-' + id).toggleClass('hidden');
    });
</script>
