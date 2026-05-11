<label class=" {{ $required ? 'required' : '' }} form-label">{{ __('Dealer Branch') }}</label>
<select class="form-select mb-2" name="branch_id" id="branch_id"
    data-control="select2" data-placeholder="{{ __('select option') }}"
    data-allow-clear="true" {{ $required ? 'required' : '' }}>
    <option value=""></option>
    @foreach ($branches as $branch)
        <option value="{{$branch->id}}"  @selected(($data->branch_id ?? '') == $branch->id)>{{$branch->name}}</option>
    @endforeach
</select>
