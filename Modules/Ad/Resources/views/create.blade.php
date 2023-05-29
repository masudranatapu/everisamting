@extends('admin.layouts.app')
@section('title')
    {{ __('create_ad') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('create_ad') }}</h3>
                        <a href="{{ route('module.ad.index') }}" class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left"></i>
                            &nbsp; {{ __('back') }}
                        </a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-12 px-5">
                            <form class="form-horizontal" action="{{ route('module.ad.create') }}" method="GET"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label for="">
                                            <span class="mr-1" style="font-size: 20px;">Get content from another website</span>
                                            <sub>
                                                <a class="ml-1" href="https://buynsellvanuatu.com/" target="__blank">buynsellvanuatu.com</a>,
                                                <a class="ml-1" href="https://vanuatuwok.vu/" target="__blank">Vanuatuwok.vu</a>,
                                                <a class="ml-1" href="https://www.firstnationalvanuatu.com/" target="__blank">Firstnationalvanuatu.com</a>,
                                                <a class="ml-1" href="https://salemnomo.vu/" target="__blank">Salemnomo.vu</a>,
                                        </label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="url" class="form-control"
                                                placeholder="Type web url" aria-label="type web url"
                                                aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="submit">Scrap Data</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form class="form-horizontal" action="{{ route('module.ad.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="title" required="true" />
                                                @if (isset($title))
                                                    <input type="text" name="title"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        value="{{ old('title') ?? $title }}"
                                                        placeholder="{{ __('enter_ad_title') }}">
                                                    @error('title')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                @else
                                                    <input type="text" name="title"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        value="{{ old('title') }}"
                                                        placeholder="{{ __('enter_ad_title') }}">
                                                    @error('title')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="select_category" required="true" />
                                                @if (isset($category_name))
                                                    <select name="category_id" id="ad_category"
                                                        class="form-control js-example-basic-single mb-2 @error('category_id') border-danger @enderror">
                                                        @foreach ($categories as $category)
                                                            <option
                                                                {{ (old('category_id') ? (old('category_id') == $category->id ? 'selected' : '') : $category_name == $category->name) ? 'selected' : '' }}
                                                                value="{{ $category->id }}">{{ __(str_replace(' ', '_', strtolower($category->name))) }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if (!in_array($category_name, $categories->pluck('name')->toArray()))
                                                        <a href="{{ route('module.category.create', ['name' => $category_name]) }}"
                                                            target="_blank" class="btn-sm btn-success"><i
                                                                class="fas fa-plus"></i></a>
                                                    @endif
                                                @else
                                                    <select name="category_id" id="ad_category"
                                                        class="form-control js-example-basic-single @error('category_id') border-danger @enderror">
                                                        @foreach ($categories as $category)
                                                            <option
                                                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                                value="{{ $category->id }}">{{ __(str_replace(' ', '_', strtolower($category->name))) }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                @error('category_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="select_subcategory" :required="false" />
                                                <select name="subcategory_id" id="ad_subcategory"
                                                    class="form-control js-example-basic-single @error('subcategory_id') border-danger @enderror"></select>
                                                @error('subcategory_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group" id="showHideForProperty">
                                                    <label for="" id="jobPriceHtml">Price <span class="text-danger">*</span> ( {{ config('zakirsoft.currency_symbol') }} ) </label>
                                                    @if (isset($price))
                                                        <input type="number" name="price"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            value="{{ old('price') ?? $price }}"
                                                            placeholder="{{ __('enter_ad_price') }}">
                                                        @error('price')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    @else
                                                        <input type="number" name="price"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            value="{{ old('price') }}"
                                                            placeholder="{{ __('enter_ad_price') }}">
                                                        @error('price')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3 mt-2">
                                                <x-forms.label name="author" required="true" />
                                                <select name="user_id" class="form-control js-example-basic-single  @error('user_id') is-invalid @enderror">
                                                    @foreach ($customers as $customer)
                                                        <option {{ old('user_id') == $customer->id ? 'selected' : '' }}
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
                                                            <input type="checkbox" name="show_phone" id="show_phone_number" @if(old('show_phone')) checked @endif>
                                                            <label for="show_phone_number">{{ __('hide_in_details') }}</label>
                                                        )
                                                    </span>
                                                </label>
                                                <input type="text" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone') ?? ($phone ?? '') }}"
                                                    placeholder="{{ __('enter_customer_phone_number') }}">
                                                @error('phone')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3 mt-3">
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
                                                    value="{{ old('whatsapp') }}" placeholder="E.g: 8801681******"
                                                    id="whatsapp_profile_url">
                                                @error('whatsapp')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">

                                                <label for="address">Address <span class="text-danger">*</span> </label>
                                                <input type="text" name="address" id="form_address" value="{{ old('address') ?? ($address ?? '') }}" placeholder="Address " class="form-control" required>
                                                <button class="btn btn-success getlocation mt-2" type="button" id="button-addon2" style="width: 100%;">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <span id="hideLocation">
                                                        Use my current location
                                                    </span>
                                                </button>
                                                @error('address')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3" style="display: none;" id="showBrnadHide">
                                                <label for="">Brand</label>
                                                <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror"  id="brand">

                                                </select>
                                                @error('brand_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <div class="icheck-success d-inline" data-toggle="tooltip"
                                                    data-original-title="{{ __('show_featured_ads_on_homepage') }} ">
                                                    <input {{ old('featured') == 1 ? 'checked' : '' }} value="1"
                                                        name="featured" type="checkbox" class="form-check-input"
                                                        id="featured" />
                                                    <x-forms.label name="featured" class="form-check-label"
                                                        for="featured" :required="false" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-md-12 mb-5">
                                            <x-forms.label name="upload_thumbnail" required="true" />
                                            @if (isset($thumb))
                                                <input type="hidden" name="url_thumb" value="1">
                                                <input name="thumbnail" accept="image/png, image/jpg, image/jpeg"
                                                    class="form-control dropify @error('thumbnail') is-invalid @enderror"
                                                    style="border:none;padding-left:0;"
                                                    accept="image/png,image/jpg,image/jpeg"
                                                    data-allowed-file-extensions='["jpg", "jpeg","png"]'
                                                    data-max-file-size="3M" data-show-errors="true"
                                                    data-default-file="{{ $thumb }}"
                                                    value="{{ $thumb }}" />
                                                @error('thumbnail')
                                                    <span
                                                        class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            @else
                                                <input name="thumbnail" type="file"
                                                    accept="image/png, image/jpg, image/jpeg"
                                                    class="form-control dropify @error('thumbnail') is-invalid @enderror"
                                                    style="border:none;padding-left:0;"
                                                    accept="image/png,image/jpg,image/jpeg"
                                                    data-allowed-file-extensions='["jpg", "jpeg","png"]'
                                                    data-max-file-size="3M" data-show-errors="true" />
                                                @error('thumbnail')
                                                    <span
                                                        class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            @endif
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="input-field--textarea">
                                                <label for="features">Features</label>
                                                <div id="multiple_feature_part">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <div class="input-field mb-3 mt-3">
                                                                <input name="features[]" type="text"
                                                                    placeholder="{{ __('feature') }}" id="adname"
                                                                    value="{{ $condition ?? '' }}"
                                                                    class="form-control @error('features') border-danger @enderror" />
                                                            </div>
                                                        </div>
                                                        <div class="col-2 mt-3">
                                                            <a role="button" onclick="add_features_field()"
                                                                class="btn bg-primary btn-sm text-light"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
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
                                            {{ old('description') ?? ($details ?? '') }}
                                        </textarea>

                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                            {{ __('create') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (old('subcategory_id'))
        <input type="hidden" id="subct_id" value="{{ old('subcategory_id') }}">
    @else
        <input type="hidden" id="subct_id" value="">
    @endif
@endsection
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
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
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
        var subct_id = document.getElementById('subct_id').value;

        $(document).ready(function() {
            var category_id = document.getElementById('ad_category').value;
            cat_wise_subcat(category_id);
        });



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
    <script>
        $(document).on('click', '.dropify', function() {
            $(this).attr('type', 'file');
        });
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
@endsection
