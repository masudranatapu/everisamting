<div class="product_wrapper {{ $className }}">
    <div class="product_item">
        <div class="product_img">
            @if ($ad->thumbnail && \Illuminate\Support\Facades\File::exists($ad->thumbnail))
                <a href="{{ route('frontend.addetails', $ad->slug) }}">
                    <img src="{{ asset($ad->thumbnail) }}" alt="{{ $ad->region }}" class="img-fluid"/>
                </a>
            @else
                <a href="{{ route('frontend.addetails', $ad->slug) }}">
                    <img src="{{ asset('backend/image/default-post.png') }}" alt="{{ $ad->region }}" class="img-fluid"/>
                </a>
            @endif
            @if($ad->featured)
                <div class="featured_tag">
                    <span>Featured</span>
                </div>
            @endif
        </div>
        <div class="product_content">
            <span class="category_name">{{ $ad->category->name }}</span>
            <h2>
                <a href="{{ route('frontend.addetails', $ad->slug) }}">{{ \Illuminate\Support\Str::limit($ad->title, 25, $end = '...') }}</a>
            </h2>
            <div class="cards__info-bottom">
                <h6 class="cards__location text--body-4" title="{{ $ad->address }}">
                    @if(isset($ad->address))
                        <span class="icon">
                            <x-svg.location-icon width="20" height="20" stroke="#27C200"/>
                        </span>
                        {{ Str::limit($ad->address, 10, '...') }}
                    @endif
                </h6>
                <span class="cards__price-title text--body-3-600">
                    @if (isset($ad->price))
                        {{ changeCurrency(number_format($ad->price, 0, '.', ',')) }} {{ $ad->price_type ?? '' }}

                    @elseif (isset($ad->salary_from) && isset($ad->salary_to))
                        {{ changeCurrency(number_format($ad->salary_from, 0, '.', ',')) }} - {{ changeCurrency(number_format($ad->salary_to, 0, '.', ',')) }}

                    @else
                        {{ __('negotiable') }}

                    @endif
                </span>
            </div>
        </div>
    </div>
</div>
