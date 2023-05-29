<div>
    <section class="breedcrumb" style="background: url('{{ asset($background) }}') center center/cover no-repeat; padding-top: 133px !important;">
        <div class="container">
            <h2 class="breedcrumb__title text--heading-2">{{ $slot }}</h2>
            <ul class="breedcrumb__page">
                <li class="breedcrumb__page-item">
                    <a href="{{ route('frontend.index') }}" class="breedcrumb__page-link text--body-3">{{ __('home') }}</a>
                </li>
                <li class="breedcrumb__page-item">
                    <a class="breedcrumb__page-link text--body-3">/</a>
                </li>
                {{ $items }}
            </ul>
        </div>
    </section>
</div>
