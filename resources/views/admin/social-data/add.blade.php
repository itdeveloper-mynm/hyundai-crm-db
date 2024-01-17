@extends('layouts.master')

@section('title', 'Social Data Add')

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
                                        <h2>{{ __('Social Data Add') }}</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <div class="row">
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Social Platform') }}</label>
                                            <select class="form-select mb-2" name="social_platform" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                <option value="Google">Google</option>
                                                <option value="Facebook">Facebook</option>
                                                <option value="Twitter">Twitter</option>
                                                <option value="Linkedin">Linkedin</option>
                                                <option value="Youtube">Youtube</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Total Visits') }}</label>
                                            <input type="text" name="total_visits" class="form-control mb-2"
                                            required />
                                        </div>

                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Page Views') }}</label>
                                            <input type="text" name="page_views" class="form-control mb-2"
                                            required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Unique Visitors') }}</label>
                                            <input type="text" name="unique_visitors" class="form-control mb-2"
                                            required/>
                                        </div>

                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Followers') }}</label>
                                            <input type="text" name="followers" class="form-control mb-2"
                                            required/>
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Likes') }}</label>
                                            <input type="text" name="likes" class="form-control mb-2"
                                            required/>
                                        </div>

                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Tweets') }}</label>
                                            <input type="text" name="tweets" class="form-control mb-2"
                                            required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Priority') }}</label>
                                            <input type="number" name="priority" class="form-control mb-2"
                                            required   min="0" oninput="validity.valid||(value='');"/>
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
                url: "{{ route('social-data.store') }}",
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

                        window.location.href = "{{route('social-data.index')}}";

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
