<div class="col-12 mb-4">
    <label for="animal_type" class="form-label">{{ __('animal_type') }} </label>
    <select name="animal_type" id="animal_type" class="form-control select2" >
        <option value="" class="d-none"> {{ __('select_animal_type') }} </option>
        <option value="bird" {{ old('animal_type') == 'Bird' ? 'selected' : '' }} >{{ __('bird') }}</option>
        <option value="cat" {{ old('animal_type') == 'Cat' ? 'selected' : '' }} >{{ __('cat') }}</option>
        <option value="dog" {{ old('animal_type') == 'Dog' ? 'selected' : '' }} >{{ __('dog') }}</option>
        <option value="fish" {{ old('animal_type') == 'Fish' ? 'selected' : '' }} >{{ __('fish') }}</option>
        <option value="rabbit" {{ old('animal_type') == 'Rabbit' ? 'selected' : '' }} >{{ __('rabbit') }}</option>
        <option value="reptile" {{ old('animal_type') == 'Reptile' ? 'selected' : '' }} >{{ __('reptile') }}</option>
        <option value="other" {{ old('animal_type') == 'Other' ? 'selected' : '' }} >{{ __('other') }}</option>
    </select>
</div>
