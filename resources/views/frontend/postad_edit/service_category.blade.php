<div class="col-12 mb-4">
    <label for="service_type_id" class="form-label">{{ __('service_type') }}</label>
    <select name="service_type_id" id="service_type_id" class="form-control select2" required>
        <option value="" class="d-none"> {{ __('select_service_type') }} </option>
        @foreach($service_types as $type)
        <option value="{{ $type->id }}" {{ $ad->service_type_id == $type->id? "selected" : "" }}>{{ $type->name }}</option>
        @endforeach
    </select>
</div>
