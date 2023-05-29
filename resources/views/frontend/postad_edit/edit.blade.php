@extends('frontend.postad.index')

@section('title')
    {{ __('edit_ad') }} ({{ __('steps01') }}) - {{ $ad->title }}
@endsection
@php
    $condition = [
        'jobs' , 'education', 'property', 'health-beauty', 'agriculture'
];
    $cat = $ad->category;
@endphp

@section('post-ad-content')
    <div class="adpost_section">
        <div class="container">
            <form action="{{ route('frontend.post.update', $ad->slug) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category" value="{{ $cat->slug }}">
                <input type="hidden" name="category_id" value="{{ $cat->id }}">
                <div class="row d-flex justify-content-center">
                    <div class="adpost_form mb-4">
                        <div class="heading mb-4">
                            <h3>Edit <span class="primary-color">{{ $ad->title }}</span></h3>
                        </div>
                        <div class="row">

                            {{-- Services --}}
                            @if($cat->slug == 'service')
                                @include('frontend.postad_edit.service_category', [$service_types, $ad])
                            @endif

                            {{-- Pets & Animals --}}
                            @if($cat->slug == 'pets-and-animals')
                                @include('frontend.postad_edit.pets_animals_category', $ad)
                            @endif

                            <div class="col-12 mb-4">
                                <label for="title" class="form-label">{{ __('title') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" value="{{ $ad->title }}"
                                       class="form-control" placeholder="{{ __('title') }}"
                                       required>
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="subcategory_id" class="form-label">{{ __('subcategory') }}</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control select2">
                                    <option value="" disabled selected>{{ __('Select Subcategory') }}</option>
                                    @if(isset($cat->subcategories) && $cat->subcategories->count() > 0 )
                                        @foreach($cat->subcategories as $subcategory)
                                            <option
                                                value="{{ $subcategory->id }}" {{ $ad->subcategory_id == $subcategory->id ? 'selected': '' }}>
                                                {{ $subcategory->name }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="location" class="form-label">{{ __('address') }}</label>
                                <input type="text" name="address" id="address" class="form-control"
                                       placeholder="{{ __('address') }}" value="{{ $ad->address }}">
                            </div>
                            @if($cat->slug != 'jobs')
                                <div class="col-12 mb-2">
                                    <label for="job_type" class="form-label">{{ ('contact_info') }}</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input class="form-check-input" name="show_email" type="checkbox"
                                                       value="1"
                                                       id="show_email" {{ $ad->show_email == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="show_email">
                                                   {{ __('show_email_public') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input class="form-check-input" name="show_phone" type="checkbox"
                                                       value="1"
                                                       id="show_phone" {{ $ad->show_phone == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="show_phone">
                                                    {{ __('show_phone_public') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4 mt-2 application_field email_show "
                                             style="display: {{ isset($ad->email) ? 'block' : 'none' }}">
                                            <input type="email" name="email" id="email"
                                                   class="email_field form-control"
                                                   value="{{ $ad->email }}"
                                                   placeholder="{{ __('enter_email') }}">
                                            @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div
                                            class="col-md-6 mb-4 mt-2 application_field phone_show" style="display: {{ isset($ad->phone) ? 'block' : 'none' }}">
                                            <input type="tel" name="phone" id="phone"
                                                   class="phone_field form-control"
                                                   value="{{ $ad->phone }}"
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
                                       placeholder="{{ __('WeChat') }}" value="{{ old('whatsapp') ?? $ad->whatsapp }}">
                            </div>
                            {{-- fashion category --}}
                            @if ($cat->slug == 'fashion')
                                <div class="col-md-6 mb-4">
                                    <label for="size" class="form-label">{{ __('size') }}</label>
                                    <select name="size" id="size" class="form-control">
                                        <option value="" disabled selected>{{ __('select_size') }} </option>
                                        <option value="small" {{ $ad->size == 'small' ? 'selected' : '' }} >{{ __('small') }}</option>
                                        <option value="medium" {{ $ad->size == 'medium' ? 'selected' : '' }} >{{ __('medium') }}</option>
                                        <option value="large" {{ $ad->size == 'large' ? 'selected' : '' }} >{{ __('large') }}</option>
                                        <option value="extra_large" {{ $ad->size == 'extra_large' ? 'selected' : '' }} >{{ __('extra_large') }}</option>
                                        <option value="double_extra_large" {{ $ad->size == 'double_extra_large' ? 'selected' : '' }} >{{ __('double_extra_large') }}</option>
                                    </select>
                                </div>
                            @endif

                            @if($cat->slug != 'jobs' && $cat->slug != 'property')
                                <div class="col-6 mb-4">
                                    <label for="price" class="form-label">Price </label>
                                    <input type="number" name="price" id="price" value="{{ $ad->price }}"
                                           class="form-control" placeholder="Ad Price">
                                </div>
                            @endif
                            @if (!in_array($cat->slug, $condition))
                                <div class="col-md-6 mb-4">
                                    <label for="condition" class="form-label">{{ __('condition') }} </label>
                                    <div class="row mt-2">
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="condition"
                                                       value="new"
                                                       {{ $ad->condition == 'new' ? 'checked' : '' }} id="condition_2">
                                                <label class="form-check-label" for="condition_2">
                                                    {{ __('new') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="condition"
                                                       value="used"
                                                       {{ $ad->condition == 'used' ? 'checked' : '' }} id="condition_1">
                                                <label class="form-check-label" for="condition_1">
                                                    {{ __('used') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="condition"
                                                       value="gently_used"
                                                       {{ $ad->condition == 'gently_used' ? 'checked' : '' }} id="condition_3">
                                                <label class="form-check-label" for="condition_3">
                                                    {{ __('gently_used') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- Mobile category --}}
                            @if($cat->slug == 'mobiles')
                                @include('frontend.postad_edit.mobile_category', [$brands, $models, $ad])
                            @endif

                            {{-- Electronics --}}
                            @if($cat->slug == 'electronics')
                                @include('frontend.postad_edit.electronices_category', [$brands, $models, $ad])
                            @endif
                            {{-- Vehicles --}}
                            @if($cat->slug == 'vehicles')
                                @include('frontend.postad_edit.vehicles_category',  [$brands, $models, $ad])
                            @endif
                            {{-- Property --}}
                            @if($cat->slug == 'property')
                                @include('frontend.postad_edit.property_category', $ad)
                            @endif
                            {{-- Job --}}
                            @if($cat->slug == 'jobs')
                                @include('frontend.postad_edit.job_category', [$designations, $ad])
                            @endif

                            <div class="col-12 mb-4 features_list">
                                <label for="features" class="form-label d-block">Features </label>
                                <div class="row feature">
                                    @if (isset($ad->adFeatures) && $ad->adFeatures->count() > 0)
                                        @foreach ($ad->adFeatures as $k => $val)
                                            @if ($k == 0)
                                                <div class="col-md-6 mb-4">
                                                    <div class="input-group">
                                                        <input type="text" name="features[]" id="features"
                                                               value="{{ $val->name }}"
                                                               class="form-control" placeholder="{{ __('features') }}">
                                                        <button class="input-group-text btn plus_btn"
                                                                onclick="addFeatures(this)"
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
                                                               value="{{ $val->name }}"
                                                               class="form-control" placeholder="{{ __('features') }}">
                                                        <button id="remove_item" class="input-group-text btn-danger"
                                                                type="button"><i
                                                                class="fa fa-times-circle remove_icon"></i></button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="col-md-6 mb-4">
                                            <div class="input-group">
                                                <input type="text" name="features[]" id="features" class="form-control"
                                                       placeholder="{{ __('features') }}">
                                                <button class="input-group-text btn plus_btn"
                                                        onclick="addFeatures(this)" type="button">
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
                                <label for="description" class="form-label">Description
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" id="description" cols="30" rows="7"
                                          class="form-control"
                                          placeholder="Write Details" required
                                          style="height:140px;">{{ $ad->description }}</textarea>
                                @error('description')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="
                                    @if($ad->thumbnail)
                                        col-md-10
                                    @else
                                    col-md-12
                                    @endif
                                    mb-4">
                                <label for="thumbnail" class="form-label">Thumbnail Image <p
                                        style="color:darkgoldenrod">(Prefer Image size 850x650)</p></label>

                                <input type="file" name="thumbnail" id="thumbnail" class="form-control">


                            </div>
                            @if($ad->thumbnail)
                                <div class="col-2">
                                    <label for="thumbnail" class="form-label">Thumbnail </label>
                                    <img class="img-style" src="{{ asset($ad->thumbnail) }}" alt="thumbnail">
                                </div>
                            @endif
                            <div class="col-12 mb-4">
                                <label class="active">{{ __('upload_photos') }}<p style="color:darkgoldenrod">
                                        (Prefer Image size 850x650)</p></label>
                                <div id="multiple_image_upload" class="input-images-2"
                                     style="padding-top: .5rem;"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    @if($ad->is_featured == 'yes')
                                        <div class="col-6 col-md-3">
                                            <div class="form-check">
                                                <input value="1" name="featured" type="checkbox" class="form-check-input" id="checkfeatured" {{ $ad->featured == 1 ? 'checked' : '' }} />
                                                <label for="checkfeatured" class="form-check-label">{{ __('make_featured') }}</label>
                                            </div>
                                        </div>
                                    @else
                                        @if($user_plan->featured_limit > 0)
                                            <div class="col-6 col-md-3">
                                                <div class="form-check">
                                                    <input value="1" name="featured" type="checkbox" class="form-check-input" id="checkfeatured"/>
                                                    <label for="checkfeatured" class="form-check-label">{{ __('make_featured') }}</label>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <button type="submit" class="btn loading">{{ __('update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('post-ad-scripts')
    <script>
        // ad update and cancel edit
        function updateCancelEdit() {
            $('#cancel_edit_input').val(1)
            $('#step1_edit_form').submit()
        }
    </script>
@endpush

@section('frontend_style')
    <link rel="stylesheet" href="{{ asset('image_uploader/image-uploader.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <style>
        .img-style {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 120px;
            height: 80px
        }

        .img-style :hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }

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
    <script src="{{ asset('frontend/js/image-uploader.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('image_uploader/image-uploader.min.js') }}"></script>
    <script>
        let preloaded = [
                @foreach ($ad->galleries as $galleries)

            {
                id: "{{ $galleries->id }}",
                src: "{{ asset($galleries->image) }}"
            },
            @endforeach
        ];
        $('.input-images-2').imageUploader({
            preloaded: preloaded,
            imagesInputName: 'images',
            preloadedInputName: 'old',
            maxFiles: 10

        });
    </script>
    <script>
        $(function () {
            $("#datepicker").datepicker({
                minDate: 'today',
            });
        });


        // select 2
        $(document).ready(function () {
            $('.select2').select2();
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

    </script>
@endpush
