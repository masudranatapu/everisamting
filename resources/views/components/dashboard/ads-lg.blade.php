<div class="body-item body-item--lg">
    <div class="card-edit">
        <a href="{{ route('frontend.addetails', $ad->slug) }}" class="card-edit__item product-name">
            <div class="img">
                @if ($ad->thumbnail)
                    <img src="{{ asset($ad->thumbnail) }}" alt="product" />
                @else
                    <img src="{{ asset('backend/image/default-ad.png') }}" alt="product" />
                @endif
            </div>
            <h2 class="text--body-3-600">
                {{ \Illuminate\Support\Str::limit($ad->title, 25, $end = '...') }}
            </h2>
        </a>
        <div class="card-edit__item product-date">
            <span class="text--body-4"> {{ date('Y-M-d', strtotime($ad->created_at)) }} </span>
        </div>
        <div class="card-edit__item product-price">
            <span class="text--body-4">
                @if (isset($ad->price))
                    {{ changeCurrency($ad->price) }} {{ $ad->price_type ?? '' }}
                @elseif (isset($ad->salary_from) && isset($ad->salary_to))
                    {{ changeCurrency($ad->salary_from) }} - {{ changeCurrency($ad->salary_to) }}
                @else
                    {{ __('negotiable') }}
                @endif
            </span>
        </div>
        @if (!request()->routeIs('frontend.favourites'))
            <div class="card-edit__item product-status">
                <x-frontend.dashboard-ad-status :ad="$ad" />
            </div>
        @else
            <div class="card-edit__item product-status">
                {{ $ad->category->name }}
            </div>
        @endif
        <div class="card-edit__item product-action">
            {{ $slot }}
        </div>
    </div>
</div>
