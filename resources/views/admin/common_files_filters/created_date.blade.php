
<div class="col-lg-6">
    <label class="form-label fw-semibold">{{ __('Start Date') }}</label>
    <input type="date" class="form-control form-control-solid ps-12"
        placeholder="Select a date" name="from"
        {{-- value="{{ formateDate(request('from', dateBeforeTenDays())) }}" --}}
        @if(request()->has('mobile') && request()->has('date'))
            value="{{ request('from') }}"
        @else
            {{-- value="{{ request('from', dateBeforeTenDays()) }}" --}}
            @if(Route::currentRouteName() !== 'qualified-crm-leads.index')
                value="{{ request('from', dateBeforeTenDays()) }}"
            @endif
        @endif
        @if(isset($no_of_months) && !auth()->user()->hasRole('SuperAdmin'))
            min="{{ getDateRangeForMonths($no_of_months)['start_date'] }}" max="{{ getDateRangeForMonths($no_of_months)['end_date'] }}"
        @endif

        id="from" />
</div>

<div class="col-lg-6">
    <label class="form-label fw-semibold">{{ __('End Date') }}</label>
    <input type="date" class="form-control form-control-solid ps-12"
        placeholder="Select a date" name="to"
        {{-- value="{{ formateDate(request('to', currentDate())) }}" --}}
        @if(request()->has('mobile') && request()->has('date'))
                value="{{ request('to') }}"
        @else
                {{-- value="{{ request('to', currentDate()) }}" --}}
                @if(Route::currentRouteName() !== 'qualified-crm-leads.index')
                    value="{{ request('to', currentDate()) }}"
                @endif
        @endif
        @if(isset($no_of_months) && !auth()->user()->hasRole('SuperAdmin'))
            min="{{ getDateRangeForMonths($no_of_months)['start_date'] }}" max="{{ getDateRangeForMonths($no_of_months)['end_date'] }}"
        @endif
     id="to" />
</div>
