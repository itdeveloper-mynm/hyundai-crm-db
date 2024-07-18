<label class=" {{ $required ? 'required' : '' }} form-label">{{ __('Dealer City') }}</label>
<select class="form-select mb-2" name="city_id" id="city_id"
    data-control="select2" data-placeholder="{{ __('select option') }}"
    data-allow-clear="true" {{ $required ? 'required' : '' }}>
    <option value=""></option>
    @foreach ($cities as $city)
        <option value="{{$city->id}}" @selected(($data->city_id ?? '')==$city->id)>{{$city->name}}</option>
    @endforeach
</select>
