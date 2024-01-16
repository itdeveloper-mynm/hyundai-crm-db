@extends('layouts.master')

@section('title', 'Contact Edit')

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
                                        <h2>{{ __('Contact Edit') }}</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <div class="row">

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('First Name') }}</label>
                                            <input type="text" name="first_name" id="first_name" value="{{$customer->first_name}}" class="form-control mb-2"
                                                required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Last Name') }}</label>
                                            <input type="text" name="last_name" id="last_name" value="{{$customer->first_name}}" class="form-control mb-2"
                                                required />
                                        </div>

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Mobile') }}</label>
                                            <small>Please follow the format: (+966123456789)</small>
                                            <input type="number" name="mobile" id="mobile" value="{{$customer->mobile}}" class="form-control mb-2"
                                                required pattern="[0-9]{9,14}" title="Mobile number must be between 9 and 12 digits"
                                                placeholder="e.g., +966123456789"  oninput="validity.valid||(value='');"/>
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Email') }}</label>
                                            <input type="email" name="email" id="email" value="{{$customer->email}}" class="form-control mb-2"
                                                required />
                                        </div>

                                    </div>

                                    <div class="row mt-5">

                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="form-label">{{ __('Customers Bank') }}</label>
                                            <select class="form-select mb-2" name="bank_id"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->id}}" @selected($bank->id == $customer->bank_id)>{{$bank->name}}</option>
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
<script>
$(document).ready(function() {

    $("#myForm").validate({
        ignore: [],
        rules: {
            'status': {
                required: true,
            },
            'email': {
                required: true,
                remote: {
                    url: "{{ route('check.name.exist') }}",
                    type: "get",
                    data: {
                        email: function(data) {
                            return $('#email').val();
                        },
                        check: function(data) {
                            return "{{$customer->id}}";
                        },
                        tableName: function(data) {
                            return 'customers';
                        },
                        fieldName: function(data) {
                            return 'email';
                        },

                    }
                }
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
                            return "{{$customer->id}}";
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
            email: {
                remote: "Email Already Exists",

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
                url: "{{ route('contact.update', [$customer->id]) }}",
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

                        window.location.href = "{{route('contact.index')}}";

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
