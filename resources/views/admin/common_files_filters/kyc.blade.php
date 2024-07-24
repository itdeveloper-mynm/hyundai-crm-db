<label class=" form-label">{{ __('KYC') }}</label>
<select class="form-select mb-2" name="kyc[]" id="kyc"
    data-control="select2" data-placeholder="{{ __('select option') }}"
    data-allow-clear="true" multiple>
    {{-- <option value="">--select--</option> --}}
        <option value="Social Media" {{ is_selected('Social Media', 'kyc') }}>Social Media</option>
        <option value="Friends & Relative" {{ is_selected('Friends & Relative', 'kyc') }}>Friends & Relative</option>
        <option value="Outdoor Advertisement" {{ is_selected('Outdoor Advertisement', 'kyc') }}>Outdoor Advertisement</option>
        <option value="Influencer" {{ is_selected('Influencer', 'kyc') }}>Influencer</option>
        <option value="Others" {{ is_selected('Others', 'kyc') }}>Others</option>
</select>
