@extends('layouts.master')

@section('content')


<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container ">

        <form class="form d-flex flex-column flex-lg-row" method="post" id="myForm">
            <!-- @csrf -->

            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Lead Add') }}</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <div class="row">

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('First Name') }}</label>
                                            <input type="text" name="firstName" id="firstName" class="form-control mb-2"
                                                required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Last Name') }}</label>
                                            <input type="text" name="lastName" id="lastName" class="form-control mb-2"
                                                required />
                                        </div>

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Mobile') }}</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control mb-2"
                                                required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Email') }}</label>
                                            <input type="text" name="email" id="email" class="form-control mb-2"
                                                required />
                                        </div>

                                    </div>

                                    <div class="row mt-5">
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Dealer City') }}</label>
                                            <select class="form-select mb-2" name="dealerCity" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($cities as $city)
                                                    <option value="{{$city->name}}">{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Dealer Branch') }}</label>
                                            <select class="form-select mb-2" name="branch" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{$branch->name}}">{{$branch->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="form-label">{{ __('Purchase Plan') }}</label>
                                            <select class="form-select mb-2" name="purchasePlan" id="purchasePlan"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                    <option value=""></option>
                                                    <option value="1 month">1 month</option>
                                                    <option value="2-3 month">2-3 month</option>
                                                    <option value="After 3 month">After 3 month</option>
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="form-label">{{ __('Monthly Salary') }}</label>
                                            <select class="form-select mb-2" name="monthlySalary" id="monthlySalary"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                    <option value="Between 5,000 and 10,000">Between 5,000 and 10,000</option>
                                                    <option value="Above 10,000">Above 10,000</option>
                                                    <option value="Cash Deal">Cash Deal</option>
                                            </select>
                                        </div>

                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="form-label">{{ __('Customers Bank') }}</label>
                                            <select class="form-select mb-2" name="customersBank" id="customersBank"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                    <option value="AlRajhi Bank">AlRajhi Bank</option>
                                                    <option value="Alinma Bank">Alinma Bank</option>
                                                    <option value="AlJazira Bank">AlJazira Bank</option>
                                                    <option value="Anb">Anb</option>
                                                    <option value="Emirates NBD">Emirates NBD</option>
                                                    <option value="Riyad Bank">Riyad Bank</option>
                                                    <option value="SABB">SABB</option>
                                                    <option value="Saudi Fransi Bank">Saudi Fransi Bank</option>
                                                    <option value="Saudi National Bank (SNB)">Saudi National Bank (SNB)</option>
                                                    <option value="Others">Others</option>
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Preferred appointment time') }}</label>
                                            <select class="form-select mb-2" name="preferredTime" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                    <option value="Morning (08:00AM~12:00PM)">Morning (08:00AM~12:00PM)</option>
                                                    <option value="Afternoon (12:00PM~04:00PM)">Afternoon (12:00PM~04:00PM)</option>
                                                    <option value="Any Time">Any Time</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Vehicle') }}</label>
                                            <select class="form-select mb-2" name="vehicle" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Source') }}</label>
                                            <select class="form-select mb-2" name="sourcee" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Campaign') }}</label>
                                            <select class="form-select mb-2" name="campaignName" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                <option value="Others">Others</option>
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
<script>
$(document).ready(function() {

    $("#myForm").validate({
        ignore: [],
        rules: {
            'status': {
                required: true,
            },

        },
        messages: {
            'status': {
                'required': "{{ __('status field is required') }}"
            },
            name: {
                remote: "Name Already Exists",

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
                url: "{{ route('addleads.store') }}",
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
                            "{{ __('Add') }}",
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