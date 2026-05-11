<label class="form-label fw-semibold">{{ __('Created By') }}</label>
<div>
    <select class="form-select mb-2" name="created_by[]" id="created_by" data-control="select2"
        data-placeholder="{{ __('select option') }}" data-allow-clear="true" multiple>
        {{-- <option value="">--select--</option> --}}
        @if(isset($crm_chk))
            @php
                $users = getCrmUser();
            @endphp
        @endif
        @foreach ($users as $user)
            <option value="{{ $user->id }}"  {{ is_selected($user->id, 'created_by') }}>{{ $user->name }}</option>
        @endforeach
    </select>
</div>
