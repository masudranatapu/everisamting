<form action="{{ route($routeName) }}" method="GET" id="myad-search">
    <div class="dashboard__filter">
        <div class="dashboard__filter-left">
            <div class="input-field">
                <input type="text" placeholder="{{ __('ads_title_keyword') }}..." name="keyword"
                    value="{{ request('keyword', '') }}" />
                <button class="icon icon-search">
                    <x-svg.search-icon />
                </button>
            </div>
        </div>
        <div class="dashboard__filter-right">
            <div class="dashboard__filter-group">
                <div class="input-select">
                    <select class="form-control category" name="category">
                        <option value="">{{ __('all_categories') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}"
                                {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-select">
                    <select class="form-control" name="sort_by">
                        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>
                            {{ __('latest') }}</option>
                        <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>
                            {{ __('oldest') }}</option>
                    </select>
                </div>
                <div class="input-select">
                    <button class="btn" type="submit" class="w-100" id="myadSearchSubmit">{{ __('search') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
