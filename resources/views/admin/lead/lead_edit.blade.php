@extends('layouts.master')


@section('title', 'Lead Edit')

@section('content')


<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container ">

    <form class="form d-flex flex-column flex-lg-row" method="post" id="myForm">
            @csrf
            @method('PUT')

            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Lead Edit') }}</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <div class="row">

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('First Name') }}</label>
                                            <input type="text" disabled value="{{$lead->customer->first_name}}" class="form-control mb-2"
                                                required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Last Name') }}</label>
                                            <input type="text" disabled value="{{$lead->customer->last_name}}" class="form-control mb-2"
                                                required />
                                        </div>

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Mobile') }}</label>
                                            <input type="text" disabled value="{{$lead->customer->mobile}}"  class="form-control mb-2"
                                                required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Email') }}</label>
                                            <input type="text" disabled value="{{$lead->customer->email}}"  class="form-control mb-2"
                                                required />
                                        </div>

                                    </div>

                                    <div class="row mt-5">
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Dealer City') }}</label>
                                            <select class="form-select mb-2" name="city_id" id="city_id" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($cities as $city)
                                                    <option value="{{$city->id}}" @selected($lead->city_id==$city->id)>{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Dealer Branch') }}</label>
                                            <select class="form-select mb-2" name="branch_id" id="branch_id" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{$branch->id}}"  @selected($lead->branch_id==$branch->id)>{{$branch->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="form-label">{{ __('Purchase Plan') }}</label>
                                            <select class="form-select mb-2" name="purchase_plan" id="purchase_plan"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                    <option value=""></option>
                                                    <option value="1 month"  @selected($lead->purchase_plan=='1 month')>1 month</option>
                                                    <option value="2-3 month"  @selected($lead->purchase_plan=='2-3 month')>2-3 month</option>
                                                    <option value="After 3 month"  @selected($lead->purchase_plan=='After 3 month')>After 3 month</option>
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="form-label">{{ __('Monthly Salary') }}</label>
                                            <select class="form-select mb-2" name="monthly_salary" id="monthly_salary"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                    <option value="Between 5,000 and 10,000" @selected($lead->monthly_salary=='Between 5,000 and 10,000')>Between 5,000 and 10,000</option>
                                                    <option value="Above 10,000" @selected($lead->monthly_salary=='Above 10,000')>Above 10,000</option>
                                                    <option value="Cash Deal" @selected($lead->monthly_salary=='Cash Deal')>Cash Deal</option>
                                            </select>
                                        </div>

                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="form-label">{{ __('Customers Bank') }}</label>
                                            <select class="form-select mb-2" disabled required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->id}}" @selected($lead->customer->bank_id==$bank->id)>{{$bank->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Preferred appointment time') }}</label>
                                            <select class="form-select mb-2" name="preferred_appointment_time" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                    <option value="Morning (08:00AM~12:00PM)"  @selected($lead->preferred_appointment_time=='Morning (08:00AM~12:00PM)')>Morning (08:00AM~12:00PM)</option>
                                                    <option value="Afternoon (12:00PM~04:00PM)"  @selected($lead->preferred_appointment_time=='Afternoon (12:00PM~04:00PM)')>Afternoon (12:00PM~04:00PM)</option>
                                                    <option value="Any Time"  @selected($lead->preferred_appointment_time=='Any Time')>Any Time</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Vehicle') }}</label>
                                            <select class="form-select mb-2" name="vehicle_id" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($vehicles as $vehicle)
                                                    <option value="{{$vehicle->id}}" @selected($lead->vehicle_id==$vehicle->id)>{{$vehicle->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Source') }}</label>
                                            <select class="form-select mb-2" name="source_id" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($sources as $source)
                                                    <option value="{{$source->id}}"  @selected($lead->source_id==$source->id)>{{$source->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Campaign') }}</label>
                                            <select class="form-select mb-2" name="campaign_id" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($campaigns as $campaign)
                                                    <option value="{{$campaign->id}}"  @selected($lead->campaign_id==$campaign->id)>{{$campaign->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-dark btn_submit sub_button" disabled
                                        id="btnSubmit" style="background-color: #000044">
                                        <span class="indicator-label">{{ __('Save') }}</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')

<script src="{{ asset('ajx_files/ajx.js') }}"></script>

<script>
$(document).ready(function() {

    $("#myForm").validate({
        ignore: [],
        rules: {
            'status': {
                required: true,
            }
        },
        messages: {
            'status': {
                'required': "{{ __('status field is required') }}"
            },
        },

        submitHandler: function(form) {

            $('.indicator-label').css({
                'display': 'none'
            });
            $('.indicator-progress').css({
                'display': 'inline-block'
            });
            $('.sub_button').attr('disabled', true);


            var form = $('#myForm')[0];
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{ route('lead.update', [$lead->id]) }}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                beforeSubmit: function() {

                    $("body").addClass("loading");

                },
                success: function(data) {

                    if (data.result == 'success') {
                        Swal.fire(
                            "{{ __('Updated') }}",
                            data.message,
                            data.result,
                        )

                        window.location.href = "{{route('lead.index')}}";

                    }
                    if (data.result == 'error') {
                        Swal.fire(
                            "{{ __('not_add') }}",
                            "{{ __('not_add') }}",
                            data.result
                        )
                    }
                    $("#btnSubmit").prop("disabled", false);
                }
            });
        }
    })

    $(".sub_button").prop("disabled", false);
})
</script>
@endsection
