<label class="form-label fw-semibold">{{ __('Source') }}</label>
        <div>
            <select class="form-select mb-2" name="source_id[]" id="source_id"
                data-control="select2" data-placeholder="{{ __('select option') }}"
                data-allow-clear="true" multiple>
                {{-- <option value="">--select--</option> --}}
                @foreach ($sources as $source)
                @if (isset($crm_chk))
                    @if(in_array($source->name, ['Email', 'Whatsapp', 'Inbound','Outbound']))
                    <option value="{{$source->id}}" {{ is_selected($source->id, 'source_id') }}>{{$source->name}}</option>
                    @endif
                @else
                    <option value="{{$source->id}}" {{ is_selected($source->id, 'source_id') }}>{{$source->name}}</option>
                @endif
                @endforeach
            </select>
        </div>
