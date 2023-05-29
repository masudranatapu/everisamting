<div class="col-md-6 mb-4">
    <label for="location" class="form-label">{{ __('authenticity') }}</label>
    <div class="row">
        <div class="col-6">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="authenticity" value="original"
                       {{ old('authenticity') == 'original' ? 'checked' : '' }} id="authenticity_1">
                <label class="form-check-label" for="authenticity_1">
                    {{ __('original') }}
                </label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="authenticity" value="refurbished"
                       {{ old('authenticity') == 'refurbished' ? 'checked' : '' }} id="authenticity_2">
                <label class="form-check-label" for="authenticity_2">
                    {{ __('refurbished') }}
                </label>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 mb-4">
    <label for="brand_id" class="form-label">{{ __('brand') }}</label>
    <select name="brand_id" id="brand_id" class="form-control select2 brand_id">
        <option value="" class="d-none"> {{ __('select_brand') }} </option>
        @if(isset($brands) && $brands->count() > 0)
            @foreach($brands as $brand)
                <option
                    value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }} >{{ $brand->name }}</option>
            @endforeach
        @endif
    </select>
</div>
<div class="col-md-6 mb-4">
    <label for="product_model_id" class="form-label">{{ __('model') }}</label>
    <select name="product_model_id" id="product_model_id" class="form-control model_id select2">
        <option value="" class="d-none"> {{ __('select_model') }} </option>
        @if(isset($models) && $models->count() > 0)
            @foreach($models as $model)
                <option
                    value="{{ $model->id }}" {{ old('product_model_id') == $model->id ? 'selected' : '' }} >{{ $model->name }}</option>
            @endforeach
        @endif

    </select>
</div>
<div class="col-md-6 mb-4">
    <label for="ram" class="form-label">{{ __('ram') }} </label>
    <select name="ram" id="ram" class="form-control select2">
        <option value="" class="d-none"> {{ __('select_ram') }} </option>
        <option value="1" {{ old('ram') == '1' ? 'selected' : '' }} >1 GB</option>
        <option value="2" {{ old('ram') == '2' ? 'selected' : '' }} >2 GB</option>
        <option value="4" {{ old('ram') == '4' ? 'selected' : '' }} >4 GB</option>
        <option value="6" {{ old('ram') == '6' ? 'selected' : '' }} >6 GB</option>
        <option value="8" {{ old('ram') == '8' ? 'selected' : '' }} >8 GB</option>
        <option value="16" {{ old('ram') == '16' ? 'selected' : '' }} >16 GB & Above</option>
    </select>
</div>
<div class="col-md-6 mb-4">
    <label for="edition" class="form-label">{{ __('edition') }} </label>
    <input type="text" name="edition" id="edition" class="form-control" placeholder="Enter the edition of your phone">
</div>

