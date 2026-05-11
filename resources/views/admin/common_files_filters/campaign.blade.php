<label class="form-label fw-semibold">{{ __('Campaign') }}</label>
<div>
    <select class="form-select mb-2" name="campaign_id[]" id="campaign_id" data-control="select2"
        data-placeholder="{{ __('select option') }}" data-allow-clear="true" multiple>
        {{-- <option value="">--select--</option> --}}
        @foreach ($campaigns as $campaign)
            <option value="{{ $campaign->id }}"  {{ is_selected($campaign->id, 'campaign_id') }}>{{ $campaign->name }}</option>
        @endforeach
    </select>
</div>
