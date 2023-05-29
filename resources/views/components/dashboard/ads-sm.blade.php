<div class="body-item body-item--sm">
    <div class="cards cards--one overflow-visible">
        <a href="ad-details.html" class="cards__img-wrapper">
            @if ($ad->thumbnail)
                <img src="{{ asset($ad->thumbnail) }}" alt="product" />
            @else
                <img src="{{ asset('backend/image/default-ad.png') }}" alt="product" />
            @endif
        </a>
        <div class="cards__info">
            <div class="cards__info-top">
                <h6 class="text--body-4 cards__category-title">
                    <span class="icon">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 11L8 14.5L14 11" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M2 8L8 11.5L14 8" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M2 5L8 8.5L14 5L8 1.5L2 5Z" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    {{ $ad->category->name }}
                </h6>
                <a href="ad-details.html" class="text--body-3-600 cards__caption-title">
                    {{ \Illuminate\Support\Str::limit($ad->title, 25, $end = '...') }}
                </a>

                @if (!request()->routeIs('frontend.favourites'))
                    <div class="cards__info-status">
                        <x-frontend.dashboard-ad-status :ad="$ad" />
                        <h6 class="text--body-4">
                            <span class="icon">
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.5 17.5C14.6421 17.5 18 14.1421 18 10C18 5.85786 14.6421 2.5 10.5 2.5C6.35786 2.5 3 5.85786 3 10C3 14.1421 6.35786 17.5 10.5 17.5Z"
                                        stroke="#FFBF00" stroke-width="1.3" stroke-miterlimit="10"></path>
                                    <path d="M10.5 5.625V10H14.875" stroke="#FFBF00" stroke-width="1.3"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            {{ date('Y-M-d', strtotime($ad->created_at)) }}
                        </h6>
                    </div>
                @endif
            </div>
            <div class="cards__info-bottom">
                <span class="cards__price-title text--body-3-600">{{ changeCurrency(number_format($ad->price, 0, '.', ',')) }}</span>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
