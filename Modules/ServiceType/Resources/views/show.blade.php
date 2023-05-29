@extends('admin.layouts.app')

@section('title')
    '{{ $service_type->name }}' {{ __('Show') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{-- category details --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('service_type_details') }}</h3>
                    </div>

                    <div class="row m-2 justify-content-center">
                        <div class="col-md-8 pt-4">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <tbody>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('service_type') }}</th>
                                        <td width="80%">
                                            {{ $service_type->name }}
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('Status') }}</th>
                                        <td width="80%">
                                            @if($service_type->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($service_type->ads)
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('ads_count') }}</th>
                                            <td width="80%">
                                                {{ $service_type->ads->count() }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('created_at') }}</th>
                                        <td width="80%">
                                            {{ date('M d, Y', strtotime($service_type->created_at)) }}
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('updated_at') }}</th>
                                        <td width="80%">
                                            {{ $service_type->updated_at->diffForHumans() }}
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
                        <h3 class="card-title" style="line-height: 36px;">{{ __('ads_for') }} {{ $service_type->name }}</h3>
                        <a href="{{ route('module.serviceType.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <x-backend.ad-manage :ads="$service_type->ads" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
