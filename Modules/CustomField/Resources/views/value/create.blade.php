<form class="form-horizontal"
    action=" {{ request()->routeIs('module.custom.field.edit.value') ? route('module.custom.field.update.value', $value->id) : route('module.custom.field.store.value', $field->id) }}"
    method="POST">
    @csrf
    @if (request()->routeIs('module.custom.field.edit.value'))
        @method('PUT')
    @endif
    <div class="col-md-12">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-12 mb-2">
                <x-forms.label name="option_name" for="option_name" required="true" />
                <input type="text" name="option_name" class="form-control @error('option_name') is-invalid @enderror"
                    value="{{ request()->routeIs('module.custom.field.edit.value') ? $value->value : old('option_name') }}"
                    id="option_name" placeholder="{{ __('option_name') }}">
                @error('option_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-success">
                @if (request()->routeIs('module.custom.field.edit.value'))
                    <i class="fas fa-sync"></i>
                    <span class="ml-2">{{ __('update') }}</span>
                @else
                    <i class="fas fa-plus"></i>
                    <span class="ml-2">{{ __('create') }}</span>
                @endif
            </button>
        </div>
    </div>
</form>
