<label class="required form-label">{{ __('Mobile') }}</label>
<small>Please follow the format: (0512345678)</small>
<input type="number" name="mobile" id="mobile"
    @if($page_chk == "edit")   value="0{{ ltrim($field_value, '+966') }}"  @endif
    class="form-control mb-2"
    required pattern="^05\d{8}$"
    title="Mobile number must start with 05 followed by 8 digits"
    placeholder="e.g., 0512345678"
    oninput="validity.valid||(value='');"/>
