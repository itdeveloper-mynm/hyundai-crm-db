<label class=" {{ $required ? 'required' : '' }} form-label">{{ __('Monthly Salary') }}</label>
<select class="form-select mb-2" name="monthly_salary" id="monthly_salary" data-control="select2"
    data-placeholder="{{ __('select option') }}" data-allow-clear="true"  {{ $required ? 'required' : '' }}>
    <option value=""></option>
    <option value="Between 5,000 and 10,000" @selected(($data->monthly_salary ?? '') =='Between 5,000 and 10,000')>Between 5,000 and 10,000</option>
    <option value="Above 10,000" @selected(($data->monthly_salary ?? '') =='Above 10,000')>Above 10,000</option>
    <option value="Cash Deal" @selected(($data->monthly_salary ?? '') =='Cash Deal')>Cash Deal</option>
</select>
