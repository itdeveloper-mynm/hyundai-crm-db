<label class="form-label fw-semibold">{{ __('Types') }}</label>
        <div>
            <select class="form-select mb-2" name="type[]" id="type"
                data-control="select2" data-placeholder="{{ __('select option') }}"
                data-allow-clear="true" multiple>
                {{-- <option value="">--select--</option> --}}
                @foreach (getApplicationTypeTitles() as $key => $type)
                    <option value="{{ $key }}" {{ is_selected($type, 'type') }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>
