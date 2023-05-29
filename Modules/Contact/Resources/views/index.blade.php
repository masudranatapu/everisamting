@extends('admin.layouts.app')
@section('title')
    {{ __('contact_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('contact_list') }}</h3>
                        @if ($contacts->count() > 0)
                            <button onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                id="selected_item_delete" class="btn btn-danger mr-3 float-right">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            @if ($contacts->count() > 0)
                                <thead>
                                    <tr>
                                        <th width="3%" style="position:unset; padding-right:10px;">
                                            <input id="category_checkall" name="multiple_category" type="checkbox">
                                        </th>
                                        <th width="5%">#</th>
                                        <th>{{ __('name') }}</th>
                                        <th>{{ __('email') }}</th>
                                        <th>{{ __('subject') }}</th>
                                        <th>{{ __('date') }}</th>
                                        <th width="10%">{{ __('actions') }}</th>
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($contacts as $contact)
                                    <tr id="item_id{{ $contact->id }}">
                                        <td><input onchange="checked_count()" id="single_checkbox_category"
                                                name="single_category_checkbox" value="{{ $contact->id }}"
                                                type="checkbox"></td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ $contact->created_at }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <button contact_id="{{ $contact->id }}" type="submit"
                                                onclick="contactDetail({{ json_encode($contact) }})"
                                                title="{{ __('view_message') }}"
                                                class="btn btn-sm bg-info mr-1 msgBtn"><i
                                                    class="far fa-envelope-open"></i></button>
                                            <form action="{{ route('module.contact.destroy', $contact->id) }}"
                                                method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button title="{{ __('delete_contact') }}"
                                                    onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                    class="btn btn-sm bg-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-not-found word="{{ __('contact') }}" />
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

    {{-- Message Modal --}}
    <div class="modal fade" id="contactModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('contact_details') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <x-forms.label name="full_name" />
                        <input class="form-control" id="contact-modal-name" readonly>
                    </div>
                    <div class="form-group">
                        <x-forms.label name="email" />
                        <input type="text" class="form-control" id="contact-modal-email" readonly>
                    </div>
                    <div class="form-group">
                        <x-forms.label name="subject" />
                        <input type="text" class="form-control" id="contact-modal-subject" readonly>
                    </div>
                    <div class="form-group">
                        <x-forms.label name="message" />
                        <textarea class="form-control" rows="3" id="contact-modal-message" readonly></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        function contactDetail(contact) {
            console.log(contact)
            $('#contact-modal-name').val(contact.name);
            $('#contact-modal-email').val(contact.email);
            $('#contact-modal-subject').val(contact.subject);
            $('#contact-modal-message').val(contact.message);
            $('#contactModal').modal('show');
        }

        $("#selected_item_delete").attr("disabled", true);
        $("#category_checkall").on("click", function() {
            if ($("input:checkbox").prop("checked")) {
                $("input:checkbox[name='single_category_checkbox']").prop("checked", true);
                $("#selected_item_delete").attr("disabled", false);
            } else {
                $("input:checkbox[name='single_category_checkbox']").prop("checked", false);
                $("#selected_item_delete").attr("disabled", true);
            }
        });

        function checked_count() {
            var checked_length = $(":checkbox:checked").length
            if (checked_length != 0) {
                $("#selected_item_delete").attr("disabled", false);
                $('#selected_item_delete').click(function(e) {
                    e.preventDefault();
                    var ids = [];
                    $('input:checked[name="single_category_checkbox"]:checked').each(function() {
                        ids.push($(this).val());
                    });
                    $.ajax({
                        url: "{{ route('module.contact.multiple.destroy') }}",
                        type: 'DELETE',
                        data: {
                            id: ids,
                        },
                        success: function(response) {
                            $.each(ids, function(key, val) {
                                $('#item_id' + val).remove();
                            })
                            toastr.success(response.message, 'Success');
                        }
                    })
                });
            } else {
                $("#selected_item_delete").attr("disabled", true);
            }
        }
    </script>
@endsection
