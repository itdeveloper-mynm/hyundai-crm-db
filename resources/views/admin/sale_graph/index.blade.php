@extends('layouts.master')

@section('title', 'Sales Report')

@section('header-js')

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

@endsection

@section('css')

    <style>

        .bank-section {
            page-break-inside: avoid;

        }

        .active-tr {
            background-color: #6495ED;
            color: white !important;
        }

        table tbody {
            border-bottom: 1px solid #505060 !important;
        }

        @media print {
    #kt_app_content_container {
        /* Make sure it takes the full page size */
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        margin: 0; /* Remove margins */
        padding: 0; /* Remove padding */
        font-size: 12pt; /* Adjust font size for printing */
        display: block; /* Ensure it behaves like a block-level element */
        overflow: visible; /* Ensure content doesn't get cut off */
    }

    /* Adjust the body to remove any background or other elements */
    body {
        background: none; /* Remove background for printing */
        margin: 0; /* Remove any margin */
        padding: 0; /* Remove padding */
    }

    /* Ensure the body and html take the full page size */
    html, body {
        width: 100%;
        height: 100%;
    }
}

.active-tr {
            background-color: #6495ED;
            color: white !important;
        }

        table tbody {
            border-bottom: 1px solid #505060 !important;
        }


    </style>
@endsection

