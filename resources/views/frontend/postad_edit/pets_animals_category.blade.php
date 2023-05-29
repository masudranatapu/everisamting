<div class="col-12 mb-4">
    <label for="animal_type" class="form-label">{{ __('animal_type') }} </label>
    <select name="animal_type" id="animal_type" class="form-control select2" >
        <option value="" class="d-none"> {{ __('select_animal_type') }} </option>
        <option value="bird" {{ $ad->animal_type == 'Bird' ? 'selected' : '' }} >{{ __('bird') }}</option>
        <option value="cat" {{ $ad->animal_type == 'Cat' ? 'selected' : '' }} >{{ __('cat') }}</option>
        <option value="dog" {{ $ad->animal_type == 'Dog' ? 'selected' : '' }} >{{ __('dog') }}</option>
        <option value="fish" {{ $ad->animal_type == 'Fish' ? 'selected' : '' }} >{{ __('fish') }}</option>
        <option value="rabbit" {{ $ad->animal_type == 'Rabbit' ? 'selected' : '' }} >{{ __('rabbit') }}</option>
        <option value="reptile" {{ $ad->animal_type == 'Reptile' ? 'selected' : '' }} >{{ __('reptile') }}</option>
        <option value="other" {{ $ad->animal_type == 'Other' ? 'selected' : '' }} >{{ __('other') }}</option>
    </select>
</div>
