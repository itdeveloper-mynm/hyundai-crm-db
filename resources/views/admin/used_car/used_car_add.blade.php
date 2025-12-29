@extends('layouts.master')

@section('title', 'Used Car Add')

@section('content')


<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container ">

        <form class="form d-flex flex-column flex-lg-row" method="post" id="myForm">
            @csrf

            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Used Car Add') }}</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <div class="row">

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('First Name') }}</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control mb-2"
                                                required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Last Name') }}</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control mb-2"
                                                required />
                                        </div>

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            @include('admin.common_files.mobile_input', ['page_chk' => 'add' ])
                                            {{-- <label class="required form-label">{{ __('Mobile') }}</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control mb-2"
                                                required /> --}}
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Email') }}</label>
                                            <input type="text" name="email" id="email" class="form-control mb-2"
                                                required />
                                        </div>

                                    </div>

                                    <div class="row mt-5">
                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.city' ,[ 'required' =>true,'page_type' => 'sales', 'data' => null ])
                                        </div>

                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.preferred_appointment_time' ,[ 'required' =>true, 'data' => null ])
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.vehicle' ,[ 'required' =>true, 'data' => null ])
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.campaign' ,[ 'required' =>true, 'data' => null ])
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
                url: "{{ route('used-car.store') }}",
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

                        window.location.href = "{{route('used-car.index')}}";

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
