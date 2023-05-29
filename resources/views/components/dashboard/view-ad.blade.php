<a href="{{ route('frontend.addetails', $ad->slug) }}" class="edit-dropdown__link">
    <span class="icon">
        <x-svg.eye-icon stroke="currentColor" width="20" height="20" />
    </span>
    <h5 class="text--body-4">{{ __('view_ads_details') }}</h5>
</a>
