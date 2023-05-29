<form class="form-horizontal" action="{{ route('admin.comingsoon.update') }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row justify-content-between">
        <div class="offset-1 col-md-6">
            <div class="form-group">
                <x-forms.label name="coming_soon_title" />
                <input type="text" class="form-control" name="coming_soon_title" id="coming_soon_title" value="{{ old('coming_soon_title', $cms->coming_soon_title) }}">
                @error('coming_soon_title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <x-forms.label name="coming_soon_subtitle" />
                <input type="text" class="form-control" name="coming_soon_subtitle" id="coming_soon_subtitle" value="{{ old('coming_soon_subtitle', $cms->coming_soon_subtitle) }}">
                @error('coming_soon_subtitle')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-8 offset-1 ">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-sync"></i> {{ __('update_content') }}
            </button>
        </div>
    </div>
</form>
