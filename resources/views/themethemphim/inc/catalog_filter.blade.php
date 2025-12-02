<form id="form-filter" class="flex items-center gap-4 flex-wrap" method="GET" action="/">
    <div class="flex items-center gap-2 max-sm:w-full">
        <p class="typography font-content text-[14px] leading-[normal] font-semibold shrink-0 max-sm:min-w-[72px]">Sắp xếp</p>
        <select name="filter[sort]" form="form-filter" class="flex w-full items-center justify-between rounded-md border border-default-400 bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1 h-9 sm:h-11 min-w-[186px]" id="order">
            <option value="">Sắp xếp</option>
            <option value="update" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'update') selected @endif>Thời gian cập nhật</option>
            <option value="create" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'create') selected @endif>Thời gian đăng</option>
            <option value="year" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'year') selected @endif>Năm sản xuất</option>
            <option value="view" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'view') selected @endif>Lượt xem</option>
        </select>
    </div>
    <div class="flex items-center gap-2 max-sm:w-full">
        <p class="typography font-content text-[14px] leading-[normal] font-semibold shrink-0 max-sm:min-w-[72px]">Thể loại</p>
        <select name="filter[category]" form="form-filter" class="flex w-full items-center justify-between rounded-md border border-default-400 bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1 h-9 sm:h-11 min-w-[186px]" id="cat_id">
            <option value="">Thể loại</option>
            @foreach (\Vsphim\Core\Models\Category::fromCache()->all() as $item)
                <option value="{{ $item->id }}" @if ((isset(request('filter')['category']) && request('filter')['category'] == $item->id) ||
                    (isset($category) && $category->id == $item->id)) selected @endif>
                    {{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex items-center gap-2 max-sm:w-full">
        <p class="typography font-content text-[14px] leading-[normal] font-semibold shrink-0 max-sm:min-w-[72px]">Quốc gia</p>
        <select name="filter[region]" form="form-filter" class="flex w-full items-center justify-between rounded-md border border-default-400 bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1 h-9 sm:h-11 min-w-[186px]" id="city_id">
            <option value="">Quốc gia</option>
            @foreach (\Vsphim\Core\Models\Region::fromCache()->all() as $item)
                <option value="{{ $item->id }}" @if ((isset(request('filter')['region']) && request('filter')['region'] == $item->id) ||
                    (isset($region) && $region->id == $item->id)) selected @endif>
                    {{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <input type="submit" form="form-filter" class="btn cursor-pointer bg-primary rounded-md px-4 py-2" value="Lọc phim" />
</form>
