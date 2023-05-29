@extends('layouts.frontend.layout_one')

@section('title', __('privacy_policy'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->default_background">
        {{ __('privacy_policy') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('privacy_policy') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- faq section start  -->
    <section class="faq section">
        <div class="container">
            <div class="row justify-content-center">
                {!! $cms->privacy_body ?? __('no_privacy_policy_found') !!}
            </div>
        </div>
    </section>
    <!-- faq section end   -->
@endsection
