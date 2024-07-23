<label class=" form-label">{{ __('Category') }}</label>
<select class="form-select mb-2" name="category[]" id="category"
    data-control="select2" data-placeholder="{{ __('select option') }}"
    data-allow-clear="true" multiple>
        <option value=""></option>
        <option value="Qualified"  {{ is_selected('Qualified', 'category') }}>Qualified</option>
        <option value="Not Qualified"  {{ is_selected('Not Qualified', 'category') }}>Not Qualified</option>
        <option value="General Inquiry"  {{ is_selected('General Inquiry', 'category') }}>General Inquiry</option>
</select>
