<label class="form-label fw-semibold">{{ __('Dealer Branch') }}</label>
    <div>
        <select class="form-select mb-2" name="branch_id[]" id="branch_id" data-control="select2"
            data-placeholder="{{ __('select option') }}"
            data-allow-clear="true" multiple>
            {{-- <option value="">--select--</option> --}}
            @foreach ($branches as $branch)
                <option value="{{$branch->id}}" {{ is_selected($branch->id, 'branch_id') }}>{{$branch->name}}</option>
            @endforeach
        </select>
    </div>
