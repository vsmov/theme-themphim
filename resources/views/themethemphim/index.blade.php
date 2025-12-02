@extends('themes::themethemphim.layout')

@php
    use Vsphim\Core\Models\Movie;

    $recommendations = Cache::remember('site.movies.recommendations', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('is_recommended', true)
            ->limit(get_theme_option('recommendations_limit', 10))
            ->orderBy('updated_at', 'desc')
            ->get();
    });

    $data = Cache::remember('site.movies.latest', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('latest'));
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
<link
  rel="stylesheet"
  href="/themes/themphim/css/swiper-bundle.min.css"
/>

<main class="pb-[32px] lg:pb-[100px]">
    <h1 class="hidden">{{env('APP_NAME')}} | Phim Mới, Phim Hay, Phim gì cũng có</h1>
    @include('themes::themethemphim.inc.slider_recommended')
    @foreach ($data as $index => $item)
        @if ($item['type'] == 'list')
            @include('themes::themethemphim.inc.section_movies')
        @else
            @include('themes::themethemphim.inc.section_slider')
        @endif
    @endforeach
</main>
@endsection

@push('scripts')
<script src="/themes/themphim/js/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-recommended', {
        loop: true,
        effect: 'fade',
        fade: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
    });

    var swiperHot = new Swiper('.swiper-hot', {
        loop: true,
        slidesPerView: 7,
        spaceBetween: 20,
        breakpoints: {
            1024: {
                slidesPerView: 7,
            },
            640: {
                slidesPerView: 5,
            },
            0: {
                slidesPerView: 3,
            },
        },
        navigation: {
            nextEl: '.navigation-next-button',
            prevEl: '.navigation-prev-button',
        },
    });
    const thumbSlides = document.querySelectorAll('.thumbs-slider .item-thumb');

    thumbSlides.forEach((slide, index) => {
        slide.addEventListener('click', () => {
            swiper.slideTo(index);

            thumbSlides.forEach(s => s.querySelector('.thumb-overlay').style.opacity = '0');
            slide.querySelector('.thumb-overlay').style.opacity = '1';
        });
    });

    swiper.on('slideChange', function() {
        thumbSlides.forEach((slide, index) => {
            const overlay = slide.querySelector('.thumb-overlay');
            overlay.style.opacity = index === swiper.activeIndex ? '1' : '0';
        });
    });
</script>
@endpush
