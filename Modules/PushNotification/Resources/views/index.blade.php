@extends('admin.layouts.app')
@section('title')
    {{ __('push_notifications') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('push_notifications') }}</h3>
                        @if (userCan('push.notification.create'))
                            <a href="{{ route('admin.push.notification.create') }}"
                               class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-plus"></i>&nbsp; {{ __('add_new') }}
                            </a>
                        @endif
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover  table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 15%">{{ __('title') }} </th>
                                <th style="width: 35%">{{ __('body') }} </th>
                                <th style="width: 10%">{{ __('url') }} </th>
                                <th style="width: 10%">{{ __('status') }} </th>
                                <th style="width: 10%">{{ __('last_sent') }} </th>
                                <th style="width: 15%">{{ __('actions') }} </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($push_notifications as $notification)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $notification->title }}
                                    </td>
                                    <td>
                                        {{ $notification->body }}
                                    </td>
                                    <td>
                                        {{ $notification->url }}
                                    </td>
                                    <td>
                                        @if($notification->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($notification->total_success > 0)
                                            {{ $notification->updated_at->diffForHumans() }}
                                        @else
                                            {{ __('not_sent') }}
                                        @endif
                                    </td>
                                    @if (userCan('push.notification.edit') || userCan('push.notification.delete'))
                                        <td class="text-center">
                                            @if (userCan('serviceType.update') && $notification->status == 1)
                                                <a title="{{ __('send_push_notification') }} "
                                                   href="{{ route('admin.push.notification.send', $notification->id) }}"
                                                   class="btn btn-sm bg-primary mr-1">
                                                    {{ $notification->total_success > 0 ? __('resend') : __('send') }}
                                                </a>
                                            @endif
                                            @if (userCan('push.notification.edit'))
                                                <a title=" {{ __('edit_push_notification') }} "
                                                   href="{{ route('admin.push.notification.edit', $notification->id) }}"
                                                   class="btn btn-sm bg-info mr-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                            @if (userCan('push.notification.delete'))
                                                <form
                                                    action="{{ route('admin.push.notification.delete', $notification->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete_push_notification') }} "
                                                            onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                            class="btn btn-sm bg-danger"><i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <x-not-found word="pushNotification" route="admin.push.notification.create"/>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($push_notifications->total() > $push_notifications->count())
                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                {{ $push_notifications->links() }}
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
