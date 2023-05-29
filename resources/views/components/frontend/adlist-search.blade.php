@php
    $isMob= is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    $isTab= is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet"));
    $isWin= is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows"));
    $isMac= is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "Mac"));

@endphp
@props(['searchableFields'])
<form action="{{ route('frontend.adlist.search') }}" method="GET" id="topSearchFrom">
    <div class="ad-list__search-box">
        <div class="container">
            <!-- Search Box -->
            <div class="search {{ $dark ? 'search-no-borders border-0' : '' }}">

                <div class="search__content">
                    <!-- search by keyword/title -->
                    <div class="search__content-item">
                        @if($isWin || $isMac )
                        <div class="input-field {{ $dark ? 'input-field--transparent' : '' }}">
                            <input type="text" placeholder="{{ __('search_by_ads_title_keywords') }}..." name="keyword"
                                value="{{ request('keyword', '') }}" />
                            <span class="icon icon--left">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                    fill="none" stroke="#f27319" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="bevel">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    <line x1="11" y1="8" x2="11" y2="14"></line>
                                    <line x1="8" y1="11" x2="14" y2="11"></line>
                                </svg>
                            </span>
                        </div>
                        @endif
                        <input type="hidden" name="lat" id="lat" value="">
                        <input type="hidden" name="long" id="long" value="">
                    </div>
                    @php
                    $oldLocation = request('location');
                    $map = setting('default_map');
                    @endphp
                    @if ($map == 'map-box')
                    <input type="hidden" name="location" id="insertlocation" value="">
                    <div class="search__content-item">
                        <div class="p-1 d-flex align-items-center">
                            <x-svg.search-location-icon />
                            <span id="geocoder"></span>
                        </div>
                    </div>
                    @endif
                    @if ($map == 'google-map')
                    <div class="search__content-item">
                        <div class="input-field {{ $dark ? 'input-field--transparent' : '' }}">
                            <input type="text" id="searchInput" placeholder="{{ __('enter_a_location') }}..."
                                name="location" value="{{ $oldLocation }}" />
                            <span class="icon icon--left">
                                <x-svg.search-location-icon />
                            </span>
                            <div id="google-map" class="d-none"></div>
                        </div>
                    </div>
                    @endif
                    <!-- Search By location -->

                    <!-- Select Category temprorary disable -->
                    <div class="search__content-item">
                        <div class="input-field {{ $dark ? 'input-field--transparent' : '' }}">
                            <select class="category_select" id="category" style="width: calc(100% - 60px);">
                                @php
                                $categories_slug = explode(',', request('category'));
                                @endphp
                                <option value="" style="display: none;">{{ __('select_category') }}</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->slug }}" {{ in_array($category->slug, $categories_slug) ?
                                    'selected' : '' }}>
                                    {{ $category->name }} </option>
                                @endforeach
                            </select>
                            <span class="icon icon--left">
                                <x-svg.category-icon />
                            </span>
                        </div>
                    </div>
                    <!-- Search Btn -->
                    <div class="search__content-item">
                        <button class="btn btn--lg d-flex align-items-center" type="submit">
                            <span class="icon--left">
                                <x-svg.search-icon stroke="#fff" />
                            </span>
                            {{ __('search') }}
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Mobile Search --}}
    <div class="mobile-search-filed">
        @if($isMob && $isTab )
        <div class="container">
            <div class="search-field-wrap">
                <div class="input-field">
                    <input type="text" name="keyword" placeholder="Search for anything">
                    <span class="icon icon--left">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.16667 15.8333C12.8486 15.8333 15.8333 12.8486 15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333Z"
                                stroke="#f27319" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                            <path d="M17.5 17.5L13.875 13.875" stroke="#f27319" stroke-width="1.6"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                @endif
                <span class="toggle-bar">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 11.25L12 20.25" stroke="white" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M12 3.75L12 8.25" stroke="white" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M18.75 18.75L18.7501 20.25" stroke="white" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M18.7501 3.75L18.75 15.75" stroke="white" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M21 15.75H16.5" stroke="white" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M5.25007 15.75L5.25 20.25" stroke="white" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M5.25 3.75L5.25007 12.75" stroke="white" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M3 12.75H7.5" stroke="white" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M14.25 8.25H9.75" stroke="white" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>

                </span>
            </div>

        </div>
    </div>
    <div class="offcanvas-overlay"></div>

    {{ $slot }}
</form>

@push('component_style')
<link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/style.css') }}">
@endpush
@push('component_script')
<script src="{{ asset('frontend/plugins/mapbox/mapbox-gl.js') }}"></script>
<script src="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.min.js') }}"></script>

<script>
    mapboxgl.accessToken = "{{ setting('map_box_key') }}";
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            types: 'country,region,place,postcode,locality,neighborhood'
        });
        geocoder.addTo('#geocoder');
        // Add geocoder result to container.
        geocoder.on('result', (e) => {
            console.log(e.result.center);
            var full_address = e.result.place_name;
            var words = full_address.split(",");
            var country = words.pop();
            var place = words.pop();
            const text = place + ',' + country;
            $('#insertlocation').val(text);
            $('#lat').val(e.result.center[1]);
            $('#long').val(e.result.center[0]);
        });
        // Clear results container when search is cleared.
        geocoder.on('clear', () => {
            results.innerText = '';
        });
</script>
<script>
    $('.mapboxgl-ctrl-geocoder--icon').hide();
        $('.mapboxgl-ctrl-geocoder--input').attr("placeholder", "Location");
        var oldLocation = "{!! $oldLocation !!}";
        if (oldLocation) {
            $('.mapboxgl-ctrl-geocoder--input').val(oldLocation);
        }
</script>
<!-- ============== gooogle map ========== -->
<script>
    function initMap() {
            var token = "{{ setting('google_map_key') }}";
            var oldlat = {{ Session::has('location') ? Session::get('location')['lat'] : setting('default_lat') }};
            var oldlng = {{ Session::has('location') ? Session::get('location')['lng'] : setting('default_long') }};
            const map = new google.maps.Map(document.getElementById("google-map"), {
                zoom: 7,
                center: {
                    lat: oldlat,
                    lng: oldlng
                },
            });
            // Search
            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });
            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                const total = place.address_components.length;
                let amount = '';
                if (total > 1) {
                    amount = total - 2;
                }
                const result = place.address_components.slice(amount);
                let country = '';
                let region = '';
                for (let index = 0; index < result.length; index++) {
                    const element = result[index];
                    if (element.types[0] == 'country') {
                        country = element.long_name;
                    }
                    if (element.types[0] == 'administrative_area_level_1') {
                        const str = element.long_name;
                        const first = str.split(',').shift()
                        region = first;
                    }
                }
                const text = region + ',' + country;
                $('#insertlocation').val(text);
                $('#lat').val(place.geometry.location.lat());
                $('#long').val(place.geometry.location.lng());
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
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
@endpush
