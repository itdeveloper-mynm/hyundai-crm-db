@extends('layouts.master')

@section('title', 'Add New Criteria')

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
                                        <h2>{{ __('Add New Criteria') }}</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <div class="row">

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Header') }}</label>
                                            <input type="text" name="header" id="header"
                                                class="form-control mb-2" required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Body') }}</label>
                                            <input type="text" name="body" id="body"
                                                class="form-control mb-2" required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Emails') }}</label>
                                            <select class="form-select mb-2" name="emails[]" id="emails"
                                            data-control="select2" data-placeholder="{{ __('select option') }}"
                                            data-allow-clear="true" multiple>
                                            <option value="">--select--</option>
                                            @foreach ($user_emails as $key => $email)
                                                <option value="{{ $email }}">{{$key}} ({{ $email }})</option>
                                            @endforeach
                                        </select>
                                        </div>


                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Type') }}</label>
                                            <select class="form-select mb-2" name="type" id="type"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true" required>
                                                <option value="">--select--</option>
                                                <option value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option>
                                                <option value="Monthly">Monthly</option>
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

            const $form = $('#myForm');

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
                url: "{{ route('email-sending-criteria.store') }}",
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

                        window.location.href = "{{route('email-sending-criteria.index')}}";

                    }
                    if (data.result == 'error') {
                        Swal.fire(
                            "{{ __('not_add') }}",
                            data.message,
                            data.result,
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
