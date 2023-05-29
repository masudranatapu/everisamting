<div class="product-item__ads-info">
    <h2 class="text--heading-2 title">{{ $ad->title }} {{ isset($ad->designation_id) ? '(' . $ad->designation->name .')' : '' }} </h2>

    <ul class="post-details">
        @if(isset($ad->address))
            <li class="post-details__item">
            <span class="icon">
                <x-svg.location-icon/>
            </span>
                {{-- <p class="text--body-3">{{ $ad->region }} {{ $ad->region ? ', ': '' }} {{ $ad->country }}</p> --}}

                <p class="text--body-3">{{ $ad->address ?? '' }}</p>

            </li>
        @endif
        <li class="post-details__item">
            <span class="icon">
                <x-svg.clock-icon width="24" height="24" stroke="#767E94" />
            </span>
            <p class="text--body-3">{{ \Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</p>
        </li>
        <li class="post-details__item">
            <span class="icon">
                <x-svg.eye-icon stroke="#767E94" />
            </span>
            <p class="text--body-3">{{ $ad->total_views }} {{ __('viewed') }}</p>
        </li>
        @if ($ad->featured == 1)
            <li class="post-details__item">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="#f27319" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="bevel">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </span>
                <p class="text--body-3 text-success">{{ __('featured') }}</p>
            </li>
        @endif
    </ul>
</div>
