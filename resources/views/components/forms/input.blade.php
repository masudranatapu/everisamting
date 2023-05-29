<input  type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id ? $id:$name }}"
        class="form-control {{ $class }} {{ error($name) }}"
        value="{{ $value }}"
        placeholder="{{ __($placeholder) }}">
<x-forms.error name="{{ $name }}"/>
