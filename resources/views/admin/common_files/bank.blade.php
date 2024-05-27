<label class=" {{ $required ? 'required' : '' }} form-label">{{ __('Customers Bank') }}</label>
<select class="form-select mb-2" data-control="select2" data-placeholder="{{ __('select option') }}"
    data-allow-clear="true" {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }}>
    <option value=""></option>
    @foreach ($banks as $bank)
        <option value="{{$bank->id}}" @selected(($data->customer->bank_id ?? '') == $bank->id)>{{$bank->name}}</option>
    @endforeach
</select>
