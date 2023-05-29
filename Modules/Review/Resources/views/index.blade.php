@extends('admin.layouts.app')

@section('title')
    {{ __('review_list') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('review') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('review') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="">
        @php
            $star = '<i class="fas fa-star text-warning" aria-hidden="true"></i>';
        @endphp
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <form class="" id="filterForm" action="{{ route('review.index') }}" method="GET">
                            <div class="col-sm-12 col-md-2 ">
                                <h3 class="card-title line-height-36">{{ __('review_list') }}</h3>
                            </div>
                            <div class="row d-flex justify-content-end ">
                                <div class="col-sm-3 col-md-2 p-1">
                                    <select name="customer" class="form-control select2bs4 w-100-p">
                                        <option value="">{{ __('all_customer') }}</option>
                                        @foreach ($customers as $customer)
                                            <option {{ request('customer') == $customer->id ? 'selected' : '' }}
                                                value="{{ $customer->id }}">{{ $customer->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3 col-md-2 p-1">
                                    <select name="product" class="form-control select2bs4 w-100-p">
                                        <option value="">{{ __('all_product') }}</option>
                                        @foreach ($products as $product)
                                            <option {{ request('product') == $product->id ? 'selected' : '' }}
                                                value="{{ $product->id }}">{{ $product->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3 col-md-2 p-1">
                                    <select name="stars" id="filter" class="form-control w-100-p">
                                        <option value="">{{ __('all_stars') }}</option>
                                        <option {{ request('stars') == 1 ? 'selected' : '' }} value="1">1
                                            {{ __('star') }}</option>
                                        <option {{ request('stars') == 2 ? 'selected' : '' }} value="2">2
                                            {{ __('star') }}</option>
                                        <option {{ request('stars') == 3 ? 'selected' : '' }} value="3">3
                                            {{ __('star') }}</option>
                                        <option {{ request('stars') == 4 ? 'selected' : '' }} value="4">4
                                            {{ __('star') }}</option>
                                        <option {{ request('stars') == 5 ? 'selected' : '' }} value="5">5
                                            {{ __('star') }}</option>

                                    </select>
                                </div>
                                <div class="col-sm-3 col-md-2 p-1">
                                    <select name="sort_by" class="form-control w-100-p">
                                        <option value="latest" selected>
                                            {{ __('latest') }}
                                        </option>
                                        <option {{ request('sort_by') == 'oldest' ? 'selected' : '' }} value="oldest">
                                            {{ __('oldest') }}
                                        </option>
                                    </select>
                                </div>
                                @if (request('customer') || request('product') || request('stars') || request('sort_by'))
                                    <div class="col-sm-3 col-md-1 p-1 mt-1">
                                        <a href="{{ route('review.index') }}"
                                            class="btn btn-sm btn-danger">{{ __('clear') }}</a>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="card-body text-center table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('customer') }}</th>
                                    <th>{{ __('product') }}</th>
                                    <th>{{ __('comment') }}</th>
                                    <th>{{ __('star') }}({{ __('rating_count') }})</th>
                                    @if (userCan('review.update'))
                                        <th>{{ __('status') }}</th>
                                    @endif
                                    @if (userCan('review.delete'))
                                        <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $review)
                                    <tr>
                                        <td>
                                            <a href="{{ route('module.customer.show', $review->user->id) }}">
                                                {{ $review->user->full_name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('module.product.show', $review->product->id) }}">
                                                {{ Str::limit($review->product->title, 30, '...') }}
                                            </a>
                                        </td>
                                        <td>{{ Str::limit($review->comment, 30, '...') }}</td>
                                        <td>
                                            @for ($i = 0; $i < $review->stars; $i++)
                                                {!! $star !!}
                                            @endfor

                                            ({{ $review->product->total_rated }})
                                        </td>
                                        @if (userCan('review.update'))
                                            <td class="text-center">
                                                <div>
                                                    <label class="switch ">
                                                        <input data-id="{{ $review->id }}" type="checkbox"
                                                            class="success toggle-switch"
                                                            {{ $review->status == 1 ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                        @endif
                                        @if (userCan('review.delete'))
                                            <td>
                                                <form action="{{ route('review.destroy', $review->id) }}" method="POST"
                                                    class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button data-toggle="tooltip" data-placement="top" title="Delete Bed"
                                                        onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                        class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="20">
                                            <x-admin.not-found word="review" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($reviews->total() > $reviews->count())
                        <div class="mt-3 d-flex justify-content-center">{{ $reviews->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

    <script>
        $('#filterForm').on('change', function() {
            $(this).submit();
        })

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        $('.toggle-switch').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{ route('review.status.change') }}',
                data: {
                    'status': status,
                    'id': id,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        });
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 35px;
            height: 19px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.success:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(15px);
            -ms-transform: translateX(15px);
            transform: translateX(15px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

    </style>
@endsection
