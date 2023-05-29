<div class="location-card">
    <a href="{{ route('frontend.adlist.search',['country'=>$country]) }}" class="location-card__img-wrapper">
        <img class="rounded" src="{{ $country }}" alt="location">
    </a>
    <div class="location-card__info">
        <h2 class="location-card__loc-title text--body-2-600">{{ $country && $country }}
        <div class="location-card__view">
            <span class="first view-number">11</span>
            <a href="{{ route('frontend.adlist.search',['country'=>$country]) }}" class="second view-btn">
                {{ __('view_ads') }}
                <span class="icon">
                    <x-svg.right-arrow-icon stroke="#00AAFF"/>
                </span>
            </a>
        </div>
    </h2></div>
</div>
