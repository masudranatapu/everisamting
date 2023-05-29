@extends('admin.layouts.app')

@section('title')
    {{ __('Business Directory') }}
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Business Directory <span
                                                class="badge bg-blue">{{ $businessdirectories_count }}</span></h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <form action="{{ route('business.fileImport') }}" method="POST" enctype="multipart/form-data" class="float-end">
                                            @csrf
                                            <div class="float-right">
                                                <div class="input-group mb-3" >
                                                    <input type="file" name="file"
                                                        class="form-control" id="customFile" style="height:45px;">
                                                    <div class="input-group-append mr-2">
                                                        <button type="submit" class="btn btn-primary"
                                                            id="basic-addon2">Import
                                                            data</button>
                                                    </div>
                                                    <a href="{{ route('business-directory.create') }}" type="button"
                                                        class="btn btn-success">
                                                        <i class="fa fa-plus"></i>
                                                        Add Business Directory
                                                    </a>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>User</th>
                                            <th>Profile Link</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($businessdirectories as $businessdirectory)
                                            @php
                                                $user = DB::table('users')
                                                    ->where('id', $businessdirectory->user_id)
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <td> {{ $businessdirectory->title ?? '' }} </td>
                                                <td>
                                                    <img width="50" height="50"
                                                        src="@if ($businessdirectory->thumbnail) {{ asset($businessdirectory->thumbnail) }} @else {{ asset('images/noimage.jpg') }} @endif"
                                                        alt="">
                                                </td>
                                                <td>
                                                    @foreach($businessdirectory->categories as $cat)
                                                        {{ $cat->name }} {{ $loop->last ? '' : ', ' }}
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a
                                                        href="mailto:{{ $businessdirectory->email }}">{{ $businessdirectory->email }}</a>
                                                </td>
                                                <td>
                                                    <a
                                                        href="tel:{{ $businessdirectory->phone }}">{{ $businessdirectory->phone }}</a>
                                                </td>
                                                <td>
                                                    {{ $businessdirectory->address }}
                                                </td>
                                                <td>
                                                    @if ($businessdirectory->user_id)
                                                        {{ $user->name ?? '' }}
                                                    @else
                                                        Admin
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($businessdirectory->business_profile_link))
                                                        <a href="{{ $businessdirectory->business_profile_link }}"
                                                            target="__blank">
                                                            Profile Link
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($businessdirectory->status == 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @endif
                                                    @if ($businessdirectory->status == 'pending')
                                                        <span class="badge bg-info">Pending</span>
                                                    @endif
                                                    @if ($businessdirectory->status == 'declined')
                                                        <span class="badge bg-danger">Declined</span>
                                                    @endif
                                                </td>
                                                <td>

                                                    <a href="{{ route('business-directory.edit', $businessdirectory->id) }}"
                                                        title="Edit event edit" type="button" title="Edit Event"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;" title="Edit event edit" type="button"
                                                        title="Delete Events" class="btn btn-danger"
                                                        onclick="formSubmit({{ $businessdirectory->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $businessdirectory->id }}"
                                                        action="{{ route('business-directory.destroy', $businessdirectory->id) }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! $businessdirectories->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function formSubmit(id) {

            if (!confirm("Do you really want to delete this?")) {
                return false;
            }

            document.getElementById('delete-form-' + id).submit();

        }
    </script>
@endsection
