@props(['searchableFields'])


<form action="{{ route('frontend.adlist.search') }}" method="GET" id="customForm">
    @php
    $categories_slug = explode(',', request('category'));
    @endphp
    <input type="hidden" name="category" value="{{ request('category') }}">
    <div class="ad-list__search-box">
        <div class="container">
            <!-- Search Box -->
            <div class="search">

                <div class="search__content" style="padding:20px 15px;">
                    <!-- search by keyword/title -->
                    <div class="row g-3">
                        @foreach ($searchableFields as $field)
                        @php
                        // dd($field->pivot->category_id);
                        $fieldId = 'cf.' . $field->id;
                        $fieldName = 'cf[' . $field->id . ']';
                        $fieldOld = 'cf.' . $field->id;
                        $defaultValue = request()->filled($fieldOld) ? request()->input($fieldOld) : '';
                        $category = DB::table('categories')
                        ->where('id', $field->pivot->category_id)
                        ->first();
                        @endphp
                        @if (
                        $field->type == 'select' ||
                        $field->type == 'radio' ||
                        $field->type == 'text' ||
                        $field->type == 'textarea' ||
                        $field->type == 'date' ||
                        $field->type == 'checkbox' ||
                        $field->type == 'checkbox_multiple')
                        @if ($field->type == 'select')
                        <div class="col-lg-4 col-xl-3">
                            <select onchange="customformFilter('{{ $fieldName }}', this.value, 'select')"
                                name="{{ $fieldName }}" id="{{ $fieldName }}"
                                data-category_id="{{ $field->pivot->category_id }}" class="form-control">
                                <option {{ old($fieldOld)=='' || old($fieldOld)==0 ? 'selected' : '' }} value=""
                                    class="d-none">
                                    {{ __($field->name) }}
                                </option>
                                @if ($field->values && count($field->values))
                                @foreach ($field->values as $value)
                                <option {{ $defaultValue==$value->value ? 'selected' : '' }}
                                    value="{{ $value->value }}">
                                    {{ $value->value }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        @elseif ($field->type == 'radio')
                        <div class="col-lg-4 col-xl-3">
                            @foreach ($field->values as $value)
                            <div class="form-check">
                                <input onchange="customformFilter('{{ $fieldName }}', this.value, 'radio')"
                                    class="form-check-input" type="radio" name="{{ $fieldName }}" id="{{ $value->id }}"
                                    value="{{ $value->value }}" data-category_id="{{ $field->pivot->category_id }}" {{
                                    $defaultValue==$value->value ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $value->id }}">
                                    {{ $value->value }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @elseif ($field->type == 'text')
                        <div class="col-lg-4 col-xl-3">
                            <input type="text" class="form-control" placeholder="{{ $field->name }}"
                                data-category_id="{{ $field->pivot->category_id }}" name="{{ $fieldName }}"
                                value="{{ $defaultValue }}">
                        </div>
                        @elseif ($field->type == 'textarea')
                        <div class="col-12">
                            <textarea placeholder="{{ $field->name }}"
                                data-category_id="{{ $field->pivot->category_id }}" name="{{ $fieldName }}"
                                value="{{ $defaultValue }}" cols="30" rows="5" class="form-control"
                                style="height: 100px;"></textarea>
                        </div>
                        @elseif ($field->type == 'date')
                        <div class="col-lg-4 col-xl-3">
                            <input type="date" class="form-control" placeholder="{{ $field->name }}"
                                data-category_id="{{ $field->pivot->category_id }}" name="{{ $fieldName }}"
                                value="{{ $defaultValue }}">
                        </div>
                        @elseif ($field->type == 'checkbox')
                        <div class="col-lg-4 col-xl-3">
                            <div class="form-group">
                                @foreach ($field->values as $value)
                                @if ($loop->first)
                                <div class="icheck-success d-inline">
                                    <input {{ $defaultValue=='1' ? 'checked' : '' }} value="1" name="{{ $fieldName }}"
                                        type="checkbox" class="form-check-input" id="{{ $fieldId }}"
                                        data-category_id="{{ $field->pivot->category_id }}"
                                        onchange="customformFilter('{{ $fieldName }}', this.value, 'checkbox')" />
                                    <label class="form-check-label" for="{{ $fieldId }}">{{ $value->value }}
                                    </label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @elseif ($field->type == 'checkbox_multiple')
                        <div class="col-lg-4 col-xl-3">
                            <div class="form-group">
                                @foreach ($field->values as $value)
                                @php
                                $oldInput = request()->filled($fieldOld) ? request()->input($fieldOld) : '';
                                $oldValue = isset($oldInput[$value->id]) ? $oldInput[$value->id] : '';
                                @endphp

                                <div class="icheck-success">
                                    <input {{ $defaultValue=='1' ? 'checked' : '' }} value="{{ $value->value }}"
                                        name="{{ $fieldName . '[' . $value->id . ']' }}"
                                        data-category_id="{{ $field->pivot->category_id }}" type="checkbox"
                                        class="form-check-input" id="{{ $fieldId . '.' . $value->id }}"
                                        onchange="customformFilter('{{ $fieldName }}', this.value, 'checkbox_multiple')"
                                        {{ $oldValue==$value->value ? 'checked' : '' }} />
                                    <label class="form-check-label" for="{{ $fieldId . '.' . $value->id }}">{{
                                        $value->value }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @endif
                        @endforeach
                        <div class="col-12">
                            <button class="btn btn--lg align-items-center" type="submit">
                                <span class="icon--left">
                                    <x-svg.search-icon stroke="#fff" />
                                </span>
                                {{ __('search') }}
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
