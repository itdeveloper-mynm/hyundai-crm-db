@extends('layouts.master')

@section('title', 'Role Add')

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
                                        <h2>{{ __('Role Add') }}</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <!--begin::Input group-->
                        <div class="row mb-10">

                            <div class="col-lg-4 col-sm-4 col-md-4">
                                <label class="fs-5 fw-bold form-label mb-2">
                                    <span class="required">Role name</span>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter a role name" required name="name" id="name" />
                            </div>

                            <div class="col-lg-4 col-sm-4 col-md-4">
                                <label class="required form-label">{{ __('After Login Dashboard Redirection') }}</label>
                                <select class="form-select mb-2" name="page_redirect" id="page_redirect" required="required"
                                    data-control="select2" data-placeholder="{{ __('select option') }}"
                                    data-allow-clear="true">
                                    <option value=""></option>
                                    <option value="dashboard">Overview Dashboard Page</option>
                                    <option value="crm-leads-graph.index">CRM Leads Graph Page</option>
                                    <option value="sale-graph.index">Sale Leads Graph Page</option>
                                    <option value="after-sale-graph.index">After Sale Leads Graph Page</option>
                                    <option value="hr-graph.index">HR Graph Page</option>
                                    <option value="used-cars-graph.index">Used Cars Graph Page</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-md-4">
                                <label class="fs-5 fw-bold form-label mb-2">
                                    <span class="required">No of Months Allowed</span>
                                </label>
                                <input type="number" class="form-control" placeholder="Enter no of months" required name="allowed_no_of_months" id="allowed_no_of_months"
                                    min="1" oninput="validity.valid||(value='');"
                                />
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                            <!--end::Label-->
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->

                                @include('admin.roles.permissions' , ['rolePermissionsArr' => [] ])

                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Permissions-->
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
            'page_redirect': {
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
                            return 'roles';
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

            const $form = $('#myForm');
            const $allCheckboxes = $form.find('[type="checkbox"]:not(:disabled)');
            let allChecked = true;

            // $allCheckboxes.each(function() {
            //     if (!$(this).is(':checked')) {
            //         allChecked = false;
            //         return false; // Exit each loop
            //     }
            // });

            if (!allChecked) {
                Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please select at least One Permission",
                });
                return false; // Prevent form submission
            }

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
                url: "{{ route('roles.store') }}",
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

                        window.location.href = "{{route('roles.index')}}";

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


    handleSelectAll();
})

const handleSelectAll = () => {
    // Define variables
    const $form = $('#myForm');
    const $selectAll = $form.find('#kt_roles_select_all');
    const $allCheckboxes = $form.find('[type="checkbox"]:not(:disabled)');

    // Handle check state
    $selectAll.on('change', function(e) {
        // Apply check state to all enabled checkboxes
        $allCheckboxes.prop('checked', $(this).prop('checked'));
    });
};



</script>
@endsection
