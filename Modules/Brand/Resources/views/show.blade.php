@extends('admin.layouts.app')

@section('title')
    '{{ $brand->name }}' {{ __('brand_wise') }} {{ __('ads') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{-- category details --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('brand_details') }}</h3>
                    </div>

                    <div class="row m-2 justify-content-center">
                        <div class="col-md-8 pt-4">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <tbody>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('name') }}</th>
                                        <td width="80%">
                                            {{ $brand->name }}
                                        </td>
                                    </tr>
                                    @if ($brand->ads_count)
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('ads_count') }}</th>
                                            <td width="80%">
                                                {{ $brand->ads_count }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('created_at') }}</th>
                                        <td width="80%">
                                            {{ date('M d, Y', strtotime($brand->created_at)) }}
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('updated_at') }}</th>
                                        <td width="80%">
                                            {{ $brand->updated_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- category wise ads --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">'{{ $brand->name }}'
                            {{ __('brand_wise') }}
                            {{ __('ads') }}</h3>
                        <a href="{{ route('module.category.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <x-backend.ad-manage :ads="$ads" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
