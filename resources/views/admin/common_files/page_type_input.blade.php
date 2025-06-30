
<label class="required form-label">{{ __('Page Type') }}</label>
<select class="form-select mb-2" name="page_type[]" required="required"
    data-control="select2" data-placeholder="{{ __('select option') }}"
    data-allow-clear="true" multiple>
    <option value=""></option>
    <option value="sales" @selected($page_chk == 'edit' && in_array('sales', explode(',', $field_value))) >Sales</option>
    <option value="after_sales"  @selected($page_chk == 'edit' && in_array('after_sales', explode(',', $field_value)))>After Sales</option>

</select>
