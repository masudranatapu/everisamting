@extends('admin.layouts.app')
@section('title')
    {{ __('ad_details') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('ad_details') }}</h3>
                        <a href="{{ route('module.ad.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>

                    <div class="row m-2">
                        <div class="col-md-4">
                            <h5><strong>{{ __('thumbnail') }}</strong></h5>
                            <img src="{{ $ad->image_url }}" alt="image" class="image-fluid" height="350px"
                                width="350px">
                        </div>
                        <div class="col-md-8 pt-4">
                            <div class="table-responsive">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <tbody>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('title') }}</th>
                                        <td width="80%">{{ $ad->title }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('customer') }}</th>
                                        <td width="80%">{{ $ad->customer->name }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('price') }}</th>
                                        <td width="80%">
                                            @if($ad->category_id == 10)
                                                $ {{ $ad->price }} <sub>Per Month</sub>
                                            @else 
                                                $ {{ $ad->price }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('category') }}</th>
                                        <td width="80%">{{ $ad->category->name }}</td>
                                    </tr>
                                    @if ($ad->subcategory && $ad->subcategory->name)
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('subcategory') }}</th>
                                            <td width="80%">{{ $ad->subcategory->name }}</td>
                                        </tr>
                                    @endif
                                    {{-- <tr class="mb-5">
                                        <th width="20%">{{ __('brand') }}</th>
                                        <td width="80%">{{ $ad->brand->name }}</td>
                                    </tr> --}}
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('brand') }}</th>
                                        <td width="80%">{{ $ad->brand_name ?? '' }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('address') }}</th>
                                        <td width="80%">
                                            {{-- {{ Str::limit($ad->region, 10, '...') }} --}}
                                            {{-- {{ $ad->region ? ', ' : '' }} --}}
                                            {{ $ad->address }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('featured') }}</th>
                                        <td width="80%">{{ $ad->featured ? 'Yes' : 'No' }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('total_views') }}</th>
                                        <td width="80%">{{ $ad->total_views }}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('ad_link') }}</th>
                                        <td width="80%"><a target="_blank"
                                                href="{{ route('frontend.addetails', $ad->slug) }}">{{ __('go_to_link') }}</a>
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('description') }}</th>
                                        <td width="80%">{!! $ad->description !!}</td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('features') }}</th>
                                        <td width="80%">
                                            <ul>
                                                @forelse ($ad->adFeatures as $feature)
                                                    <li>{{ $feature->name }}</li>
                                                @empty
                                                    {{ __('no_features_found') }}
                                                @endforelse
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('galleries') }}</th>
                                        <td width="80%">
                                            @foreach ($ad->galleries as $gallery)
                                                <img width="50px" height="50px" src="{{ asset($gallery->image) }}"
                                                    alt="">
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }

        .ck-editor__editable_inline {
            min-height: 170px;
        }
    </style>
    <!-- >=>Mapbox<=< -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.css') }}" type="text/css">
    <link href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}" rel="stylesheet">
    <!-- >=>Mapbox<=< -->
    <style>
        .mymap {
            width: 100%;
            min-height: 400px;
            /* border-radius: 12px; */
        }

        .p-half {
            padding: 1px;
        }

        .location-text {
            color: #191f33;
            font-weight: 600;
            padding: 22px;
            border-bottom: 1px solid #ebeef7;
            font-size: 24px;
            text-transform: capitalize;
            margin-bottom: 1px
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $('.select2s4').select2({
            theme: 'bootstrap4'
        })
        $('.select2ds4').select2({
            theme: 'bootstrap4'
        })
        $('.select2ds4').select2({
            theme: 'bootstrap4'
        })
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor3'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <!-- >=>Mapbox<=< -->
    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl.js') }}"></script>
    <!-- >=>Mapbox<=< -->
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
        $('.mapboxgl-ctrl-attrib-inner').addClass('d-none');
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
