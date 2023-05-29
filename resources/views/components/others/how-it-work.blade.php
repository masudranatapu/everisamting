<section class="section work bgcolor--gray-10">
    <div class="container">
        <h2 class="text--heading-1 section__title">
            {{ __('how_it_work') }}
        </h2>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="work-card">
                    <span class="work-card__icon">
                        <x-svg.user-plus-icon />
                    </span>
                    <span class="work-card__count-number">
                        01
                    </span>
                    <h2 class="work-card__title text--body-1">{{ __('create_account') }}</h2>
                    <p class="work-card__description text--body-3">
                        {{ $cms->create_account }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="work-card">
                    <span class="work-card__icon">
                        <x-svg.big-list-icon />
                    </span>
                    <span class="work-card__count-number">
                        02
                    </span>
                    <h2 class="work-card__title text--body-1">{{ __('post_ads') }}</h2>
                    <p class="work-card__description text--body-3">
                        {{ $cms->post_ads }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="work-card">
                    <span class="work-card__icon">
                        <x-svg.green-cube-icon />
                    </span>
                    <span class="work-card__count-number">
                        03
                    </span>
                    <h2 class="work-card__title text--body-1">{{ __('start_earning') }}</h2>
                    <p class="work-card__description text--body-3">
                        {{ $cms->start_earning }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
