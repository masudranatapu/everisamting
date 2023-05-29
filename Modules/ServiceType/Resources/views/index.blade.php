@extends('admin.layouts.app')
@section('title')
    {{ __('service_type_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('service_type_list') }}</h3>
                        @if (userCan('serviceType.create'))
                            <a href="{{ route('module.serviceType.create') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-plus"></i>&nbsp; {{ __('add_service_type') }}
                            </a>
                        @endif
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }} ({{ __('ads_count') }}) </th>
                                    <th>{{ __('status') }} </th>
                                    <th>{{ __('created_date') }} </th>
                                    <th>{{ __('last_updated') }} </th>
                                    <th width="10%">{{ __('actions') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($service_types as $service_type)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('module.serviceType.show', $service_type->id) }}">
                                                {{ $service_type->name }} ({{ $service_type->ads->count() }})
                                            </a>
                                        </td>
                                        <td>
                                            @if($service_type->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $service_type->created_at->diffForHumans() }}</td>
                                        <td>{{ $service_type->updated_at->diffForHumans() }}</td>
                                        @if (userCan('serviceType.update') || userCan('serviceType.delete'))
                                            <td class="text-center">
                                                @if (userCan('serviceType.update'))
                                                    <a title="{{ __('edit_service_type') }} "
                                                        href="{{ route('module.serviceType.edit', $service_type->id) }}"
                                                        class="btn bg-info mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if (userCan('serviceType.delete'))
                                                    <form action="{{ route('module.serviceType.destroy', $service_type->id) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete_service_type') }} "
                                                            onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                            class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-not-found word="ServiceType" route="module.serviceType.create" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($service_types->total() > $service_types->count())
                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                {{ $service_types->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .page-link.page-navigation__link.active {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

    </style>
@endsection
