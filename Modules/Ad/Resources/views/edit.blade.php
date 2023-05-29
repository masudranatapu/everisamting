@extends('admin.layouts.app')
@section('title')
    {{ __('edit_ad') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('edit_ad') }}</h3>
                        <a href="{{ route('module.ad.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-12 px-5">
                            <form class="form-horizontal" action="{{ route('module.ad.update', $ad->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="title" required="true" />
                                                <input type="text" name="title"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    value="{{ $ad->title }}" placeholder="{{ __('enter_ad_title') }}}">
                                                @error('title')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="category" required="true" />
                                                <select name="category_id" id="ad_category"
                                                    class="form-control js-example-basic-single @error('category_id') border-danger @enderror">
                                                    @foreach ($categories as $category)
                                                        <option {{ $category->id == $ad->category_id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">{{ __(str_replace(' ', '_', strtolower($category->name))) }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="">Sub category</label>
                                                <select name="subcategory_id" id="ad_subcategory"
                                                    class="form-control js-example-basic-single @error('subcategory_id') border-danger @enderror">
                                                    @foreach ($subcategories as $subcategory)
                                                        <option
                                                            {{ $subcategory->id == $ad->subcategory_id ? 'selected' : '' }}
                                                            value="{{ $subcategory->id }}">{{ __(str_replace(' ', '_', strtolower($subcategory->name))) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('subcategory_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                @if($ad->category_id == 2)
                                                    <div class="form-group" id="showHideForProperty" style="display: none;">
                                                        <label for="" id="jobPriceHtml">Price <span class="text-danger">*</span> ( {{ config('zakirsoft.currency_symbol') }} ) </label>
                                                        <input type="number" name="price"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            value="{{ $ad->price }}" placeholder="{{ __('enter_ad_price') }}">
                                                        @error('price')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @else
                                                    <div class="form-group" id="showHideForProperty">
                                                        <label for="" id="jobPriceHtml">Price <span class="text-danger">*</span> ( {{ config('zakirsoft.currency_symbol') }} ) </label>
                                                        <input type="number" name="price"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            value="{{ $ad->price }}" placeholder="{{ __('enter_ad_price') }}">
                                                        @error('price')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3 mt-2">
                                                <x-forms.label name="author" required="true" />
                                                <select name="user_id"
                                                    class="form-control js-example-basic-single @error('user_id') is-invalid @enderror">
                                                    @foreach ($customers as $customer)
                                                        <option {{ $ad->user_id == $customer->id ? 'selected' : '' }}
                                                            value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="phone_number">{{ __('phone_number') }}
                                                    <span>
                                                        (
                                                            <input type="checkbox" name="show_phone" id="show_phone_number" @if($ad->show_phone == 1) checked @endif>
                                                            <label for="show_phone_number">{{ __('hide_in_details') }}</label>
                                                        )
                                                    </span>
                                                </label>
                                                <input type="text" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ $ad->phone }}"
                                                    placeholder="{{ __('enter_customer_phone_number') }}">
                                                @error('phone')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="whatsapp_profile_url">
                                                    WeChat
                                                    (
                                                        <a href="https://web.wechat.com/"
                                                            target="_blank">
                                                            {{ __('Get Help') }}
                                                        </a>
                                                    )
                                                </label>
                                                <input type="number" name="whatsapp"
                                                    class="form-control @error('whatsapp') is-invalid @enderror"
                                                    value="{{ old('whatsapp', $ad->whatsapp) }}"
                                                    placeholder="E.g: 8801681******" id="whatsapp_profile_url">
                                                @error('whatsapp')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label for="address">Address <span class="text-danger">*</span> </label>
                                                <input type="text" name="address" id="form_address" value="{{ old('address') ?? ($ad->address ?? '') }}" placeholder="Address " class="form-control" required>
                                                <button class="btn btn-success getlocation mt-2" type="button" id="button-addon2" style="width: 100%;">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <span id="hideLocation">
                                                        Use my current location
                                                    </span>
                                                </button>
                                            </div>
                                            @if($ad->brand_id)
                                                <div class="col-md-6 mb-3" id="showBrnadHide">
                                                    <label for="">Brand</label>
                                                    <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror" id="brand">
                                                        <option selected disabled>Select One</option>
                                                        @foreach ($brands as $brand)
                                                            <option {{ $ad->brand_id == $brand->id ? 'selected' : '' }}
                                                                value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <input type="text" name="brand_name" value="{{ $ad->brand_name ?? '' }}"
                                                        placeholder="Brand Name" class="form-control"> --}}
                                                    @error('brand_id')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @else
                                                <div class="col-md-6 mb-3" style="display: none;" id="showBrnadHide">
                                                    <label for="">Brand</label>
                                                    <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror" id="brand">
                                                        <option selected disabled>Select One</option>
                                                        @foreach ($brands as $brand)
                                                            <option {{ $ad->brand_id == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <input type="text" name="brand_name" value="{{ $ad->brand_name ?? '' }}"
                                                        placeholder="Brand Name" class="form-control"> --}}
                                                    @error('brand_id')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <div class="icheck-success d-inline">
                                                    <input value="1" name="featured" type="checkbox"
                                                        class="form-check-input" id="featured"
                                                        {{ $ad->featured == 1 ? 'checked' : '' }} />
                                                    <x-forms.label name="featured" class="form-check-label"
                                                        for="featured" :required="false" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12 mb-5">
                                                <x-forms.label name="upload_thumbnail" required="true" />
                                                <input name="thumbnail" type="file"
                                                    accept="image/png, image/jpg, image/jpeg"
                                                    class="form-control dropify @error('thumbnail') is-invalid @enderror"
                                                    style="border:none;padding-left:0;" data-max-file-size="3M"
                                                    data-show-errors="true"
                                                    data-allowed-file-extensions='["jpg", "jpeg","png"]'
                                                    data-default-file="{{ $ad->image_url }}" />
                                                @error('thumbnail')
                                                    <span
                                                        class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="input-field--textarea">
                                                    <label for="">Features</label>
                                                    <div id="multiple_feature_part">
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <div class="input-field mb-3">
                                                                    <input name="features[]" type="text"
                                                                        placeholder="{{ __('feature') }}" id="adname"
                                                                        class="form-control @error('title') border-danger @enderror" />
                                                                </div>
                                                            </div>
                                                            <div class="col-2 mt-10">
                                                                <a role="button" onclick="add_features_field()"
                                                                    class="btn bg-primary btn-sm text-light"><i
                                                                        class="fas fa-plus"></i></a>
                                                            </div>
                                                        </div>
                                                        @foreach ($ad->adFeatures as $feature)
                                                            <div class="row">
                                                                <div class="col-10">
                                                                    <div class="input-field mb-3">
                                                                        <input name="features[]"
                                                                            value="{{ $feature->name }}" type="text"
                                                                            placeholder="{{ __('feature') }}"
                                                                            id="adname"
                                                                            class="form-control @error('features') border-danger @enderror" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-2 mt-10">
                                                                    <button onclick="remove_single_field()"
                                                                        id="remove_item"
                                                                        class="btn btn-sm bg-danger text-light"><i
                                                                            class="fas fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <x-forms.label name="description" required="true" />
                                        <textarea id="editor2" name="description" class="form-control @error('description') is-invalid @enderror"
                                            placeholder="{{ __('write_description_of_ad') }}">
                                            {{ $ad->description }}
                                        </textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @include('components.set-location-edit') --}}
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
    </style>
    <!-- >=>Mapbox<=< -->
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor/config.js"></script>

    {{-- ck-editor --}}
    <script>
        CKEDITOR.replace('editor2', {
            height: 600,
            removeButtons: 'PasteFromWord'
        });
    </script>

    {{-- category-subcategory dropdown --}}
    <script>
        // category wise subcategory function
        function cat_wise_subcat(categoryID) {
            axios.get('/get-sub-categories/' + categoryID).then((res => {
                if (res.data) {
                    console.log(res);
                    $('#ad_subcategory').empty();
                    $('select[name="subcategory_id"]').append(res.data);
                    // $.each(res.data, function(key, subcat) {
                    //     var matched = parseInt(subct_id) === subcat.id ? true : false

                    //     $('select[name="subcategory_id"]').append(
                    //         `<option ${matched ? 'selected':''} value="${subcat.id}">${subcat.name}</option>`
                    //     );
                    // });
                } else {
                    $('#ad_subcategory').empty();
                }
            }))
        }

        // Category wise subcategories dropdown
        $('#ad_category').on('change', function() {
            var categoryID = $(this).val();
            if (categoryID) {
                cat_wise_subcat(categoryID);
            }
        });
    </script>

    {{-- Featured inputs --}}
    <script>
        function add_features_field() {
            $("#multiple_feature_part").append(`
                <div class="row">
                    <div class="col-lg-10">
                            <div class="input-field mb-3">
                                <input name="features[]" type="text" placeholder="Feature" id="adname" class="form-control @error('features') border-danger @enderror"/>
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

    {{-- Dropify image upload --}}
    <script>
        var drEvent = $('.dropify').dropify();

        drEvent.on('dropify.error.fileSize', function(event, element) {
            alert('Filesize error message!');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element) {
            alert('Image format error message!');
        });
    </script>
    <!-- >=>Mapbox<=< -->
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("[data-toggle=tooltip]").tooltip()
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#ad_category').on('change', function(){
                var category_id = $(this).val();
                // alert(category_id);

                if(category_id == 10){

                    $("#jobPriceHtml").html(`
                        Salary Per Month ( {{ config('zakirsoft.currency_symbol') }} )
                    `);

                }else {

                    $("#jobPriceHtml").html(`
                        Price <span class="text-danger">*</span> ( {{ config('zakirsoft.currency_symbol') }} )
                    `);

                }

                if(category_id == 2){
                    $("#showHideForProperty").hide();
                }else {
                    $("#showHideForProperty").show();
                }

                if(category_id) {
                    $.ajax({
                        url: "{{  url('/get_brand') }}/"+category_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            console.log(data);
                            if(data.length > 0){
                                $("#showBrnadHide").show();
                            }else {
                                $("#showBrnadHide").hide();
                            }

                            var d =$('#brand').empty();
                            $.each(data, function(key, value){
                                $('#brand').append('<option value="'+ value.id +'">' + value.name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <script defer src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en&key=AIzaSyCGYnCh2Uusd7iASDhsUCxvbFgkSifkkTM" type="text/javascript"></script>
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
                    '&sensor=true_or_false&key=AIzaSyATgI95Rp6YpYchbA6c8rD-3tC9xRIc96c')
                .then((response) => response.json())
                .then((data) => {

                    let formatedAddress = data.results[0].formatted_address
                    $('#form_address').val(formatedAddress);
                    $(".getlocation").html('<i class="fa-solid fa-location-dot"></i> Use my current location');
                });
        }

        function success(data) {
            let latitude = data.coords.latitude;
            let longitude = data.coords.longitude;
            reverseGeocode(latitude, longitude);
        }

        $(".getlocation").click(function() {
            $("#hideLocation").hide();
            $(this).html(
                '<div class="spinner-border" role="status"><span class="visually-hidden"><i class="fas fa-spinner"></i></span></div>'
            );
            if (navigator.geolocation) {

                window.navigator.geolocation
                    .getCurrentPosition(success, console.error);
            }
        })
    </script>
    <!-- >=>Mapbox<=< -->
@endsection
