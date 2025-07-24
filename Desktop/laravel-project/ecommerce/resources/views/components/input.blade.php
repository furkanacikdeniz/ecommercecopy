<label for="{{ $field }}" class="form-label">{{ $label }}</label>

@if ($type === 'file')
    <input type="file" class="form-control" id="{{ $field }}" name="{{ $field }}">
@else
    <input
        type="{{ $type }}"
        class="form-control"
        id="{{ $field }}"
        name="{{ $field }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($field, $value ?? '') }}"
>
@endif

@error($field)
    <span class="text-danger">{{ $message }}</span>
@enderror
