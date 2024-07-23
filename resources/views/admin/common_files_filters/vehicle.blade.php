<label class="form-label fw-semibold">{{ __('Vehicle') }}</label>
<div>
    <select class="form-select mb-2" name="vehicle_id[]" id="vehicle_id"
        data-control="select2" data-placeholder="{{ __('select option') }}"
        data-allow-clear="true" multiple>
        <option value="">--select--</option>
        @foreach ($vehicles as $vehicle)
            <option value="{{$vehicle->id}}" {{ is_selected($vehicle->id, 'vehicle_id') }}>{{$vehicle->name}}</option>
        @endforeach
    </select>
</div>
