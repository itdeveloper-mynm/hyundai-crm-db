
<div class="col-lg-6">
    <label class="form-label fw-semibold">{{ __('Start Date') }}</label>
    <input type="date" class="form-control form-control-solid ps-12"
        placeholder="Select a date" name="from"
        {{-- value="{{ dateBeforeTenDays() }}" --}}
        value="{{ formateDate(request('from', dateBeforeTenDays())) }}"
        id="from" />
</div>

<div class="col-lg-6">
    <label class="form-label fw-semibold">{{ __('End Date') }}</label>
    <input type="date" class="form-control form-control-solid ps-12"
        placeholder="Select a date" name="to"
        value="{{ formateDate(request('to', currentDate())) }}" id="to" />
</div>
