@extends('frontend.postad.index')

@section('title')
    {{ __('edit_ad') }} ({{ __('steps02') }}) - {{ $ad->title }}
@endsection

@section('post-ad-content')
    @php
        $adinfo = DB::table('ads')
            ->where('id', $ad->id)
            ->first();
        $features = DB::table('ad_features')
            ->where('ad_id', $ad->id)
            ->get();
        $adsgalleries = DB::table('ad_galleries')
            ->where('ad_id', $ad->id)
            ->get();
    @endphp
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
            <form id="step2_edit_form" action="{{ route('frontend.post.step2.update', $ad->slug) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="dashboard-post__information-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-field--textarea">
                                <label for="">{{ __('ad_description') }} <span class="text-danger">*</span></label>
                                <textarea required name="description" placeholder="{{ __('whats_your_thought') }}..." id="description"
                                    class="@error('description') border-danger @enderror">{{ $adinfo->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-field--textarea">
                            <label for="">{{ __('featured') }}</label>
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
                                @foreach ($features as $feature)
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="input-field">
                                                <input value="{{ $feature->name }}" name="features[]" type="text"
                                                    placeholder="{{ __('feature') }}" id="adname"
                                                    class="@error('title') border-danger @enderror" />
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mt-10">
                                            <button onclick="remove_single_field()" id="remove_item"
                                                class="btn btn-sm bg-danger text-light"><i
                                                    class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if (isset($fields) && $fields->count() > 0)
                            <h5 class="mt-3">
                                {{ __('custom_fields') }}
                            </h5>
                            <hr>
                            <div class="row dashboard-post__information-form">
                                @foreach ($fields as $item)
                                    @foreach ($item as $field)
                                        @if ($field->customField->type == 'text')
                                            <div class="col-md-6 input-field__group">
                                                <div class="input-field">
                                                    <x-forms.label name="{{ $field->customField->name }}"
                                                        :required="$field->customField->required" />
                                                    <input value="{{ $field->value }}" type="text"
                                                        name="{{ $field->customField->slug }}"
                                                        placeholder="{{ $field->customField->name }}"
                                                        class="form-control @error($field->customField->slug) border-danger @enderror" />
                                                    @error($field->customField->slug)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        @if ($field->customField->type == 'select')
                                            <div class="col-md-6 input-field__group">
                                                <div class="input-select">
                                                    <x-forms.label name="{{ $field->customField->name }}"
                                                        :required="$field->customField->required" />
                                                    <select id="select" class="form-control"
                                                        name="{{ $field->customField->slug }}">
                                                        @foreach ($field->customField->values as $value)
                                                            <option
                                                                {{ ucfirst($field->value) == ucfirst($value->value) ? 'selected' : '' }}
                                                                value="{{ $value->value }}">
                                                                {{ ucfirst($value->value) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error($field->customField->slug)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        @if ($field->customField->type == 'file')
                                            <div class="col-md-6 input-field__group">
                                                <div class="input-field">
                                                    <x-forms.label name="{{ $field->customField->name }}"
                                                        :required="$field->customField->required" />
                                                    <input type="file" name="{{ $field->customField->slug }}"
                                                        class="form-control @error($field->customField->slug) is-invalid @enderror custom-file-input"
                                                        id="customFile">
                                                    @error($field->customField->slug)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        @if ($field->customField->type == 'textarea')
                                            <div class="col-md-6 input-field__group">
                                                <div class="input-field">
                                                    <x-forms.label name="{{ $field->customField->name }}"
                                                        :required="$field->customField->required" />
                                                    <textarea name="{{ $field->customField->slug }}" placeholder="{{ $field->customField->name }}" cols="12"
                                                        rows="2" id="description" class="form-control @error($field->customField->slug) border-danger @enderror ">{{ $field->customField->slug }}</textarea>
                                                    @error($field->customField->slug)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        @if ($field->customField->type == 'radio')
                                            <div class="col-md-6">
                                                <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                                @foreach ($field->customField->values as $value)
                                                    <div class="form-check">
                                                        <input
                                                            {{ ucfirst($field->value) == ucfirst($value->value) ? 'checked' : '' }}
                                                            value="{{ ucfirst($value->value) }}"
                                                            name="{{ $field->customField->slug }}" type="radio"
                                                            class="form-check-input" id="checkme{{ $value->id }}" />
                                                        <x-forms.label name="{{ $value->value }}" :required="false"
                                                            class="form-check-label" for="checkme{{ $value->id }}" />
                                                    </div>
                                                @endforeach
                                                @error($field->customField->slug)
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                        {{-- @if ($field->customField->type == 'url')
                                    <div class="col-md-6 input-field__group">
                                        <div class="input-field">
                                            <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                            <textarea name="{{ $field->customField->slug }}" placeholder="{{ $field->customField->name }}" cols="12"
                                                rows="2" id="description" class="form-control @error($field->customField->slug) border-danger @enderror ">{{ $field->customField->slug }}</textarea>
                                            @error($field->customField->slug)
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif --}}
                                        @if ($field->customField->type == 'url')
                                            <div class="col-sm-6">
                                                <div class="input-field">
                                                    <x-forms.label name="{{ $field->customField->name }}"
                                                        :required="$field->customField->required" />
                                                    <input type="url" name="{{ $field->customField->slug }}"
                                                        class="form-control @error($field->customField->slug) border-danger @enderror"
                                                        value="{{ old($field->customField->slug, $field->value) }}"
                                                        placeholder="{{ $field->customField->name }}">
                                                    @error($field->customField->slug)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        @if ($field->customField->type == 'number')
                                            <div class="col-sm-6">
                                                <div class="input-field">
                                                    <x-forms.label name="{{ $field->customField->name }}"
                                                        :required="$field->customField->required" />
                                                    <input min="1" type="number"
                                                        name="{{ $field->customField->slug }}"
                                                        class="form-control @error($field->customField->slug) border-danger @enderror"
                                                        value="{{ old($field->customField->slug, $field->value) }}"
                                                        placeholder="{{ $field->customField->name }}">
                                                    @error($field->customField->slug)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        @if ($field->customField->type == 'date')
                                            <div class="col-sm-6">
                                                <div class="input-field">
                                                    <x-forms.label name="{{ $field->customField->name }}"
                                                        :required="$field->customField->required" />
                                                    <input type="date" name="{{ $field->customField->slug }}"
                                                        class="form-control @error($field->customField->slug) border-danger @enderror"
                                                        value="{{ old($field->customField->slug, $field->value) }}"
                                                        placeholder="{{ $field->customField->name }}">
                                                    @error($field->customField->slug)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        @php
                                            $fieldId = 'cf.' . $field->customField->id;
                                            $fieldName = 'cf[' . $field->customField->id . ']';
                                            $fieldOld = 'cf.' . $field->customField->id;
                                        @endphp

                                        @if ($field->customField->type == 'checkbox')
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <x-forms.label name="{{ $field->customField->name }}"
                                                        :required="$field->customField->required" />
                                                    <div class="row">
                                                        @foreach ($field->customField->values as $value)
                                                            @if ($loop->first && $value != '0')
                                                                <input type="hidden" value="0"
                                                                    name="{{ $fieldName }}">
                                                                <div class="col-md-3 mb-1">
                                                                    <div class="icheck-success d-inline">
                                                                        <input {{ $field->value ? 'checked' : '' }}
                                                                            value="1" name="{{ $fieldName }}"
                                                                            type="checkbox" class="form-check-input"
                                                                            id="{{ $fieldId }}" />
                                                                        <label class="form-check-label"
                                                                            for="{{ $fieldId }}">{{ $value->value }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    @error($field->customField->slug)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        @if ($field->customField->type == 'checkbox_multiple')
                                            @php
                                                $exploded_values = explode(', ', $field->value);
                                            @endphp

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <x-forms.label name="{{ $field->customField->name }}"
                                                        :required="$field->customField->required" />
                                                    @foreach ($field->customField->values as $key => $value)
                                                        <div class="icheck-success ">
                                                            <input id="{{ $fieldId . '.' . $value->id }}"
                                                                name="{{ $fieldName . '[' . $value->id . ']' }}"
                                                                type="checkbox" value="{{ $value->id }}"
                                                                class="form-check-input"
                                                                {{ in_array($value->id, $exploded_values) ? 'checked' : '' }} />
                                                            <label class="form-check-label"
                                                                for="{{ $fieldId . '.' . $value->id }}">
                                                                {{ $value->value }}
                                                            </label>
                                                        </div>
                                                    @endforeach

                                                    @error($field->customField->slug)
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row dashboard-post__information-form mt-3 mb-3">
                            <div class="col-md-12 input-field__group">
                                <div class="col-md-12 mb-3">
                                    <label for="">{{ __('ad_location') }}  <span class="text-danger">*</span></label>
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
                                    <div>

                                        <input type="text" name="location" id="form_address" class="form-control"
                                            placeholder="Enter your location" value="{{ $ad->address }}">
                                        <button class="getlocation" type="button" id="button-addon2">
                                            <i class="fa-solid fa-location-dot"></i> Use my
                                            current location
                                        </button>
                                    </div>
                                    @error('location')
                                        <span class="text-md text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <small id="emailHelp" class="form-text text-muted" style="margin-top: -12px;">
                                {{ __('location_info') }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 upload-wrapper">
                        <h3>{{ __('Thumbnail Image') }} <span class="text-danger">*</span></h3>
                        <div class="input-field">
                            <input type="file" name="thumbnail"
                                class="form-control @error('title') border-danger @enderror" onchange="readURL(this);">
                            <input type="hidden" name="old_thumbnail" value="{{ $ad->thumbnail ?? '' }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <img src="{{ asset($adinfo->thumbnail ?? '') }}" id="thumbnail"
                            style="height: 100px;width: 80px;float: right;margin-right: 46%;">
                    </div>
                </div>
                <div class="col-12 mb-4 mt-4">
                    <div class="row">
                        @foreach ($adsgalleries as $gallery)
                            <div class="col-md-3" id="photo_div_{{ $gallery->id }}" class="gallery_sec">
                                <div class="form-group">
                                    <div id="image-box" class="img-box"
                                        style="border: 2px solid #ccc; display: inline-block;">
                                        <img src="{{ asset($gallery->image) }}" class="img-fluid"
                                            style="width: 200px; height: 200px;">
                                        <div class="img-box-child">
                                            <a href="javascript:void(0)" class="text-danger delete_image h4"
                                                data-url="{{ route('frontend.ad.gallery.delete', $gallery->id) }}"
                                                data-id="{{ $gallery->id }}"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="dashboard-post__information-form">
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
                    <a href="{{ route('frontend.post.step1.back', $ad->slug) }}" class="btn btn--lg btn--outline">
                        {{ __('previous') }}
                    </a>
                    <button type="submit" class="btn btn--lg ms-3">
                        {{ __('finish_update') }}
                    </button>
                </div>
                <input type="hidden" id="cancel_edit_input" name="cancel_edit" value="0">
                <input type="hidden" name="old_lat" class="old_lat" value="{{ $lat }}">
                <input type="hidden" name="old_long" class="old_long" value="{{ $long }}">
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

        $(document).on('click', '.delete_image', function(e) {
            var id = $(this).data('id');
            // alert(id);
            var div = '#photo_div_' + id;
            var url = $(this).data('url');
            if (!confirm('Are you sure you want to delete the photo')) {
                return false;
            }
            if ('' != id) {
                $.ajax({
                    type: 'get',
                    url: url,
                    async: true,
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 'success') {
                            $(div).hide();
                            toastr.success(response.message);
                        }
                    },
                });
            }
        })
    </script>
    <script defer
        src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en&key=AIzaSyA72zy8Wy4kFpom_brg28OqBOa8S0eXXGY"
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
    {{-- <x-set-googlemap :lat="$lat" :long="$long" /> --}}
@endsection
