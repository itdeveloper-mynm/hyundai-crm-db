@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <!--begin::Toolbar container-->
            <div class="card-header mb-3" style="padding: 0px;">
                <div class="card-toolbar ">
                    <div class="row  mt-5">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <button id="printButton" type="button" class="btn btn-success me-3">
                                <span class="svg-icon svg-icon-2"> <i class="bi bi-file-earmark-spreadsheet"></i> </span>
                                {{ __('Pdf') }}
                            </button>
                            <button type="button" class="btn btn-info me-3" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>Filter</button>

                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-400px" data-kt-menu="true"
                                id="kt_menu_62fe86549b38d">
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <form method="GET" action="{{ route('hr-graph.index') }}"
                                    class="form d-flex flex-column flex-lg-row" id="myForm">
                                    {{-- @csrf --}}
                                    <div class="px-7 py-5">

                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label class="form-label fw-semibold">{{ __('Dealer City') }}</label>

                                                    <div>
                                                        <select class="form-select mb-2" name="city_id" id="city_id"
                                                            data-control="select"
                                                            data-placeholder="{{ __('select option') }}"
                                                            data-allow-clear="true">
                                                            <option value="">--select--</option>
                                                            @foreach ($dropdown['cities'] as $city)
                                                                <option value="{{ $city->id }}" @selected(request('city_id') == $city->id)>{{ $city->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="form-label fw-semibold">{{ __('Dealer Branch') }}</label>
                                                    <div>
                                                        <select class="form-select mb-2" name="branch_id" id="branch_id"
                                                            data-control="select"
                                                            data-placeholder="{{ __('select option') }}"
                                                            data-allow-clear="true">
                                                            <option value="">--select--</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-lg-6">
                                                    <input type="date" class="form-control form-control-solid ps-12"
                                                        placeholder="Select a date" name="start_date"
                                                        value="{{ formateDate($startDate) }}"
                                                        id="start_date" />
                                                </div>

                                                <div class="col-lg-6">
                                                    <input type="date" class="form-control form-control-solid ps-12"
                                                        placeholder="Select a date" name="end_date"
                                                        value="{{ formateDate($endDate)}}" id="end_date" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-kt-menu-dismiss="true" value="apply"
                                                        id="apply">Apply</button>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a href="{{ route('sale-graph.index') }}"
                                                        class="btn btn-sm btn-primary" data-kt-menu-dismiss="true"
                                                        value="reset" id="reset">Reset</a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Toolbar container-->

            <div class="row gx-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Performance</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Total Leads
                                    ({{ $total_performance_count }})</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-6">
                            <!--begin::Tab content-->
                            <div class="tab-content">
                                <!--end::Tab pane-->
                                <!--begin::Tab pane-->
                                <div class="tab-pane fade active show" id="" role="tabpanel">

                                    <canvas id="1st_graph" class="mh-400px"></canvas>
                                    <!--begin::Chart-->
                                    <!--end::Chart-->
                                </div>
                                <!--end::Tab pane-->
                            </div>
                            <!--end::Tab content-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 8-->
                </div>
                <!--end::Col-->
            </div>

        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection


@section('js')

    <script src="{{ asset('ajx_files/ajx.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <script src="{{ asset('graphs/sale-graph.js') }}"></script> --}}

    <script>
        //var ctx = document.getElementById('kt_chartjs_2');
        var ctx = document.getElementById('1st_graph');

        // Define colors
        var primaryColor = KTUtil.getCssVariableValue('--kt-primary');
        var dangerColor = KTUtil.getCssVariableValue('--kt-danger');
        var successColor = KTUtil.getCssVariableValue('--kt-success');
        var warningColor = KTUtil.getCssVariableValue('--kt-warning');
        var defaultColor = KTUtil.getCssVariableValue('--kt-default');

        // Define fonts
        var fontFamily = KTUtil.getCssVariableValue('--bs-font-sans-serif');

        // Chart labels
        // const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
        const labels = @json($months) ;

        // Chart data
        const data = {
            labels: labels,
            datasets: [{
                    label: 'Hr',
                    data: @json($first_count),
                    fill: false,
                    borderColor: dangerColor,
                    tension: 0.6
                }
            ]
        };

        // Chart config
        const config = {
            type: 'line',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: false,
                    }
                },
                responsive: true,
            },
            defaults: {
                global: {
                    defaultFont: fontFamily
                }
            }
        };

        // Init ChartJS -- for more info, please visit: https://www.chartjs.org/docs/latest/
        var myChart = new Chart(ctx, config);


    </script>

@endsection
