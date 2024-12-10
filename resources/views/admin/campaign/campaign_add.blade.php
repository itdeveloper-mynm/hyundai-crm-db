@extends('layouts.master')

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
                                        <h2>{{ __('Campaign Add') }}</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <div class="row">

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="name" class="form-control mb-2"
                                                required />
                                        </div>

                                    </div>

                                    <div class="row mt-5">
                                        <div class="mb-10 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Status') }}</label>
                                            <select class="form-select mb-2" name="status" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                <option value="1">True</option>
                                                <option value="0">False</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-5 fv-row col-lg-6">
                                            @include('admin.common_files.page_type_input', ['page_chk' => 'add' , 'field_value'=> "" ])
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
            'name': {
                required: true,
                remote: {
                    url: "{{ route('check.name.exist') }}",
                    type: "get",
                    data: {
                        name: function(data) {
                            return $('#name').val();
                        },
                        check: function(data) {
                            return 0;
                        },
                        tableName: function(data) {
                            return 'campaigns';
                        },

                    }
                }
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
                url: "{{ route('campaign.store') }}",
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

                        window.location.href = "{{route('campaign.index')}}";

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
