@extends('layouts.master')

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
                                            <h2>{{ __('Google Business Edit') }}</h2>
                                        </div>
                                    </div>

                                    <div class="card-body pt-0">

                                        <div class="row">
                                            <div class="mb-5 fv-row col-lg-6">
                                                <label class="required form-label">{{ __('City') }}</label>
                                                <select class="form-select mb-2" name="city_id" id="city_id" required="required"
                                                    data-control="select2" data-placeholder="{{ __('select option') }}"
                                                    data-allow-clear="true">
                                                    <option value=""></option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}" @selected($row->city_id == $city->id)>
                                                            {{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6">
                                                <label class="required form-label">{{ __('Branch') }}</label>
                                                <select class="form-select mb-2" name="branch_id" id="branch_id"
                                                    required="required" data-control="select2"
                                                    data-placeholder="{{ __('select option') }}"
                                                    data-allow-clear="true">
                                                    <option value="">--select--</option>
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}" @selected($row->branch_id == $branch->id)>
                                                            {{ $branch->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6">
                                                <label class="required form-label">{{ __('Month') }}</label>
                                                <select class="form-select mb-2" name="month"
                                                    required="required" data-control="select2"
                                                    data-placeholder="{{ __('select option') }}"
                                                    data-allow-clear="true">
                                                    <option value="">--select--</option>
                                                    @foreach (range(1, 12) as $month)
                                                    @php
                                                        $nmonth= date('F', mktime(0, 0, 0, $month, 1));
                                                    @endphp
                                                        <option
                                                            value="{{ $nmonth}}" @selected($row->month == $nmonth)>
                                                            {{$nmonth}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6">
                                                <label class="required form-label">{{ __('Year') }}</label>
                                                <select class="form-select mb-2" name="year"
                                                    required="required" data-control="select2"
                                                    data-placeholder="{{ __('select option') }}"
                                                    data-allow-clear="true">
                                                    <option value="">--select--</option>
                                                    @foreach (range(date('Y'), 2010) as $year)
                                                        <option value="{{ $year }}" @selected($row->year == $year)>
                                                            {{ $year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6">
                                                <label class="required form-label">{{ __('Type') }}</label>
                                                <select class="form-select mb-2" name="gtype"
                                                    required="required" data-control="select2"
                                                    data-placeholder="{{ __('select option') }}"
                                                    data-allow-clear="true">
                                                    <option value="">--select--</option>
                                                    <option value="Showroom"  @selected($row->gtype == 'Showroom')>Showroom</option>
                                                    <option value="Service"  @selected($row->gtype == 'Service')>Service</option>
                                                    <option value="Genuineparts"  @selected($row->gtype == 'Genuineparts')>Genuineparts</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6">
                                                <label class="required form-label">{{ __('greviews') }}</label>
                                                <input type="number" name="greviews" id="greviews" value="{{$row->greviews}}" class="form-control mb-2"
                                                required />
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6">
                                                <label class="required form-label">{{ __('greplied') }}</label>
                                                <input type="number" name="greplied" id="greplied" value="{{$row->greplied}}" class="form-control mb-2"
                                                required />
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6">
                                                <label class="required form-label">{{ __('gsearchlisting') }}</label>
                                                <input type="number" name="gsearchlisting" id="gsearchlisting" value="{{$row->gsearchlisting}}" class="form-control mb-2"
                                                required />
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6">
                                                <label class="required form-label">{{ __('gmapslisting') }}</label>
                                                <input type="number" name="gmapslisting" id="gmapslisting" value="{{$row->gmapslisting}}" class="form-control mb-2"
                                                required />
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6">
                                                <label class="required form-label">{{ __('gwebsite') }}</label>
                                                <input type="number" name="gwebsite" id="gwebsite" value="{{$row->gwebsite}}" class="form-control mb-2"
                                                required />
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6">
                                                <label class="required form-label">{{ __('gdirection') }}</label>
                                                <input type="number" name="gdirection" id="gdirection" value="{{$row->gdirection}}" class="form-control mb-2"
                                                required />
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-md-6">
                                                <label class="required form-label">{{ __('gcalls') }}</label>
                                                <input type="number" name="gcalls" id="gcalls" value="{{$row->gcalls}}" class="form-control mb-2"
                                                required />
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
                        url: "{{ route('google-business.update', [$row->id]) }}",
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

                                window.location.href =
                                    "{{ route('google-business.index') }}";

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
        });

        $('#city_id').change(function() {
            var selectedCity = $(this).val();
            // Make AJAX request to fetch branches based on the selected city
            $.ajax({
                url: '{{ route('get-city-branches.ajx', '') }}/' + selectedCity,
                type: 'GET',
                success: function(data) {
                    // Populate the branches select box with the fetched data
                    var branchesSelect = $('#branch_id');
                    branchesSelect.empty();

                    $.each(data, function(key, value) {
                        branchesSelect.append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
@endsection
