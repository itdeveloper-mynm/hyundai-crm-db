@extends('layouts.master')


@section('title', 'Sales Data Edit')

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
                                        <h2>{{ __('Sales Data Edit') }}</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">

                                    <div class="row">

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Customer Name') }}</label>
                                            <input type="text" disabled value="{{$sales_data->customer->first_name}}" class="form-control mb-2"
                                                required />
                                        </div>

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Mobile') }}</label>
                                            <input type="text" disabled value="{{$sales_data->customer->mobile}}"  class="form-control mb-2"
                                                required />
                                        </div>
                                    </div>
                                    <div class="row mt-2">

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Gender') }}</label>
                                            <input type="text" disabled value="{{$sales_data->customer->gender}}"  class="form-control mb-2"
                                                required />
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('INV Date') }}</label>
                                            <input type="date" name="inv_date" value="{{$sales_data->inv_date}}"  class="form-control mb-2"
                                                required />
                                        </div>
                                    </div>
                                    <div class="row t-2">

                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Year') }}</label>
                                            <input type="number" name="year" value="{{$sales_data->year}}"  class="form-control mb-2"
                                                required   min="0" oninput="validity.valid||(value='');"/>
                                        </div>
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('S') }}</label>
                                            <input type="text" name="s" value="{{$sales_data->s}}"  class="form-control mb-2"
                                                required />
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-lg-6 col-sm-4 col-md-4">
                                            <label class="required form-label">{{ __('Chass') }}</label>
                                            <input type="text" name="chass" value="{{$sales_data->chass}}"  class="form-control mb-2"
                                                required />
                                        </div>
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Vehicle / Model') }}</label>
                                            <select class="form-select mb-2" name="vehicle_id" required="required"
                                                data-control="select2" data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                @foreach ($vehicles as $vehicle)
                                                    <option value="{{$vehicle->id}}"  @selected($sales_data->vehicle_id==$vehicle->id)>{{$vehicle->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="mb-5 fv-row col-lg-6">
                                            <label class="required form-label">{{ __('Select Department') }}</label>
                                            <select class="form-select mb-2" name="department"
                                                id="department" required="required" data-control="select2"
                                                data-placeholder="{{ __('select option') }}"
                                                data-allow-clear="true">
                                                <option value=""></option>
                                                <option value="Sales"  @selected($sales_data->department=='Sales')>Sales</option>
                                                <option value="Aftersales"  @selected($sales_data->department=='Aftersales')>After Sales</option>
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
                url: "{{ route('sales-data.update', [$sales_data->id]) }}",
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

                        window.location.href = "{{route('sales-data.index')}}";

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
