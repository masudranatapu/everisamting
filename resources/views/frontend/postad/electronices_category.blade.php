<div class="col-md-6 mb-4">
    <label for="brand_id" class="form-label">{{ __('brand') }}</label>
    <select name="brand_id" id="brand_id" class="form-control brand_id select2">
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
@if($cat->slug == 'pc')

    <div class="col-md-6 mb-4">
        <label for="ram" class="form-label">{{ __('ram') }} </label>
        <select name="ram" id="ram" class="form-control select2">
            <option value="" class="d-none"> {{ __('select_ram') }} </option>
            <option value="1" {{ old('ram') == '1' ? 'selected' : '' }} >1 GB</option>
            <option value="3" {{ old('ram') == '2' ? 'selected' : '' }} >2 GB</option>
            <option value="4" {{ old('ram') == '4' ? 'selected' : '' }} >4 GB</option>
            <option value="6" {{ old('ram') == '6' ? 'selected' : '' }} >6 GB</option>
            <option value="8" {{ old('ram') == '8' ? 'selected' : '' }} >8 GB</option>
            <option value="16" {{ old('ram') == '16' ? 'selected' : '' }} >16 GB & Above</option>
        </select>
    </div>
    <div class="col-md-6 mb-4">
        <label for="processor" class="form-label">{{ __('processor') }} </label>
        <select name="processor" id="processor" class="form-control select2">
            <option value="" class="d-none"> {{ __('select_processor') }} </option>
            <option value="Dual Core" {{ old('processor') == 'Dual Core' ? 'selected' : '' }} >Dual Core</option>
            <option value="Quad Core" {{ old('processor') == 'Quad Core' ? 'selected' : '' }} >Quad Core</option>
            <option value="i3" {{ old('processor') == 'i3' ? 'selected' : '' }} >i3</option>
            <option value="i5" {{ old('processor') == 'i5' ? 'selected' : '' }} >i5</option>
            <option value="i7" {{ old('processor') == 'i7' ? 'selected' : '' }} >i7</option>
            <option value="i9" {{ old('processor') == 'i9' ? 'selected' : '' }} >i9</option>
        </select>
    </div>
@endif
