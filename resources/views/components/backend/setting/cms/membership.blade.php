<form class="form-horizontal" action="{{ route('admin.getmembership.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row ">
        <div class="col-md-3">
            <div class="form-group">
                <x-forms.label name="get_membership_background" />
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->get_membership_background }}" name="get_membership_background"
                        autocomplete="image">
                </div>
            </div>
        </div>
        <div class="offset-1 col-md-3 ">
            <div class="form-group">
                <x-forms.label name="get_membership_image" />
                <div class="row">
                    <input type="file" class="form-control dropify"
                        data-default-file="{{ $cms->get_membership_image }}" name="get_membership_image"
                        autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                        accept="image/png, image/jpg, image/jpeg">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('upate_membership_settings') }}
            </button>
        </div>
    </div>
</form>
