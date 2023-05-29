@extends('admin.layouts.app')

@section('title')
    {{ __('transaction_history') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('transaction_history') }}</h3>
                        <a href="{{ url()->previous() }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('order_id') }}</th>
                                    <th>{{ __('transaction_id') }}</th>
                                    <th>{{ __('customer') }}</th>
                                    <th>{{ __('amount') }}</th>
                                    <th>{{ __('plan_name') }}</th>
                                    <th>{{ __('payment_provider') }}</th>
                                    <th>{{ __('created_time') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $transaction)
                                    <tr>
                                        <td class="text-muted">
                                            {{ $transaction->order_id }}
                                        </td>
                                        <td class="text-muted">
                                            {{ $transaction->transaction_id ?? '--' }}
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('module.customer.show', $transaction->customer->username) }}">{{ $transaction->customer->name }}</a>
                                        </td>
                                        <td class="text-muted">
                                            {{ $transaction->currency_symbol }}{{ $transaction->amount }}
                                        <td class="text-muted">
                                            <span class="badge badge-primary">
                                                {{ $transaction->plan->label }}
                                            </span>
                                        </td>
                                        <td class="text-muted">{{ ucfirst($transaction->payment_provider) }}</td>
                                        <td class="text-muted">
                                            {{ date('M d, Y', strtotime($transaction->created_at)) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <span class="">{{ __('no_transactions_found') }}...</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
