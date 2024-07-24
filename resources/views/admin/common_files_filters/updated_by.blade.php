<label class="form-label fw-semibold">{{ __('Updated By') }}</label>
<div>
    <select class="form-select mb-2" name="updated_by[]" id="updated_by" data-control="select2"
        data-placeholder="{{ __('select option') }}" data-allow-clear="true" multiple>
        {{-- <option value="">--select--</option> --}}
        @foreach ($users as $user)
            <option value="{{ $user->id }}"  {{ is_selected($user->id, 'updated_by') }}>{{ $user->name }}</option>
        @endforeach
    </select>
</div>
