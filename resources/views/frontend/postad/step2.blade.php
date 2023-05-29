@extends('frontend.postad.index')

@section('title', __('step2'))

@section('post-ad-content')
    <!-- Step 02 -->
    <div class="tab-pane fade show active" id="pills-post" role="tabpanel" aria-labelledby="pills-post-tab">
        <div class="dashboard-post__ads step-information">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('frontend.post.step2.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="dashboard-post__information-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-field--textarea">
                                <label for="">{{ __('ad_description') }}<span class="text-danger">*</span></label>
                                <textarea required name="description" placeholder="{{ __('whats_your_thought') }}..." id="descriptio"
                                    class="@error('description') border-danger @enderror">{{ old('description') ?? session()->get('ad_details') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-field--textarea">
                            <label for="">{{ __('feature') }}</label>
                            <div id="multiple_feature_part">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="input-field">
                                            <input name="features[]" type="text" placeholder="{{ __('feature') }}"
                                                id="adname" class="@error('title') border-danger @enderror" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a role="button" onclick="add_features_field()"
                                            class="btn bg-primary btn-sm text-light">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (isset($category->customFields) && $category->customFields->count() > 0)

                        <h5 class="mt-3">
                            {{ __('custom_fields') }}
                        </h5>
                        <hr>
                        <div class="row dashboard-post__information-form">
                            @foreach ($category->customFields as $field)
                                @if ($field->type == 'text')
                                    <div class="col-md-6 input-field__group">
                                        <div class="input-field">
                                            <x-forms.label name="{{ $field->name }}" for="" :required="$field->required" />
                                            <input type="text" name="{{ $field->slug }}"
                                                placeholder="{{ $field->name }}" value="{{ old($field->slug) }}"
                                                class="form-control @error($field->slug) border-danger @enderror" />
                                            @error($field->slug)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                @if ($field->type == 'select')
                                    <div class="col-md-6 input-field__group">
                                        <div class="input-select">
                                            <x-forms.label name="{{ $field->name }}" for="select" :required="$field->required" />
                                            <select id="select" class="form-control" name="{{ $field->slug }}">
                                                @foreach ($field->values as $value)
                                                    <option
                                                        {{ (old(ucfirst($field->value)) == ucfirst($value->value) ? 'selected' : $value->id == 1) ? 'selected' : '' }}
                                                        value="{{ $value->value }}">
                                                        {{ ucfirst($value->value) }}</option>
                                                @endforeach
                                            </select>
                                            @error($field->slug)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                @if ($field->type == 'file')
                                    <div class="col-md-6 input-field__group">
                                        <div class="input-field">
                                            <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                            <input type="file" name="{{ $field->slug }}"
                                                class="form-control @error($field->slug) is-invalid @enderror custom-file-input"
                                                id="customFile">
                                            @error($field->slug)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                @if ($field->type == 'textarea')
                                    <div class="col-md-6 input-field__group">
                                        <div class="input-field">
                                            <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                            <textarea name="{{ $field->slug }}" placeholder="{{ $field->name }}" cols="12" rows="2" id="description"
                                                class="form-control @error($field->slug) border-danger @enderror ">{{ old($field->slug) }}</textarea>
                                            @error($field->slug)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                @if ($field->type == 'radio')
                                    <div class="col-md-6">
                                        <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                        @foreach ($field->values as $value)
                                            <div class="form-check">
                                                <input
                                                    {{ old(ucfirst($field->value)) == ucfirst($value->value) ? 'checked' : '' }}
                                                    value="{{ ucfirst($value->value) }}" name="{{ $field->slug }}"
                                                    type="radio" class="form-check-input"
                                                    id="checkme{{ $value->id }}" />
                                                <x-forms.label name="{{ $value->value }}" :required="false"
                                                    class="form-check-label" for="checkme{{ $value->id }}" />
                                            </div>
                                        @endforeach
                                        @error($field->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                @if ($field->type == 'url')
                                    <div class="col-sm-6">
                                        <div class="input-field">
                                            <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                            <input type="url" name="{{ $field->slug }}"
                                                class="form-control @error($field->slug) border-danger @enderror"
                                                value="{{ old($field->slug) }}" placeholder="{{ $field->name }}">
                                            @error($field->slug)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                @if ($field->type == 'number')
                                    <div class="col-sm-6">
                                        <div class="input-field">
                                            <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                            <input min="1" type="number" name="{{ $field->slug }}"
                                                class="form-control @error($field->slug) border-danger @enderror"
                                                value="{{ old($field->slug) }}" placeholder="{{ $field->name }}">
                                            @error($field->slug)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                @if ($field->type == 'date')
                                    <div class="col-sm-6">
                                        <div class="input-field">
                                            <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                            <input type="date" name="{{ $field->slug }}"
                                                class="form-control @error($field->slug) border-danger @enderror"
                                                value="{{ old($field->slug) }}" placeholder="{{ $field->name }}">
                                            @error($field->slug)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                @php
                                    $fieldId = 'cf.' . $field->id;
                                    $fieldName = 'cf[' . $field->id . ']';
                                    $fieldOld = 'cf.' . $field->id;
                                    $defaultValue = isset($oldInput) && isset($oldInput[$field->id]) ? $oldInput[$field->id] : '';
                                @endphp
                                @if ($field->type == 'checkbox')
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                            <div class="row">
                                                @foreach ($field->values as $value)
                                                    @if ($loop->first)
                                                        <input type="hidden" value="0" name="{{ $fieldName }}">
                                                        <div class="icheck-success d-inline">
                                                            <input {{ old($fieldName) == '1' ? 'checked' : '' }}
                                                                value="1" name="{{ $fieldName }}"
                                                                type="checkbox" class="form-check-input"
                                                                id="{{ $fieldId }}" />
                                                            <label class="form-check-label"
                                                                for="{{ $fieldId }}">{{ $value->value }}
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            @error($field->slug)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                @if ($field->type == 'checkbox_multiple')
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                            @foreach ($field->values as $value)
                                                <div class="icheck-success">
                                                    <input id="{{ $fieldId . '.' . $value->id }}"
                                                        name="{{ $fieldName . '[' . $value->id . ']' }}" type="checkbox"
                                                        value="{{ $value->id }}" class="form-check-input"
                                                        {{ old($fieldName . '[' . $value->id . ']') == $value->id ? 'checked' : '' }} />
                                                    <label class="form-check-label"
                                                        for="{{ $fieldId . '.' . $value->id }}">{{ $value->value }}
                                                    </label>
                                                </div>
                                            @endforeach

                                            @error($field->slug)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="dashboard-post__information-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row dashboard-post__information-form mt-3 mb-3">
                                <div class="col-md-12 input-field__group">
                                    <div class="col-md-12 mb-3">
                                        <label for="">{{ __('ad_location') }} <span class="text-danger">*</span></label>
                                        {{-- <span data-toggle="tooltip" title="Drag the pointer Or click your location"
                                            data-original-title="Drag the pointer Or click your location">
                                            <x-svg.exclamation />
                                        </span>
                                        <span class="text-danger"><strong>( Drag the pointer Or click your location
                                                )</strong></span>
                                        @php
                                            $map = setting('default_map');
                                        @endphp
                                        @if ($map == 'map-box')
                                            <div class="map mymap" id='map-box'></div>
                                        @endif
                                        @if ($map == 'google-map')
                                            <div>
                                                <input id="searchInput" class="mapClass" name="location" type="text"
                                                    placeholder="{{ __('enter_a_location') }}">
                                                <div class="map mymap" id="google-map"></div>
                                            </div>
                                        @endif
                                        @error('location')
                                            <span class="text-md text-danger">{{ $message }}</span>
                                        @enderror --}}


                                        {{-- <input type="text" class="form-control" placeholder="Enter your location"
                                            value=""> --}}

                                        <div>
                                            <input type="text" name="location" id="form_address" class="form-control"
                                                placeholder="Your Location">
                                            <button class="btn getlocation" type="button" id="button-addon2">
                                                <i class="fa-solid fa-location-dot"></i> Use my
                                                current location
                                            </button>
                                        </div @error('location') <span class="text-md text-danger">
                                            {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <small id="emailHelp" class="form-text text-muted" style="margin-top: -12px;">
                                {{ __('location_info') }}
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="upload-wrapper">
                                <h3>{{ __('upload_photos') }}</h3>
                                <div class="alert alert-danger" role="alert">
                                    {{ __('You must upload at least 1 image.') }}
                                    {{ __('image_must_be_in_jpg_jpeg_png_format') }}
                                </div>
                                <div class="input-images-2" style="padding-top: .5rem;" multiple></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-post__action-btns">
                    <a href="{{ route('frontend.post.step1.back') }}" class="btn btn--lg btn--outline">
                        {{ __('previous') }}
                    </a>
                    <button type="submit" class="btn btn--lg ms-3">
                        {{ __('post_ads') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('adlisting_style')
    <link rel="stylesheet" href="{{ asset('image_uploader/image-uploader.css') }}">
    <!-- Format Images loader CSS -->
    <link rel="stylesheet" href="{{ asset('image_uploader/jquery.imagesloader.css') }}">
    <!-- >=>Mapbox<=< -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.css') }}" type="text/css">
    <link href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}" rel="stylesheet">
    <style>
        .mymap {
            width: 100%;
            min-height: 300px;
            border-radius: 12px;
        }

        .p-half {
            padding: 1px;
        }

        .mapClass {
            border: 1px solid transparent;
            margin-top: 15px;
            border-radius: 4px 0 0 4px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 35px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #searchInput {
            font-family: 'Roboto';
            background-color: #fff;
            font-size: 16px;
            text-overflow: ellipsis;
            margin-left: 16px;
            font-weight: 400;
            width: 30%;
            padding: 0 11px 0 13px;
        }

        #searchInput:focus {
            border-color: #4d90fe;
        }

        .getlocation {
            width: 100%;
            background: rgb(255, 255, 255);
            color: #f27319;
            border: 1px solid #f27319;
            padding: 10px 22px;
            margin-top: 10px;
            border-radius: 4px;
            text-align: left;
        }

        .getlocation:hover {
            background: #f27319;
            color: rgb(255, 255, 255);
        }
    </style>
@endsection

@section('frontend_style')
    <link rel="stylesheet" href="{{ asset('image_uploader/image-uploader.css') }}">
    <!-- Format Images loader CSS -->
    <link rel="stylesheet" href="{{ asset('image_uploader/jquery.imagesloader.css') }}">
    <link href="{{ asset('backend/plugins/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
@endsection

@section('frontend_script')
    <script src="{{ asset('backend') }}/dist/js/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor/config.js"></script>
    <script src="{{ asset('image_uploader/image-uploader.min.js') }}"></script>
    <script type="text/javascript">
        $('.input-images-2').imageUploader({
            maxSize: 10 * 1024 * 1024,
            maxFiles: 10,
            multiple: true,
        });

        CKEDITOR.replace('description', {
            height: 150,
            removeButtons: 'PasteFromWord'
        });
        // feature field
        function add_features_field() {
            $("#multiple_feature_part").append(`
                <div class="row">
                    <div class="col-lg-10">
                            <div class="input-field">
                                <input name="features[]" type="text" placeholder="Feature" id="adname" class="@error('title') border-danger @enderror"/>
                            </div>
                    </div>
                    <div class="col-lg-2 mt-10">
                        <button onclick="remove_single_field()" id="remove_item" class="btn btn-sm bg-danger text-light"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            `);
        }
        $(document).on("click", "#remove_item", function() {
            $(this).parent().parent('div').remove();
        });
    </script>
    <script defer
        src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en&key=AIzaSyATgI95Rp6YpYchbA6c8rD-3tC9xRIc96c"
        type="text/javascript"></script>
    <script>
        const options = {

            componentRestrictions: {
                country: "vu"
            },
            fields: ["address_components", "geometry", "icon", "name"],

            types: ["establishment"],
        };

        $(function() {
            var from_places = new google.maps.places.Autocomplete(
                document.getElementById("form_address"), options
            );
            google.maps.event.addListener(
                from_places,
                "place_changed",
            );

        });



        function reverseGeocode(latitude, longitude) {

            fetch('https://maps.googleapis.com/maps/api/geocode/json?latlng=' + latitude + ',' + longitude +
                    '&sensor=true_or_false&key=AIzaSyA72zy8Wy4kFpom_brg28OqBOa8S0eXXGY')
                .then((response) => response.json())
                .then((data) => {

                    if (data.status == "REQUEST_DENIED") {
                        $(".getlocation").html('<i class="fa-solid fa-location-dot"></i> Use my current location');
                        console.error(data.error_message);

                    } else {
                        let formatedAddress = data.results[0].formatted_address
                        $('#form_address').val(formatedAddress);
                        $(".getlocation").html('<i class="fa-solid fa-location-dot"></i> Use my current location');

                    }

                }).catch((error) => {

                });
        }

        function success(data) {
            let latitude = data.coords.latitude;
            let longitude = data.coords.longitude;
            reverseGeocode(latitude, longitude);
        }

        $(".getlocation").click(function() {
            $(this).html(
                '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            if (navigator.geolocation) {

                window.navigator.geolocation
                    .getCurrentPosition(success, console.error);
            }
        })
    </script>
    <!-- map generate  -->
    {{-- <x-set-googlemap /> --}}
@endsection
