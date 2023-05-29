@props(['searchableFields'])
@foreach ($searchableFields as $field)
    @php
        $fieldId = 'cf.' . $field->id;
        $fieldName = 'cf[' . $field->id . ']';
        $fieldOld = 'cf.' . $field->id;
        $defaultValue = request()->filled($fieldOld) ? request()->input($fieldOld) : '';
    @endphp

    @if (
        $field->type == 'select' ||
            $field->type == 'radio' ||
            $field->type == 'text' ||
            $field->type == 'textarea' ||
            $field->type == 'date' ||
            $field->type == 'checkbox' ||
            $field->type == 'checkbox_multiple')
        <div class="accordion-item list-sidebar__accordion-item category">
            <h2 class="accordion-header list-sidebar__accordion-header" id="category">
                <button class="accordion-button list-sidebar__accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#customFieldFilter{{ $field->slug }}" aria-expanded="true"
                    aria-controls="customFieldFilter{{ $field->slug }}">
                    {{ $field->name }}
                </button>
            </h2>
            <div id="customFieldFilter{{ $field->slug }}" class="accordion-collapse collapse show"
                aria-labelledby="category" data-bs-parent="#accordionGroup">
                <div class="accordion-body list-sidebar__accordion-body">
                    <div class="accordion list-sidebar__accordion-inner" id="subcategoryGroup">
                        @if ($field->type == 'select')
                            <select onchange="customformFilter('{{ $fieldName }}', this.value, 'select')"
                                name="{{ $fieldName }}" id="{{ $fieldName }}" class="form-control">
                                <option {{ old($fieldOld) == '' || old($fieldOld) == 0 ? 'selected' : '' }} value="">
                                    {{ __('select') }}
                                </option>
                                @if ($field->values && count($field->values))
                                    @foreach ($field->values as $value)
                                        <option {{ $defaultValue == $value->value ? 'selected' : '' }}
                                            value="{{ $value->value }}">
                                            {{ $value->value }}</option>
                                    @endforeach
                                @endif
                            </select>
                        @elseif ($field->type == 'radio')
                            @foreach ($field->values as $value)
                                <div class="form-check">
                                    <input onchange="customformFilter('{{ $fieldName }}', this.value, 'radio')"
                                        class="form-check-input" type="radio" name="{{ $fieldName }}"
                                        id="{{ $value->id }}" value="{{ $value->value }}"
                                        {{ $defaultValue == $value->value ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $value->id }}">
                                        {{ $value->value }}
                                    </label>
                                </div>
                            @endforeach
                        @elseif ($field->type == 'text' || $field->type == 'textarea')
                            <input type="text" class="form-control" placeholder="{{ $field->name }}"
                                name="{{ $fieldName }}" value="{{ $defaultValue }}">
                        @elseif ($field->type == 'date')
                            <input type="date" class="form-control" placeholder="{{ $field->name }}"
                                name="{{ $fieldName }}" value="{{ $defaultValue }}">
                        @elseif ($field->type == 'checkbox')
                            <div class="form-group">
                                @foreach ($field->values as $value)
                                    @if ($loop->first)
                                        <div class="icheck-success d-inline">
                                            <input {{ $defaultValue == '1' ? 'checked' : '' }} value="1"
                                                name="{{ $fieldName }}" type="checkbox" class="form-check-input"
                                                id="{{ $fieldId }}"
                                                onchange="customformFilter('{{ $fieldName }}', this.value, 'checkbox')" />
                                            <label class="form-check-label"
                                                for="{{ $fieldId }}">{{ $value->value }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @elseif ($field->type == 'checkbox_multiple')
                            <div class="form-group">
                                @foreach ($field->values as $value)
                                    @php
                                        $oldInput = request()->filled($fieldOld) ? request()->input($fieldOld) : '';
                                        $oldValue = isset($oldInput[$value->id]) ? $oldInput[$value->id] : '';
                                    @endphp

                                    <div class="icheck-success">
                                        <input {{ $defaultValue == '1' ? 'checked' : '' }} value="{{ $value->value }}"
                                            name="{{ $fieldName . '[' . $value->id . ']' }}" type="checkbox"
                                            class="form-check-input" id="{{ $fieldId . '.' . $value->id }}"
                                            onchange="customformFilter('{{ $fieldName }}', this.value, 'checkbox_multiple')"
                                            {{ $oldValue == $value->value ? 'checked' : '' }} />
                                        <label class="form-check-label"
                                            for="{{ $fieldId . '.' . $value->id }}">{{ $value->value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
