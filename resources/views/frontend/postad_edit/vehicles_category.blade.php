<div class="col-md-6 mb-4">
    <label for="brand_id" class="form-label">{{ __('brand') }}</label>
    <select name="brand_id" id="brand_id" class="form-control select2">
        <option value="" class="d-none"> {{ __('select_brand') }} </option>
        @if(isset($brands) && $brands->count() > 0)
            @foreach($brands as $brand)
                <option
                    value="{{ $brand->id }}" {{ $ad->brand_id == $brand->id ? 'selected' : '' }} >{{ $brand->name }}</option>
            @endforeach
        @endif
    </select>
</div>
<div class="col-md-6 mb-4">
    <label for="product_model_id" class="form-label">{{ __('model') }}</label>
    <select name="product_model_id" id="product_model_id" class="form-control select2">
        <option value="" class="d-none"> {{ __('select_model') }} </option>
        @if(isset($models) && $models->count() > 0)
            @foreach($models as $model)
                <option
                    value="{{ $model->id }}" {{ $ad->product_model_id == $model->id ? 'selected' : '' }} >{{ $model->name }}</option>
            @endforeach
        @endif
    </select>
</div>
<div class="col-md-6 mb-4">
    <label for="trim_edition" class="form-label">{{ __('trim_edition') }}</label>
    <input type="text" name="trim_edition" value="{{ $ad->trim_edition }}" id="trim_edition" class="form-control"
        placeholder="What is them trim/edition of your Vehicle?">
</div>
<div class="col-md-6 mb-4">
    <label for="year_of_manufacture" class="form-label">{{ __('year_of_manufacture') }}</label>
    <input type="number" name="year_of_manufacture" value="{{ $ad->year_of_manufacture }}"  id="year_of_manufacture" class="form-control"
        placeholder="When was your Vehicle manufactured?" >
</div>
<div class="col-md-6 mb-4">
    <label for="engine_capacity" class="form-label">{{ __('engine_capacity') }} (cc)</label>
    <input type="number" name="engine_capacity" value="{{ $ad->engine_capacity }}" id="engine_capacity" class="form-control"
        placeholder="What is the engine capacity of your Vehicle?" >
</div>
<div class="col-12 mb-4">
    <label for="engine_capacity" class="form-label">{{ __('fuel_type') }}</label>
    <div class="row">
        <div class="col-6">
            <div class="form-check">
                <input class="form-check-input" name="fuel_type[]" type="checkbox" value="diesel" {{ $ad->fuel_type == 'diesel' ? 'checked' : '' }} id="fuletype_1">
                <label class="form-check-label" for="fuletype_1">
                    {{ __('diesel') }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="fuel_type[]" type="checkbox" value="petrol" {{ $ad->fuel_type == 'petrol' ? 'checked' : '' }} id="fuletype_2">
                <label class="form-check-label" for="fuletype_2">
                    {{ __('petrol') }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="fuel_type[]" type="checkbox" value="cng" {{ $ad->fuel_type == 'cng' ? 'checked' : '' }} id="fuletype_3">
                <label class="form-check-label" for="fuletype_3">
                    {{ __('cng') }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="fuel_type[]" type="checkbox" value="petrol" {{ $ad->fuel_type == 'petrol' ? 'checked' : '' }} id="fuletype_4">
                <label class="form-check-label" for="fuletype_4">
                    {{ __('hybrid') }}
                </label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-check">
                <input class="form-check-input" name="fuel_type[]" type="checkbox" value="diesel" {{ $ad->fuel_type == 'diesel' ? 'checked' : '' }} id="fuletype_5">
                <label class="form-check-label" for="fuletype_5">
                    {{ __('electric') }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="fuel_type[]" type="checkbox" value="petrol" {{ $ad->fuel_type == 'petrol' ? 'checked' : '' }} id="fuletype_6">
                <label class="form-check-label" for="fuletype_6">
                    {{ __('octane') }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="fuel_type[]" type="checkbox" value="cng" {{ $ad->fuel_type == 'cng' ? 'checked' : '' }} id="fuletype_7">
                <label class="form-check-label" for="fuletype_7">
                    {{ __('lpg') }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="fuel_type[]" type="checkbox" value="petrol" {{ $ad->fuel_type == 'petrol' ? 'checked' : '' }} id="fuletype_8">
                <label class="form-check-label" for="fuletype_8">
                    {{ __('other') }}
                </label>
            </div>
        </div>
    </div>
</div>
<div class="col-12 mb-4">
    <label for="transmission" class="form-label">{{ __('transmission') }}</label>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="transmission" value="manual" {{ $ad->transmission == 'manual' ? 'checked' : '' }} id="transmission_1">
                <label class="form-check-label" for="transmission_1">
                    {{ __('manual') }}
                </label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="transmission" value="automatic" {{ $ad->transmission == 'automatic' ? 'checked' : '' }} id="transmission_2">
                <label class="form-check-label" for="transmission_2">
                    {{ __('automatic') }}
                </label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="transmission" value="other_transmission" {{ $ad->transmission == 'other_transmission' ? 'checked' : '' }} id="transmission_3">
                <label class="form-check-label" for="transmission_3">
                    {{ __('other_transmission') }}
                </label>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 mb-4">
    <label for="body_type" class="form-label">Body Type </label>
    <select name="body_type" id="body_type" class="form-control select2">
        <option value="" class="d-none">-- Select Body Type --</option>
        <option value="saloon" {{ $ad->body_type == 'saloon' ? 'selected' : '' }} >{{ __('saloon') }}</option>
        <option value="hatchback" {{ $ad->body_type == 'hatchback' ? 'selected' : '' }} >{{ __('hatchback') }}</option>
        <option value="estate" {{ $ad->body_type == 'estate' ? 'selected' : '' }} >{{ __('estate') }}</option>
        <option value="convertible" {{ $ad->body_type == 'convertible' ? 'selected' : '' }} >{{ __('convertible') }}</option>
        <option value="coupe/sports" {{ $ad->body_type == 'coupe/sports' ? 'selected' : '' }} >{{ ('coupe/sports') }}</option>
        <option value="SUV/4X4" {{ $ad->body_type == 'SUV/4X4' ? 'selected' : '' }} >{{ ('SU__V/4X4') }}</option>
        <option value="MPV" {{ $ad->body_type == 'MPV' ? 'selected' : '' }} >{{ __('MPV') }}</option>
    </select>
</div>
<div class="col-md-6 mb-4">
    <label for="registration_year" class="form-label">{{ __('registration_year') }} </label>
    <input type="number" name="registration_year" value="{{ $ad->registration_year }}" id="registration_year" class="form-control"
        placeholder="When was your Vehicle registered?">
</div>
