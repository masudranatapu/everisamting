@extends('layouts.frontend.layout_one')

@section('title', __('ad_post'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_post_ads_background">
        {{ __('overview') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.dashboard') }}"
                   class="breedcrumb__page-link text--body-3">{{ __('dashboard') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('post_ads') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- dashboard section start  -->
    <section class="section dashboard">
        <div class="container">
            @include('frontend.dashboard-alert')
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9">
                    <div class="dashboard-post">
                        {{--                        <ul class="px-3 border-bottom">--}}
                        {{--                            <div class="row">--}}
                        {{--                                <div class="col-sm-5">--}}
                        {{--                                    <div class="float-md-end">--}}
                        {{--                                        @if (request()->route()->getName() === 'frontend.post')--}}
                        {{--                                            <a href="{{ route('frontend.post') }}">--}}
                        {{--                                                <x-frontend.ad.ad-step />--}}
                        {{--                                            </a>--}}
                        {{--                                        @else--}}
                        {{--                                            <button disabled>--}}
                        {{--                                                <x-frontend.ad.ad-step />--}}
                        {{--                                            </button>--}}
                        {{--                                        @endif--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="col-sm-1"></div>--}}
                        {{--                                <div class="col-sm-6">--}}
                        {{--                                    @if (request()->route()->getName() === 'frontend.post.step2')--}}
                        {{--                                        <a href="{{ route('frontend.post.step2') }}">--}}
                        {{--                                            <x-frontend.ad.ad-step2 />--}}
                        {{--                                        </a>--}}
                        {{--                                    @else--}}
                        {{--                                        <button disabled>--}}
                        {{--                                            <x-frontend.ad.ad-step2 />--}}
                        {{--                                        </button>--}}
                        {{--                                    @endif--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </ul>--}}
                        {{--                        <div class="tab-content dashboard-post__content mt-3" id="pills-tabContent">--}}
                        {{--                            @yield('post-ad-content')--}}
                        {{--                        </div>--}}
                        @yield('post-ad-content')
                    </div>
                </div>
            </div>
        </div>
        @isset($ad->category_id)
            <input type="hidden" id="cat_id" value="{{ $ad->category_id }}">
        @else
            <input type="hidden" id="cat_id" value="">
        @endisset

        @isset($ad->subcategory_id)
            <input type="hidden" id="subct_id" value="{{ $ad->subcategory_id }}">
        @else
            <input type="hidden" id="subct_id" value="">
        @endisset
    </section>
    <!-- dashboard section end  -->

@endsection

@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
    <script>
        $('.loading').click(function () {
            $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading..`);
            $(this).attr('disabled', true);
            $(this).closest('form').submit();

        });
        // session category wise subcategory
        // var cat_id = document.getElementById('cat_id').value;
        // var subct_id = document.getElementById('subct_id').value;
        //
        // if (cat_id) {
        //     cat_wise_subcat(cat_id)
        // }
        //
        // // Category wise subcategories
        // $('#ad_category').on('change', function() {
        //     var categoryID = $(this).val();
        //     if (categoryID) {
        //         cat_wise_subcat(categoryID);
        //     }
        // });


        // cat wise subcat function
        // function cat_wise_subcat(categoryID) {
        //     axios.get('/get-sub-categories/' + categoryID).then((res => {
        //         if (res.data) {
        //             console.log(res);
        //             $('#ad_subcategory').empty();
        //             $('select[name="subcategory_id"]').append(res.data);
        //             // $.each(res.data, function(key, subcat) {
        //             //     var matched = parseInt(subct_id) === subcat.id ? true : false
        //
        //             //     $('select[name="subcategory_id"]').append(
        //             //         `<option ${matched ? 'selected':''} value="${subcat.id}">${subcat.name}</option>`
        //             //     );
        //             // });
        //         } else {
        //             $('#ad_subcategory').empty();
        //         }
        //     }))
        // }

        $('#brand_id').change(function () {
            let brand_id = $(this).val();
            console.log(brand_id);
            $.ajax({
                type: "get",
                url: "{{ route('getProductModel') }}",
                data: {
                    brand_id : brand_id,
                },
                beforeSend: function (res) {
                    $('#product_model_id').attr('disabled', true);
                },
                success: function (response) {
                    $('#product_model_id').html(response);
                },
                complete: function (res) {
                    $('#product_model_id').attr('disabled', false);
                }
            });

        });


    </script>

    @stack('post-ad-scripts')
    @yield('post-ad-scripts')
@endsection

@section('frontend_style')
    <link rel="stylesheet" href="{{ asset('css/zakirsoft.css') }}">
@endsection
