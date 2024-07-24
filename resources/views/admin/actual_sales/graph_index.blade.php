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

                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-800px" data-kt-menu="true"
                                id="kt_menu_62fe86549b38d">
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <form method="POST" action="{{ route('actualsales-graph.index') }}"
                                    class="form d-flex flex-column flex-lg-row" id="myForm">
                                    @csrf
                                    <div class="px-7 py-5">
                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <div class="row">

                                                    <div class="col-lg-12 mb-2">
                                                        <h3 class=" fw-semibold">{{ __('Actual Sales Data') }}</h3>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        @include('admin.common_files_filters.vehicle')
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <label class="form-label fw-semibold">{{ __('Department') }}</label>
                                                        <div>
                                                            <select class="form-select mb-2" name="department" id="department"
                                                                data-control="select"
                                                                data-placeholder="{{ __('select option') }}"
                                                                data-allow-clear="true">
                                                                <option value="">--select--</option>
                                                                <option value="sales">Sales</option>
                                                                <option value="after_sales">After Sales</option>
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
                                                            value="{{ formateDate($endDate) }}" id="end_date" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-6">
                                                <div class="row">


                                                    <div class="col-lg-12 mb-2">
                                                        <h3 class=" fw-semibold">{{ __('Digital Compaign Data') }}</h3>
                                                    </div>


                                                    <div class="col-lg-6">
                                                        <label class="form-label fw-semibold">{{ __('Vehicle') }}</label>
                                                        <div>
                                                            <select class="form-select mb-2" name="vehicle_id_comp[]" id="vehicle_id_comp"
                                                                data-control="select2"
                                                                data-placeholder="{{ __('select option') }}"
                                                                data-allow-clear="true" multiple>
                                                                <option value=""></option>
                                                                @foreach ($dropdown['vehicles'] as $vehicle)
                                                                    <option value="{{ $vehicle->id }}" {{is_selected($vehicle->id, 'vehicle_id_comp')}}
                                                                        >{{ $vehicle->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="form-label fw-semibold">{{ __('Department') }}</label>
                                                        <div>
                                                            <select class="form-select mb-2" name="department_2" id="department_2"
                                                                data-control="select"
                                                                data-placeholder="{{ __('select option') }}"
                                                                data-allow-clear="true">
                                                                <option value="">--select--</option>
                                                                <option value="sales">Sales</option>
                                                                <option value="after_sales">After Sales</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-lg-6">
                                                        <input type="date" class="form-control form-control-solid ps-12"
                                                            placeholder="Select a date" name="start_date_comp"
                                                            value="{{ formateDate($startDate_comp) }}"
                                                            id="start_date_comp" />
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <input type="date" class="form-control form-control-solid ps-12"
                                                            placeholder="Select a date" name="end_date_comp"
                                                            value="{{ formateDate($endDate_comp) }}" id="end_date_comp" />
                                                    </div>
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
                                                    <a href="{{ route('actualsales-graph.index') }}"
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

            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-100">
                        <!--begin::Body-->
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ human_readable_number(array_sum($second_count['counts'])) }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-400">Digital Compaign Leads
                                    </span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-100">
                        <!--begin::Body-->
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ human_readable_number(array_sum($first_count)) }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-400">Actual Sales Data</span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-100">
                        <!--begin::Body-->
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ human_readable_number(array_sum($getLeadsConversions)) }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-400">Leads Conversions</span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-100">
                        <!--begin::Body-->
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$percent_friendly}}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-400">Leads comparison rate %</span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
            </div>

            <div class="row gy-5 g-xl-10">
                <div class="col-lg-4">
                    <!--begin::Card-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h3 class="fw-bold mb-1">Actual Sales Data ({{array_sum($actual_sales_data)}})</h3>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card toolbar-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column p-9 pt-3 mb-9">
                            <!--begin::Item-->
                            @foreach ($actual_sales_data as $key => $actual_sales_data_single )
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::Details-->
                                    <div class="fw-semibold">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary">{{$key}}</a>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Badge-->
                                    <div class="badge badge-light ms-auto"><span class="badge badge-light-info fw-bold px-4 py-3">{{$actual_sales_data_single}}</span></div>
                                    <!--end::Badge-->
                                </div>
                            @endforeach
                            <!--end::Item-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-lg-4">
                    <!--begin::Card-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h3 class="fw-bold mb-1">Digital Compaign Leads ({{human_readable_number(array_sum($digital_compaign_Leads))}})</h3>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card toolbar-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column p-9 pt-3 mb-9">
                            <!--begin::Item-->
                            @foreach ($digital_compaign_Leads as $key => $digital_compaign_Lead_single )
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::Details-->
                                    <div class="fw-semibold">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary">{{$key}}</a>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Badge-->
                                    <div class="badge badge-light ms-auto"><span class="badge badge-light-info fw-bold px-4 py-3">{{$digital_compaign_Lead_single}}</span></div>
                                    <!--end::Badge-->
                                </div>
                            @endforeach
                            <!--end::Item-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-lg-4">
                    <!--begin::Card-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h3 class="fw-bold mb-1">Compared Results ({{array_sum($getLeadsConversions)}})</h3>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card toolbar-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column p-9 pt-3 mb-9">
                            <!--begin::Item-->
                            @foreach ($getLeadsConversions as $key => $leadsConversion )
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::Details-->
                                    <div class="fw-semibold">
                                        <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary">{{$key}}</a>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Badge-->
                                    <div class="badge badge-light ms-auto"><span class="badge badge-light-success fw-bold px-4 py-3">{{$leadsConversion}}</span></div>
                                    <!--end::Badge-->
                                </div>
                            @endforeach
                            <!--end::Item-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
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
                    label: 'Actual Sales Data('+ @json(array_sum($first_count)) +')',
                    data: @json($first_count),
                    fill: false,
                    borderColor: dangerColor,
                    tension: 0.6
                },
                {
                    label: 'Digital Compaign Leads('+ @json(array_sum($second_count['counts'])) +')',
                    data: @json($second_count['counts']),
                    fill: false,
                    borderColor: successColor,
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
