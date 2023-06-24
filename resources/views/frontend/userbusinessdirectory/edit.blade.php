@extends('layouts.frontend.layout_one')

@section('title', __('dashboard'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_overview_background">
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.dashboard') }}"
                   class="breedcrumb__page-link text--body-3">{{ __('dashboard') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('Business Directory') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- dashboard section start  -->
    <section class="section dashboard dashboard--user">
        <div class="container">
            @include('frontend.dashboard-alert')
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9">
                    <form action="{{ route('frontend.user-business-directory.update', $businessdirectories->id) }}"
                          enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <div class="dashboard__posted-ads">
                                    <div class="dashboard__section-info">
                                        <h2 class="dashboard-card__title">{{ __('Edit Business Directory') }}</h2>
                                        <a href="{{ route('frontend.user-business-directory.index') }}" class="btn">
                                            {{ __('business_directory') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 mb-3 mb-lg-0">
                                        <label for="">{{ __('title') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="title"
                                               class="form-control @error('title') border-danger @enderror"
                                               value="{{ $businessdirectories->title }}" placeholder="{{ __('title') }}"
                                               placeholder="Title">
                                        @error('title')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-3">
                                        <label for="">{{ __('email') }} <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('email') border-danger @enderror"
                                               name="email" value="{{ $businessdirectories->email }}"
                                               placeholder="{{ __('email') }}">
                                        @error('email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-3 mb-lg-0">
                                        <label for="">{{ __('category') }} <span class="text-danger">*</span></label>
                                        <select name="category_id[]" class="form-control select2 mycategory"
                                                multiple="multiple" id="categoryid"
                                                required>
                                            <option class="d-none">{{ __('select_one') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ isset($businessdirectories->category_id) && in_array($category->id , $businessdirectories->category_id) ? 'selected' : '' }} >{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                                        <label for="">{{ __('phone_no') }} <span class="text-danger">*</span>
                                            <sub>{{ __('head_ofice') }}</sub></label>
                                        <input type="tel"
                                               class="form-control @error('phone') border-danger @enderror"
                                               name="phone" value="{{ $businessdirectories->phone }}"
                                               placeholder="{{ __('phone_no_one') }}">
                                        @error('phone')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <label for="">{{ __('phone_no') }}
                                            <sub> {{ __('corporate_office') }} </sub></label>
                                        <input type="tel" class="form-control " name="phone_2"
                                               value="{{ $businessdirectories->phone_2 }}"
                                               placeholder="{{ __('phone_no_two') }}">
                                    </div>
                                    <div class="col-lg-6 col-md-6 mb-3">
                                        <label for="">{{ __('business_profile') }}</label>
                                        <input type="text" class="form-control" name="business_profile_link"
                                               value="{{ $businessdirectories->business_profile_link }}"
                                               placeholder="{{ __('business_profile') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">

                                </div>
                            </div>
                            <div class="row p-4">
                                <div class="col-lg-12 col-md-12 mb-3 mb-lg-0">
                                    <label for="">{{ __('business_location') }} <span
                                            class="text-danger">*</span></label>
                                    <input name="address"
                                           class="form-control @error('address') border-danger @enderror"
                                           value="{{ $businessdirectories->address }}"
                                           placeholder="{{ __('business_location') }}"/>

                                    @error('address')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror

                                    <label for="">{{ __('map') }} </label>

                                    <div>
                                        <input id="searchInput" class="mapClass form-control" name="map"
                                               type="text" placeholder="{{ __('enter_a_location') }}">
                                        <div class="map mymap" id="google-map"></div>
                                    </div>
                                    @error('map')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror


                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="mt-3">
                                        <label for="description">{{ __('description') }}</label>
                                        <textarea class="form-control" name="description" id="description"
                                                  placeholder="{{ __('description') }}"
                                                  style="height: 200px">{{ $businessdirectories->description }}</textarea>

                                        @error('description')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center m-3 mt-4" id="showImageArea">
                                        <img style="width: 100px; height: 100px"
                                             src="@if ($businessdirectories->thumbnail) {{ asset($businessdirectories->thumbnail) }} @else {{ asset('images/noimage.jpg') }} @endif"
                                             alt="event-image" id="showImage">
                                    </div>
                                    <div class="text-center mt-4 pb-3">
                                        <input type="file" class="form-control d-none" id="file-upload"
                                               onChange="mainFavion(this)" name="thumbnail">
                                        <label for="file-upload" class="custom-file-upload">Choose Image </label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="old_lat" value="{{ $businessdirectories->lat }}">
                            <input type="hidden" class="old_long" value="{{ $businessdirectories->lang }}">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-center p-4">
                                    <button class="btn" type="submit">{{ __('update_my_business') }}</button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('adlisting_style')
    <link rel="stylesheet" href="{{asset('backend/plugins/summernote/summernote.min.css')}}">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    {{-- select  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container--default .select2-selection--multiple {
            min-height: 38px;
        }

        .note-btn-group .note-btn {
            padding: 0.5rem 0.5rem !important;
            font-size: 15px !important;
        }

        .mb-3 .btn {
            line-height: 15px !important;
        }

        .select2-container .select2-selection--single {
            min-height: 46px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 46px !important;
            padding-left: 20px !important;
        }

        .select2-selection__arrow {
            height: 32px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            margin-top: 4px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: rgb(0, 0, 0) !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: rgb(255, 0, 0) !important;
        }

        .form-style-input-file {
            height: calc(2.7rem + 2px) !important;
        }

        .mapClass {
            position: absolute;
            left: 188px;
            top: 10px !important;
            height: 41px !important;
            border: none;
            border-radius: 4px !important;
        }

        .map {
            max-height: 289px !important;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            line-height: 33px !important;
        }

        .select2-container--default .select2-search--inline .select2-search__field {
            height: 30px !important;
        }
    </style>
@endsection

@section('frontend_script')
    <script src="{{asset('backend/plugins/summernote/summernote.min.js')}}"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "{{ __('select_one') }}",
                allowClear: true
            });
        });

        function mainFavion(input) {
            // alert(input);
            if (input.files && input.files[0]) {

                setTimeout(function () {
                    $("#showImageArea").slideDown();
                }, 100)

                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result).width(100).height(100);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

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


    <x-set-googlemap/>
@endsection
