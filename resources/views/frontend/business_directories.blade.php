@extends('layouts.frontend.layout_one')

@section('title', __('Business Directory'))
@push('css')
    <style>
        @media screen and ( max-width: 500px ){

            li.page-item {
                display: none;
            }

            .page-item:first-child,
            .page-item:nth-child( 2 ),
            .page-item:nth-last-child( 2 ),
            .page-item:last-child {
                display: block !important;
            }

            li.page-item:has(a.active){
                display: block !important;
            }
        }
    </style>
@endpush

@section('content')
    <x-frontend.breedcrumb-component :background="$cms->about_background">
        {{ __('business_directory') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.business.directories') }}" class="breedcrumb__page-link text--body-3">{{
                __('business_directory') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>

    <section class="section business">
        <div class="container">
            <form action="{{ route('frontend.business.directories') }}" method="get" class="search_form_business mb-5">
                <div class="row">
                    <div class="col-sm-6 col-lg-4 mb-2 mb-lg-0">
                        <div class="form-group">
                            <input type="text" name="keyword" @if(request('keyword')) value="{{ request('keyword') }}"
                                   @endif class="form-control" placeholder="{{ __('looking_for') }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-2 mb-lg-0">
                        <div class="form-group">
                            <input type="text" name="location"
                                   @if(request('location')) value="{{ request('location') }}"
                                   @endif class="form-control" placeholder="{{ __('location') }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-2 mb-lg-0">
                        <div class="form-group">
                            <select name="category" class="form-control">
                                <option disabled selected> {{ __('select_cate') }} </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}" {{ request('category')==$category->slug ? 'selected' :
                                '' }}>{{ $category->name }}
                                    </option>
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
                                <a href="{{ route('frontend.business.directories') }}" class=" btn bg-warning">{{
                                __('clear') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="business_wrapper">
                        @if($ads->count() > 0)
                            @foreach ($ads as $ad)
                                <div class="business_item mb-2 border shadow-sm">
                                    <div class="row g-0 bg-white position-relative align-items-center">
                                        <div class="col-md-3 mb-md-0 p-md-4 text-center mt-2 mt-lg-0">
                                            <div class="business_img">
                                                <a
                                                    href="{{ route('frontend.business.details', ['id' =>$ad->id, 'slug' => $ad->slug]) }}">
                                                    <img
                                                        src="{{ asset($ad->image_url) }} "
                                                        class="w-100 rounded" alt="image">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-9 p-4 ps-md-0 text-md-start text-center">
                                            <div class="content">
                                                <h5>
                                                    <a
                                                        href="{{ route('frontend.business.details', ['id' =>$ad->id, 'slug' => $ad->slug]) }}">
                                                        {{$ad->title ?? ''}}
                                                    </a>
                                                </h5>
                                                <ul>
                                                    @if($ad->categories && $ad->categories->count() > 0 )
                                                        <li><i class="fa fa-tag"></i>
                                                            <span>
                                                                @foreach($ad->categories as $cat)
                                                                    {{ $cat->name }} {{ $loop->last ? '.' : ', ' }}
                                                                @endforeach
                                                            </span></li>
                                                    @endif
                                                    @if($ad->created_at)
                                                            <br>
                                                        <li><i class="fa fa-clock"></i>
                                                            <span>{{\Carbon\Carbon::parse($ad->created_at)->format('d M Y')}}</span>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <ul>
                                                    <li><i class="fa fa-user"></i>
                                                        <span>{{$ad->customer->name ?? 'Admin'}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h5 class="text-danger text-center">{{ __('no_data') }}</h5>
                        @endif
                        <!-- pagination -->
                        <div class="mt-4 pagination-sm">
                           {!!  $ads->links()  !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="business_sidebar position-sticky" style="top:8rem;">
                        <div class="sidebar_wrapper mb-4">
                            <div class="sidebar_title mb-3">
                                <h3>{{ __('order_by') }}</h3>
                            </div>
                            <div class="sidebar_wrap">
                                <form action="{{ route('frontend.business.directories') }}" method="get"
                                      class="search_form_business mb-5">
                                    <select name="sort" class="form-control" onchange="this.form.submit()">
                                        <option disabled selected>{{ __('select_one') }}</option>
                                        <option value="az" {{ request()->get('sort') == 'az' ? 'selected' : '' }}>{{
                                        __('alphabetical') }} (A to Z)
                                        </option>
                                        <option value="za" {{ request()->get('sort') == 'za' ? 'selected' : '' }}>{{
                                        __('alphabetical') }} (Z to A)
                                        </option>
                                        <option value="newest_to_oldest" {{ request()->get('sort') == 'newest_to_oldest' ?
                                        'selected' : '' }}>{{ __('Newest_to_Oldest') }}</option>
                                        <option value="oldest_to_newest" {{ request()->get('sort') == 'oldest_to_newest' ?
                                        'selected' : '' }}>{{ __('Oldest_to_Newest') }}</option>
                                        <option value="popular" {{ request()->get('sort') == 'popular' ? 'selected' : ''
                                        }}>{{ __('popular') }}</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar_wrapper mb-4">
                            <div class="sidebar_title mb-3">
                                <h3>{{ __('categories') }}</h3>
                            </div>
                            <div class="sidebar_wrap">
                                <form action="{{ route('frontend.business.directories') }}" method="get"
                                      class="search_form_business mb-5">
                                    <select name="category" class="form-control" onchange="this.form.submit()">
                                        <option disabled selected>{{ __('select_cate') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->slug }}" {{ request('category')==$category->slug ?
                                        'selected' : '' }} >{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
