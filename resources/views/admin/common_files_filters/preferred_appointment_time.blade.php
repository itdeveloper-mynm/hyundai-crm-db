<label class=" form-label">{{ __('Preferred Time') }}</label>
<select class="form-select mb-2" name="preferred_appointment_time[]" id ="preferred_appointment_time"
    data-control="select2" data-placeholder="{{ __('select option') }}"
    data-allow-clear="true" multiple>
    {{-- <option value="">--select--</option> --}}
        <option value="Morning 08:00AM~12:00PM" {{ is_selected('Morning 08:00AM~12:00PM', 'preferred_appointment_time') }}>Morning (08:00AM~12:00PM)</option>
        <option value="Afternoon 12:00PM~04:00PM" {{ is_selected('Afternoon 12:00PM~04:00PM', 'preferred_appointment_time') }}>Afternoon (12:00PM~04:00PM)</option>
        <option value="Any Time" {{ is_selected('Any Time', 'preferred_appointment_time') }}>Any Time</option>
</select>
