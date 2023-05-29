<div class="col-12 mb-4">
    <label for="land_type" class="form-label">{{ __('property_type') }}</label>
    <div class="row">
        <div class="col-6 col-sm-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="property_type" value="agricultural"
                       {{ old('property_type') == 'agricultural' ? 'checked' : '' }} id="property_type_1">
                <label class="form-check-label" for="property_type_1">
                    {{ __('agricultural') }}
                </label>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="property_type" value="residential"
                       {{ old('property_type') == 'residential' ? 'checked' : '' }} id="property_type_2">
                <label class="form-check-label" for="property_type_2">
                    {{ __('residential') }}
                </label>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="property_type" value="commercial"
                       {{ old('property_type') == 'commercial' ? 'checked' : '' }} id="property_type_3">
                <label class="form-check-label" for="property_type_3">
                    {{ __('commercial') }}
                </label>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="property_type" value="other"
                       {{ old('property_type') == 'other' ? 'checked' : '' }} id="property_type_4">
                <label class="form-check-label" for="property_type_4">
                    {{ __('other') }}
                </label>
            </div>
        </div>
        @error('property_type')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="col-md-6 mb-4">
    <label for="size" class="form-label">{{ __('size') }}</label>
    <div class="input-group">
        <input type="number" name="size" id="size" class="form-control"
               placeholder="What's the size of your land?">
        <select name="size_type" id="size_type" class="input-gorup-text">
            <option value="sqft" {{ old('size_type') == 'sqft' ? 'selected' : '' }} >sqft</option>
            <option value="hectare" {{ old('size_type') == 'hectare' ? 'selected' : '' }} >hectare</option>
            <option value="acres" {{ old('size_type') == 'acres' ? 'selected' : '' }} >acres</option>
            <option value="decimal" {{ old('size_type') == 'decimal' ? 'selected' : '' }} >decimal</option>
        </select>
    </div>
</div>
<div class="col-md-6 mb-4">
    <label for="bedroom" class="form-label">{{ __('bedroom') }}</label>
    <input type="number" name="bedroom" id="bedroom" value="{{ old('bedroom') }}" class="form-control"
           placeholder="{{ __('enter_bedroom') }}" >
</div>
<div class="col-md-6 mb-4">
    <label for="property_location" class="form-label">{{ __('property_location') }}</label>
    <input type="text" name="property_location" value="{{ old('property_location') }}" id="property_location" class="form-control"
           placeholder="{{ __('enter_property_location') }}" >
</div>
<div class="col-6 mb-4">
    <label for="price" class="form-label">{{ __('price') }}</label>
    <div class="input-group">
        <input type="number" name="price" id="price" value="price" class="form-control"
               placeholder="{{ __('property_price') }}"
               >
        <select name="price_type" id="price_type" class="input-group-text" >
            <option value="total price" {{ old('price_type') == 'total price' ? 'selected' : '' }} >total price</option>
            <option value="per sqft" {{ old('price_type') == 'per sqft' ? 'selected' : '' }} >per sqft</option>
            <option value="per hectare" {{ old('price_type') == 'per hectare' ? 'selected' : '' }} >per hectare</option>
            <option value="per acre" {{ old('price_type') == 'per acre' ? 'selected' : '' }} >per acre</option>
            <option value="per decimal" {{ old('price_type') == 'per decimal' ? 'selected' : '' }} >per decimal</option>
        </select>
    </div>
    @error('price')
        <p class="text-danger">{{ $message }}</p>
    @enderror
    @error('price_type')
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
