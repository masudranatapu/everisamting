@if ($lists->count())
<section class="section related-post pt-0">
    <div class="container">
        <div class="related-post__header">
            <h2 class="text--heading-1">{{ __('related_ads') }}</h2>
            @if ($lists->count() > 4)
                <div class="slider-btn">
                    <button class="slider-btn--prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#f27319" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="bevel"><circle cx="12" cy="12" r="10"/><path d="M12 8l-4 4 4 4M16 12H9"/></svg>
                    </button>
                    <button class="slider-btn--next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#f27319" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="bevel"><circle cx="12" cy="12" r="10"/><path d="M12 8l4 4-4 4M8 12h7"/></svg>
                    </button>
                </div>
            @endif
        </div>
        <div class="related-post__slider" id="relatedPostSlider">
            @foreach ($lists as $ad)
                <x-frontend.single-ad :ad="$ad" :adfields="$ad->productCustomFields" className="related-post__slider-item" />
            @endforeach
        </div>
    </div>
</section>

@endif