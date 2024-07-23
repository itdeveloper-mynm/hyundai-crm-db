<label class="form-label fw-semibold">{{ __('Source') }}</label>
        <div>
            <select class="form-select mb-2" name="source_id[]" id="source_id"
                data-control="select2" data-placeholder="{{ __('select option') }}"
                data-allow-clear="true" multiple>
                <option value="">--select--</option>
                @foreach ($sources as $source)
                    <option value="{{$source->id}}" {{ is_selected($source->id, 'source_id') }}>{{$source->name}}</option>
                @endforeach
            </select>
        </div>
