<label class=" {{ $required ? 'required' : '' }} form-label">{{ __('Campaign') }}</label>
<select class="form-select mb-2" name="campaign_id" data-control="select2"
    data-placeholder="{{ __('select option') }}" data-allow-clear="true" {{ $required ? 'required' : '' }}>
    <option value=""></option>
    @foreach ($campaigns as $campaign)
        <option value="{{ $campaign->id }}" @selected(($data->campaign_id ?? '') == $campaign->id)>{{ $campaign->name }}</option>
    @endforeach
</select>
