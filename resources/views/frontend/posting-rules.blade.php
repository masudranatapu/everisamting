@extends('layouts.frontend.layout_one')
@section('title')
    {{ __('posting_rules') }}
@endsection

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->posting_rules_background">
        {{ __('post_ads') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.dashboard') }}"
                    class="breedcrumb__page-link text--body-3">{{ __('dashboard') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3"> {{ __('posting_rules') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- dashboard section start  -->
    <section class="section dashboard">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9">
                    <div class="dashboard-card dashboard__upgrade">
                        <h2 class="dashboard-card__title"> {{ __('posting_rules') }}</h2>
                        <div class="dashboard__upgrade-content">
                            @if ($cms->posting_rules_body)
                                {!! $cms->posting_rules_body !!}
                            @else
                                {{ __('no_rules_found') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard section end  -->
@endsection