@section('content')

    <!--begin::Page loading(append to body)-->
    <!--begin::Page loading(append to body)-->
    <div class="page-loader flex-column bg-dark bg-opacity-25">
        <span class="spinner-border text-primary" role="status"></span>
        <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
    </div>
    <!--end::Page loading-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <!--begin::Toolbar container-->
            <div class="card-header mb-3" style="padding: 0px;">
                <div class="card-toolbar ">
                    <div class="row  mt-5">
                        <div class="col-lg-4">
                            <div id="kt_app_toolbar_container" class="d-flex flex-stack">

                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                        Sales Report</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex justify-content-end">
                            {{-- <form action="{{route('exportPdf.index')}}" method="POST" target="blank">
                               @csrf
                               <input type="hidden" id="performance_data" name="performance_data">
                                <button type="submit" class="btn btn-success me-3">
                                    <span class="svg-icon svg-icon-2"> <i class="bi bi-file-earmark-spreadsheet"></i> </span>
                                    {{ __('Pdf') }}
                                </button>
                            </form> --}}
                            <button id="printButton" type="button" class="btn btn-success me-3">
                                <span class="svg-icon svg-icon-2"> <i class="bi bi-file-earmark-spreadsheet"></i> </span>
                                {{ __('Pdf') }}
                            </button>

                            {{-- <button id="captureButton">Capture & Open</button> --}}

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

                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-500px" data-kt-menu="true"
                                id="kt_menu_62fe86549b38d">
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <form method="POST" action="#"
                                    class="form d-flex flex-column flex-lg-row" id="myForm">
                                    @csrf
                                    <div class="px-7 py-5">
                                        <div class="mb-3">
                                            @can('sale-graph-filters')
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.city')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.branch')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.vehicle')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.source')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.campaign')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.purchase_plan')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.monthly_salary')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.preferred_appointment_time')
                                                    </div>
                                                      <div class="col-lg-4">
                                                        <label class="form-label fw-semibold">{{ __('Agency') }}</label>
                                                        <div>
                                                            <select class="form-select mb-2" name="agency" id="agency" data-control="select2"
                                                                data-placeholder="{{ __('select option') }}" data-allow-clear="true">
                                                                <option value="">All</option>
                                                                <option value="CORE3">CORE3</option>
                                                                <option value="HMCinc">HMCinc</option>
                                                                <option value="DAS">DAS</option>
                                                                <option value="SMCM">SMCM</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    {{-- <div class="col-lg-4">
                                                        @include('admin.common_files_filters.kyc')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.category')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.created_by')
                                                    </div>
                                                    <div class="col-lg-4">
                                                        @include('admin.common_files_filters.updated_by')
                                                    </div>--}}
                                                </div>
                                            @endcan
                                            <div class="row mt-1">
                                                    @include('admin.common_files_filters.created_date_graph')
                                            </div>
                                            {{-- <div class="row mt-2">
                                                    @include('admin.common_files_filters.updated_date')
                                            </div> --}}
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
                    <div class="row mt-2">
                            @include('admin.common_files.top-message-graph-page')
                    </div>
                </div>
            </div>
            <!--end::Toolbar container-->

            <div class="row gx-5 gx-xl-10 bank-section">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Performance</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Total Leads (<span id="total_performance_count">0</span>)</span>
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


            <div class="row g-5 g-xl-10 bank-section">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Card widget 20-->
                    <div class="card card-bordered">
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Departments Overall Leads</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <div class="card-body">
                            <div id="dept_leads_graph_div"></div>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $badgeClasses = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
            @endphp

            <div class="row gx-5 gx-xl-10 mt-5 bank-section">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Campaign Performance Measurement</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body align-items-end pt-0">
                            <!--begin::Chart-->
                            <div class="tab-content" id="campaignTabsContent">
                                <!-- Backtoschool-2024 Content -->
                                <div class="tab-pane fade show active" id="content-backtoschool" role="tabpanel"
                                    aria-labelledby="tab-backtoschool">
                                    <div id="campaign_first_graph_div"></div>
                                </div>
                            </div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>

            </div>

            <div class="row gx-5 gx-xl-10 mt-5 bank-section">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Campaign Vehcile Performance Measurement</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body align-items-end pt-0">
                            <!--begin::Chart-->
                            <div class="tab-content" id="campaignTabsContent">
                                <!-- Backtoschool-2024 Content -->
                                <div class="tab-pane fade show active" id="content-backtoschool" role="tabpanel"
                                    aria-labelledby="tab-backtoschool">
                                    <div id="campaign_vehcile_second_graph_div"></div>
                                </div>
                            </div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>

            </div>

            <div class="row gx-5 gx-xl-10 mt-5 bank-section">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Campaign City Branches Performance Measurement</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body align-items-end pt-0">
                            <!--begin::Chart-->
                            <div class="tab-content" id="campaignTabsContent">
                                <!-- Backtoschool-2024 Content -->
                                <div class="tab-pane fade show active" id="content-backtoschool" role="tabpanel"
                                    aria-labelledby="tab-backtoschool">
                                    <div id="camp_city_branch_graph_div"></div>
                                </div>
                            </div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>

            </div>



            <div class="row gx-5 gx-xl-10 bank-section">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Analysis Vehicle wise</span>
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

                                    <canvas id="vehicleAnalysisChart" class="mh-400px"></canvas>
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


            <div class="row gx-5 gx-xl-10 mt-5 bank-section">
                <div id="campaign_performance_graph_div"></div>
            </div>
            {{-- <div class="row gx-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Campaign Performance ({{collect($countsByCampaign)->sum('count') ?? 0}})</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        @foreach ($countsByCampaign as $campaign_wise)
                            @if ($loop->first)
                                @php $first_show = "show"; @endphp
                            @else
                                @php $first_show = ""; @endphp
                            @endif
                            <div class="card-body pt-2 pb-0">
                                <div class="row g-5 g-xl-10 mb-5">
                                    <!--begin::Accordion-->
                                    <div class="accordion" id="kt_accordion_1_{{ $campaign_wise['campaign_id'] }}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button fs-4 fw-semibold" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#kt_accordion_1_body_1_{{ $campaign_wise['campaign_id'] }}"
                                                    aria-expanded="true"
                                                    aria-controls="kt_accordion_1_body_1_{{ $campaign_wise['campaign_id'] }}">
                                                    {{ $campaign_wise['name'] ?? '' }}
                                                    <span
                                                        class="badge py-3 px-4 fs-7 badge-light-danger  justify-content-end">{{ $campaign_wise['count'] ?? 0 }}</span>
                                                </button>
                                            </h2>
                                            <div id="kt_accordion_1_body_1_{{ $campaign_wise['campaign_id'] }}"
                                                class="accordion-collapse collapse {{ $first_show }}"
                                                aria-labelledby="kt_accordion_1_header_1"
                                                data-bs-parent="#kt_accordion_{{ $campaign_wise['campaign_id'] }}">
                                                <div class="accordion-body">
                                                    <div class="card-body pt-5">
                                                        @foreach ($campaign_wise['source'] as $source_data)
                                                            @if (isset($source_data))
                                                                <!--begin::Item-->
                                                                <div class="d-flex flex-stack">
                                                                    <!--begin::Section-->
                                                                    <span
                                                                        class="text-black fw-semibold fs-6 me-2">{{ $source_data['name'] ?? '' }}</span>
                                                                    <!--end::Section-->
                                                                    <!--begin::Action-->
                                                                    <span
                                                                        class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr095.svg-->
                                                                        <span
                                                                            class="badge py-3 px-4 fs-7 badge-light-primary">{{ $source_data['count'] ?? 0 }}</span>
                                                                        <!--end::Svg Icon-->
                                                                    </span>
                                                                    <!--end::Action-->
                                                                </div>
                                                                <!--end::Item-->
                                                                <!--begin::Separator-->
                                                                <div class="separator separator-dashed my-3"></div>
                                                                <!--end::Separator-->
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Accordion-->
                                </div>
                            </div>
                        @endforeach
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 8-->
                </div>
                <!--end::Col-->
            </div> --}}

            {{-- <div class="row gx-5 gx-xl-10 mt-5">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Vehicles Interested</span>
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
                                    <div id="graph_3" style="height: 350px;"></div>
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
            </div> --}}


            <div class="row gx-5 gx-xl-10 mt-10 bank-section">
                <div id="vehicle_bank_graph_div"></div>
            </div>


            <div class="row gx-5 gx-xl-10 mt-5 bank-section">
                <div id="city_branches_div"></div>
            </div>

            {{-- <div class="row gx-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">City ({{collect($citygraph)->sum('count') ?? 0}})</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        @foreach ($citygraph as $campaign_wise)
                            @if ($loop->first)
                                @php $first_show = "show"; @endphp
                            @else
                                @php $first_show = ""; @endphp
                            @endif
                            <div class="card-body pt-2 pb-0">
                                <div class="row g-5 g-xl-10 mb-5">
                                    <!--begin::Accordion-->
                                    <div class="accordion" id="kt_accordion_1_{{ $campaign_wise['city_id'] }}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button fs-4 fw-semibold" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#kt_accordion_1_body_1_{{ $campaign_wise['city_id'] }}"
                                                    aria-expanded="true"
                                                    aria-controls="kt_accordion_1_body_1_{{ $campaign_wise['city_id'] }}">
                                                    {{ $campaign_wise['name'] ?? '' }}
                                                    <span
                                                        class="badge py-3 px-4 fs-7 badge-light-danger  justify-content-end">{{ $campaign_wise['count'] ?? 0 }}</span>
                                                </button>
                                            </h2>
                                            <div id="kt_accordion_1_body_1_{{ $campaign_wise['city_id'] }}"
                                                class="accordion-collapse collapse {{ $first_show }}"
                                                aria-labelledby="kt_accordion_1_header_1"
                                                data-bs-parent="#kt_accordion_{{ $campaign_wise['city_id'] }}">
                                                <div class="accordion-body">
                                                    <div class="card-body pt-5">
                                                        @foreach ($campaign_wise['branches'] as $source_data)
                                                            @if (isset($source_data))
                                                                <!--begin::Item-->
                                                                <div class="d-flex flex-stack">
                                                                    <!--begin::Section-->
                                                                    <span
                                                                        class="text-black fw-semibold fs-6 me-2">{{ $source_data['name'] ?? '' }}</span>
                                                                    <!--end::Section-->
                                                                    <!--begin::Action-->
                                                                    <span
                                                                        class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr095.svg-->
                                                                        <span
                                                                            class="badge py-3 px-4 fs-7 badge-light-primary">{{ $source_data['count'] ?? 0 }}</span>
                                                                        <!--end::Svg Icon-->
                                                                    </span>
                                                                    <!--end::Action-->
                                                                </div>
                                                                <!--end::Item-->
                                                                <!--begin::Separator-->
                                                                <div class="separator separator-dashed my-3"></div>
                                                                <!--end::Separator-->
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Accordion-->
                                </div>
                            </div>
                        @endforeach
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 8-->
                </div>
                <!--end::Col-->
            </div> --}}

            <div class="row gx-5 gx-xl-10 mt-10 bank-section">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Monthly Salary</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Chart-->
                            {{-- <div id="graph_4" style="height: 350px;"></div> --}}
                            <canvas id="graph_4" class="mh-400px"></canvas>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>
                <!--end::Col-->
                <div class="col-xl-6">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Purchase Plan</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Chart-->
                            <canvas id="graph_5" class="mh-400px"></canvas>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>

            </div>

            {{-- <div class="row gx-5 gx-xl-10 mt-5 bank-section">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">CRM Data</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Chart-->
                            <canvas id="graph_7" class="mh-400px"></canvas>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">PDPL Graph</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-end pt-0">
                            <!--begin::Chart-->
                            <canvas id="graph_6" class="mh-400px"></canvas>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>
                <!--end::Col-->

            </div> --}}

        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection


