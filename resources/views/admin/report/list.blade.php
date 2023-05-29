@extends('admin.layouts.app')
@section('title')
    {{ __('seller_report') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title" style="line-height: 36px;">{{ __('seller_report') }}</h3>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>{{ __('report_to') }}</th>
                                    <th>{{ __('report_from') }}</th>
                                    <th>{{ __('reason') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reports as $report)
                                    <tr>
                                        <td width="20%"><a
                                                href="{{ route('module.customer.show', $report->reportTo->username) }}">{{ $report->reportTo->name }}</a>
                                        </td>
                                        <td width="20%"><a
                                                href="{{ route('module.customer.show', $report->reportTo->username) }}">{{ $report->reportFrom->name }}</a>
                                        </td>
                                        <td>{{ $report->reason }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-not-found2 />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
