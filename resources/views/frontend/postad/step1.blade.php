@extends('frontend.postad.index')

@section('title', __('step1'))

@section('post-ad-content')
    @php
        $user_plan = DB::table('user_plans')
            ->where('user_id', Auth::user()->id)
            ->first();
    @endphp
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
            <form action="{{ route('frontend.post.store') }}" method="POST">
                @csrf
                <div class="dashboard-post__information-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-field">
                                <label for="">{{ __('ad_name') }}<span class="text-danger">*</span></label>
                                <input required value="{{ old('title') }}" name="title" type="text"
                                    placeholder="{{ __('ad_name') }}" id="adname"
                                    class="@error('title') border-danger @enderror" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-select">
                                <label for="">{{ __('category') }} <span class="text-danger">*</span></label>
                                <select required name="category_id" id="ad_category"
                                    class="ad_category form-control select-bg @error('category_id') border-danger @enderror">
                                    <option value="" hidden>{{ __('select_category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" data-name="{{ $category->name }}"
                                            class="ad_category_option">{{ __(str_replace(' ', '_', strtolower($category->name))) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-select">
                                <label for="">{{ __('subcategory') }} </label>
                                <select name="subcategory_id" id="ad_subcategory"
                                    class="form-control select-bg @error('subcategory_id') border-danger @enderror">
                                    <option value="" selected>{{ __('select_subcategory') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-field" id="showHideForProperty">
                                <label for="" id="jobPriceHtml">{{ __('price') }} <span class="text-danger">*</span> (
                                    {{ config('zakirsoft.currency_symbol') }} ) </label>
                                <input value="{{ old('price') }}" name="price" type="number" min="1"
                                    placeholder="{{ __('price') }}" id="price"
                                    class="@error('price') border-danger @enderror" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-field">
                                <label for="">{{ __('phone') }}</label>
                                <span>
                                    (
                                    <input type="checkbox" name="show_phone" id="show_phone_number" @if(old('show_phone')) checked @endif>
                                    <label for="show_phone_number">{{ __('Show In Ads Details') }}</label>
                                    )
                                </span>
                                <input name="phone" id="phoneNumber" type="number" min="0" placeholder="{{ __('phone') }}"
                                    value="{{ Auth::user()->phone }}" class="@error('phone') border-danger @enderror" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-field">
                                <label for="">
                                    {{ __('WeChat') }}
                                    (
                                    <a href="https://web.wechat.com/"
                                        target="_blank">
                                        {{ __('Get Help') }}
                                    </a>
                                    )
                                </label>
                                <input value="{{ old('whatsapp') }}" name="whatsapp" id="whatsapp_url" type="number"
                                    class="backupPhone" placeholder="E.g: 1687******" value="{{ $ad->whatsapp ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-md-6" id="showDispaly" style="display: none;">
                            <div class="input-select">
                                <label for="">{{ __('brand') }}</label>
                                <select name="brand_id" id="brandd"
                                    class="form-control @error('brand_id') border-danger @enderror">
                                    <option value="" hidden>{{ __('select_brand') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            @if ($user_plan->featured_limit > 0)
                                <div class="form-check">
                                    <input value="1" name="featured" type="checkbox" class="form-check-input"
                                        id="featured" {{ old('featured') == '1' ? 'checked' : '' }} />
                                    <label for="">{{ __('featured') }}</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="dashboard-post__action-btns">
                    <a href="{{ route('frontend.post.rules') }}" class="btn btn--lg btn--outline">
                        {{ __('view_posting_rules') }}
                    </a>
                    <button type="submit" class="btn btn--lg ms-3">
                        {{ __('next_steps') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('frontend_style')
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}" />
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

        #addon-wrapping {
            cursor: pointer;
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

        // function getDataFormUrl() {
        //     var websiteurl = $("#web_site_url").val();
        //     // alert(websiteurl);
        //     if (websiteurl) {
        //         $.ajax({
        //             type: "GET",
        //             data: {
        //                 websiteurl: websiteurl,
        //             },
        //             success: function(data) {
        //                 // console.log(data);
        //                 if (data.status == 'success') {
        //                     $('#adname').val(data.title);
        //                     var price = data.price.match(/\d/g);
        //                     if (price) {
        //                         price = price.join("");
        //                     } else {
        //                         price = '';
        //                     }
        //                     $('#price').val(price);
        //                     var phone = data.phone.match(/\d/g);
        //                     if (phone) {
        //                         phone = phone.join("");
        //                     } else {
        //                         phone = '';
        //                     }
        //                     $('#phoneNumber').val(phone);

        //                     if (data.category) {
        //                         $('.ad_category_option').each(function (index, element) {
        //                             if ($(element).data('name') == data.category) {
        //                                 $(element).attr('selected', true);
        //                                 console.log($(element).val());
        //                             }
        //                         });
        //                     }
        //                     toastr.success(data.message,'Success',{
        //                         closeButton:true,
        //                         progressBar:true,
        //                     });
        //                 } else {
        //                     console.log(data.error);
        //                     toastr.error(data.message,'Error',{
        //                         closeButton:true,
        //                         progressBar:true,
        //                     });
        //                 }
        //             },
        //         });
        //     } else {
        //         toastr.error('Please give your copied url into input filed', 'Info', {
        //             closeButton: true,
        //             progressBar: true,
        //         });
        //     }
        // }
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
