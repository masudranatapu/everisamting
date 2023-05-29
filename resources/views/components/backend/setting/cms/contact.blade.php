<form class="form-horizontal" action="{{ route('admin.contact.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row ">
        <div class="offset-3 col-md-6">
            <div class="form-group">
                <x-forms.label name="contact_number" :required="false"/>
                <input type="text" name="contact_number" class="form-control" value="{{ $cms->contact_number }}">
            </div>
            <div class="form-group">
                <x-forms.label name="contact_email" :required="false"/>
                <input type="text" name="contact_email" class="form-control" value="{{ $cms->contact_email }}">
            </div>
            <div class="form-group">
                <x-forms.label name="contact_address" :required="false"/>
                <input type="text" name="contact_address" class="form-control" value="{{ $cms->contact_address }}">
            </div>
            {{-- <div class="form-group">
                <x-forms.label name="contact_background" />
                    <input type="file" class="form-control dropify" data-default-file="{{ $cms->contact_background }}"
                        name="contact_background" autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                        accept="image/png, image/jpg, image/jpeg">
            </div> --}}
        </div>
    </div>
    <div class="row mt-3">
        <div class="offset-3 col-3 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_contact_settings') }}
            </button>
        </div>
    </div>
</form>
