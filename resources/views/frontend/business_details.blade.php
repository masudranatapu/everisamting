@extends('layouts.frontend.layout_one')

@section('title', __('Business Details'))

@section('meta')

    <meta name="title" content="{{ $ad->title }}">
    <meta name="description" content="{{ $ad->title }}">

    <meta property="og:image"
        content="@if ($ad->thumbnail) {{ asset($ad->thumbnail) }} @else {{ asset('images/noimage.jpg') }} @endif" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $ad->title }}">
    <meta property="og:url" content="{{ route('frontend.business.details', ['id' => $ad->id, 'slug' => $ad->slug]) }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $ad->title }}">

    <meta name=twitter:card content="summary_large_image" />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('frontend.business.details', ['id' => $ad->id, 'slug' => $ad->slug]) }}" />
    <meta name=twitter:title content="{{ $ad->title }}" />
    <meta name=twitter:description content="{{ $ad->title }}" />
    <meta name=twitter:image
        content="@if ($ad->thumbnail) {{ asset($ad->thumbnail) }} @else {{ asset('images/noimage.jpg') }} @endif" />

@endsection

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->about_background">
        {{ __('business_directory') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.business.directories') }}" class="breedcrumb__page-link text--body-3">
                    {{ __('business_directory') }}
                </a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <section class="section business">
        <div class="container">
            <form action="{{ route('frontend.business.directories') }}" method="get" class="search_form_business mb-5">
                <div class="row">
                    <div class="col-sm-6 col-lg-4 mb-2 mb-lg-0">
                        <div class="form-group">
                            <input type="text" name="keyword"
                                @if (request('keyword')) value="{{ request('keyword') }}" @endif
                                class="form-control" placeholder="{{ __('looking_for') }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-2 mb-lg-0">
                        <div class="form-group">
                            <input type="text" name="location"
                                @if (request('location')) value="{{ request('location') }}" @endif
                                class="form-control" placeholder="{{ __('location') }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-2 mb-lg-0">
                        <div class="form-group">
                            <select name="category" class="form-control">
                                <option disabled selected> {{ __('select_cate') }} </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}"
                                        {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->businessAds->count() ?? 0 }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mb-2 mb-lg-0">
                                <div class="form-group">
                                    <button title="Search" type="submit" class="btn btn-primary border-0 w-100"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <a href="{{ route('frontend.business.directories') }}"
                                    class=" btn bg-warning">{{ __('clear') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="business_wrapper">
                        <div class="event_details event_item mb-3">
                            <div class="event_wrapper">
                                <div class="row g-1 bg-light position-relative">
                                    <div class="col-lg-6 mb-lg-0 p-lg-3">
                                        <div class="event_img mb-2">
                                            <img src="@if ($ad->thumbnail) {{ asset($ad->thumbnail) }} @else {{ asset('images/noimage.jpg') }} @endif"
                                                class="w-100 rounded" alt="image">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-2 ps-lg-0">
                                        <div class="details">
                                            @if ($ad->description)
                                                <p>{!! $ad->description  !!} </p>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="details p-2 mt-0 pt-0">
                                        @if ($ad->description)
                                            <p>
                                                {!!  $ad->description  !!}
                                            </p>
                                        @endif
                                    </div>
                                </div>


                                <div class="business_date mt-3">
                                    <ul>
                                        @if($ad->categories && $ad->categories->count() > 0 )
                                        <li><i class="fa fa-tag"></i>
                                            <span>
                                                @foreach($ad->categories as $cat)
                                                    {{ $cat->name }}{{ $loop->last ? '.' : ', ' }}
                                                @endforeach
                                            </span></li>
                                        @endif

                                        <li>
                                            <i class="fa fa-calendar"></i>
                                            <span>{{ \Carbon\Carbon::parse($ad->created_at)->format('d M Y') }} 12</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-eye"></i>
                                            <span>{{ $ad->total_views }}</span>
                                        </li>

                                    </ul>
                                    <h2>{{ $ad->title }}</h2>
                                </div>
                                <div class="additional_info mt-3">
                                    <div class="mb-3">
                                        <h3>{{ __('additional_info') }}</h3>
                                    </div>
                                    <table class="table table-striped">
                                        @if ($ad->address)
                                            <tr>
                                                <td>{{ __('address') }}</td>
                                                <td>{{ $ad->address }}</td>
                                            </tr>
                                        @endif
                                        @if ($ad->phone)
                                            <tr>
                                                <td>{{ __('head_ofice') }}</td>
                                                <td><a href="tel:{{ $ad->phone }}">{{ $ad->phone }}</a></td>
                                            </tr>
                                        @endif
                                        @if ($ad->phone_2)
                                            <tr>
                                                <td>{{ __('corporate_office') }}</td>
                                                <td><a href="tel:{{ $ad->phone_2 }}">{{ $ad->phone }}</a></td>
                                            </tr>
                                        @endif
                                        @if ($ad->email)
                                            <tr>
                                                <td>{{ __('email') }}</td>
                                                <td><a href="mailto:{{ $ad->email }}">{{ $ad->email }}</a></td>
                                            </tr>
                                        @endif
                                        {{-- @if ($ad->description)
                                    <tr>
                                        <td>{{ __('description') }}</td>
                                        <td>{{ $ad->description }}</td>
                                    </tr>
                                    @endif --}}
                                        @if ($ad->business_profile_link)
                                            <tr>
                                                <td>{{ __('business_profile') }} </td>
                                                <td><a target="__blank"
                                                        href="{{ $ad->business_profile_link }}">{{ __('Visit_My_Business') }}</a>
                                                </td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                                <div class="row">
                                    @if ($ad->user_id == null)
                                        <div class="col-md-12 mt-5">
                                            <button type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">{{ __('Claim_Your_Business') }}</button>
                                        </div>
                                    @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form id="businessClaim" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ __('Claim_Your_Business') }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">{{ __('name') }}</label>
                                                                <input type="text" name="name"
                                                                    placeholder="{{ __('name') }}"
                                                                    id="businessClaim_name" class="form-control">
                                                            </div>
                                                            <div class="col-md-12 mt-3">
                                                                <label for="">{{ __('email') }}</label>
                                                                <input type="email" name="myemail"
                                                                    placeholder="{{ __('email') }}"
                                                                    id="businessClaim_email" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-danger"
                                                            data-bs-dismiss="modal">{{ __('close') }}</button>
                                                        <button type="submit"
                                                            class="btn">{{ __('submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($ad->map)
                                    <div class="row">
                                        <div class="col-md-12 mt-5">
                                            <h5 class="mb-3">{{ __('find') }}</h5>
                                            {{-- <div class="map mymap" id="google-map" style="width: 100%; height:350px"></div>
                                    --}}
                                            <iframe src="{{ $ad->map . '&z=15&output=embed' }}" width="100%"
                                                height="350" frameborder="0" style="border:0"></iframe>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="business_sidebar position-sticky" style="top:8rem;">
                        <div class="sidebar_wrapper mb-4">
                            <div class="sidebar_title mb-3">
                                <h3>{{ __('Contact_with_author') }}</h3>
                            </div>
                            <div class="sidebar_wrap">
                                <form action="{{ route('frontend.contact.author') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $ad->id }}">
                                    <div class="row">
                                        <div class="col-lg-12 mb-2">
                                            <label for="">{{ __('email') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" placeholder="{{ __('email') }}" name="email"
                                                class="form-control" required>
                                            @error('email')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <label for="">{{ __('Leave_a_message') }}</label>
                                            <textarea name="message" class="form-control" cols="30" rows="10"
                                                placeholder="{{ __('Leave_a_message') }}" required style="height: 200px;"></textarea>
                                            @error('message')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 mt-3 text-center">
                                            @if (auth('user')->check())
                                                <button type="submit" class="btn">{{ __('submit') }}</button>
                                            @else
                                                <a href="{{ route('users.login') }}" class="btn ">{{ __('submit') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                                {{-- @dd($ad->customer->socialMedia) --}}
                                @if (isset($ad->customer->socialMedia))

                                    <div class="sidebar_title mb-3 mt-3">
                                        <div class="social-media">
                                            <div class="share-content">
                                                <h2 class="share-content__title text--body-3 card-header">
                                                    {{ __('contact_with_social') }}
                                                </h2>
                                                <ul class="share card-body">
                                                    @foreach ($ad->customer->socialMedia as $item)
                                                        <li class="share__item">

                                                            <a target="_blank" href="{{ $item->url }}"
                                                                class="social-link social-link--wa share__link">
                                                                    <i class="fa fa-{{ $item->social_media }}"></i>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="sidebar_wrapper mb-4">
                            <div class="sidebar_title mb-3">
                                <div class="social-media">
                                    <x-frontend.ad-details.ad-share :slug="$ad->slug" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('frontend_style')

    <style>
        .share {
            margin-top: 13px !important;
        }

        .mybtn {}
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('frontend_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#businessClaim").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('frontend.business.directory.claim') }}",
                type: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    console.log(data);
                    if (data.result == 1) {

                        toastr.success(data.success, 'Success', {
                            closeButton: true,
                            progressBar: true,
                        });

                        $("#businessClaim_name").val('');
                        $("#businessClaim_email").val('');

                        $('#exampleModal').modal('hide');

                    } else {

                        var errors = data.errors;
                        for (var i = 0; i < errors.length; i++) {
                            toastr.error(errors[i], 'Error', {
                                closeButton: true,
                                progressBar: true,
                            });
                        }

                    }

                },
            });

        });
    </script>


@endsection
