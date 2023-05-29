<form class="form-horizontal" action="{{ route('admin.blog.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row ">
        <div class="col-md-3">
            <div class="form-group">
                <x-forms.label name="blog_background" />
                <div class="row">
                    <input type="file" class="form-control dropify" data-default-file="{{ $cms->blog_background }}"
                        name="blog_background" autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                        accept="image/png, image/jpg, image/jpeg">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_blog_settings') }}
            </button>
        </div>
    </div>
</form>
