<label class=" {{ $required ? 'required' : '' }} form-label">{{ __('Source') }}</label>
<select class="form-select mb-2" name="source_id" data-control="select2"
    data-placeholder="{{ __('select option') }}" data-allow-clear="true" {{ $required ? 'required' : '' }}>
    <option value=""></option>
    @foreach ($sources as $source)
        <option value="{{ $source->id }}" @selected(($data->source_id ?? '') == $source->id)>{{ $source->name }}</option>
    @endforeach
</select>
