@extends('admin.layouts.app')

@section('title')
    '{{ $category->name }}' {{ __('category_wise') }} {{ __('ads') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{-- category details --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('category_details') }}</h3>
                    </div>

                    <div class="row m-2 justify-content-center">
                        <div class="col-md-4">
                            <img src="{{ $category->image_url }}" alt="image" class="image-fluid" height="350px"
                                width="350px">
                        </div>
                        <div class="col-md-8 pt-4">
                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                                cellspacing="0" width="100%">
                                <tbody>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('name') }}</th>
                                        <td width="80%">
                                            {{ $category->name }}
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('icon') }}</th>
                                        <td width="80%">
                                            {{ $category->name }}
                                        </td>
                                    </tr>
                                    @if ($category->ads_count)
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('ads_count') }}</th>
                                            <td width="80%">
                                                {{ $category->ads_count }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($category->subcategories_count)
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('subcategories_count') }}</th>
                                            <td width="80%">
                                                {{ $category->subcategories_count }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('created_at') }}</th>
                                        <td width="80%">
                                            {{ date('M d, Y', strtotime($category->created_at)) }}
                                        </td>
                                    </tr>
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('updated_at') }}</th>
                                        <td width="80%">
                                            {{ $category->updated_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- category subcategories --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">'{{ $category->name }}'
                            {{ __('category_wise') }}
                            {{ __('subcategory') }}</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('ads_count') }}</th>
                                    <th width="20%">{{ __('actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subcategories as $key => $subcategory)
                                    <tr>
                                        <td class="text-center" tabindex="0">{{ $key + 1 }}</td>
                                        <td class="text-center" tabindex="0">{{ $subcategory->name }}</td>
                                        <td class="text-center" tabindex="0">{{ $subcategory->ads_count }}</td>
                                        <td class="text-center" tabindex="0">
                                            @if (userCan('subcategory.update'))
                                                <a data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('edit_subcategory') }}"
                                                    href="{{ route('module.subcategory.edit', $subcategory->id) }}"
                                                    class="btn bg-info"><i class="fas fa-edit"></i></a>
                                            @endif
                                            @if (userCan('subcategory.delete'))
                                                <form
                                                    action="{{ route('module.subcategory.destroy', $subcategory->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('delete_subcategory') }}"
                                                        onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                        class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-not-found word="Subcategory" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- category wise ads --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">'{{ $category->name }}'
                            {{ __('category_wise') }}
                            {{ __('ads') }}</h3>
                        <a href="{{ route('module.category.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <x-backend.ad-manage :ads="$ads" :showCategory="false" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
