<div class="col-lg-6">
    <label class="form-label fw-semibold">{{ __('Updated Start Date') }}</label>
    <input type="date" class="form-control form-control-solid ps-12"
        placeholder="Select a date" name="upd_from" id="upd_from"
            @if(Route::currentRouteName() == 'qualified-crm-leads.index')
                value="{{ request('from', dateBeforeTenDays()) }}"
            @else
                value="{{ request('upd_from') }}"
            @endif
        @if(isset($no_of_months) && !auth()->user()->hasRole('SuperAdmin'))
            min="{{ getDateRangeForMonths($no_of_months)['start_date'] }}" max="{{ getDateRangeForMonths($no_of_months)['end_date'] }}"
        @endif
         />
</div>

<div class="col-lg-6">
    <label class="form-label fw-semibold">{{ __('Updated End Date') }}</label>
    <input type="date" class="form-control form-control-solid ps-12"
        placeholder="Select a date" name="upd_to" id="upd_to"
            @if(Route::currentRouteName() == 'qualified-crm-leads.index')
                value="{{ request('upd_to', currentDate()) }}"
            @else
                value="{{ request('upd_to') }}"
            @endif
        @if(isset($no_of_months) && !auth()->user()->hasRole('SuperAdmin'))
            min="{{ getDateRangeForMonths($no_of_months)['start_date'] }}" max="{{ getDateRangeForMonths($no_of_months)['end_date'] }}"
        @endif
         />
</div>
