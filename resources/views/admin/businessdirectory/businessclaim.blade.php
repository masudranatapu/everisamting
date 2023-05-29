@extends('admin.layouts.app')

@section('title')
    {{ __('Business Claim') }}
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
                                        <h3>Claimed Business<span class="badge bg-blue">{{ $businessclaim->count() }}</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Business Directory</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($businessclaim as $key => $business)

                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $business->name }}</td>
                                                <td>
                                                    <a href="mailto:{{ $business->email }}">{{ $business->email }}</a>

                                                </td>
                                                <td>
                                                    {{ $business->ad->title ?? '' }}

                                                    @if($business->ad->user_id)
                                                        <div> <a href="{{ route('module.customer.show',$business->ad->customer->username) }}" target="_blank"> User: {{ $business->ad->customer->username ?? '' }}</a> </div>
                                                        <div><a href="{{ route('module.customer.show',$business->ad->customer->username) }}" target="_blank"> Email: {{ $business->ad->customer->email ?? '' }} </a></div>
                                                    @else
                                                        <div>User: Admin</div>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if($business->status == 1)
                                                        <span class="badge bg-success">Approved</span>
                                                    @else
                                                        <span class="badge bg-info">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            @if($business->ad->user_id == null)
                                                                @if($business->status == 0)
                                                                    <form action="{{ route('business.claim.status.update') }}" method="get">
                                                                        <input type="hidden" name="business_claim_id" value="{{$business->id}}" >
                                                                        <select name="status" class="form-control" onchange="if(confirm('Do you want to change status ?')) {this.form.submit()}">
                                                                            <option value="1" @if($business->status == 1) selected @endif>Approved</option>
                                                                            <option value="0" @if($business->status == 0) selected @endif>Pending</option>
                                                                        </select>
                                                                    </form>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="javascript:;" title="Edit event edit" type="button" title="Delete business claim" class="btn btn-danger" onclick="formSubmit({{ $business->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $business->id }}" action="{{ route('business.claim.delete', $business->id) }}" method="get" class="d-none">

                                                            </form>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! $businessclaim->links() !!}
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

            if(!confirm("Do you really want to delete this?")) {
                return false;
            }

            document.getElementById('delete-form-'+id).submit();

        }
    </script>
@endsection
