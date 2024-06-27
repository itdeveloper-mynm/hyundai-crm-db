<label class=" {{ $required ? 'required' : '' }}  form-label">{{ __('Preferred appointment time') }}</label>
<select class="form-select mb-2" name="preferred_appointment_time" data-control="select2"
    data-placeholder="{{ __('select option') }}" data-allow-clear="true" {{ $required ? 'required' : '' }}>
    <option value=""></option>
    {{-- <option value="Morning (08:00AM~12:00PM)" @selected(($data->preferred_appointment_time ?? '') == 'Morning (08:00AM~12:00PM)')>Morning (08:00AM~12:00PM)</option> --}}
    {{-- <option value="Afternoon (12:00PM~04:00PM)" @selected(($data->preferred_appointment_time ?? '') == 'Afternoon (12:00PM~04:00PM)')>Afternoon (12:00PM~04:00PM)</option> --}}
    <option value="Morning 08:00AM~12:00PM" @selected(($data->preferred_appointment_time ?? '') == 'Morning (08:00AM~12:00PM)')>Morning (08:00AM~12:00PM)</option>
    <option value="Afternoon 12:00PM~04:00PM" @selected(($data->preferred_appointment_time ?? '') == 'Afternoon (12:00PM~04:00PM)')>Afternoon (12:00PM~04:00PM)</option>

    <option value="Any Time" @selected(($data->preferred_appointment_time ?? '') == 'Any Time')>Any Time</option>
</select>
