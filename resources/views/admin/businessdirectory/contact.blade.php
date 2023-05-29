@extends('admin.layouts.app')

@section('title')
    {{ __('Author Contact List') }}
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
                                    <div class="col-md-12">
                                        <h3>Author Contact List <span class="badge bg-blue">{{ $contactauthor->count() }}</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Author Name</th>
                                            <th>User name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contactauthor as $key => $author)
                                            @php
                                                $userauthor = DB::table('users')->where('id', $author->author_id)->first();
                                                $usersender = DB::table('users')->where('id', $author->created_by)->first();
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}    
                                                </td>
                                                <td>
                                                    <a href="mailto:{{ $author->email }}">{{ $author->email }}</a>
                                                </td>
                                                <td>
                                                    {!! $author->message !!}
                                                </td>
                                                <td>
                                                    {{$userauthor->name ?? ''}}
                                                </td>
                                                <td>
                                                    {{$usersender->name ?? ''}}
                                                </td>
                                                <td>


                                                    <a href="javascript:;" title="Edit event edit" type="button" title="Delete author contact" class="btn btn-danger" onclick="formSubmit({{ $author->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </a>

                                                    <form id="delete-form-{{ $author->id }}" action="{{ route('business.author.delete', $author->id) }}" method="get" class="d-none">

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
                                        {!! $contactauthor->links() !!}
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