@extends('layouts.frontend.gallery')

@section('title')
{{ $ad->title }}
@endsection

@section('content')

<section class="full-screen-gallery">
    <div class="overlay"></div>
    <div class="content">
        <div class="slider-wrapper">
            <a class="cross" href="{{ route('frontend.addetails', $ad) }}">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>
            <div class="main-image-wrapper">
                <div class="gallery-slider-left">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </div>
                <div class="main-image product-sliderview-for">
                    @foreach ($ad->galleries as $gallery )
                    <div class="main-image-item active">
                        <img src="{{ asset($gallery->image) }}" alt="product-img" />
                    </div>
                    @endforeach
                </div>
                <div class="gallery-images product-sliderview-nav">
                    @foreach ($ad->galleries as $gallery )
                        <div class="gallery-item active">
                            <img src="{{ asset($gallery->image) }}" alt="product-img" />
                        </div>
                    @endforeach
                </div>
                <div class="gallery-slider-right slick-arrow" style="">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('adlisting_style')
<link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />
@endsection

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
<script>
    // class="overlay-view"
    document.body.classList.add('overlay-view')
</script>
@endsection
