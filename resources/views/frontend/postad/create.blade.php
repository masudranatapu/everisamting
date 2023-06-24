@extends('frontend.postad.index')

@section('title', __('Create Ads'))
@php
    $condition = [
        'jobs' , 'education', 'property', 'health-beauty', 'agriculture'
];
@endphp


@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/summernote/summernote.min.css')}}">
@endpush

@section('post-ad-content')
    <div class="adpost_section">
        <div class="container">
            <form action="{{ route('frontend.post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category" value="{{ $cat->slug }}">
                <input type="hidden" name="category_id" value="{{ $cat->id }}">
                <div class="adpost_form mb-4">
                    <div class="heading mb-4">
                        <h3>Post an ad for <span class="primary-color">{{ $cat->name }}</span></h3>
                    </div>
                    <div class="row">


                        {{-- Services --}}
                        @if ($cat->slug == 'services')
                            @include('frontend.postad.service_category', $service_types)
                        @endif

                        {{-- Pets & Animals --}}
                        @if ($cat->slug == 'pets-animals')
                            @include('frontend.postad.pets_animals_category')
                        @endif

                        <div class="col-12 mb-4">
                            <label for="title" class="form-label">{{ __('title') }}<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                   class="form-control" placeholder="{{ __('title') }}" required>
                            @error('title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="subcategory_id" class="form-label">{{ __('subcategory') }}</label>
                            <select name="subcategory_id" id="subcategory_id" class="form-control select2">
                                <option value="" disabled selected> {{ __('select_subcategory') }}
                                </option>
                                @if (isset($cat->subcategories) && $cat->subcategories->count() > 0)
                                    @foreach ($cat->subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}"
                                            {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                            {{ $subcategory->name }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="location" class="form-label">{{ __('address') }}</label>
                            <div class="input-group">
                                <input type="text" name="address" id="form_address" class="form-control"
                                       placeholder="{{ __('address') }}" value="{{ old('address') }}">
                                <button class="btn getlocation" type="button" title="Use My Current Location" id="button-addon2">
                                    <i class="fa-solid fa-location-dot"></i>
                                </button>
                            </div>
                        </div>

                        @if ($cat->slug != 'jobs')
                            <div class="col-12 mb-2">
                                <label for="job_type" class="form-label">{{ __('contact_info') }}</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" name="show_email" type="checkbox"
                                                   value="1" id="show_email" checked>
                                            <label class="form-check-label" for="show_email">
                                                {{ __('show_email_public') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" name="show_phone" type="checkbox"
                                                   value="1" id="show_phone" checked>
                                            <label class="form-check-label" for="show_phone">
                                                {{ __('show_phone_public') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 mt-2 application_field email_show">
                                        <input type="email" name="email" id="email"
                                               class="email_field form-control"
                                               value="{{ old('email') ?? Auth::user()->email }}"
                                               placeholder="{{ __('enter_email') }}">
                                        @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-4 mt-2 application_field phone_show">
                                        <input type="tel" name="phone" id="phone"
                                               class="phone_field form-control"
                                               value="{{ old('phone') ?? Auth::user()->phone }}"
                                               placeholder="{{ __('enter_phone') }}">
                                        @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6 mb-4">
                            <label for="whatsapp" class="form-label">{{ __('WeChat') }} ( <a
                                    href="https://web.wechat.com/">{{ __('get_help') }}</a> )</label>
                            <input type="tel" name="whatsapp" id="whatsapp" class="form-control"
                                   placeholder="{{ __('WeChat') }}" value="{{ old('whatsapp') }}">
                        </div>
                        {{-- fashion category --}}
                        @if ($cat->slug == 'fashion')
                            <div class="col-md-6 mb-4">
                                <label for="size" class="form-label">{{ __('size') }}</label>
                                <select name="size" id="size" class="form-control">
                                    <option value="" disabled selected> {{ __('select_size') }} </option>
                                    <option value="small" {{ old('size') == 'small' ? 'selected' : '' }} >{{ __('small') }}</option>
                                    <option value="medium" {{ old('size') == 'medium' ? 'selected' : '' }} >{{ __('medium') }}</option>
                                    <option value="large" {{ old('size') == 'large' ? 'selected' : '' }} >{{ __('large') }}</option>
                                    <option value="extra_large" {{ old('size') == 'extra_large' ? 'selected' : '' }} >{{ __('extra_large') }}</option>
                                    <option value="double_extra_large" {{ old('size') == 'double_extra_large' ? 'selected' : '' }} >{{ __('double_extra_large') }}</option>
                                </select>
                            </div>
                        @endif
                        @if ($cat->slug != 'jobs' && $cat->slug != 'property')
                            <div class="col-6 mb-4">
                                <label for="price" class="form-label">{{ __('price') }}</label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                       class="form-control" placeholder="{{ __('price') }}">
                            </div>
                        @endif

                        @if (!in_array($cat->slug, $condition))
                            <div class="col-md-6 mb-4">
                                <label for="condition" class="form-label">{{ __('condition') }}</label>
                                <div class="row">
                                    <div class="col-4 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="condition" value="new"
                                                   {{ old('condition') == 'new' ? 'checked' : '' }} id="condition_2">
                                            <label class="form-check-label" for="condition_2">
                                                new
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="condition" value="used"
                                                   {{ old('condition') == 'used' ? 'checked' : '' }} id="condition_1">
                                            <label class="form-check-label" for="condition_1">
                                                used
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="condition"
                                                   value="gently_used"
                                                   {{ old('condition') == 'gently_used' ? 'checked' : '' }} id="condition_3">
                                            <label class="form-check-label" for="condition_3">
                                                {{__('gently_used')}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif



                        {{-- Mobile category --}}
                        @if ($cat->slug == 'mobiles' || $cat->slug == 'mobile-phones-tablets')
                            @include('frontend.postad.mobile_category', [$brands])
                        @endif

                        {{-- Electronics --}}
                        @if ($cat->slug == 'electronics' || $cat->slug == 'pc')
                            @include('frontend.postad.electronices_category', [$brands])
                        @endif
                        {{-- Vehicles --}}
                        @if ($cat->slug == 'vehicles')
                            @include('frontend.postad.vehicles_category', [$brands])
                        @endif
                        {{-- Property --}}
                        @if ($cat->slug == 'property')
                            @include('frontend.postad.property_category')
                        @endif
                        {{-- Job --}}
                        @if ($cat->slug == 'jobs')
                            @include('frontend.postad.job_category', $designations)
                        @endif

                        <div class="col-12 mb-4 features_list">
                            <label for="features" class="form-label d-block">Features </label>
                            <div class="row feature">
                                @if(old('features'))
                                    @foreach(old('features') as $k => $val)
                                        @if($k == 0)
                                            <div class="col-md-6 mb-4">
                                                <div class="input-group">
                                                    <input type="text" name="features[]" id="features"
                                                           value="{{ $val }}" class="form-control"
                                                           placeholder="{{ __('features') }}">
                                                    <button class="input-group-text btn plus_btn" onclick="addFeatures(this)"
                                                            type="button">
                                                        <span class="">
                                                    <x-svg.image-select-icon/>
                                                </span>
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-6 mb-4">
                                                <div class="input-group">
                                                    <input type="text" name="features[]" id="features"
                                                           value="{{ $val }}" class="form-control"
                                                           placeholder="{{ __('features') }}">
                                                    <button id="remove_item" class="input-group-text btn-danger"
                                                            type="button"><i class="fa fa-times-circle remove_icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                @else
                                    <div class="col-md-6 mb-4">
                                        <div class="input-group">
                                            <input type="text" name="features[]" id="features" class="form-control"
                                                   placeholder="{{ __('features') }}">
                                            <button class="input-group-text btn plus_btn" onclick="addFeatures(this)"
                                                    type="button">
                                                <span class="">
                                                    <x-svg.image-select-icon/>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>


                        <div class="col-12 mb-4">
                            <label for="description" class="form-label">{{ __('description') }}
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="description" id="description" cols="30" rows="7" class="form-control"
                                      placeholder="{{ __('whats_your_thought') }}..." required
                                      style="height:140px;">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12 mb-4">
                            <label for="gallery" class="form-label">{{ __('upload_photos') }} <p
                                    style="color:darkgoldenrod">({{ __('prefer_image_size') }} 850x650)</p></label>
                            <div class="imageUploader"></div>
                        </div>
                    </div>
                    @if ($user_plan->featured_limit > 0)
                        <div class="col-12 mb-4 terms_check">
                            <div class="form-check">
                                <input value="1" name="featured" type="checkbox" class="form-check-input"
                                       id="featured" {{ old('featured') == '1' ? 'checked' : '' }} />
                                <label for="featured">{{ __('make_featured') }}</label>
                            </div>
                        </div>
                    @endif
                    <div class="col-12 mb-4">
                        <button type="submit" class="btn loading">{{ __('post_ads') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('frontend_style')
    <link rel="stylesheet" href="{{ asset('image_uploader/image-uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        .select2-selection__rendered {
            line-height: 37px !important;
        }

        .select2-container .select2-selection--single {
            height: 50px !important;
            padding: 7px 10px !important;
            color: #000000 !important;
            border: 1px solid #edeff5;
        }

        .select2-selection__arrow {
            height: 49px !important;
        }

        #addon-wrapping {
            cursor: pointer;
        }

        .remove_icon {
            padding: 3px 9px;
            font-size: 22px;
        }

        .plus_btn {
            background: #157347 !important;
        }

    </style>
@endsection

@push('component_script')
    <script src="{{asset('backend/plugins/summernote/summernote.min.js')}}"></script>

    <script src="{{ asset('frontend') }}/js/plugins/select2.min.js"></script>
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
    <script src="{{ asset('image_uploader/image-uploader.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $('.imageUploader').imageUploader({
            maxFiles: 10,
        });
        // select 2
        $(document).ready(function () {
            $('.select2').select2();
        });
        $(function () {
            $("#datepicker").datepicker({
                minDate: 'today',
            });
        });


        function addFeatures() {
            let html = '<div class="col-md-6 mb-4 removeDiv"><div class="input-group">' +
                '<input type="text" name="features[]" class="form-control" placeholder="{{ __('features') }}" >' +
                '<button id="remove_item" class="input-group-text btn-danger" type="button">' +
                '<span class=""><i class="fa fa-times-circle remove_icon"></i></span>' +
                '</button></div> </div>';
            $('.feature').append(html);
        }

        $(document).on("click", "#remove_item", function () {
            $(this).parent().parent('div').remove();
        });

        // application email / phone field show hide
        $(document).ready(function () {
            $('#show_email').change(function () {
                if ($(this).is(':checked')) {
                    $('.email_show').show();
                } else {
                    $('.email_show').hide();
                }
            });
            $('#show_phone').change(function () {
                if ($(this).is(':checked')) {
                    $('.phone_show').show();
                } else {
                    $('.phone_show').hide();
                }
            });
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
                        $(".getlocation").html('<i class="fa-solid fa-location-dot"></i>');
                        console.error(data.error_message);

                    } else {
                        let formatedAddress = data.results[0].formatted_address
                        $('#form_address').val(formatedAddress);
                        $(".getlocation").html('<i class="fa-solid fa-location-dot"></i>');

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
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            );
            if (navigator.geolocation) {

                window.navigator.geolocation
                    .getCurrentPosition(success, console.error);
            }
        })

        $('#description').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['insert', ['link', 'picture', 'video']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            height:160,
            callbacks: {
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                }
            },
        });
        function uploadImage(image) {
            const data = new FormData();
            data.append("image", image);
            $.ajax({
                method:"POST",
                url: "{{route('text-editor.image')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                success: function(url) {
                    console.log(url)

                    var image = $('<img>').attr('src', url).attr('data-src', url).attr('class', 'img-fluid img-responsive');
                    $('#description').summernote("insertNode", image[0]);
                },
                error: function(data) {

                    console.log(data);
                }
            });
        }


    </script>
@endpush
