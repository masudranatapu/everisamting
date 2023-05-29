<form class="form-horizontal" action="{{ route('admin.maintenance.update') }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row justify-content-between">
        <div class="offset-1 col-md-6">
            <div class="form-group">
                <x-forms.label name="maintenance_title" />
                <input type="text" class="form-control" name="maintenance_title" id="maintenance_title" value="{{ old('maintenance_title', $cms->maintenance_title) }}">
                @error('maintenance_title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <x-forms.label name="maintenance_subtitle" />
                <input type="text" class="form-control" name="maintenance_subtitle" id="maintenance_subtitle" value="{{ old('maintenance_subtitle', $cms->maintenance_subtitle) }}">
                @error('maintenance_subtitle')
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
