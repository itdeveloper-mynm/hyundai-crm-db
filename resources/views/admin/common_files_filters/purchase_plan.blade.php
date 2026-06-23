<label class=" form-label">{{ __('Purchase Plan') }}</label>
<select class="form-select mb-2" name="purchase_plan[]" id="purchase_plan" data-control="select2"
    data-placeholder="{{ __('select option') }}" data-allow-clear="true" multiple>
    {{-- <option value="">--select--</option> --}}
    <option value="1 month" {{ is_selected('1 month', 'purchase_plan') }}>1 month</option>
    <option value="2-3 months" {{ is_selected('2-3 months', 'purchase_plan') }}>2-3 months</option>
    <option value="After 3 months" {{ is_selected('After 3 months', 'purchase_plan') }}>After 3 months</option>
</select>
