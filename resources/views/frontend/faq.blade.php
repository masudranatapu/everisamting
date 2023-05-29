@extends('layouts.frontend.layout_one')

@section('title', __('faqs'))

@section('meta')
@php
$data = metaData('faq');
@endphp

<meta name="title" content="{{ $data->title }}">
<meta name="description" content="{{ $data->description }}">

<meta property="og:image" content="{{ $data->image_url }}" />
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:title" content="{{ $data->title }}">
<meta property="og:url" content="{{ route('frontend.faq') }}">
<meta property="og:type" content="article">
<meta property="og:description" content="{{ $data->description }}">

<meta name=twitter:card content={{ $data->image_url }} />
<meta name=twitter:site content="{{ config('app.name') }}" />
<meta name=twitter:url content="{{ route('frontend.faq') }}" />
<meta name=twitter:title content="{{ $data->title }}" />
<meta name=twitter:description content="{{ $data->description }}" />
<meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('content')
<!-- breedcrumb section start  -->
<x-frontend.breedcrumb-component :background="$cms->faq_background">
    {{ __('faqs') }}
    <x-slot name="items">
        <li class="breedcrumb__page-item">
            <a class="breedcrumb__page-link text--body-3">{{ __('faqs') }}</a>
        </li>
    </x-slot>
</x-frontend.breedcrumb-component>
<!-- breedcrumb section end  -->

<!-- faq section start  -->
@php
$cat_count = $categories->count();
@endphp
<section class="faq section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-{{ $cat_count <= 3 ? 6 : 8 }}">
                <h2 class="faq__title text--heading-1">{{ __('frequently_asked_question') }}</h2>
                <p class="faq__brief text--body-3">
                    {{ $cms->faq_content }}
                </p>
                <ul class="nav nav-pills faq__nav" id="pills-tab" role="tablist">
                    @foreach ($categories as $faq_category)
                    <li class="nav-item faq__nav-item my-1" role="presentation">
                        <a onclick="setCategorySlug('{{ $faq_category->slug }}')" href="javascript:void(0)" class="nav-link faq__nav-link
                                @if (request('category')) @if ($faq_category->slug === request('category')) active @endif
                                @else
                                @if ($loop->first) active @endif
                                @endif
                               ">
                            <span class="icon">
                                <i class="{{ $faq_category->icon }}"
                                    style="font-size: 30px; line-height: 32px; font-weight: 600; color: #191f33;"></i>
                            </span>
                            {{ $faq_category->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-pane show active" id="pills-general" role="tabpanel"
                    aria-labelledby="pills-general-tab">
                    <!-- Frequent Asked Question  -->
                    <div class="accordion faq__acordion">
                        @foreach ($faqs as $faq)
                        <div class="accordion-item faq__accordion-item">
                            <h2 class="accordion-header faq__accordion-header" id="freq{{ $faq->id }}">
                                <button class="accordion-button faq__accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}"
                                    aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                    <span class="text"> {{ $faq->question }} </span>
                                    <span class="icon">
                                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.75 12.0039H20.25" stroke="currentColor" stroke-width="1.6"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12 3.75391V20.2539" stroke="currentColor" stroke-width="1.6"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}"
                                class="accordion-collapse faq__accordion-collapse collapse "
                                aria-labelledby="freq{{ $faq->id }}">
                                <div class="accordion-body faq__accordion-body">
                                    <p class="text--body-3">
                                        {!! $faq->answer !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    <form id="faqForm" action="{{ route('frontend.faq') }}" method="GET">
        <input id="categoryInput" type="hidden" name="category" value="{{ request('category') }}" />
    </form>
</section>
<!-- faq section end   -->
@endsection

@section('adlisting_style')
<style>
    .faq__nav .faq__nav-item a {
        text-align: center;
    }

    .faq__nav .faq__nav-item:hover i {
        color: #0a58ca !important;
        transition: .15s;
    }

    .active .icon i {
        color: #fff !important;
    }

    .faq__nav .faq__nav-item:hover .active .icon i {
        color: #fff !important;
    }

</style>
@endsection

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/venobox.min.js"></script>
<script>
    function setCategorySlug(categorySlug) {
        $('#categoryInput').val(categorySlug)
        $('#faqForm').submit()
    }

</script>
@endsection
