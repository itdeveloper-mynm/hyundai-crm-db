
<div class="col-lg-6">
    <label class="form-label fw-semibold">{{ __('Start Date') }}</label>
    <input type="date" class="form-control form-control-solid ps-12"
        placeholder="Select a date" name="start_date"
        {{-- value="{{ dateBeforeTenDays() }}" --}}
        value="{{ formateDate($startDate) }}"
        id="start_date" />
</div>

<div class="col-lg-6">
    <label class="form-label fw-semibold">{{ __('End Date') }}</label>
    <input type="date" class="form-control form-control-solid ps-12"
        placeholder="Select a date" name="end_date"
        value="{{ formateDate($endDate)}}" id="end_date" />
</div>
