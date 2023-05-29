@extends('admin.layouts.app')
@section('title')
    {{ __('skins') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('skins') }}</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('change_home_page_skin') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-6 col-xl-4">
                                <div class="card d-inline-block">
                                    <img src="{{ asset('backend/image/theme2.png') }}" width="500px" height="250px"
                                        class="card-img-top skin-image" alt="home page 1">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ __('home_page_1') }}</h5>
                                        <p class="card-text">{{ __('home_page1_description') }}</p>
                                        @if (homePageThemes() == 1)
                                            <button onclick="homePageChange(1)" type="submit"
                                                class="btn btn-danger">{{ __('deactivate') }}</button>
                                        @else
                                            <input hidden name="home_page" type="text" value="2">
                                            <button onclick="homePageChange(1)" type="submit"
                                                class="btn btn-primary">{{ __('activate') }}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-4">
                                <div class=" card d-inline-block">
                                    <img src="{{ asset('backend/image/theme1.png') }}" width="500px" height="250px"
                                        class="card-img-top skin-image" alt="home page 2">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ __('home_page_2') }}</h5>
                                        <p class="card-text">{{ __('home_page2_description') }}</p>
                                        @if (homePageThemes() == 2)
                                            <button onclick="homePageChange(1)" type="submit"
                                                class="btn btn-danger">{{ __('deactivate') }}</button>
                                        @else
                                            <input hidden name="home_page" type="text" value="1">
                                            <button onclick="homePageChange(2)" type="submit"
                                                class="btn btn-primary">{{ __('activate') }}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-4">
                                <div class="card d-inline-block">
                                    <img src="{{ asset('backend/image/theme3.png') }}" class="card-img-top skin-image"
                                        width="500px" height="250px" alt="home page 3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ __('home_page_3') }}</h5>
                                        <p class="card-text">{{ __('home_page3_description') }}</p>
                                        @if (homePageThemes() == 3)
                                            <button onclick="homePageChange(1)" type="submit"
                                                class="btn btn-danger">{{ __('deactivate') }}</button>
                                        @else
                                            <button onclick="homePageChange(3)" type="submit"
                                                class="btn btn-primary">{{ __('activate') }}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('module.themes') }}" method="POST" id="themes_form">
        @method('PUT')
        @csrf
        <input id="home_page" hidden name="home_page" type="text" value="">
    </form>
@endsection

@section('script')
    <script>
        function homePageChange(pageNo) {
            $('#home_page').val(pageNo)
            $('#themes_form').submit()
        }
    </script>
@endsection
