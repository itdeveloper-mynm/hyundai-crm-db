@extends('layouts.master')

@section('title', 'Users Edit')

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
                                            <h2>{{ __('Users Edit') }}</h2>
                                        </div>
                                    </div>

                                    <div class="card-body pt-0">

                                        <div class="row">

                                            <div class="col-lg-6 col-sm-4 col-md-4">
                                                <label class="required form-label">{{ __('Name') }}</label>
                                                <input type="text" name="name" id="name"
                                                    class="form-control mb-2" value="{{$user->name}}" required />
                                            </div>
                                            <div class="col-lg-6 col-sm-4 col-md-4">
                                                <label class="required form-label">{{ __('Email') }}</label>
                                                <input type="text" name="email" id="email" value="{{$user->email}}"
                                                    class="form-control mb-2" required />
                                            </div>
                                            <div class="col-lg-6 col-sm-4 col-md-4">
                                                <!--begin::Main wrapper-->
                                                <div class="fv-row" data-kt-password-meter="true">
                                                    <!--begin::Wrapper-->
                                                    <div class="mb-1">
                                                        <!--begin::Label-->
                                                        <label class="form-label fw-semibold fs-6 mb-2">
                                                            Password
                                                        </label>
                                                        <!--end::Label-->

                                                        <!--begin::Input wrapper-->
                                                        <div class="position-relative mb-3">
                                                            <input class="form-control form-control-lg form-control-solid"
                                                                type="password" placeholder="" name="password"
                                                                autocomplete="off" />

                                                            <!--begin::Visibility toggle-->
                                                            <span
                                                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                                data-kt-password-meter-control="visibility">
                                                                <i class="bi bi-eye-slash fs-1"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span><span
                                                                        class="path4"></span></i>
                                                                <i class="bi bi-eye d-none fs-1"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span></i>
                                                            </span>
                                                            <!--end::Visibility toggle-->
                                                        </div>
                                                        <!--end::Input wrapper-->

                                                        <!--begin::Highlight meter-->
                                                        <div class="d-flex align-items-center mb-3"
                                                            data-kt-password-meter-control="highlight">
                                                            <div
                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                            </div>
                                                            <div
                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                            </div>
                                                            <div
                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                            </div>
                                                            <div
                                                                class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                                            </div>
                                                        </div>
                                                        <!--end::Highlight meter-->
                                                    </div>
                                                    <!--end::Wrapper-->

                                                    <!--begin::Hint-->
                                                    <div class="text-muted">
                                                        Use 8 or more characters with a mix of letters, numbers & symbols.
                                                    </div>
                                                    <!--end::Hint-->
                                                </div>
                                                <!--end::Main wrapper-->
                                            </div>

                                            <div class="col-lg-6 col-sm-4 col-md-4">
                                                <label class="required form-label">{{ __('Role') }}</label>
                                                <select class="form-select mb-2" name="roles[]" id="roles"
                                                    data-control="select2" data-placeholder="{{ __('select option') }}"
                                                    data-allow-clear="true" required>
                                                    <option value="">--select--</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role }}"
                                                        @if($userRole) {{in_array($role, $userRole)?"selected":""}}  @endif>
                                                            {{ $role }}</option>
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
                        url: "{{ route('users.update', [$user->id]) }}",
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

                                window.location.href = "{{ route('users.index') }}";

                            }
                            if (data.result == 'error') {
                                Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data.message,
                                });
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
