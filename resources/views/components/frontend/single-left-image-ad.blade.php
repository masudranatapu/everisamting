<div  class="{{ $classList }}">
    <div class="cards cards--two {{  $ad->featured ? 'cards--highlight' : '' }}">
        <a href="{{ route('frontend.addetails',$ad->slug) }}" class="cards__img-wrapper">
            @if ($ad->thumbnail)
            <img src="{{ asset($ad->thumbnail) }}" alt="card-img" />
            @else
            <img src="{{ asset('backend/image/default-ad.png') }}" alt="card-img" />
            @endif
        </a>
        <div class="cards__info">
            <div class="cards__info-top">
                <div class="text--body-3 cards__category-title">
                    <span class="icon">
                        <i class="{{ $ad->category->icon }}" style="color:#ff4f4f"></i>
                    </span>
                    {{ $ad->category->name }}
                    @if ($ad->featured)
                        <div class="tag-label tag-label--feature">
                            {{ __('featured') }}
                        </div>
                    @endif

                </div>
                <a href="{{ route('frontend.addetails',$ad->slug) }}" class="text--body-3-600 cards__caption-title">
                    {{ \Illuminate\Support\Str::limit($ad->title, 40, $end='...') }}
                </a>

                <div class="cards__user-details">
                    <div class="cards__user-details__item">
                        <h5 class="text--body-4 username">
                            <span class="icon">
                                <x-svg.user-icon stroke="#939AAD" />
                            </span>
                            {{ $ad->customer->name }}
                        </h5>
                    </div>
                    <div class="cards__user-details__item">
                        <h5 class="text--body-4 location">
                            <span class="icon">
                                <x-svg.location-icon width="16" height="16" stroke="#939AAD" />
                            </span>
                            {{ $ad->region }} {{ $ad->region ? ', ': '' }} {{ $ad->country }}
                        </h5>
                    </div>
                    <div class="cards__user-details__item">
                        <h5 class="text--body-4 location">
                            <span class="icon">
                                <x-svg.clock-icon width="18" height="18" stroke="#939AAD" />
                            </span>
                            {{ $ad->created_at }}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="cards__info-bottom">
                <span class="cards__price-title text--body-2">${{ $ad->price }}</span>
                <form action="{{ route('frontend.add.wishlist') }}" method="POST">
                    @csrf

                    @if (auth('user')->check())
                    <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                    <input type="hidden" name="user_id" value="{{ auth('user')->user()->id }}">
                    <button type="submit" class="btn-icon">
                        @if (isWishlisted($ad->id))
                            <x-svg.heart-icon fill="#00AAFF" stroke="#00AAFF" stroke-width="0.5" />
                        @else
                            <x-svg.heart-icon fill="none" stroke="#00AAFF" stroke-width="1.6" />
                        @endif
                    </button>
                    @else
                    <a href="{{ route('users.login') }}">
                        <button type="submit" class="btn-icon login_required">
                            <x-svg.heart-icon fill="none" stroke="#00AAFF" stroke-width="1.6" />
                        </button>
                    </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
