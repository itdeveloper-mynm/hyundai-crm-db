<label class=" {{ $required ? 'required' : '' }} form-label">{{ __('Purchase Plan') }}</label>
<select class="form-select mb-2" name="purchase_plan" id="purchase_plan"
    data-control="select2" data-placeholder="{{ __('select option') }}"
    data-allow-clear="true" {{ $required ? 'required' : '' }}>
    <option value=""></option>
    <option value="1 month" @selected(($data->purchase_plan ?? '') == '1 month')>1 month</option>
    <option value="2-3 month" @selected(($data->purchase_plan ?? '') == '2-3 month')>2-3 month</option>
    <option value="After 3 month" @selected(($data->purchase_plan ?? '') == 'After 3 month')>After 3 month</option>
</select>
