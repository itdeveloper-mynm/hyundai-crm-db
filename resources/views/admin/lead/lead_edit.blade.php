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
                                            <input type="text"  name="first_name" id="first_name"  value="{{$lead->customer->first_name}}" class="form-control mb-2"
                                                required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Last Name') }}</label>
                                            <input type="text"  name="last_name" id="last_name"  value="{{$lead->customer->last_name}}" class="form-control mb-2"
                                                required />
                                        </div>

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            @include('admin.common_files.mobile_input', ['page_chk' => 'edit' , 'field_value'=> $lead->customer->mobile  ])
                                            {{-- <label class="required form-label">{{ __('Mobile') }}</label>
                                            <input type="text" disabled value="{{$lead->customer->mobile}}"  class="form-control mb-2"
                                                required /> --}}
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Email') }}</label>
                                            <input type="text"  name="email" id="email" value="{{$lead->customer->email}}"  class="form-control mb-2"
                                                required />
                                        </div>

                                    </div>

                                    <div class="row mt-5">
                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.city' ,[ 'required' =>true, 'data' => $lead ,'page_type' => 'sales' ])

                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.branch' ,[ 'required' =>true, 'data' => $lead ])
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.purchase_plan' ,[ 'required' =>false, 'data' => $lead ])
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.monthly_salary' ,[ 'required' =>false, 'data' => $lead ])
                                        </div>

                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.bank' ,[ 'required' =>false,'disabled' =>true, 'data' => $lead ])
                                        </div>

                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.preferred_appointment_time' ,[ 'required' =>true, 'data' => $lead ])
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.vehicle' ,[ 'required' =>true, 'data' => $lead ])
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.source' ,[ 'required' =>true, 'data' => $lead ])
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.campaign' ,[ 'required' =>true, 'data' => $lead ])
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
            },
            'mobile': {
                required: true,
                remote: {
                    url: "{{ route('check.name.exist') }}",
                    type: "get",
                    data: {
                        mobile: function(data) {
                            return $('#mobile').val();
                        },
                        check: function(data) {
                            return "{{$lead->customer_id}}";
                        },
                        tableName: function(data) {
                            return 'customers';
                        },
                        fieldName: function(data) {
                            return 'mobile';
                        },

                    }
                }
            },
        },
        messages: {
            'status': {
                'required': "{{ __('status field is required') }}"
            },
            mobile: {
                remote: "Mobile Already Exists",

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
