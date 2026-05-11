<label class="form-label fw-semibold">{{ __('Dealer City') }}</label>
        <div>
            <select class="form-select mb-2" name="city_id[]" id="city_id"
                data-control="select2" data-placeholder="{{ __('select option') }}"
                data-allow-clear="true" multiple   data-page_type ={{ $page_type ?? '' }}>
                {{-- <option value="">--select--</option> --}}
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ is_selected($city->id, 'city_id') }}>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
