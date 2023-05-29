@extends('admin.layouts.app')
@section('title')
    {{ __('brand_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('brand_list') }}</h3>
                        @if (userCan('brand.create'))
                            <a href="{{ route('module.brand.create') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-plus"></i>&nbsp; {{ __('add_brand') }}
                            </a>
                        @endif
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('Category Name') }}</th>
                                    <th>{{ __('name') }} ({{ __('ads_count') }}) </th>
                                    <th>{{ __('created_date') }} </th>
                                    <th>{{ __('last_updated') }} </th>
                                    <th width="10%">{{ __('actions') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $brand)
                                    @php
                                        $category = Modules\Category\Entities\Category::where('id', $brand->category_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{$category->name ?? ''}}
                                        </td>
                                        <td>
                                            <a href="{{ route('module.brand.show', $brand->slug) }}">
                                                {{ $brand->name }} ({{ $brand->ads_count }})
                                            </a>
                                        </td>
                                        <td>{{ $brand->created_at->diffForHumans() }}</td>
                                        <td>{{ $brand->updated_at->diffForHumans() }}</td>
                                        @if (userCan('brand.update') || userCan('brand.delete'))
                                            <td class="text-center">
                                                @if (userCan('brand.update'))
                                                    <a title="{{ __('edit_brand') }} "
                                                        href="{{ route('module.brand.edit', $brand->id) }}"
                                                        class="btn bg-info mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if (userCan('brand.delete'))
                                                    <form action="{{ route('module.brand.destroy', $brand->id) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete_brand') }} "
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
                                            <x-not-found word="Brand" route="module.brand.create" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($brands->total() > $brands->count())
                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                {{ $brands->links() }}
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
