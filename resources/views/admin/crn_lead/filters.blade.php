<div class="row">
    <div class="col-lg-6">
        <label class="form-label fw-semibold">{{ __('Dealer City') }}</label>
        <div>
            <select class="form-select mb-2" name="city_id[]" id="city_id"
                data-control="select2" data-placeholder="{{ __('select option') }}"
                data-allow-clear="true" multiple>
                <option value="">--select--</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ is_selected($city->id, 'city_id') }}>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <label class="form-label fw-semibold">{{ __('Dealer Branch') }}</label>
        <div>
            <select class="form-select mb-2" name="branch_id[]" id="branch_id" data-control="select2"
                data-placeholder="{{ __('select option') }}"
                data-allow-clear="true" multiple>
                <option value="">--select--</option>
                @foreach ($branches as $branch)
                    <option value="{{$branch->id}}" {{ is_selected($branch->id, 'branch_id') }}>{{$branch->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <label class="form-label fw-semibold">{{ __('Vehicle') }}</label>
        <div>
            <select class="form-select mb-2" name="vehicle_id[]" id="vehicle_id"
                data-control="select2" data-placeholder="{{ __('select option') }}"
                data-allow-clear="true" multiple>
                <option value="">--select--</option>
                @foreach ($vehicles as $vehicle)
                    <option value="{{$vehicle->id}}" {{ is_selected($vehicle->id, 'vehicle_id') }}>{{$vehicle->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <label class="form-label fw-semibold">{{ __('Source') }}</label>
        <div>
            <select class="form-select mb-2" name="source_id[]" id="source_id"
                data-control="select2" data-placeholder="{{ __('select option') }}"
                data-allow-clear="true" multiple>
                <option value="">--select--</option>
                @foreach ($sources as $source)
                    <option value="{{$source->id}}" {{ is_selected($source->id, 'source_id') }}>{{$source->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6">
        <label class=" form-label">{{ __('Intention to Buy') }}</label>
        <select class="form-select mb-2" name="purchase_plan[]" id="purchase_plan"
            data-control="select2" data-placeholder="{{ __('select option') }}"
            data-allow-clear="true" multiple>
            <option value="">--select--</option>
                <option value="1 month"  {{ is_selected('1 month', 'purchase_plan') }}>1 month</option>
                <option value="2-3 month"  {{ is_selected('2-3 month', 'purchase_plan') }}>2-3 month</option>
                <option value="After 3 month"  {{ is_selected('After 3 month', 'purchase_plan') }}>After 3 month</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label class=" form-label">{{ __('Monthly Salary') }}</label>
        <select class="form-select mb-2" name="monthly_salary[]" id="monthly_salary"
            data-control="select2" data-placeholder="{{ __('select option') }}"
            data-allow-clear="true" multiple>
            <option value="">--select--</option>
                <option value="Between 5,000 and 10,000"  {{ is_selected('Between 5,000 and 10,000', 'monthly_salary') }}>Between 5,000 and 10,000</option>
                <option value="Above 10,000"  {{ is_selected('Above 10,000', 'monthly_salary') }}>Above 10,000</option>
                <option value="Below 5,000"  {{ is_selected('Below 5,000', 'monthly_salary') }}>Below 5,000</option>
                <option value="Cash Deal"  {{ is_selected('Cash Deal', 'monthly_salary') }}>Cash Deal</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label class=" form-label">{{ __('Preferred Time') }}</label>
        <select class="form-select mb-2" name="preferred_appointment_time[]"
            data-control="select2" data-placeholder="{{ __('select option') }}"
            data-allow-clear="true" multiple>
            <option value=""></option>
                <option value="Morning 08:00AM~12:00PM" {{ is_selected('Morning 08:00AM~12:00PM', 'preferred_appointment_time') }}>Morning (08:00AM~12:00PM)</option>
                <option value="Afternoon 12:00PM~04:00PM" {{ is_selected('Afternoon 12:00PM~04:00PM', 'preferred_appointment_time') }}>Afternoon (12:00PM~04:00PM)</option>
                <option value="Any Time" {{ is_selected('Any Time', 'preferred_appointment_time') }}>Any Time</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label class=" form-label">{{ __('KYC') }}</label>
        <select class="form-select mb-2" name="kyc[]" id="kyc"
            data-control="select2" data-placeholder="{{ __('select option') }}"
            data-allow-clear="true" multiple>
                <option value=""></option>
                <option value="Social Media" {{ is_selected('Social Media', 'kyc') }}>Social Media</option>
                <option value="Friends & Relative" {{ is_selected('Friends & Relative', 'kyc') }}>Friends & Relative</option>
                <option value="Outdoor Advertisement" {{ is_selected('Outdoor Advertisement', 'kyc') }}>Outdoor Advertisement</option>
                <option value="Influencer" {{ is_selected('Influencer', 'kyc') }}>Influencer</option>
                <option value="Others" {{ is_selected('Others', 'kyc') }}>Others</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label class=" form-label">{{ __('Category') }}</label>
        <select class="form-select mb-2" name="category[]" id="category"
            data-control="select2" data-placeholder="{{ __('select option') }}"
            data-allow-clear="true" multiple>
                <option value=""></option>
                <option value="Qualified"  {{ is_selected('Qualified', 'category') }}>Qualified</option>
                <option value="Not Qualified"  {{ is_selected('Not Qualified', 'category') }}>Not Qualified</option>
                <option value="General Inquiry"  {{ is_selected('General Inquiry', 'category') }}>General Inquiry</option>
        </select>
    </div>
</div>
