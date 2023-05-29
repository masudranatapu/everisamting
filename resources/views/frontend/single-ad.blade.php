@extends('layouts.frontend.layout_one')

@section('title')
    {{ $ad->title }}
@endsection

@section('meta')
    <meta name="title" content="{{ $ad->title }}">
    <meta name="description" content="{{ $ad->description }}">

    <meta property="og:image" content="{{ $ad->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $ad->title }}">
    <meta property="og:url" content="{{ route('frontend.addetails', $ad->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $ad->description }}">

    <meta name=twitter:card content=summary_large_image />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:creator content="{{ $ad->customer->name }}" />
    <meta name=twitter:url content="{{ route('frontend.addetails', $ad->slug) }}" />
    <meta name=twitter:title content="{{ $ad->title }}" />
    <meta name=twitter:description content="{{ $ad->description }}" />
    <meta name=twitter:image content="{{ $ad->image_url }}" />
@endsection

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->ads_background">
        {{ $ad->title }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ $ad->title }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- single ads section start  -->
    <section class="product-item section">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="single_produt_wrapper">
                        {{-- ad badge --}}
                        <x-frontend.ad-details.ad-badge :featured="$ad->featured" :customerid="$ad->user_id" :verifiedseller="$verified_seller"
                            :status="$ad->status" />

                        {{-- ad info --}}
                        <x-frontend.ad-details.ad-info :ad="$ad" />

                        {{-- ad gallery --}}
                        <x-frontend.ad-details.ad-gallery :galleries="$ad->galleries" :thumbnail="$ad->thumbnail" :slug="$ad->slug" />

                        {{-- ad description --}}
                        <x-frontend.ad-details.ad-description :description="$ad->description" :features="$ad->adFeatures" />
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="product-item__sidebar">
                        <span class="toggle-bar">
                            {{-- <x-svg.toggle-icon /> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 24 24" fill="none" stroke="#034da7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </span>
                        <div class="product-item__sidebar-top">
                            <x-frontend.ad-details.ad-wishlist :id="$ad->id" :price="$ad->price" :ad="$ad" />
                            <x-frontend.ad-details.ad-contact :ad="$ad" />
                            <x-frontend.ad-details.ad-customer-info :customer="$ad->customer" :ad="$ad"
                                :link="$ad->website_link" />
                        </div>
                        <div class="product-item__sidebar-bottom">
                            <div class="product-item__sidebar-item overview">
                                {{-- ad overview --}}
                                <x-frontend.ad-details.ad-overview :ad="$ad" :product_custom_field_groups="$product_custom_field_groups" />

                                <p style="display:block;border-bottom: 1px solid #ebeef7"></p>

                                {{-- ad share --}}
                                <x-frontend.ad-details.ad-share :slug="$ad->slug" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- single ads section End  -->

    <!-- related ads section start  -->
    <x-frontend.ad-details.ad-related-item :lists="$lists" />
    <!-- related ads section end  -->
@endsection

@section('adlisting_style')
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />

    <link rel="stylesheet" href="{{ asset('frontend/css') }}/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/productslider.css') }}" />
    <!-- >=>Mapbox<=< -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.css') }}" type="text/css">
    <link href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}" rel="stylesheet">
    <!-- >=>Mapbox<=< -->
    <style>
        .mymap {
            width: 100%;
            min-height: 400px;
            border-radius: 12px;
        }

        .p-half {
            padding: 1px;
        }

       .location-text {
            color: #191f33;
            font-weight: 600;
            padding: 11px 20px;
            border-bottom: 1px solid #ebeef7;
            font-size: 24px;
            text-transform: capitalize;
            margin-bottom: 1px;
        }
    </style>
@endsection

@section('frontend_script')
    <!-- >=>Mapbox<=< -->
    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl.js') }}"></script>
    <!-- >=>Mapbox<=< -->
    <script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/swiper-bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/js/swiperslider.config.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.0/css/lightgallery-bundle.min.css">

    <!-- lightgallery plugins -->
    <script src="{{asset('lightgallery/lightgallery.js')}}"></script>
    <script src="{{asset('lightgallery/thumbnail.js')}}"></script>
    <script src="{{asset('lightgallery/zoom.js')}}"></script>
    <script type="text/javascript">
        lightGallery(document.getElementById('lightgallery'), {
            plugins: [lgZoom, lgThumbnail],
            speed: 500,
        });
    </script>
    @stack('ad_scripts')
    <!-- ================ mapbox map ============== -->
    <script>
        mapboxgl.accessToken = "{{ setting('map_box_key') }}";
        const coordinates = document.getElementById('coordinates');

        var oldlat = {!! $ad->lat ? $ad->lat : setting('default_lat') !!};
        var oldlng = {!! $ad->long ? $ad->long : setting('default_long') !!};

        const map = new mapboxgl.Map({
            container: 'map-box',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [oldlng, oldlat],
            zoom: 6
        });

        var marker = new mapboxgl.Marker({
                draggable: false
            }).setLngLat([oldlng, oldlat])
            .addTo(map);

        function onDragEnd() {
            const lngLat = marker.getLngLat();
            let lat = lngLat.lat;
            let lng = lngLat.lng;
            $('#lat').val(lat);
            $('#lng').val(lng);
            document.getElementById('form').submit();
        }

        function add_marker(event) {
            var coordinates = event.lngLat;
            marker.setLngLat(coordinates).addTo(map);

        }
    </script>
    <script>
        $('.mapboxgl-ctrl-logo').addClass('d-none');
        $('.mapboxgl-compact').addClass('d-none');
    </script>
    <!-- ================ mapbox map ============== -->
    <!-- ================ google map ============== -->
    <script>
        function initMap() {
            var token = "{{ setting('google_map_key') }}";

            var oldlat = {!! $ad->lat ? $ad->lat : setting('default_lat') !!};
            var oldlng = {!! $ad->long ? $ad->long : setting('default_long') !!};

            const map = new google.maps.Map(document.getElementById("google-map"), {
                zoom: 7,
                center: {
                    lat: oldlat,
                    lng: oldlng
                },
            });

            const image =
                "https://gisgeography.com/wp-content/uploads/2018/01/map-marker-3-116x200.png";
            const beachMarker = new google.maps.Marker({

                draggable: false,
                position: {
                    lat: oldlat,
                    lng: oldlng
                },
                map,
                // icon: image
            });
        }
        window.initMap = initMap;
    </script>
    <script>
        @php
            $link1 = 'https://maps.googleapis.com/maps/api/js?key=';
            $link2 = setting('google_map_key');
            $Link3 = '&callback=initMap&libraries=places,geometry';
            $scr = $link1 . $link2 . $Link3;
        @endphp;
    </script>
    <script src="{{ $scr }}" async defer></script>
    <!-- ================ google map ============== -->
@endsection
