@extends('themes::themethemphim.layout')

@php
    use Vsphim\Core\Models\Movie;

    $data = Cache::remember('site.movies.404', setting('site_cache_ttl', 5 * 60), function () {
        $lists = [
            '🔥 Nổi bật|Những phim được xem nhiều nhất||is_copyright|0|view_total|desc|14|#|top'
        ];
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $description, $relation, $field, $val, $sortKey, $alg, $limit, $link, $type] = array_merge($list, ['Phim mới cập nhật', '', '', 'type', 'series', 'created_at', 'desc', 8, '/', 'list']);
                try {
                    $data[] = [
                        'label' => $label,
                        'description' => $description,
                        'data' => Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                        'link' => $link ?: '#',
                        'type' => $type,
                    ];
                } catch (\Exception $e) {
                }
            }
        }
        return $data;
    });
@endphp


@section('content')
<main class="pb-[32px] lg:pb-[100px] mt-[calc(var(--header-height)+16px)] lg:mt-[calc(var(--header-height)+52px)]">
    <div class="container"><div class="flex items-center gap-7 lg:gap-[100px] lg:flex-row flex-col"><div class="pt-10 lg:pt-0 w-[90%] lg:w-[60%]"><div class="aspect-[712/368] relative"><img alt="404" draggable="false" loading="lazy" decoding="async" data-nimg="fill" class="object-cover" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" src="https://themphim.tv/images/video-404.webp"></div></div><div class="flex flex-col grow min-w-0"><p class="typography font-title lg:text-[32px] lg:leading-[normal] text-[22px] leading-[30px] font-normal max-lg:text-center">Oh no! Chúng tôi không thể tìm thấy trang này</p><p class="typography font-content lg:text-[1rem] lg:leading-[24px] text-[14px] leading-[normal] font-normal mt-4 text-foreground-600 max-lg:text-center">Xin lỗi, chúng tôi không tìm thấy trang bạn đang tìm kiếm</p><div class="flex mt-8 lg:mt-5 max-lg:justify-center"><a class="font-medium a-button rounded-lg flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] relative font-content duration-200 whitespace-nowrap leading-normal active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-400 text-primary-foreground h-10 px-4 gap-[0.625rem]" href="/">Về trang chủ</a></div></div></div></div>
    @foreach ($data as $index => $item)
        @include('themes::themethemphim.inc.section_movies')
    @endforeach
</main>
@endsection

@push('scripts')
@endpush
