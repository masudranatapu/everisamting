@extends('admin.settings.setting-layout')
@section('title')
    {{ __('Currency') }}
@endsection

@section('website-settings')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <form class="" action="{{ route('module.currency.default') }}" method="POST">
                    @csrf
                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                            <x-forms.label name="set_default_currency" class="mr-sm-2" for="inlineFormCustomSelect" />
                            <select name="currency" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                <option value="" disabled selected>{{ __('Currency') }}</option>
                                @foreach ($currencies as $key => $currency)
                                    <option {{ env('APP_CURRENCY') == $currency->code ? 'selected' : '' }}
                                        value="{{ $currency->id }}">
                                        {{ $currency->name }} ( {{ $currency->code }} )
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto my-2 py-2 ">
                            <button type="submit" class="btn btn-primary "
                                style="margin-top:25px">{{ __('save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('currency_list') }}</h3>
                        <a href="{{ route('module.currency.create') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-plus"></i>&nbsp; {{ __('add') }}</a>
                        <a target="blank" href="{{ route('module.currency.example') }}"
                            class="btn btn-outline-success float-right d-flex align-items-center justify-content-center mr-2">
                            &nbsp; {{ __('Check Example') }}</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('code') }}</th>
                                    <th>{{ __('symbol') }}</th>
                                    <th>{{ __('position') }}</th>
                                    <th width="15%">{{ __('actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse ($currencies as $key => $currency)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $currency->name }}
                                            @if (env('APP_CURRENCY') == $currency->code)
                                                <span class="badge badge-pill badge-primary">
                                                    {{ __('default') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $currency->code }}</td>
                                        <td>{{ $currency->symbol }}</td>
                                        <td>{{ Str::ucfirst($currency->symbol_position) }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            @if ($currency->code == 'USD')
                                                <a href="javascript:void(0)" class="btn btn-warning mt-0 mr-2"
                                                    data-toggle="tooltip"
                                                    title="{{ __('you_can_not_delete_or_edit_this_currency') }}">
                                                    <i class="fas fa-lock"></i>
                                                </a>
                                            @endif
                                            @if ($currency->code != 'USD')
                                                <a href="{{ route('module.currency.edit', $currency->id) }}"
                                                    class="btn btn-info mt-0 mr-2"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('module.currency.delete', $currency->id) }}"
                                                    class="d-inline" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('delete_language') }}"
                                                        onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                        class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-admin.not-found word="{{ __('currency') }}" route="module.currency.create"
                                                method="GET" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($currencies->total() > $currencies->count())
                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                {{ $currencies->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $('input[name="default"]').on('switchChange.bootstrapSwitch', function(event, state) {
            $('#' + event.currentTarget.id).submit();
        });
    </script>
@endsection
