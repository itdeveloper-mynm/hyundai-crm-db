@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div class="row">
            <div class="col-6">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Row-->
                    <!--begin::Toolbar container-->
                    <div class="card-header mb-3" style="padding: 0px;">
                        <div class="card-toolbar ">
                            <div class="row  mt-5">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    {{-- <button type="button" class="btn btn-info me-3" data-kt-menu-trigger="click"
                                        data-kt-menu-placement="bottom-end">.</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Toolbar container-->
                    <div class="row gx-5 gx-xl-10 mt-16">
                        <!--begin::Col-->
                        <div class="col-xxl-12 mb-5 mb-xl-10">
                            <!--begin::Chart widget 8-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Performance
                                            ({{ formateDate($startDate) }} - {{ formateDate($endDate) }})</span>
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
                    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                        <!--begin::Col-->
                        <div class="col-xxl-12 mb-5 mb-xl-10">
                            <!--begin::Card widget 20-->
                            <div class="card card-bordered">
                                <div class="card-body">
                                    <div id="graph_2" style="height: 350px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-5 gx-xl-10">
                        <!--begin::Col-->
                        <div class="col-xxl-12 mb-5 mb-xl-10">
                            <!--begin::Chart widget 8-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Campaign Performance
                                            ({{ collect($countsByCampaign)->sum('count') ?? 0 }})</span>
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
                    </div>
                    <div class="row gx-5 gx-xl-10">
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
                    </div>
                    <div class="row gx-5 gx-xl-10">
                        <!--begin::Col-->
                        <div class="col-xxl-12 mb-5 mb-xl-10">
                            <!--begin::Chart widget 8-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">City
                                            ({{ collect($citygraph)->sum('count') ?? 0 }})</span>
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
                    </div>
                    <div class="row gx-5 gx-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-12">
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
                        <div class="col-xl-12">
                            <hr>
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

                        <div class="col-xl-12">
                            <hr>
                            <hr>
                            <!--begin::Chart widget 31-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-7">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-800">Banks
                                            ({{ collect($banks_graph)->sum('count') ?? 0 }})</span>
                                    </h3>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-5">
                                    @foreach ($banks_graph as $bank)
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <span
                                                class="text-black fw-semibold fs-6 me-2">{{ $bank['bank_name'] ?? '' }}</span>
                                            <!--end::Section-->
                                            <!--begin::Action-->
                                            <span
                                                class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr095.svg-->
                                                <span
                                                    class="badge py-3 px-4 fs-7 badge-light-primary">{{ $bank['count'] ?? 0 }}</span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-3"></div>
                                        <!--end::Separator-->
                                    @endforeach
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Chart widget 31-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Row-->
                    <!--begin::Toolbar container-->
                    <div class="card-header mb-3" style="padding: 0px;">
                        <div class="card-toolbar ">
                            <div class="row  mt-5">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button id="printButton" type="button" class="btn btn-success me-3">
                                        <span class="svg-icon svg-icon-2"> <i class="bi bi-file-earmark-spreadsheet"></i>
                                        </span>
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

                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-1000px" data-kt-menu="true"
                                        id="kt_menu_62fe86549b38d">
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                        </div>
                                        <div class="separator border-gray-200"></div>
                                        <form method="POST" action="{{ route('sale-graph-comparison.index') }}"
                                            class="form d-flex flex-column flex-lg-row" id="myForm">
                                            @csrf
                                            <div class="px-7 py-5">
                                                <div class="row">
                                                    <div class="mb-3 col-6">
                                                        @can('sale-graph-comparison-filters')
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
                                                                </div>
                                                            </div>
                                                        @endcan
                                                        <div class="row mt-1">
                                                            @include('admin.common_files_filters.created_date')
                                                        </div>
                                                        {{-- <div class="row mt-2">
                                                                @include('admin.common_files_filters.updated_date')
                                                        </div> --}}
                                                    </div>
                                                    <div class="mb-3 col-6">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <label
                                                                    class="form-label fw-semibold">{{ __('Dealer City') }}</label>
                                                                <div>
                                                                    <select class="form-select mb-2" name="city_id_comp[]"
                                                                        id="city_id_comp" data-control="select2"
                                                                        data-placeholder="{{ __('select option') }}"
                                                                        data-allow-clear="true" multiple>
                                                                        {{-- <option value="">--select--</option> --}}
                                                                        @foreach ($cities as $city)
                                                                            <option value="{{ $city->id }}"
                                                                                {{ is_selected($city->id, 'city_id_comp') }}>
                                                                                {{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label
                                                                    class="form-label fw-semibold">{{ __('Dealer Branch') }}</label>
                                                                <div>
                                                                    <select class="form-select mb-2"
                                                                        name="branch_id_comp[]" id="branch_id_comp"
                                                                        data-control="select2"
                                                                        data-placeholder="{{ __('select option') }}"
                                                                        data-allow-clear="true" multiple>
                                                                        {{-- <option value="">--select--</option> --}}
                                                                        @foreach ($branches as $branch)
                                                                            <option value="{{ $branch->id }}"
                                                                                {{ is_selected($branch->id, 'branch_id_comp') }}>
                                                                                {{ $branch->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label
                                                                    class="form-label fw-semibold">{{ __('Vehicle') }}</label>
                                                                <div>
                                                                    <select class="form-select mb-2"
                                                                        name="vehicle_id_comp[]" id="vehicle_id_comp"
                                                                        data-control="select2"
                                                                        data-placeholder="{{ __('select option') }}"
                                                                        data-allow-clear="true" multiple>
                                                                        {{-- <option value="">--select--</option> --}}
                                                                        @foreach ($vehicles as $vehicle)
                                                                            <option value="{{ $vehicle->id }}"
                                                                                {{ is_selected($vehicle->id, 'vehicle_id_comp') }}>
                                                                                {{ $vehicle->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label
                                                                    class="form-label fw-semibold">{{ __('Source') }}</label>
                                                                <div>
                                                                    <select class="form-select mb-2"
                                                                        name="source_id_comp[]" id="source_id_comp"
                                                                        data-control="select2"
                                                                        data-placeholder="{{ __('select option') }}"
                                                                        data-allow-clear="true" multiple>
                                                                        {{-- <option value="">--select--</option> --}}
                                                                        @foreach ($sources as $source)
                                                                            <option value="{{ $source->id }}"
                                                                                {{ is_selected($source->id, 'source_id_comp') }}>
                                                                                {{ $source->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label
                                                                    class="form-label fw-semibold">{{ __('Campaign') }}</label>
                                                                <div>
                                                                    <select class="form-select mb-2"
                                                                        name="campaign_id_comp[]" id="campaign_id_comp"
                                                                        data-control="select2"
                                                                        data-placeholder="{{ __('select option') }}"
                                                                        data-allow-clear="true" multiple>
                                                                        {{-- <option value="">--select--</option> --}}
                                                                        @foreach ($campaigns as $campaign)
                                                                            <option value="{{ $campaign->id }}"
                                                                                {{ is_selected($campaign->id, 'campaign_id_comp') }}>
                                                                                {{ $campaign->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label
                                                                    class=" form-label">{{ __('Purchase Plan') }}</label>
                                                                <select class="form-select mb-2"
                                                                    name="purchase_plan_comp[]" id="purchase_plan_comp"
                                                                    data-control="select2"
                                                                    data-placeholder="{{ __('select option') }}"
                                                                    data-allow-clear="true" multiple>
                                                                    {{-- <option value="">--select--</option> --}}
                                                                    <option value="1 month"
                                                                        {{ is_selected('1 month', 'purchase_plan') }}>1
                                                                        month</option>
                                                                    <option value="2-3 month"
                                                                        {{ is_selected('2-3 month', 'purchase_plan') }}>2-3
                                                                        month</option>
                                                                    <option value="After 3 month"
                                                                        {{ is_selected('After 3 month', 'purchase_plan_comp') }}>
                                                                        After 3 month</option>
                                                                </select>

                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label
                                                                    class=" form-label">{{ __('Monthly Salary') }}</label>
                                                                <select class="form-select mb-2"
                                                                    name="monthly_salary_comp[]" id="monthly_salary_comp"
                                                                    data-control="select2"
                                                                    data-placeholder="{{ __('select option') }}"
                                                                    data-allow-clear="true" multiple>
                                                                    {{-- <option value="">--select--</option> --}}
                                                                    <option value="Between 5,000 and 10,000"
                                                                        {{ is_selected('Between 5,000 and 10,000', 'monthly_salary') }}>
                                                                        Between
                                                                        5,000 and 10,000</option>
                                                                    <option value="Above 10,000"
                                                                        {{ is_selected('Above 10,000', 'monthly_salary_comp') }}>
                                                                        Above 10,000</option>
                                                                    <option value="Below 5,000"
                                                                        {{ is_selected('Below 5,000', 'monthly_salary_comp') }}>
                                                                        Below 5,000</option>
                                                                    <option value="Cash Deal"
                                                                        {{ is_selected('Cash Deal', 'monthly_salary_comp') }}>
                                                                        Cash Deal</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <label
                                                                    class=" form-label">{{ __('Preferred Time') }}</label>
                                                                <select class="form-select mb-2"
                                                                    name="preferred_appointment_time_comp[]"
                                                                    id ="preferred_appointment_time_comp"
                                                                    data-control="select2"
                                                                    data-placeholder="{{ __('select option') }}"
                                                                    data-allow-clear="true" multiple>
                                                                    {{-- <option value="">--select--</option> --}}
                                                                    <option value="Morning 08:00AM~12:00PM"
                                                                        {{ is_selected('Morning 08:00AM~12:00PM', 'preferred_appointment_time_comp') }}>
                                                                        Morning (08:00AM~12:00PM)</option>
                                                                    <option value="Afternoon 12:00PM~04:00PM"
                                                                        {{ is_selected('Afternoon 12:00PM~04:00PM', 'preferred_appointment_time_comp') }}>
                                                                        Afternoon (12:00PM~04:00PM)</option>
                                                                    <option value="Any Time"
                                                                        {{ is_selected('Any Time', 'preferred_appointment_time_comp') }}>
                                                                        Any Time</option>
                                                                </select>

                                                            </div>

                                                            <div class="col-lg-4">
                                                                <label class=" form-label">{{ __('KYC') }}</label>
                                                                <select class="form-select mb-2" name="kyc_comp[]"
                                                                    id="kyc_comp" data-control="select2"
                                                                    data-placeholder="{{ __('select option') }}"
                                                                    data-allow-clear="true" multiple>
                                                                    {{-- <option value="">--select--</option> --}}
                                                                    <option value="Social Media"
                                                                        {{ is_selected('Social Media', 'kyc_comp') }}>
                                                                        Social Media</option>
                                                                    <option value="Friends & Relative"
                                                                        {{ is_selected('Friends & Relative', 'kyc_comp') }}>
                                                                        Friends & Relative</option>
                                                                    <option value="Outdoor Advertisement"
                                                                        {{ is_selected('Outdoor Advertisement', 'kyc_comp') }}>
                                                                        Outdoor Advertisement</option>
                                                                    <option value="Influencer"
                                                                        {{ is_selected('Influencer', 'kyc_comp') }}>
                                                                        Influencer</option>
                                                                    <option value="Others"
                                                                        {{ is_selected('Others', 'kyc_comp') }}>Others
                                                                    </option>
                                                                </select>

                                                            </div>

                                                            <div class="col-lg-4">
                                                                <label class=" form-label">{{ __('Category') }}</label>
                                                                <select class="form-select mb-2" name="category_comp[]"
                                                                    id="category_comp" data-control="select2"
                                                                    data-placeholder="{{ __('select option') }}"
                                                                    data-allow-clear="true" multiple>
                                                                    {{-- <option value="">--select--</option> --}}
                                                                    <option value="Qualified"
                                                                        {{ is_selected('Qualified', 'category_comp') }}>
                                                                        Qualified</option>
                                                                    <option value="Not Qualified"
                                                                        {{ is_selected('Not Qualified', 'category_comp') }}>
                                                                        Not Qualified</option>
                                                                    <option value="General Inquiry"
                                                                        {{ is_selected('General Inquiry', 'category_comp') }}>
                                                                        General Inquiry</option>
                                                                </select>

                                                            </div>

                                                            <div class="col-lg-4">
                                                                <label
                                                                    class="form-label fw-semibold">{{ __('Created By') }}</label>
                                                                <div>
                                                                    <select class="form-select mb-2"
                                                                        name="created_by_comp[]" id="created_by_comp"
                                                                        data-control="select2"
                                                                        data-placeholder="{{ __('select option') }}"
                                                                        data-allow-clear="true" multiple>
                                                                        {{-- <option value="">--select--</option> --}}
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id }}"
                                                                                {{ is_selected($user->id, 'created_by_comp') }}>
                                                                                {{ $user->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>

                                                            <div class="col-lg-4">
                                                                <label class="form-label fw-semibold">{{ __('Updated By') }}</label>
                                                                <div>
                                                                    <select class="form-select mb-2" name="updated_by_comp[]" id="updated_by_comp" data-control="select2"
                                                                        data-placeholder="{{ __('select option') }}" data-allow-clear="true" multiple>
                                                                        {{-- <option value="">--select--</option> --}}
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id }}"  {{ is_selected($user->id, 'updated_by_comp') }}>{{ $user->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>

                                                            <div class="col-lg-6">
                                                                <label class="form-label fw-semibold">{{ __('Start Date') }}</label>
                                                                <input type="date"
                                                                    class="form-control form-control-solid ps-12"
                                                                    placeholder="Select a date" name="start_date_comp"
                                                                    value="{{ formateDate($startDate_comp) }}"
                                                                    id="start_date_comp" />
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <label class="form-label fw-semibold">{{ __('End Date') }}</label>
                                                                <input type="date"
                                                                    class="form-control form-control-solid ps-12"
                                                                    placeholder="Select a date" name="end_date_comp"
                                                                    value="{{ formateDate($endDate_comp) }}"
                                                                    id="end_date_comp" />
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
                                                            <a href="{{ route('sale-graph-comparison.index') }}"
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
                                        <span class="card-label fw-bold text-dark">Performance
                                            ({{ formateDate($startDate_comp) }} - {{ formateDate($endDate_comp) }})</span>
                                        <span class="text-gray-400 mt-1 fw-semibold fs-6">Total Leads
                                            ({{ $total_performance_count_comp }})</span>
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

                                            <canvas id="1st_graph_comp" class="mh-400px"></canvas>
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
                    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                        <!--begin::Col-->
                        <div class="col-xxl-12 mb-5 mb-xl-10">
                            <!--begin::Card widget 20-->
                            <div class="card card-bordered">
                                <div class="card-body">
                                    <div id="graph_2_comp" style="height: 350px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-5 gx-xl-10">
                        <!--begin::Col-->
                        <div class="col-xxl-12 mb-5 mb-xl-10">
                            <!--begin::Chart widget 8-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Campaign Performance
                                            ({{ collect($countsByCampaign_comp)->sum('count') ?? 0 }})</span>
                                    </h3>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                @foreach ($countsByCampaign_comp as $campaign_wise)
                                    @if ($loop->first)
                                        @php $first_show = "show"; @endphp
                                    @else
                                        @php $first_show = ""; @endphp
                                    @endif
                                    <div class="card-body pt-2 pb-0">
                                        <div class="row g-5 g-xl-10 mb-5">
                                            <!--begin::Accordion-->
                                            <div class="accordion"
                                                id="kt_accordion_1_{{ $campaign_wise['campaign_id'] }}">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button fs-4 fw-semibold" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#kt_accordion_1_body_11_{{ $campaign_wise['campaign_id'] }}"
                                                            aria-expanded="true"
                                                            aria-controls="kt_accordion_1_body_11_{{ $campaign_wise['campaign_id'] }}">
                                                            {{ $campaign_wise['name'] ?? '' }}
                                                            <span
                                                                class="badge py-3 px-4 fs-7 badge-light-danger  justify-content-end">{{ $campaign_wise['count'] ?? 0 }}</span>
                                                        </button>
                                                    </h2>
                                                    <div id="kt_accordion_1_body_11_{{ $campaign_wise['campaign_id'] }}"
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
                    </div>
                    <div class="row gx-5 gx-xl-10">
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
                                            <div id="graph_3_comp" style="height: 350px;"></div>
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
                    <div class="row gx-5 gx-xl-10">
                        <!--begin::Col-->
                        <div class="col-xxl-12 mb-5 mb-xl-10">
                            <!--begin::Chart widget 8-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">City
                                            ({{ collect($citygraph_comp)->sum('count') ?? 0 }})</span>
                                    </h3>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                @foreach ($citygraph_comp as $campaign_wise)
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
                    </div>
                    <div class="row gx-5 gx-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-12">
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
                                    <canvas id="graph_4_comp" class="mh-400px"></canvas>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Chart widget 31-->
                        </div>
                        <!--end::Col-->
                        <div class="col-xl-12">
                            <hr>
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
                                    <canvas id="graph_5_comp" class="mh-400px"></canvas>
                                    <!--end::Chart-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Chart widget 31-->
                        </div>

                        <div class="col-xl-12">
                            <hr>
                            <hr>
                            <!--begin::Chart widget 31-->
                            <div class="card card-flush h-xl-100">
                                <!--begin::Header-->
                                <div class="card-header pt-7">
                                    <!--begin::Title-->
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-800">Banks
                                            ({{ collect($banks_graph_comp)->sum('count') ?? 0 }})</span>
                                    </h3>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-5">
                                    @foreach ($banks_graph_comp as $bank)
                                        <!--begin::Item-->
                                        <div class="d-flex flex-stack">
                                            <!--begin::Section-->
                                            <span
                                                class="text-black fw-semibold fs-6 me-2">{{ $bank['bank_name'] ?? '' }}</span>
                                            <!--end::Section-->
                                            <!--begin::Action-->
                                            <span
                                                class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr095.svg-->
                                                <span
                                                    class="badge py-3 px-4 fs-7 badge-light-primary">{{ $bank['count'] ?? 0 }}</span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-3"></div>
                                        <!--end::Separator-->
                                    @endforeach
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Chart widget 31-->
                        </div>
                    </div>

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
        // for left side

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
        const labels = @json($months);

        // Chart data
        const data = {
            labels: labels,
            datasets: [{
                    label: 'Request a Quote (' + @json($second_graph_data[0]) + ')',
                    data: @json($first_count),
                    fill: false,
                    borderColor: primaryColor,
                    tension: 0.6
                },
                {
                    label: 'Special Offers (' + @json($second_graph_data[1]) + ')',
                    data: @json($second_count),
                    fill: false,
                    borderColor: dangerColor,
                    tension: 0.6
                },
                {
                    label: 'Smo Leads (' + @json($second_graph_data[2]) + ')',
                    data: @json($third_count),
                    fill: false,
                    borderColor: successColor,
                    tension: 0.6
                },
                {
                    label: 'Contact Us (Sales & Marketing) (' + @json($second_graph_data[3]) + ')',
                    data: @json($fourth_count),
                    fill: false,
                    borderColor: warningColor,
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



        ////second chart

        var options = {
            series: [{
                name: 'Count',
                data: @json($second_graph_data)
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758", '#546E7A']
                }
            },

            xaxis: {
                categories: ["Request a Quote", "Special Offers", "Smo Leads", "Contact Us (Sales & Marketing)"],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val;
                    }
                }

            },
            title: {
                text: 'Departments Overall Leads',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#graph_2"), options);
        chart.render();


        // Example data
        //var xData = ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan', 'United States', 'China', 'Germany'];
        //var yData = [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380];
        var xData = @json($vehcile_graph['vehicle_names']);
        var yData = @json($vehcile_graph['vehicle_count']);

        // Generate random fill colors
        var fillColors = Array.from({
            length: xData.length
        }, () => getRandomColor());

        // Create series data
        var seriesData = xData.map((x, index) => ({
            x: x,
            y: yData[index],
            fill: fillColors[index]
        }));

        // Function to generate a random color
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

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
                    distributed: true
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
            }
        };

        // Render the chart
        var chart = new ApexCharts(document.querySelector("#graph_3"), options);
        chart.render();


        var ctx1 = document.getElementById('graph_4');

        const data1 = {
            labels: @json($salary_graph['monthly_salary']),
            datasets: [{
                label: 'Dataset',
                data: @json($salary_graph['monthly_salary_count']),
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
            }]
        };


        const config1 = {
            type: 'doughnut',
            data: data1,
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

        var myChart = new Chart(ctx1, config1);



        var ctx2 = document.getElementById('graph_5');

        const data2 = {
            labels: @json($purchase_plan_graph['purchase_plan']),
            datasets: [{
                label: 'Dataset',
                data: @json($purchase_plan_graph['purchase_plan_count']),
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
            }]
        };


        const config2 = {
            type: 'pie',
            data: data2,
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

        var myChart = new Chart(ctx2, config2);
        // for left side end

        // for right side


        var ctx_comp = document.getElementById('1st_graph_comp');

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
        const labels_comp = @json($months_comp);

        // Chart data
        const data_comp = {
            labels: labels_comp,
            datasets: [{
                    label: 'Request a Quote (' + @json($second_graph_data_comp[0]) + ')',
                    data: @json($first_count_comp),
                    fill: false,
                    borderColor: primaryColor,
                    tension: 0.6
                },
                {
                    label: 'Special Offers (' + @json($second_graph_data_comp[1]) + ')',
                    data: @json($second_count_comp),
                    fill: false,
                    borderColor: dangerColor,
                    tension: 0.6
                },
                {
                    label: 'Smo Leads (' + @json($second_graph_data_comp[2]) + ')',
                    data: @json($third_count_comp),
                    fill: false,
                    borderColor: successColor,
                    tension: 0.6
                },
                {
                    label: 'Contact Us (Sales & Marketing) (' + @json($second_graph_data_comp[3]) + ')',
                    data: @json($fourth_count_comp),
                    fill: false,
                    borderColor: warningColor,
                    tension: 0.6
                }
            ]
        };

        // Chart config
        const config_comp = {
            type: 'line',
            data: data_comp,
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
        var myChart1 = new Chart(ctx_comp, config_comp);



        ////second chart

        var options_comp = {
            series: [{
                name: 'Count',
                data: @json($second_graph_data_comp)
            }],
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758", '#546E7A']
                }
            },

            xaxis: {
                categories: ["Request a Quote", "Special Offers", "Smo Leads", "Contact Us (Sales & Marketing)"],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val;
                    }
                }

            },
            title: {
                text: 'Departments Overall Leads',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var chart_comp = new ApexCharts(document.querySelector("#graph_2_comp"), options_comp);
        chart_comp.render();


        // Example data
        //var xData = ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan', 'United States', 'China', 'Germany'];
        //var yData = [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380];
        var xData_comp = @json($vehcile_graph_comp['vehicle_names']);
        var yData_comp = @json($vehcile_graph_comp['vehicle_count']);

        // Generate random fill colors
        var fillColors_comp = Array.from({
            length: xData.length
        }, () => getRandomColor());

        // Create series data
        var seriesData_comp = xData_comp.map((x, index) => ({
            x: x,
            y: yData_comp[index],
            fill: fillColors_comp[index]
        }));

        // Function to generate a random color
        // function getRandomColor() {
        //     var letters = '0123456789ABCDEF';
        //     var color = '#';
        //     for (var i = 0; i < 6; i++) {
        //         color += letters[Math.floor(Math.random() * 16)];
        //     }
        //     return color;
        // }

        // Chart options
        var options_comp = {
            series: [{
                data: seriesData_comp
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    distributed: true
                }
            },
            dataLabels: {
                enabled: true
            },
            xaxis: {
                categories: xData_comp.map((x, index) => `${x} (${yData_comp[index]})`),
                labels: {
                    formatter: function(val) {
                        return val;
                    }
                }
            }
        };

        // Render the chart
        var chart_comp = new ApexCharts(document.querySelector("#graph_3_comp"), options_comp);
        chart_comp.render();


        var ctx1_comp = document.getElementById('graph_4_comp');

        const data1_comp = {
            labels: @json($salary_graph_comp['monthly_salary']),
            datasets: [{
                label: 'Dataset',
                data: @json($salary_graph_comp['monthly_salary_count']),
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
            }]
        };


        const config1_comp = {
            type: 'doughnut',
            data: data1,
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

        var myChart_comp = new Chart(ctx1_comp, config1_comp);



        var ctx2_comp = document.getElementById('graph_5_comp');

        const data2_comp = {
            labels: @json($purchase_plan_graph_comp['purchase_plan']),
            datasets: [{
                label: 'Dataset',
                data: @json($purchase_plan_graph_comp['purchase_plan_count']),
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
            }]
        };


        const config2_comp = {
            type: 'pie',
            data: data2_comp,
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

        var myChart = new Chart(ctx2_comp, config2_comp);

        // for right side end

        $('#city_id_comp').change(function() {
            var selectedCity = $(this).val();
            getBranches(selectedCity, branch_id_comp);
        });
    </script>

@endsection
