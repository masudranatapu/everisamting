@extends('frontend.postad.index')

@section('title')
    {{ __('edit_ad') }} ({{ __('steps01') }}) - {{ $ad->title }}
@endsection

@section('post-ad-content')
    @php
        $adinfo = DB::table('ads')->where('id', $ad->id)->first();
        $subcategory = DB::table('sub_categories')->where('category_id', $ad->category_id)->get();
        $user_plan = DB::table('user_plans')->where('user_id', Auth::user()->id)->first();
    @endphp
    <!-- Step 01 -->
    <div class="tab-pane fade show active" id="pills-basic" role="tabpanel" aria-labelledby="pills-basic-tab">
        <div class="dashboard-post__information step-information">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="step1_edit_form" action="{{ route('frontend.post.update', $ad->slug) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="dashboard-post__information-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-field">
                                <label for="">{{ __('ad_name') }}<span class="text-danger">*</span></label>
                                <input required value="{{ $ad->title }}" name="title" type="text" placeholder="{{ __('ad_name') }}" id="adname" class="@error('title') border-danger @enderror" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if($ad->category_id == 2)
                                <div class="input-field" id="showHideForProperty" style="display: none;">
                                    <label id="jobPriceHtml">{{ __('price') }} <span class="text-danger">*</span> ( {{ config('zakirsoft.currency_symbol') }} ) </label>
                                    <input value="{{ $ad->price }}" name="price" type="number" min="1" placeholder="{{ __('price') }}" id="price" class="@error('price') border-danger @enderror" />
                                </div>
                            @else
                                <div class="input-field" id="showHideForProperty">
                                    <label id="jobPriceHtml">Price <span class="text-danger">*</span> ( {{ config('zakirsoft.currency_symbol') }} ) </label>
                                    <input value="{{ $ad->price }}" name="price" type="number" min="1" placeholder="{{ __('price') }}" id="price" class="@error('price') border-danger @enderror" />
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="input-select">
                                <label for="">{{ __('category') }} <span class="text-danger">*</span></label>
                                <select required name="category_id" id="ad_category" class="form-control select-bg @error('category_id') border-danger @enderror">
                                    <option value="" hidden>{{ __('select_category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $ad->category_id ? 'selected' : '' }}> {{ __(str_replace(' ', '_', strtolower($category->name))) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-select">
                                <label for="">{{ __('subcategory') }} </label>
                                <select name="subcategory_id" id="ad_subcategory" class="form-control select-bg @error('subcategory_id') border-danger @enderror">
                                    <option value="" selected>{{ __('select_subcategory') }}</option>
                                    @foreach($subcategory as $subcate)
                                        <option value="{{ $subcate->id }}" @if($subcate->id == $ad->subcategory_id) selected @endif >{{__(str_replace(' ', '_', strtolower($subcate->name)))}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-field">
                                <label for="">{{ __('phone') }}</label>
                                <span>
                                    (
                                        <input type="checkbox" name="show_phone" id="show_phone_number" @if($adinfo->show_phone) checked @endif>
                                        <label for="show_phone_number">{{ __('Show In Ads Details') }}</label>
                                    )
                                </span>
                                <input name="phone" id="phoneNumber" type="number" min="0" placeholder="{{ __('phone') }}" value="{{ $adinfo->phone }}" class="@error('phone') border-danger @enderror" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-field">
                                <label for="">
                                    WeChat
                                    (
                                        <a href="https://web.wechat.com/"
                                            target="_blank">
                                            {{ __('Get Help') }}
                                        </a>
                                    )
                                </label>
                                <input value="{{ $adinfo->whatsapp }}" name="whatsapp" id="whatsapp_url" type="number" class="backupPhone"  placeholder="E.g: 1687******" value="{{ $ad->whatsapp ?? '' }}" />
                            </div>
                        </div>
                        @if($ad->brand_id)
                            <div class="col-md-6" id="showDispaly">
                                <div class="input-select">
                                    <label for="">{{ __('brand') }}</label>
                                    {{-- <input type="text" name="brand_name" value="{{$adinfo->brand_name}}" placeholder="Brand Name" class="form-control"> --}}
                                    <select name="brand_id" id="brandd" class="form-control select-bg @error('brand_id') border-danger @enderror">
                                        <option value="" hidden>{{ __('select_brand') }}</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $ad->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                        <div class="col-md-6" id="showDispaly" style="display: none;">
                            <div class="input-select">
                                <label for="">{{ __('brand') }}</label>
                                {{-- <input type="text" name="brand_name" value="{{$adinfo->brand_name}}" placeholder="Brand Name" class="form-control"> --}}
                                <select name="brand_id" id="brandd" class="form-control select-bg @error('brand_id') border-danger @enderror">
                                    <option value="" hidden>{{ __('select_brand') }}</option>

                                </select>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            @if($adinfo->is_featured == 'yes')
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input value="1" name="featured" type="checkbox" class="form-check-input" id="checkfeatured" {{ $ad->featured == 1 ? 'checked' : '' }} />
                                        <label for="checkfeatured" class="form-check-label">{{ __('featured') }}</label>
                                    </div>
                                </div>
                            @else
                                @if($user_plan->featured_limit > 0)
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input value="1" name="featured" type="checkbox" class="form-check-input" id="checkfeatured"/>
                                            <label for="checkfeatured" class="form-check-label">{{ __('featured') }}</label>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="dashboard-post__action-btns">
                    <a href="{{ route('frontend.post.cancel.edit') }}" class="btn btn--lg bg-danger text-light">
                        {{ __('cancel_edit') }}
                    </a>
                    <button type="button" onclick="updateCancelEdit()" class="btn btn--lg bg-warning text-light">
                        {{ __('update_cancel_edit') }}
                    </button>
                    <button type="submit" class="btn btn--lg ms-3">
                        {{ __('update_next_step') }}
                    </button>
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
    <link rel="stylesheet" href="{{asset('frontend/css/select2.min.css')}}" />
    <style>
        .select2-selection__rendered {
            line-height: 38px !important;
        }
        .select2-container .select2-selection--single {
            height: 42px !important;
        }
        .select2-selection__arrow {
            height: 38px !important;
        }
    </style>
@endsection

@push('component_script')
    <script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/venobox.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/select2.min.js"></script>
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
    <script src="{{ asset('image_uploader/image-uploader.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // ===== Select2 ===== \\

            // $('#brandd').select2({
            //     // theme: 'bootstrap-5',
            //     allowClear: Boolean($(this).data('allow-clear')),
            //     closeOnSelect: !$(this).attr('multiple'),
            // });

            $('#ad_category').select2({
                // theme: 'bootstrap-5',
                allowClear: Boolean($(this).data('allow-clear')),
                closeOnSelect: !$(this).attr('multiple'),
            });

            $('#ad_subcategory').select2({
                // theme: 'bootstrap-5',
                allowClear: Boolean($(this).data('allow-clear')),
                closeOnSelect: !$(this).attr('multiple'),
            });
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
                        url: "{{  url('/dashboard/post/get_brand') }}/"+category_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            console.log(data);

                            if(data.length > 0){
                                $("#showDispaly").show();
                            }else {
                                $("#showDispaly").hide();
                            }

                            var d =$('#brandd').empty();
                            $.each(data, function(key, value){
                                $('#brandd').append('<option value="'+ value.id +'">' + value.name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endpush
