<div class="col-lg-6">
    <label class="form-label fw-semibold">{{ __('Updated Start Date') }}</label>
    <input type="date" class="form-control form-control-solid ps-12"
        placeholder="Select a date" name="upd_from"  value="{{ request('upd_from') }}" id="upd_from" />
</div>

<div class="col-lg-6">
    <label class="form-label fw-semibold">{{ __('Updated End Date') }}</label>
    <input type="date" class="form-control form-control-solid ps-12"
        placeholder="Select a date" name="upd_to"  value="{{ request('upd_to') }}" id="upd_to" />
</div>
