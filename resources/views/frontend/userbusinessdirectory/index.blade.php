@extends('layouts.frontend.layout_one')

@section('title', __('business_directory'))

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
                <a class="breedcrumb__page-link text--body-3">{{ __('business_directory') }}</a>
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

                    <div class="card">
                        <div class="card-header">
                            <div class="dashboard__posted-ads">
                                <div class="dashboard__section-info">
                                    <h2 class="dashboard-card__title"> {{ __('business_directory') }} </h2>
                                    <a href="{{ route('frontend.user-business-directory.create') }}" class="btn">
                                        {{ __('ad_my_business') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($userbusinessdirectories->count() > 0)
                                <div class="row user_events">
                                    @foreach ($userbusinessdirectories as $businessdirectory)
                                        <div class="col-md-4 mb-3">
                                            <div class="cards cards--one">
                                                <a href="{{ route('frontend.business.details', ['id' =>$businessdirectory->id, 'slug' => $businessdirectory->slug]) }}" class="cards__img-wrapper">
                                                    <img src="@if($businessdirectory->thumbnail) {{ asset($businessdirectory->thumbnail) }} @else {{ asset('images/noimage.jpg') }} @endif" alt="card-img" class="img-fluid" />
                                                </a>
                                                <div class="cards__info">
                                                    <div class="cards__info-top">
                                                        <a href="{{ route('frontend.business.details', ['id' =>$businessdirectory->id, 'slug' => $businessdirectory->slug]) }}" class="text--body-3-600 cards__caption-title">
                                                            {{ \Illuminate\Support\Str::limit($businessdirectory->title, 25, $end = '...') }}
                                                        </a>
                                                    </div>
                                                    <div class="cards__info-bottom">
                                                        <span class="cards__price-title text--body-3-600">
                                                            @if($businessdirectory->status == 'pending')
                                                                <span class="badge bg-info">{{ __('pending') }}</span>
                                                            @endif
                                                            @if($businessdirectory->status == 'active')
                                                                <span class="badge bg-success">{{ __('active') }}</span>
                                                            @endif
                                                            @if($businessdirectory->status == 'declined')
                                                                <span class="badge bg-danger">{{ __('declined') }}</span>
                                                            @endif
                                                        </span>

                                                        <ul class="edit">
                                                            <li class="edit-icon">
                                                                <span class="icon-toggle">
                                                                    <x-svg.three-dots-icon />
                                                                </span>
                                                                <ul class="edit-dropdown">
                                                                    <li class="edit-dropdown__item">
                                                                        <a href="{{ route('frontend.user-business-directory.edit', $businessdirectory->id) }}" class="edit-dropdown__link">
                                                                            <span class="icon">
                                                                                <x-svg.edit-icon />
                                                                            </span>
                                                                            <h5 class="text--body-4">{{ __('Edit') }}</h5>
                                                                        </a>
                                                                    </li>
                                                                    <li class="edit-dropdown__item">
                                                                        <a href="{{ route('frontend.business.details', ['id' =>$businessdirectory->id, 'slug' => $businessdirectory->slug]) }}" class="edit-dropdown__link">
                                                                            <span class="icon">
                                                                                <x-svg.eye-icon stroke="currentColor" width="20" height="20" />
                                                                            </span>
                                                                            <h5 class="text--body-4">{{ __('View') }}</h5>
                                                                        </a>
                                                                    </li>
                                                                    <li class="edit-dropdown__item">

                                                                        <a href="javascript:;" class="edit-dropdown__link" onclick="formSubmit({{ $businessdirectory->id }})">
                                                                            <span class="icon">
                                                                                <x-svg.delete-icon />
                                                                            </span>
                                                                            <h5 class="text--body-4">{{ __('Delete') }}</h5>
                                                                        </a>

                                                                        <form id="delete-form-{{ $businessdirectory->id }}" action="{{ route('frontend.user-business-directory.destroy', $businessdirectory->id) }}" method="POST" class="d-none">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>

                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h4>{{ __('no_data') }}</h4>
                                        <br>
                                        <a href="{{ route('frontend.user-business-directory.create') }}"class="btn">{{ __('first_busi_direct') }}</a>
                                    </div>
                                </div>
                            @endif
                            <br>
                            {{ $userbusinessdirectories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('adlisting_style')

@endsection

@section('frontend_script')
    <script>
        function formSubmit(id) {

            if(!confirm("Do you really want to delete this?")) {
                return false;
            }

            document.getElementById('delete-form-'+id).submit();

        }
    </script>
@endsection
