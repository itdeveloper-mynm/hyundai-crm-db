<label class="{{ $required ? 'required' : '' }}  form-label">{{ __('Vehicle') }}</label>
<select class="form-select mb-2" name="vehicle_id"
    data-control="select2" data-placeholder="{{ __('select option') }}"
    data-allow-clear="true" {{ $required ? 'required' : '' }}>
    <option value=""></option>
    @foreach ($vehicles as $vehicle)
    <option value="{{$vehicle->id}}" @selected(($data->vehicle_id ?? '') ==$vehicle->id)>{{$vehicle->name}}</option>
    @endforeach
</select>
