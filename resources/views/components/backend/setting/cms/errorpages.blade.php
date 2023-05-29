<form class="form-horizontal" action="{{ route('admin.errorpages.update') }}" method="POST"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row justify-content-between">
        <div class="col-md-6">
            <div class="form-group">
                <x-forms.label name="e404_title" />
                <input type="text" class="form-control" name="e404_title" id="e404_title"
                    value="{{ old('e404_title', $cms->e404_title) }}">
                @error('e404_title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <x-forms.label name="e404_subtitle" />
                <input type="text" class="form-control" name="e404_subtitle" id="e404_subtitle"
                    value="{{ old('e404_subtitle', $cms->e404_subtitle) }}">
                @error('e404_subtitle')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <x-forms.label name="e404_image" />
                <input type="file" class="form-control dropify" data-default-file="{{ asset($cms->e404_image) }}"
                    name="e404_image" autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                    accept="image/png, image/jpg, image/jpeg">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <x-forms.label name="e500_title" />
                <input type="text" class="form-control" name="e500_title" id="e500_title"
                    value="{{ old('e500_title', $cms->e500_title) }}">
                @error('e500_title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <x-forms.label name="e500_subtitle" />
                <input type="text" class="form-control" name="e500_subtitle" id="e500_subtitle"
                    value="{{ old('e500_subtitle', $cms->e500_subtitle) }}">
                @error('e500_subtitle')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <x-forms.label name="e500_image" />
                <input type="file" class="form-control dropify" data-default-file="{{ asset($cms->e500_image) }}"
                    name="e500_image" autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                    accept="image/png, image/jpg, image/jpeg">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <x-forms.label name="e503_title" />
                <input type="text" class="form-control" name="e503_title" id="e503_title"
                    value="{{ old('e503_title', $cms->e503_title) }}">
                @error('e503_title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <x-forms.label name="e503_subtitle" />
                <input type="text" class="form-control" name="e503_subtitle" id="e503_subtitle"
                    value="{{ old('e503_subtitle', $cms->e503_subtitle) }}">
                @error('e503_subtitle')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <x-forms.label name="e503_image" />
                <input type="file" class="form-control dropify" data-default-file="{{ asset($cms->e503_image) }}"
                    name="e503_image" autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                    accept="image/png, image/jpg, image/jpeg">
            </div>
        </div>
    </div>
    <div class="row mt-3 text-center justify-content-center">
        <div class="col-8 offset-1 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_content') }}
            </button>
        </div>
    </div>
</form>
