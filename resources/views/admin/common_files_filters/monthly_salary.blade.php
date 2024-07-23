<label class=" form-label">{{ __('Monthly Salary') }}</label>
<select class="form-select mb-2" name="monthly_salary[]" id="monthly_salary" data-control="select2"
    data-placeholder="{{ __('select option') }}" data-allow-clear="true" multiple>
    <option value="">--select--</option>
    <option value="Between 5,000 and 10,000" {{ is_selected('Between 5,000 and 10,000', 'monthly_salary') }}>Between
        5,000 and 10,000</option>
    <option value="Above 10,000" {{ is_selected('Above 10,000', 'monthly_salary') }}>Above 10,000</option>
    <option value="Below 5,000" {{ is_selected('Below 5,000', 'monthly_salary') }}>Below 5,000</option>
    <option value="Cash Deal" {{ is_selected('Cash Deal', 'monthly_salary') }}>Cash Deal</option>
</select>
