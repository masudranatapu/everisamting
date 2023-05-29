@extends('admin.layouts.app')
@section('title')
    {{ __('plan_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        @if (userCan('plan.update') && $plans->count())
            <div class="row align-items-end justify-content-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-2">
                        <form action="{{ route('module.plan.recommended') }}" method="POST" class="mr-4">
                            @csrf
                            <div class="form-row align-items-end">
                                <div class="col-auto">
                                    <x-forms.label name="set_recommended_package" for="inlineFormCustomSelect"
                                        class="mr-sm-2" />
                                    <select name="plan_id" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option value="" hidden>{{ __('select_plan') }}</option>
                                        @foreach ($plans as $plan)
                                            <option {{ $plan->recommended ? 'selected' : '' }}
                                                value="{{ $plan->id }}">
                                                {{ $plan->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary "
                                        style="margin-top:30px">{{ __('save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 d-flex mb-2 justify-content-end">
                    @if (userCan('plan.create'))
                        <a href="{{ route('module.plan.create') }}" class="btn2 d-inline-block">
                            <i class="fas fa-plus"></i>&nbsp; {{ __('add_plan') }}
                        </a>
                    @endif
                </div>
            </div>
        @endif
        <div class="row h-100 mt-4">
            @forelse ($plans as $plan)
                <div class="col-md-6 col-lg-4 col-xl-3 mb-3 col-12">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header text-center py-4">
                            <h4>{{ $plan->label }}</h4>
                            <span class="text-dark h2">{{ changeCurrency($plan->price) }}</span>
                            @if ($setting->subscription_type == 'recurring')
                                @if ($plan->interval == 'custom_date')
                                    <small>/{{ $plan->custom_interval_days }} {{ __('days') }}</small>
                                @else
                                    <small>/{{ $plan->interval }}</small>
                                @endif
                            @endif
                            <br>
                            @if ($plan->recommended)
                                <div class="badge badge-info">{{ __('recommended') }}</div>
                            @endif
                        </div>

                        <div class="card-body">
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        <x-svg.check-icon width="22" height="22"
                                            stroke="{{ $setting->frontend_primary_color }}" />
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('ads_limit') }}
                                    </h5>
                                </div>
                                <h5 class="mb-0"> {{ $plan->ad_limit }}</h5>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        <x-svg.check-icon width="22" height="22"
                                            stroke="{{ $setting->frontend_primary_color }}" />
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('featured_ads_limit') }}
                                    </h5>
                                </div>
                                <h5 class="mb-0"> {{ $plan->featured_limit }}</h5>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        @if ($plan->badge)
                                            <x-svg.check-icon width="22" height="22"
                                                stroke="{{ $setting->frontend_primary_color }}" />
                                        @else
                                            <x-svg.cross-icon width="22" height="22" stroke="#dc3545" />
                                        @endif
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('business_directory_limit') }}
                                    </h5>
                                </div>
                                <h5 class="mb-0"> {{ $plan->business_directory_limit }}</h5>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        @if ($plan->badge)
                                            <x-svg.check-icon width="22" height="22"
                                                stroke="{{ $setting->frontend_primary_color }}" />
                                        @else
                                            <x-svg.cross-icon width="22" height="22" stroke="#dc3545" />
                                        @endif
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('premium_badge') }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class=" d-flex justify-content-between">
                                @if (userCan('plan.update') || userCan('plan.delete'))
                                    @if (userCan('plan.update'))
                                        <a href="{{ route('module.plan.edit', $plan->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                            {{ __('edit_plan') }}
                                        </a>
                                    @endif
                                    @if (userCan('plan.delete'))
                                        <form action="{{ route('module.plan.delete', $plan->id) }}"
                                            class="" method="POST"
                                            onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger w-100-p">
                                                <i class="fas fa-trash"></i>
                                                {{ __('delete_plan') }}
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <x-not-found message="{{ __('no_data_found') }}" />
                            <p class="plan-p">{{ __('there_is_no_plan_found_in_this_page') }}.</p>
                            @if (userCan('plan.create'))
                                <a href="{{ route('module.plan.create') }}" class="plan-btn">
                                    {{ __('add_your_first_plan') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection


@section('style')
    <style>
        .btn2 {
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            color: #fff;
            background-color: #007bff;
            font-weight: 400;
            padding: .375rem .75rem;
        }

        .btn2:hover {
            background-color: #0062cc;
            color: #fff;
        }

        .col-6 {
            padding-right: 1px;
            padding-left: 1px;
        }

        .card_footer-bg {
            background-color: #e8f7ff;
            color: #00aaff;
            width: 100%;
        }

        .card_footer-bg button {
            color: #00aaff;
        }

        .card_footer-bg:hover button {
            color: #0088cc;
        }

        .card_footer-bg:hover {
            background-color: #cceeff;
            color: #0088cc;
        }

        .cards__tag {
            position: absolute;
            top: 20px;
            left: -40px;
            padding: 8px 57px 8px 30px;
            color: #fff;
            text-transform: uppercase;
            transform: rotate(-45deg);

        }

        .plan-card {
            position: relative;
            border-radius: 12px;
            background-color: #fff;
            overflow: hidden;
        }

        .plan-card--active {
            border: 2px solid #00aaff;
        }

        .plan-card__top {
            background-color: #0088cc;
            border: 0px;
            border-radius: 0px;
            text-align: center;
            padding: 32px;
        }

        .plan-card__title {
            color: #fff;
            margin-bottom: 12px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .text--body-1 {
            line-height: 36px;
            font-family: "Nunito", sans-serif;
            font-size: 24px;
        }

        .plan-card__price {
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            margin-bottom: 32px;
            color: #fff;
        }

        .text--display-3 {
            line-height: 67.2px;
            font-weight: 700;
            font-family: "Nunito Sans", sans-serif;
            font-size: 56px;
            text-transform: capitalize;
        }

        .plan-card__bottom {
            border-top: 0px;
            padding: 32px;
            border: 1px solid #ebeef7;
        }

        .plan-card__package-list {
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .plan-card__package-list.active .icon {
            color: #fff;
            background-color: #00aaff;
        }

        .plan-card__package-list .icon {
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            margin-right: 12px;
            color: #66ccff;
        }
    </style>
@endsection