@section('js')

    <script src="{{ asset('ajx_files/ajx.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    {{-- <script src="{{ asset('graphs/sale-graph.js') }}"></script> --}}

    <script>
        //var ctx = document.getElementById('kt_chartjs_2');
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
     // Chart labels

        let myChartInstance = null; // global chart instance for reuse/destroy

        function renderCustomLineChart(months, firstCount, secondCount, thirdCount, fifthCount, secondGraphData) {
            const data = {
                labels: months,
                datasets: [
                    {
                        label: 'Request a Quote (' + secondGraphData[0] + ')',
                        data: firstCount,
                        fill: false,
                        borderColor: primaryColor,
                        tension: 0.6
                    },
                    {
                        label: 'Special Offers (' + secondGraphData[1] + ')',
                        data: secondCount,
                        fill: false,
                        borderColor: dangerColor,
                        tension: 0.6
                    },
                    {
                        label: 'Request a Test Drive (' + secondGraphData[2] + ')',
                        data: thirdCount,
                        fill: false,
                        borderColor: successColor,
                        tension: 0.6
                    },
                    {
                        label: 'Leads (' + secondGraphData[4] + ')',
                        data: fifthCount,
                        fill: false,
                        borderColor: primaryColor,
                        tension: 0.6
                    }
                ]
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    plugins: {
                        title: {
                            display: false,
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function (tooltipItem) {
                                    let label = tooltipItem.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += tooltipItem.raw;
                                    return label;
                                }
                            }
                        }
                    },
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    }
                }
            };

            // Destroy previous chart instance if exists
            if (myChartInstance) {
                myChartInstance.destroy();
            }

            const ctx = document.getElementById('1st_graph');
            myChartInstance = new Chart(ctx, config);
        }


        // Function to generate a random color
        function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
        }

        {{--
            // Example data
            var xData = @json($vehcile_graph['vehicle_names']) ;
            var yData = @json($vehcile_graph['vehicle_count']) ;

            // Generate random fill colors
            var fillColors = Array.from({ length: xData.length }, () => getRandomColor());

            // Create series data
            var seriesData = xData.map((x, index) => ({
            x: x,
            y: yData[index],
            fill: fillColors[index]
            }));


            // Chart options
            var options = {
            series: [{
                data: seriesData
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    distributed: true,
                    barHeight: '70%', // Adjust bar height (value can be in percentage or pixels)

                }
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: xData.map((x, index) => `${x} (${yData[index]})`),
                labels: {
                    formatter: function(val) {
                        return val;
                    }
                }
            },
                legend: {
                show: false // Hides the legend below the graph
            }
            };

            // Render the chart
            var chart = new ApexCharts(document.querySelector("#graph_3"), options);
            chart.render();
        --}}

        let salaryChartInstance = null; // Global chart instance for reuse/destroy

        function renderSalaryDoughnutChart(labels, dataValues) {
            const backgroundColors = [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)'
            ];

            const data = {
                labels: labels,
                datasets: [
                    {
                        label: 'Dataset',
                        data: dataValues,
                        backgroundColor: backgroundColors
                    }
                ]
            };

            const config = {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                generateLabels: function (chart) {
                                    const chartData = chart.data;
                                    return chartData.labels.map((label, index) => {
                                        const value = chartData.datasets[0].data[index];
                                        return {
                                            text: `${label} (${value})`,
                                            fillStyle: chartData.datasets[0].backgroundColor[index],
                                            index: index
                                        };
                                    });
                                }
                            }
                        },
                        title: {
                            display: false,
                            text: 'Pie Chart'
                        }
                    }
                }
            };

            // Destroy previous chart instance if it exists
            if (salaryChartInstance) {
                salaryChartInstance.destroy();
            }

            const ctx = document.getElementById('graph_4');
            salaryChartInstance = new Chart(ctx, config);
        }




        let purchasePlanChartInstance = null; // Global chart instance for reuse/destroy

        function renderPurchasePlanPieChart(labels, dataValues) {
            const backgroundColors = [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)'
            ];

            const data = {
                labels: labels,
                datasets: [
                    {
                        label: 'Dataset',
                        data: dataValues,
                        backgroundColor: backgroundColors
                    }
                ]
            };

            const config = {
                type: 'pie',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                generateLabels: function (chart) {
                                    const chartData = chart.data;
                                    return chartData.labels.map((label, index) => {
                                        const value = chartData.datasets[0].data[index];
                                        return {
                                            text: `${label} (${value})`,
                                            fillStyle: chartData.datasets[0].backgroundColor[index],
                                            index: index
                                        };
                                    });
                                }
                            }
                        },
                        title: {
                            display: false,
                            text: 'Pie Chart'
                        }
                    }
                }
            };

            // Destroy previous chart instance if it exists
            if (purchasePlanChartInstance) {
                purchasePlanChartInstance.destroy();
            }

            const ctx = document.getElementById('graph_5');
            purchasePlanChartInstance = new Chart(ctx, config);
        }



    {{--
    var ctx7 = document.getElementById('graph_7');

    const data7 = {
            labels: @json($category_graph['category_names']),
            datasets: [{
                label: 'Dataset',
                data: @json($category_graph['category_count']),
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
            }]
        };


        const config7 = {
            type: 'doughnut',
            data: data7,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            generateLabels: function(chart) {
                                const data = chart.data;
                                return data.labels.map((label, index) => {
                                    const value = data.datasets[0].data[index];
                                    return {
                                        text: `${label} (${value})`,
                                        fillStyle: data.datasets[0].backgroundColor[index],
                                        index: index
                                    };
                                });
                            }
                        }
                    },
                    title: {
                        display: false,
                        text: 'Pie Chart'
                    }
                }
            },
        };

        var myChart = new Chart(ctx7, config7);

        var ctx6 = document.getElementById('graph_6');

        const data6 = {
            labels: @json($pdpl_graph['names']),
            datasets: [{
                label: 'Dataset',
                data: @json($pdpl_graph['counts']),
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
            }]
        };


        const config6 = {
            type: 'pie',
            data: data6,
            // plugins: [ChartDataLabels],
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            generateLabels: function(chart) {
                                const data = chart.data;
                                return data.labels.map((label, index) => {
                                    const value = data.datasets[0].data[index];
                                    return {
                                        text: `${label} (${value})`,
                                        fillStyle: data.datasets[0].backgroundColor[index],
                                        index: index
                                    };
                                });
                            }
                        }
                    },
                }
            },
        };

        var myChart = new Chart(ctx6, config6);
    --}}

    // $(document).ready(function() {
    //         setTimeout(function() {
    //             var div = $('#kt_app_content_container');
    //             if (div.length > 0) {
    //                 // Use html2canvas to render the div to a canvas
    //                 html2canvas(div[0]).then(function(canvas) {
    //                     // Convert the canvas to a Base64 string with the correct prefix
    //                     var base64Content = canvas.toDataURL("image/png");

    //                     // Log the Base64 content to the console
    //                     console.log("Base64 Content:", base64Content);
    //                     $('#page_data').val(base64Content);
    //                 }).catch(function(error) {
    //                     console.error("Error rendering canvas:", error);
    //                 });
    //             } else {
    //                 console.warn("Div with id 'kt_app_content_container' not found");
    //             }
    //         }, 5000); // Delay of 5000 milliseconds (5 seconds)
    // });


    $(document).on('click', '.toggle-sources', function () {
            var campaignId = $(this).data('campaign-id');
            var childName = $(this).data('child-name');

            var sourceRows;
            if (childName) {
                sourceRows = $('.' + childName + '[data-campaign-id="' + campaignId + '"]');
            } else {
                sourceRows = $('.source-row[data-campaign-id="' + campaignId + '"]');
            }

            // Toggle the visibility of the source rows
            sourceRows.toggle();

            // Ensure all child elements (branches) are hidden when collapsing cities
            if (!sourceRows.is(':visible')) {
                sourceRows.each(function () {
                    var childId = $(this).data('child-id');
                    $('.branches-row[data-campaign-id="' + childId + '"]').hide();
                });
            }
        });


        $(document).on('click', '.toggle-child-sources', function () {
            var campaignId = $(this).data('child-id');
            var childName = $(this).data('child-name');
            var campaignAttr = $(this).data('campaign-id');
            var sourceRows;

            if (childName) {
                sourceRows = $('.' + childName + '[data-city-id="' + campaignId + '"][data-campaign-id="' + campaignAttr + '"]');
            } else {
                sourceRows = $('.source-row[data-city-id="' + campaignId + '"][data-campaign-id="' + campaignAttr + '"]');
            }

            // Toggle the visibility of the source rows
            sourceRows.toggle();
        });


    let vehicleAnalysisChartInstance = null; // Global chart instance for reuse/destroy

    function renderVehicleAnalysisChart(vehicle_graph_data) {
        const data = {
            labels: vehicle_graph_data.vehicle_names,
            datasets: [
                {
                    label: 'Total MQL (' + vehicle_graph_data.mql_total + ')',
                    data: vehicle_graph_data.mql,
                    backgroundColor: "#F97316"
                },
                {
                    label: 'Qualified (' + vehicle_graph_data.cql_total + ')',
                    data: vehicle_graph_data.cql,
                    backgroundColor: "#9CA3AF"
                },
                {
                    label: 'Not Qualified (' + vehicle_graph_data.cnq_total + ')',
                    data: vehicle_graph_data.cnq,
                    backgroundColor: "#FACC15"
                },
                {
                    label: 'General Inquiry (' + vehicle_graph_data.cgi_total + ')',
                    data: vehicle_graph_data.cgi,
                    backgroundColor: "#2563EB"
                }
            ]
        };

        const options = {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                x: { stacked: true },
                y: { stacked: true }
            }
        };

        // Destroy previous chart instance if it exists
        if (vehicleAnalysisChartInstance) {
            vehicleAnalysisChartInstance.destroy();
        }

        const ctx = document.getElementById('vehicleAnalysisChart');
        vehicleAnalysisChartInstance = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

    }


    // var ctx = $("#vehicleAnalysisChart");

    // var dataa = {
    //     labels: ["Kona", "Venue", "Azera", "Sonata", "Tucson", "Creta Grand", "Creta", "Elantra", "Accent"],
    //     datasets: [
    //         {
    //             label: "Target",
    //             data: [5, 10, 7, 8, 6, 9, 11, 15, 18],
    //             backgroundColor: "#3B82F6"
    //         },
    //         {
    //             label: "Total MQL",
    //             data: [20, 25, 18, 22, 24, 30, 35, 50, 55],
    //             backgroundColor: "#F97316"
    //         },
    //         {
    //             label: "Qualified",
    //             data: [10, 12, 9, 11, 10, 13, 15, 22, 24],
    //             backgroundColor: "#9CA3AF"
    //         },
    //         {
    //             label: "Not Qualified",
    //             data: [3, 4, 2, 3, 5, 6, 7, 8, 9],
    //             backgroundColor: "#FACC15"
    //         },
    //         {
    //             label: "General Inquiry",
    //             data: [2, 3, 2, 3, 4, 5, 6, 7, 8],
    //             backgroundColor: "#2563EB"
    //         },
    //         {
    //             label: "Unreachable",
    //             data: [8, 9, 7, 10, 12, 15, 18, 25, 30],
    //             backgroundColor: "#22C55E"
    //         },
    //         {
    //             label: "New",
    //             data: [1, 2, 1, 2, 3, 4, 5, 6, 7],
    //             backgroundColor: "#1E3A8A"
    //         }
    //     ]
    // };

    // var options = {
    //     indexAxis: 'y',
    //     responsive: true,
    //     plugins: {
    //         legend: { position: 'bottom' }
    //     },
    //     scales: {
    //         x: { stacked: true },
    //         y: { stacked: true }
    //     }
    // };

    // new Chart(ctx, {
    //     type: 'bar',
    //     data: dataa,
    //     options: options
    // });


    $('#agency').on('change', function() {
        var selectedText = $(this).val();
        $('#source_id option').prop('selected', false); // clear previous
        $('#source_id option').each(function() {
            // Check if dropdown2 option text contains the selectedText
            if ($(this).text().includes(selectedText)) {
                $(this).prop('selected', true);
            }
        });

        $('#source_id').trigger('change'); // if you need it'
        $('#source_id').trigger('select2:select'); // Explicit Select2 refresh

    });

    function fetchAndRenderGraphData(formElement, mode = 'graph', callback = null) {
        var formData = new FormData(formElement);
        formData.append('mode', mode); // Pass mode with request

        $.ajax({
            type: "POST",
            url: "{{ route('sale-graph.index') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,
            beforeSend: function () {
                document.body.setAttribute('data-kt-app-page-loading', 'on');
                $('#total_performance_count').empty();
                $('#dept_leads_graph_div').empty();
                $('#campaign_performance_graph_div').empty();
                $('#city_branches_div').empty();
                $('#vehicle_bank_graph_div').empty();
                $('#campaign_first_graph_div').empty();
                $('#campaign_vehcile_second_graph_div').empty();
                $('#camp_city_branch_graph_div').empty();
            },
            success: function (data) {
                document.body.removeAttribute('data-kt-app-page-loading');

                if (mode === 'graph') {
                    renderCustomLineChart(data.months, data.first_count, data.second_count, data.third_count , data.fifth_count, data.second_graph_data);
                    renderVehicleAnalysisChart(data.vehicle_graph);
                    renderSalaryDoughnutChart(data.salary_graph.monthly_salary,data.salary_graph.monthly_salary_count);
                    renderPurchasePlanPieChart(data.purchase_plan_graph.purchase_plan,data.purchase_plan_graph.purchase_plan_count);
                    $('#total_performance_count').empty().text(data.total_performance_count);
                    $('#dept_leads_graph_div').empty().html(data.dept_leads_graph_html);
                }else if (mode === 'second_graph') {
                    $('#campaign_performance_graph_div').empty().html(data.campaign_performance_graph_html);
                    $('.campaign_wise_row:first-child').trigger('click');
                    $('#city_branches_div').empty().html(data.city_branches_graph_html);
                    $('.city_wise_row:first-child').trigger('click');
                    $('#vehicle_bank_graph_div').empty().html(data.vehicle_bank_graph_html);
                } else if (mode === 'table') {
                    $('#campaign_first_graph_div').empty().html(data.campaigns_detial_data_html);
                    $('#campaign_vehcile_second_graph_div').empty().html(data.campaigns_vehcile_data_html);
                } else if (mode === 'second_table') {
                    $('#camp_city_branch_graph_div').empty().html(data.camp_city_branch_graph_html);
                }

                if (typeof callback === 'function') {
                    callback();
                }
            },
            error: function (xhr, status, error) {
                document.body.removeAttribute('data-kt-app-page-loading');
                console.error("AJAX Error:", error);
            }
        });
    }


    $(document).ready(function () {
        fetchAndRenderGraphData($('#myForm')[0], 'graph');
        fetchAndRenderGraphData($('#myForm')[0], 'second_graph');
        fetchAndRenderGraphData($('#myForm')[0], 'table');
        fetchAndRenderGraphData($('#myForm')[0], 'second_table');

        // Form validation and submit
        $("#myForm").validate({
            ignore: [],
            rules: {
                // your rules
            },
            messages: {
                // your messages
            },
            submitHandler: function (form) {
                fetchAndRenderGraphData($('#myForm')[0], 'graph');
                fetchAndRenderGraphData($('#myForm')[0], 'second_graph');
                fetchAndRenderGraphData($('#myForm')[0], 'table');
                fetchAndRenderGraphData($('#myForm')[0], 'second_table');
                return false; // Prevent default
            }
        });
    });


    </script>

@endsection
