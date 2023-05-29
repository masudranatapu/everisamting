@extends('layouts.frontend.layout_one')

@section('title', __('terms_condition'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->terms_background">
        {{ __('terms_condition') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('terms_condition') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- faq section start  -->
    <section class="faq section">
        <div class="container">
            <div class="row justify-content-center">
                {!! $cms->terms_body ?? __('no_terms_conditions_found') !!}
            </div>
        </div>
    </section>
    <!-- faq section end   -->
@endsection
