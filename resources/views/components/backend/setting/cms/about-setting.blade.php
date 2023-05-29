<form class="form-horizontal" action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row justify-content-between">
        <div class="offset-1 col-md-6">
           <!--  <div class="form-group">
                <x-forms.label name="about_video_thumb" />
                <div class="row">
                    <input type="file" class="form-control dropify" data-default-file="{{ $aboutVideoThumb }}"
                        name="about_video_thumb" autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                        accept="image/png, image/jpg, image/jpeg">
                </div>
            </div> -->
            <div class="form-group">
                <x-forms.label name="about_background" />
                <div class="row">
                    <input type="file" class="form-control dropify" data-default-file="{{ $aboutBackground }}"
                        name="about_background" autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                        accept="image/png, image/jpg, image/jpeg">
                </div>
            </div>
            <div class="form-group">
                <x-forms.label name="about_body" />
                <div class="row">
                    <textarea id="about_ck" class="form-control" name="about_body"
                        placeholder="{{ __('write_the_answer') }}">{{ $aboutcontent }}</textarea>
                    @error('about_body')
                        <span class="text-danger" style="font-size: 13px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 offset-1 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_about_setting') }}
            </button>
        </div>
    </div>
</form>
