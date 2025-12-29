<label class="form-label fw-semibold">{{ __('Departments') }}</label>
        <div>
            <select class="form-select mb-2" name="department_types[]" id="department_types"
                data-control="select2" data-placeholder="{{ __('select option') }}"
                data-allow-clear="true" multiple>
                {{-- <option value="">--select--</option> --}}
                    <option value="sales" {{ is_selected('sales', 'department_types') }}>Sales</option>
                    <option value="after_sales" {{ is_selected('after_sales', 'department_types') }}>After Sales</option>
            </select>
        </div>
