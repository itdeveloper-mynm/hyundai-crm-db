@extends('layouts.master')

@section('title', 'CRM Leads Report')

@section('css')

    <style>
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
                                    <h1
                                        class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                        CRM Leads Report</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex justify-content-end">
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

                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-500px" data-kt-menu="true"
                                id="kt_menu_62fe86549b38d">
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <form method="POST" action="{{ route('crm-leads-graph.index') }}"
                                    class="form d-flex flex-column flex-lg-row" id="myForm">
                                    @csrf
                                    <div class="px-7 py-5">
                                        <div class="mb-3">
                                            @can('crm-leads-filters')
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
                                                    <a href="{{ route('crm-leads-graph.index') }}"
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



            <div class="row gx-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Input from CRM Team ({{ collect($category_graph['category_count'])->sum() ?? 0 }})</span>
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
                                    <div id="graph_6" style="height: 350px;"></div>
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
                                <table class="table table-striped gy-4 gs-7">
                                    <thead>
                                        <tr  style="background: #A0C5E8;">
                                            <th class="" colspan="2">
                                                <h5><span style="float: left">Name</span></h5>
                                            </th>
                                            <th class=""><h5><span style="float: left">MQL</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Target Sql (MQL / Percentage)">TSQL <small>(30%)</small></span></h5></th>
                                            <th class=""><h5><span style="float: left">SQL</span></h5></th>
                                            <th class=""><h5><span style="float: left">SGI</span></h5></th>
                                            <th class=""><h5><span style="float: left">SNQ</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Unreachable">Unreach</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Pending CRM Leads">PCL</span></h5></th>
                                            <th class=""><h5><span style="float: left">Conversion (%)</span></h5></th>
                                            <th class=""><h5><span style="float: left">Inv</span></h5></th>
                                            <th class=""><h5><span style="float: left">SalesConv (%)</span></h5></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_percentage_value = 0;
                                        @endphp
                                        @foreach ($campaigns_detial_data as $key => $campaign)
                                            <tr class="cursor-pointer campaign-row toggle-sources" data-campaign-id="{{ $campaign['campaign_id'] }}">
                                                @php
                                                    $mql = $campaign['mql'] ?? 0;
                                                    $cql = $campaign['cql'] ?? 0;
                                                    $cgi = $campaign['cgi'] ?? 0;
                                                    $cnq = $campaign['cnq'] ?? 0;
                                                    $unreachable = $campaign['unreach'] ?? 0;
                                                    $inv = $campaign['inv'] ?? 0;
                                                    $remaining = $mql - $cql - $cgi - $cnq - $unreachable;

                                                    // Calculate percentage value and sum it
                                                    $percentage_value = calculatePercentageValue($mql, $campaign['percentage']);
                                                    $total_percentage_value += $percentage_value;
                                                @endphp
                                                <td colspan="2"><span style="float: left">{{ $campaign['campaign_name'] }}</span></td>
                                                <td><span class="badge badge-primary">{{ $mql }}</span></td>
                                                <td><span class="badge badge-primary">{{ $percentage_value }}</span></td>
                                                <td><span class="badge badge-success">{{ $cql }}</span></td>
                                                <td><span class="badge badge-info">{{ $cgi }}</span></td>
                                                <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                                                <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                                                <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                                                <td><span class="badge" style="background-color: #002c5f !important;">
                                                    {{ calculatePercentage($mql, $cql) }}
                                                </span></td>
                                                <td><span class="badge badge-success">{{ $inv }}</span></td>
                                                <td><span class="badge" style="background-color: #002c5f !important;">
                                                    {{ calculatePercentage($mql, $inv) }}
                                                </span></td>
                                            </tr>


                                            @foreach($campaign['sources'] as $source)
                                                <tr class="source-row nested-sources" data-campaign-id="{{ $campaign['campaign_id'] }}"
                                                style="display: none;
                                                {{ $loop->first ? 'border-top: 2px solid black;' : '' }}
                                                {{ $loop->last ? 'border-bottom: 2px solid black;' : '' }}">

                                                @php
                                                    $mql = $source['mql'] ?? 0;
                                                    $cql = $source['cql'] ?? 0;
                                                    $cgi = $source['cgi'] ?? 0;
                                                    $cnq = $source['cnq'] ?? 0;
                                                    $unreachable = $source['unreach'] ?? 0;
                                                    $inv = $source['inv'] ?? 0;
                                                    $remaining = $mql - $cql - $cgi - $cnq - $unreachable;
                                                @endphp

                                                <td colspan="2" style="border-left: 2px solid black;">
                                                    <span>{{ $source['source_name'] }}</span>
                                                </td>
                                                <td><span class="badge badge-primary">{{ $mql }}</span></td>
                                                <td>0</td>
                                                <td><span class="badge badge-success">{{ $cql }}</span></td>
                                                <td><span class="badge badge-info">{{ $cgi }}</span></td>
                                                <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                                                <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                                                <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                                                <td>
                                                    <span class="badge" style="background-color: #002c5f !important;">
                                                        {{ calculatePercentage($mql, $cql) }}
                                                    </span>
                                                </td>
                                                <td><span class="badge badge-success">{{ $inv }}</span></td>
                                                <td style="border-right: 2px solid black;">
                                                    <span class="badge" style="background-color: #002c5f !important;">
                                                        {{ calculatePercentage($mql, $inv) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="background: #a36b4f">
                                            <th colspan="2"><h5><span style="float: left">Total Count</span></h5></th>
                                            @php
                                                $mql = collect($campaigns_detial_data)->sum('mql') ?? 0;
                                                $cql = collect($campaigns_detial_data)->sum('cql') ?? 0;
                                                $cgi = collect($campaigns_detial_data)->sum('cgi') ?? 0;
                                                $cnq = collect($campaigns_detial_data)->sum('cnq') ?? 0;
                                                $inv = collect($campaigns_detial_data)->sum('inv') ?? 0;
                                                $unreachable = collect($campaigns_detial_data)->sum('unreach') ?? 0;
                                                $remaining = $mql - $cql - $cgi - $cnq - $unreachable;
                                            @endphp
                                            <th><h5><span class="badge badge-primary">{{ $mql }}</span></h5></th>
                                            <th><h5><span class="badge badge-primary">{{ $total_percentage_value }}</span></h5></th>
                                            <th><h5><span class="badge badge-success">{{ $cql }}</span></h5></th>
                                            <th><h5><span class="badge badge-info">{{ $cgi }}</span></h5></th>
                                            <th><h5><span class="badge badge-warning">{{ $cnq }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></h5></th>
                                            <th><h5><span class="badge badge-danger">{{ $remaining }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                                                {{ calculatePercentage($mql, $cql) }}
                                            </span></h5></th>
                                            <th><h5><span class="badge badge-success">{{ $inv }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                                                {{ calculatePercentage($mql, $inv) }}
                                            </span></h5></th>
                                        </tr>

                                    </tfoot>
                                </table>
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
                                <table class="table table-striped gy-4 gs-7">
                                    <thead>
                                        <tr  style="background: #A0C5E8;">
                                            <th class="" colspan="2">
                                                <h5><span style="float: left">Name</span></h5>
                                            </th>
                                            <th class=""><h5><span style="float: left">MQL</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Target Sql (MQL / Percentage)">TSQL <small>(30%)</small></span></h5></th>
                                            <th class=""><h5><span style="float: left">SQL</span></h5></th>
                                            <th class=""><h5><span style="float: left">SGI</span></h5></th>
                                            <th class=""><h5><span style="float: left">SNQ</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Unreachable">Unreach</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Pending CRM Leads">PCL</span></h5></th>
                                            <th class=""><h5><span style="float: left">Conversion (%)</span></h5></th>
                                            <th class=""><h5><span style="float: left">Inv</span></h5></th>
                                            <th class=""><h5><span style="float: left">SalesConv (%)</span></h5></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_percentage_value = 0;
                                        @endphp

                                        @foreach ($campaigns_vehcile_data as $key => $campaign)
                                            <tr class="cursor-pointer campaign-row toggle-sources" data-campaign-id="{{ $campaign['campaign_id'] }}" data-child-name="vehciles-row">
                                                @php
                                                    $mql = $campaign['mql'] ?? 0;
                                                    $cql = $campaign['cql'] ?? 0;
                                                    $cgi = $campaign['cgi'] ?? 0;
                                                    $cnq = $campaign['cnq'] ?? 0;
                                                    $unreachable = $campaign['unreach'] ?? 0;
                                                    $inv = $campaign['inv'] ?? 0;
                                                    $remaining = $mql - $cql - $cgi - $cnq - $unreachable;

                                                    // Calculate percentage value and sum it
                                                    $percentage_value = calculatePercentageValue($mql, $campaign['percentage']);
                                                    $total_percentage_value += $percentage_value;

                                                @endphp
                                                <td colspan="2"><span style="float: left">{{ $campaign['campaign_name'] }}</span></td>
                                                <td><span class="badge badge-primary">{{ $mql }}</span></td>
                                                <td><span class="badge badge-primary">{{ $percentage_value }}</span></td>
                                                <td><span class="badge badge-success">{{ $cql }}</span></td>
                                                <td><span class="badge badge-info">{{ $cgi }}</span></td>
                                                <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                                                <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                                                <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                                                <td><span class="badge" style="background-color: #002c5f !important;">
                                                    {{ calculatePercentage($mql, $cql) }}
                                                </span></td>
                                                <td><span class="badge badge-success">{{ $inv }}</span></td>
                                                <td><span class="badge" style="background-color: #002c5f !important;">
                                                    {{ calculatePercentage($mql, $inv) }}
                                                </span></td>
                                            </tr>


                                            @foreach($campaign['vehicles'] as $source)
                                                <tr class="vehciles-row nested-sources" data-campaign-id="{{ $campaign['campaign_id'] }}"
                                                style="display: none;
                                                {{ $loop->first ? 'border-top: 2px solid black;' : '' }}
                                                {{ $loop->last ? 'border-bottom: 2px solid black;' : '' }}">

                                                @php
                                                    $mql = $source['mql'] ?? 0;
                                                    $cql = $source['cql'] ?? 0;
                                                    $cgi = $source['cgi'] ?? 0;
                                                    $cnq = $source['cnq'] ?? 0;
                                                    $unreachable = $source['unreach'] ?? 0;
                                                    $inv = $source['inv'] ?? 0;
                                                    $remaining = $mql - $cql - $cgi - $cnq - $unreachable;
                                                @endphp

                                                <td colspan="2" style="border-left: 2px solid black;">
                                                    <span>{{ $source['vehicle_name'] }}</span>
                                                </td>
                                                <td><span class="badge badge-primary">{{ $mql }}</span></td>
                                                <td>0</td>
                                                <td><span class="badge badge-success">{{ $cql }}</span></td>
                                                <td><span class="badge badge-info">{{ $cgi }}</span></td>
                                                <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                                                <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                                                <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                                                <td>
                                                    <span class="badge" style="background-color: #002c5f !important;">
                                                        {{ calculatePercentage($mql, $cql) }}
                                                    </span>
                                                </td>
                                                <td><span class="badge badge-success">{{ $inv }}</span></td>
                                                <td style="border-right: 2px solid black;">
                                                    <span class="badge" style="background-color: #002c5f !important;">
                                                        {{ calculatePercentage($mql, $inv) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="background: #a36b4f">
                                            <th colspan="2"><h5><span style="float: left">Total Count</span></h5></th>
                                            @php
                                                $mql = collect($campaigns_vehcile_data)->sum('mql') ?? 0;
                                                $cql = collect($campaigns_vehcile_data)->sum('cql') ?? 0;
                                                $cgi = collect($campaigns_vehcile_data)->sum('cgi') ?? 0;
                                                $cnq = collect($campaigns_vehcile_data)->sum('cnq') ?? 0;
                                                $unreachable = collect($campaigns_vehcile_data)->sum('unreach') ?? 0;
                                                $inv = collect($campaigns_vehcile_data)->sum('inv') ?? 0;
                                                $remaining = $mql - $cql - $cgi - $cnq - $unreachable;
                                            @endphp
                                            <th><h5><span class="badge badge-primary">{{ $mql }}</span></h5></th>
                                            <th><h5><span class="badge badge-primary">{{    $total_percentage_value }}</span></h5></th>
                                            <th><h5><span class="badge badge-success">{{ $cql }}</span></h5></th>
                                            <th><h5><span class="badge badge-info">{{ $cgi }}</span></h5></th>
                                            <th><h5><span class="badge badge-warning">{{ $cnq }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></h5></th>
                                            <th><h5><span class="badge badge-danger">{{ $remaining }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                                                {{ calculatePercentage($mql, $cql) }}
                                            </span></h5></th>
                                            <th><h5><span class="badge badge-success">{{ $inv }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                                                {{ calculatePercentage($mql, $inv) }}
                                            </span></h5></th>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Chart widget 31-->
            </div>

        </div>

        {{-- <div class="row gx-5 gx-xl-10 mt-5 bank-section">
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
                                <table class="table table-striped gy-4 gs-7">
                                    <thead>
                                        <tr  style="background: #A0C5E8;">
                                            <th class="w-250px" colspan="2">
                                                <h5><span style="float: left">Name</span></h5>
                                            </th>
                                            <th class="w-100px"><h5><span style="float: left">MQL</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Target Sql (MQL / Percentage)">TSQL <small>(30%)</small></span></h5></th>
                                            <th class="w-100px"><h5><span style="float: left">SQL</span></h5></th>
                                            <th class="w-100px"><h5><span style="float: left">SGI</span></h5></th>
                                            <th class="w-100px"><h5><span style="float: left">SNQ</span></h5></th>
                                            <th class="w-100px"><h5><span style="float: left" title="Unreachable">Unreach</span></h5></th>
                                            <th class="w-100px"><h5><span style="float: left" title="Pending CRM Leads">PCL</span></h5></th>
                                            <th class="w-150px"><h5><span style="float: left">Conversion (%)</span></h5></th>
                                            <th class="w-100px"><h5><span style="float: left">Inv</span></h5></th>
                                            <th class="w-150px"><h5><span style="float: left">SalesConv (%)</span></h5></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_percentage_value = 0;
                                        @endphp

                                        @foreach ($campaigns_city_data as $key => $campaign)
                                            <tr class="cursor-pointer campaign-row toggle-sources" data-campaign-id="{{ $campaign['campaign_id'] }}" data-child-name="cities-row">
                                                @php
                                                    $mql = $campaign['mql'] ?? 0;
                                                    $cql = $campaign['cql'] ?? 0;
                                                    $cgi = $campaign['cgi'] ?? 0;
                                                    $cnq = $campaign['cnq'] ?? 0;
                                                    $unreachable = $campaign['unreach'] ?? 0;
                                                    $inv = $campaign['inv'] ?? 0;
                                                    $remaining = $mql - $cql - $cgi - $cnq - $unreachable;

                                                    // Calculate percentage value and sum it
                                                    $percentage_value = calculatePercentageValue($mql, $campaign['percentage']);
                                                    $total_percentage_value += $percentage_value;

                                                @endphp
                                                <td colspan="2"><span style="float: left">{{ $campaign['campaign_name'] }} ({{ $campaign['percentage'] }}%) </span></td>
                                                <td><span class="badge badge-primary">{{ $mql }}</span></td>
                                                <td><span class="badge badge-primary">{{ $percentage_value }}</span></td>
                                                <td><span class="badge badge-success">{{ $cql }}</span></td>
                                                <td><span class="badge badge-info">{{ $cgi }}</span></td>
                                                <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                                                <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                                                <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                                                <td><span class="badge" style="background-color: #002c5f !important;">
                                                    {{ calculatePercentage($mql, $cql) }}
                                                </span></td>
                                                <td><span class="badge badge-success">{{ $inv }}</span></td>
                                                <td><span class="badge" style="background-color: #002c5f !important;">
                                                    {{ calculatePercentage($mql, $inv) }}
                                                </span></td>
                                            </tr>
                                            @foreach($campaign['cities'] as $city)
                                                <tr class="cities-row nested-sources toggle-child-sources" data-campaign-id="{{ $campaign['campaign_id'] }}" data-child-id="{{ $city['city_id'] }}" data-child-name="branches-row"
                                                style="cursor: pointer;display: none;
                                                {{ $loop->first ? 'border-top: 2px solid black;' : '' }}
                                                {{ $loop->last ? 'border-bottom: 2px solid black;' : '' }}">

                                                @php
                                                    $mql = $city['mql'] ?? 0;
                                                    $cql = $city['cql'] ?? 0;
                                                    $cgi = $city['cgi'] ?? 0;
                                                    $cnq = $city['cnq'] ?? 0;
                                                    $unreachable = $city['unreach'] ?? 0;
                                                    $inv = $city['inv'] ?? 0;
                                                    $remaining = $mql - $cql - $cgi - $cnq - $unreachable;
                                                @endphp

                                                <td colspan="2" style="border-left: 2px solid black;">
                                                    <span>{{ $city['city_name'] }}</span>
                                                </td>
                                                <td><span class="badge badge-primary">{{ $mql }}</span></td>
                                                <td>0</td>
                                                <td><span class="badge badge-success">{{ $cql }}</span></td>
                                                <td><span class="badge badge-info">{{ $cgi }}</span></td>
                                                <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                                                <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                                                <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                                                <td>
                                                    <span class="badge" style="background-color: #002c5f !important;">
                                                        {{ calculatePercentage($mql, $cql) }}
                                                    </span>
                                                </td>
                                                <td><span class="badge badge-success">{{ $inv }}</span></td>
                                                <td style="border-right: 2px solid black;">
                                                    <span class="badge" style="background-color: #002c5f !important;">
                                                        {{ calculatePercentage($mql, $inv) }}
                                                    </span>
                                                </td>
                                            </tr>
                                                @foreach($city['branches'] as $branch)
                                                    <tr class="branches-row nested-sources" data-campaign-id="{{ $campaign['campaign_id'] }}" data-city-id="{{ $city['city_id'] }}"
                                                    style="display: none;
                                                    {{ $loop->first ? 'border-top: 2px solid #b503ff;' : '' }}
                                                    {{ $loop->last ? 'border-bottom: 2px solid #b503ff;' : '' }}">

                                                    @php
                                                        $mql = $branch['mql'] ?? 0;
                                                        $cql = $branch['cql'] ?? 0;
                                                        $cgi = $branch['cgi'] ?? 0;
                                                        $cnq = $branch['cnq'] ?? 0;
                                                        $unreachable = $branch['unreach'] ?? 0;
                                                        $inv = $branch['inv'] ?? 0;
                                                        $remaining = $mql - $cql - $cgi - $cnq - $unreachable;
                                                    @endphp

                                                    <td colspan="2" style="border-left: 2px solid #b503ff;">
                                                        <span>{{ $branch['branch_name'] }}</span>
                                                    </td>
                                                    <td><span class="badge badge-primary">{{ $mql }}</span></td>
                                                    <td>0</td>
                                                    <td><span class="badge badge-success">{{ $cql }}</span></td>
                                                    <td><span class="badge badge-info">{{ $cgi }}</span></td>
                                                    <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                                                    <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                                                    <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                                                    <td>
                                                        <span class="badge" style="background-color: #002c5f !important;">
                                                            {{ calculatePercentage($mql, $cql) }}
                                                        </span>
                                                    </td>
                                                    <td><span class="badge badge-success">{{ $inv }}</span></td>
                                                    <td style="border-right: 2px solid #b503ff;">
                                                        <span class="badge" style="background-color: #002c5f !important;">
                                                            {{ calculatePercentage($mql, $inv) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="background: #a36b4f">
                                            <th colspan="2"><h5><span style="float: left">Total Count</span></h5></th>
                                            @php
                                                $mql = collect($campaigns_city_data)->sum('mql') ?? 0;
                                                $cql = collect($campaigns_city_data)->sum('cql') ?? 0;
                                                $cgi = collect($campaigns_city_data)->sum('cgi') ?? 0;
                                                $cnq = collect($campaigns_city_data)->sum('cnq') ?? 0;
                                                $unreachable = collect($campaigns_city_data)->sum('unreach') ?? 0;
                                                $inv = collect($campaigns_city_data)->sum('inv') ?? 0;
                                                $remaining = $mql - $cql - $cgi - $cnq - $unreachable;
                                            @endphp
                                            <th><h5><span class="badge badge-primary">{{ $mql }}</span></h5></th>
                                            <th><h5><span class="badge badge-primary">{{    $total_percentage_value }}</span></h5></th>
                                            <th><h5><span class="badge badge-success">{{ $cql }}</span></h5></th>
                                            <th><h5><span class="badge badge-info">{{ $cgi }}</span></h5></th>
                                            <th><h5><span class="badge badge-warning">{{ $cnq }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></h5></th>
                                            <th><h5><span class="badge badge-danger">{{ $remaining }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                                                {{ calculatePercentage($mql, $cql) }}
                                            </span></h5></th>
                                            <th><h5><span class="badge badge-success">{{ $inv }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                                                {{ calculatePercentage($mql, $inv) }}
                                            </span></h5></th>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Chart widget 31-->
            </div>

        </div> --}}

        <div class="row gx-5 gx-xl-10 mt-5 bank-section">
            <!--begin::Col-->
            <div class="col-xl-12">
                <!--begin::Chart widget 31-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header pt-7 mb-7">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">City Branch Campaigns Performance Measurement</span>
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
                                <table class="table gy-4 gs-7">
                                    <thead>
                                        <tr  style="background: #A0C5E8;">
                                            <th class="" colspan="2">
                                                <h5><span style="float: left">Name</span></h5>
                                            </th>
                                            <th class=""><h5><span style="float: left">MQL</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Target Sql (MQL / Percentage)">TSQL <small>(30%)</small></span></h5></th>
                                            <th class=""><h5><span style="float: left">SQL</span></h5></th>
                                            <th class=""><h5><span style="float: left">SGI</span></h5></th>
                                            <th class=""><h5><span style="float: left">SNQ</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Unreachable">Unreach</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Pending CRM Leads">PCL</span></h5></th>
                                            <th class=""><h5><span style="float: left">Conversion (%)</span></h5></th>
                                            <th class=""><h5><span style="float: left">Inv</span></h5></th>
                                            <th class=""><h5><span style="float: left">SalesConv (%)</span></h5></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_percentage_value = 0;
                                        @endphp

                                        @foreach ($city_branch_camp_data as $key => $city)
                                            <tr class="cursor-pointer campaign-row toggle-sources" data-campaign-id="{{ $city['city_id'] }}" data-child-name="cities-row">
                                                @php
                                                    $mql = $city['mql'] ?? 0;
                                                    $cql = $city['cql'] ?? 0;
                                                    $cgi = $city['cgi'] ?? 0;
                                                    $cnq = $city['cnq'] ?? 0;
                                                    $unreachable = $city['unreach'] ?? 0;
                                                    $inv = $city['inv'] ?? 0;
                                                    $remaining = $mql - $cql - $cgi - $cnq - $unreachable;


                                                @endphp
                                                <td colspan="2"><span style="float: left">{{ $city['city_name'] }}</span></td>
                                                <td><span class="badge badge-primary">{{ $mql }}</span></td>
                                                <td><span class="badge badge-primary">0</span></td>
                                                <td><span class="badge badge-success">{{ $cql }}</span></td>
                                                <td><span class="badge badge-info">{{ $cgi }}</span></td>
                                                <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                                                <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                                                <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                                                <td><span class="badge" style="background-color: #002c5f !important;">
                                                    {{ calculatePercentage($mql, $cql) }}
                                                </span></td>
                                                <td><span class="badge badge-success">{{ $inv }}</span></td>
                                                <td><span class="badge" style="background-color: #002c5f !important;">
                                                    {{ calculatePercentage($mql, $inv) }}
                                                </span></td>
                                            </tr>
                                            @foreach($city['branches'] as $branch)
                                                <tr class="cities-row nested-sources toggle-child-sources" data-campaign-id="{{ $city['city_id'] }}" data-child-id="{{ $branch['branch_id'] }}" data-child-name="branches-row"
                                                style="cursor: pointer;display: none;
                                                {{ $loop->first ? 'border-top: 2px solid black;' : '' }}
                                                {{ $loop->last ? 'border-bottom: 2px solid black;' : '' }}">

                                                @php
                                                    $mql = $branch['mql'] ?? 0;
                                                    $cql = $branch['cql'] ?? 0;
                                                    $cgi = $branch['cgi'] ?? 0;
                                                    $cnq = $branch['cnq'] ?? 0;
                                                    $unreachable = $branch['unreach'] ?? 0;
                                                    $inv = $branch['inv'] ?? 0;
                                                    $remaining = $mql - $cql - $cgi - $cnq - $unreachable;
                                                @endphp

                                                <td colspan="2" style="border-left: 2px solid black;">
                                                    <span>{{ $branch['branch_name'] }}</span>
                                                </td>
                                                <td><span class="badge badge-primary">{{ $mql }}</span></td>
                                                <td>0</td>
                                                <td><span class="badge badge-success">{{ $cql }}</span></td>
                                                <td><span class="badge badge-info">{{ $cgi }}</span></td>
                                                <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                                                <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                                                <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                                                <td>
                                                    <span class="badge" style="background-color: #002c5f !important;">
                                                        {{ calculatePercentage($mql, $cql) }}
                                                    </span>
                                                </td>
                                                <td><span class="badge badge-success">{{ $inv }}</span></td>
                                                <td style="border-right: 2px solid black;">
                                                    <span class="badge" style="background-color: #002c5f !important;">
                                                        {{ calculatePercentage($mql, $inv) }}
                                                    </span>
                                                </td>
                                            </tr>
                                                @foreach($branch['campaigns'] as $campaign)
                                                    <tr class="branches-row nested-sources" data-campaign-id="{{ $city['city_id'] }}" data-city-id="{{ $branch['branch_id']  }}"
                                                    style="display: none;background: antiquewhite;
                                                    {{ $loop->first ? 'border-top: 2px solid #b503ff;' : '' }}
                                                    {{ $loop->last ? 'border-bottom: 2px solid #b503ff;' : '' }}">

                                                    @php
                                                        $mql = $campaign['mql'] ?? 0;
                                                        $cql = $campaign['cql'] ?? 0;
                                                        $cgi = $campaign['cgi'] ?? 0;
                                                        $cnq = $campaign['cnq'] ?? 0;
                                                        $unreachable = $campaign['unreach'] ?? 0;
                                                        $inv = $campaign['inv'] ?? 0;
                                                        $remaining = $mql - $cql - $cgi - $cnq - $unreachable;
                                                    @endphp

                                                    <td colspan="2" style="border-left: 2px solid #b503ff;">
                                                        <span>{{ $campaign['campaign_name'] }}</span>
                                                    </td>
                                                    <td><span class="badge badge-primary">{{ $mql }}</span></td>
                                                    <td>0</td>
                                                    <td><span class="badge badge-success">{{ $cql }}</span></td>
                                                    <td><span class="badge badge-info">{{ $cgi }}</span></td>
                                                    <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                                                    <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                                                    <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                                                    <td>
                                                        <span class="badge" style="background-color: #002c5f !important;">
                                                            {{ calculatePercentage($mql, $cql) }}
                                                        </span>
                                                    </td>
                                                    <td><span class="badge badge-success">{{ $inv }}</span></td>
                                                    <td style="border-right: 2px solid #b503ff;">
                                                        <span class="badge" style="background-color: #002c5f !important;">
                                                            {{ calculatePercentage($mql, $inv) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="background: #a36b4f">
                                            <th colspan="2"><h5><span style="float: left">Total Count</span></h5></th>
                                            @php
                                                $mql = collect($city_branch_camp_data)->sum('mql') ?? 0;
                                                $cql = collect($city_branch_camp_data)->sum('cql') ?? 0;
                                                $cgi = collect($city_branch_camp_data)->sum('cgi') ?? 0;
                                                $cnq = collect($city_branch_camp_data)->sum('cnq') ?? 0;
                                                $unreachable = collect($city_branch_camp_data)->sum('unreach') ?? 0;
                                                $inv = collect($city_branch_camp_data)->sum('inv') ?? 0;
                                                $remaining = $mql - $cql - $cgi - $cnq - $unreachable;
                                            @endphp
                                            <th><h5><span class="badge badge-primary">{{ $mql }}</span></h5></th>
                                            <th><h5><span class="badge badge-primary">{{    $total_percentage_value }}</span></h5></th>
                                            <th><h5><span class="badge badge-success">{{ $cql }}</span></h5></th>
                                            <th><h5><span class="badge badge-info">{{ $cgi }}</span></h5></th>
                                            <th><h5><span class="badge badge-warning">{{ $cnq }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></h5></th>
                                            <th><h5><span class="badge badge-danger">{{ $remaining }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                                                {{ calculatePercentage($mql, $cql) }}
                                            </span></h5></th>
                                            <th><h5><span class="badge badge-success">{{ $inv }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                                                {{ calculatePercentage($mql, $inv) }}
                                            </span></h5></th>
                                        </tr>

                                    </tfoot>
                                </table>
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
                            <span class="card-label fw-bold text-gray-800">Analysis Vehicle wise</span>
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
                                <table class="table table-striped gy-4 gs-7">
                                    <thead>
                                        <tr  style="background: #A0C5E8;">
                                            <th class="" colspan="2">
                                                <h5><span style="float: left">Name</span></h5>
                                            </th>
                                            <th class=""><h5><span style="float: left">MQL</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Target Sql (MQL / Percentage)">TSQL <small>(30%)</small></span></h5></th>
                                            <th class=""><h5><span style="float: left">SQL</span></h5></th>
                                            <th class=""><h5><span style="float: left">SGI</span></h5></th>
                                            <th class=""><h5><span style="float: left">SNQ</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Unreachable">Unreach</span></h5></th>
                                            <th class=""><h5><span style="float: left" title="Pending CRM Leads">PCL</span></h5></th>
                                            <th class=""><h5><span style="float: left">Conversion (%)</span></h5></th>
                                            <th class=""><h5><span style="float: left">Inv</span></h5></th>
                                            <th class=""><h5><span style="float: left">SalesConv (%)</span></h5></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_percentage_value = 0;
                                        @endphp
                                        @if($vehcile_detial_graph)
                                            @foreach ($vehcile_detial_graph as $key => $vehcile)
                                                <tr class="campaign-row toggle-sources" data-campaign-id="{{ $vehcile['vehicle_id'] }}">
                                                    @php
                                                        $mql = $vehcile['mql'] ?? 0;
                                                        $cql = $vehcile['cql'] ?? 0;
                                                        $cgi = $vehcile['cgi'] ?? 0;
                                                        $cnq = $vehcile['cnq'] ?? 0;
                                                        $unreachable = $vehcile['unreach'] ?? 0;
                                                        $inv = $vehcile['inv'] ?? 0;
                                                        $remaining = $mql - $cql - $cgi - $cnq - $unreachable;

                                                        // Calculate percentage value and sum it
                                                        $percentage_value = calculatePercentageValue($mql, 30);
                                                        $total_percentage_value += $percentage_value;
                                                    @endphp
                                                    <td colspan="2"><span style="float: left">{{ $vehcile['vehicle_name'] }}</span></td>
                                                    <td><span class="badge badge-primary">{{ $mql }}</span></td>
                                                    <td><span class="badge badge-primary">{{ $percentage_value }}</span></td>
                                                    <td><span class="badge badge-success">{{ $cql }}</span></td>
                                                    <td><span class="badge badge-info">{{ $cgi }}</span></td>
                                                    <td><span class="badge badge-warning">{{ $cnq }}</span></td>
                                                    <td><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></td>
                                                    <td><span class="badge badge-danger">{{ $remaining }}</span></td>
                                                    <td><span class="badge" style="background-color: #002c5f !important;">
                                                        {{ calculatePercentage($mql, $cql) }}
                                                    </span></td>
                                                    <td><span class="badge badge-success">{{ $inv }}</span></td>
                                                    <td><span class="badge" style="background-color: #002c5f !important;">
                                                        {{ calculatePercentage($mql, $inv) }}
                                                    </span></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr style="background: #a36b4f">
                                            <th colspan="2"><h5><span style="float: left">Total Count</span></h5></th>
                                            @php
                                                $mql = collect($vehcile_detial_graph)->sum('mql') ?? 0;
                                                $cql = collect($vehcile_detial_graph)->sum('cql') ?? 0;
                                                $cgi = collect($vehcile_detial_graph)->sum('cgi') ?? 0;
                                                $cnq = collect($vehcile_detial_graph)->sum('cnq') ?? 0;
                                                $inv = collect($vehcile_detial_graph)->sum('inv') ?? 0;
                                                $unreachable = collect($vehcile_detial_graph)->sum('unreach') ?? 0;
                                                $remaining = $mql - $cql - $cgi - $cnq - $unreachable;
                                            @endphp
                                            <th><h5><span class="badge badge-primary">{{ $mql }}</span></h5></th>
                                            <th><h5><span class="badge badge-primary">{{ $total_percentage_value }}</span></h5></th>
                                            <th><h5><span class="badge badge-success">{{ $cql }}</span></h5></th>
                                            <th><h5><span class="badge badge-info">{{ $cgi }}</span></h5></th>
                                            <th><h5><span class="badge badge-warning">{{ $cnq }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color : #4BC0C0">{{ $unreachable }}</span></h5></th>
                                            <th><h5><span class="badge badge-danger">{{ $remaining }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                                                {{ calculatePercentage($mql, $cql) }}
                                            </span></h5></th>
                                            <th><h5><span class="badge badge-success">{{ $inv }}</span></h5></th>
                                            <th><h5><span class="badge" style="background-color: #002c5f !important;">
                                                {{ calculatePercentage($mql, $inv) }}
                                            </span></h5></th>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Chart widget 31-->
            </div>

        </div>

        {{-- <div class="row gx-5 gx-xl-10 bank-section">
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
        </div> --}}

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
                <div class="col-xl-6">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Sales Leads Perfomance
                                    ({{ collect($countsByCampaign)->sum('count') ?? 0 }})</span>
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
                                    <table class="table table-striped gy-4 gs-7">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <h5><span style="float: left">Current Campaigns</span></h5>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($countsByCampaign as $key => $campaign_wise)
                                                <tr class="campaign_wise_row cursor-pointer"
                                                    data-id="{{ $key }}">
                                                    <td colspan="2"><span style="float: left">
                                                            {{ $campaign_wise['name'] ?? '' }}</span>
                                                        <span style="float: right"
                                                            class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $campaign_wise['count'] ?? 0 }}</span>
                                                    </td>
                                                </tr>

                                                <textarea id="campaign_wise_detials_{{ $key }}" style="display: none">
                                                        <table class="table table-striped gy-4 gs-7">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="2">
                                                                                <h5><span style="float: left">Current Campaigns</span></h5>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th colspan="2">
                                                                                <h5><span style="float: left">{{ $campaign_wise['name'] ?? '' }}</span></h5>
                                                                                <span  style="float: right" class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $campaign_wise['count'] ?? 0 }}</span>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($campaign_wise['source'] as $source_data)
                                                                @if (isset($source_data))
                                                                <tr class="cursor-pointer">
                                                                        <td colspan="2"><span style="float: left"> {{ $source_data['name'] ?? '' }}</span>
                                                                                        <span  style="float: right" class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $source_data['count'] ?? 0 }}</span>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </textarea>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                                <span class="card-label fw-bold text-gray-800">Sources</span>
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
                                    <div id="source_detials_div"></div>
                                    {{-- <table class="table table-striped gy-5 gs-7">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                                <h5><span style="float: left">Current Campaigns</span></h5>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($countsByCampaign as $campaign_wise)
                                                    <tr>
                                                        <td colspan="2"><span style="float: left"> {{ $campaign_wise['name'] ?? '' }}</span>
                                                                        <span  style="float: right" class="badge badge-success">{{ $campaign_wise['count'] ?? 0 }}</span>
                                                        </td>
                                                    </tr>


                                                @endforeach
                                            </tbody>
                                        </table> --}}
                                </div>
                            </div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>

            </div>
            <div class="row gx-5 gx-xl-10 mt-5">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">City ({{collect($citygraph)->sum('count') ?? 0}})</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body align-items-end pt-0">
                            <!--begin::Chart-->
                                <div class="tab-content" id="campaignTabsContent">
                                    <!-- Backtoschool-2024 Content -->
                                    <div class="tab-pane fade show active" id="content-backtoschool" role="tabpanel" aria-labelledby="tab-backtoschool">
                                        <table class="table table-striped gy-4 gs-7">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                                <h5><span style="float: left">Current Cities</span></h5>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($citygraph as $key => $campaign_wise)
                                                    <tr class="city_wise_row cursor-pointer" data-id="{{ $key }}">
                                                        <td colspan="2"><span style="float: left"> {{ $campaign_wise['name'] ?? '' }}</span>
                                                                        <span  style="float: right" class="badge badge-{{Arr::random($badgeClasses)}}">{{ $campaign_wise['count'] ?? 0 }}</span>
                                                        </td>
                                                    </tr>

                                                    <textarea id="city_wise_detials_{{ $key }}" style="display: none">
                                                        <table class="table table-striped gy-4 gs-7">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="2">
                                                                                <h5><span style="float: left">{{ $campaign_wise['name'] ?? '' }}</span></h5>
                                                                                <span  style="float: right" class="badge badge-{{Arr::random($badgeClasses)}}">{{ $campaign_wise['count'] ?? 0 }}</span>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($campaign_wise['branches'] as $source_data)
                                                                    @if (isset($source_data))
                                                                    <tr class="cursor-pointer">
                                                                        <td colspan="2"><span style="float: left"> {{ $source_data['name'] ?? '' }}</span>
                                                                                        <span  style="float: right" class="badge badge-{{Arr::random($badgeClasses)}}">{{ $source_data['count'] ?? 0 }}</span>
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </textarea>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
                                <span class="card-label fw-bold text-gray-800">Branches</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body align-items-end pt-0">
                            <!--begin::Chart-->
                                <div class="tab-content" id="campaignTabsContent">
                                    <!-- Backtoschool-2024 Content -->
                                    <div class="tab-pane fade show active" id="content-backtoschool" role="tabpanel" aria-labelledby="tab-backtoschool">
                                        <div id="branch_detials_div"></div>
                                    </div>
                                </div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>

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
            </div> --}}



            <div class="row gx-5 gx-xl-10 mt-5">
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


            <div class="row gx-5 gx-xl-10 mt-5">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">CRM User Graph</span>
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
                                    <table class="table table-striped gy-4 gs-7">
                                        <thead>
                                            <tr  style="background: #A0C5E8;">
                                                <th class="w-200px" colspan="2">
                                                    <h5><span style="float: left">Name</span></h5>
                                                </th>
                                                <th class="w-200px"><h5><span style="float: left">Qualified</span></h5></th>
                                                <th class="w-200px"><h5><span style="float: left">Not Qualified</span></h5></th>
                                                <th class="w-200px"><h5><span style="float: left">General Inquiry</span></h5></th>
                                                <th class="w-200px"><h5><span style="float: left">Total</span></h5></th>
                                                {{-- <th><h5><span style="float: left">Inv</span></h5></th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($crm_users_graph as $crm_users)
                                                <tr class="cursor-pointer">
                                                    <td colspan="2">
                                                        <span class="float-left">
                                                            {{ $crm_users['updatedby']['name'] ?? '' }}
                                                        </span>
                                                    </td>
                                                    @php
                                                        $badgeClass = Arr::random($badgeClasses);
                                                        $qualified = $crm_users['qualified_count'] ?? 0;
                                                        $notQualified = $crm_users['not_qualified_count'] ?? 0;
                                                        $generalInquiry = $crm_users['general_inquiry_count'] ?? 0;
                                                        $total = $qualified + $notQualified + $generalInquiry;
                                                    @endphp
                                                    <td>
                                                        <span class="float-left badge badge-{{ $badgeClass }}">{{ $qualified }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="float-left badge badge-{{ $badgeClass }}">{{ $notQualified }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="float-left badge badge-{{ $badgeClass }}">{{ $generalInquiry }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="float-left badge badge-{{ $badgeClass }}">{{ $total }}</span>
                                                    </td>
                                                    {{-- <td>
                                                        <span style="float: left"
                                                            class="badge badge-success">{{ $crm_users['inv'] ?? 0 }}</span>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            @php
                                                $badgeClass = Arr::random($badgeClasses);
                                                $totalQualified = collect($crm_users_graph)->sum('qualified_count') ?? 0;
                                                $totalNotQualified = collect($crm_users_graph)->sum('not_qualified_count') ?? 0;
                                                $totalGeneralInquiry = collect($crm_users_graph)->sum('general_inquiry_count') ?? 0;
                                                $grandTotal = $totalQualified + $totalNotQualified + $totalGeneralInquiry;
                                            @endphp

                                            <tr style="background: #8FBC8F;">
                                                <th colspan="2">
                                                    <h5><span class="float-left">Total Count</span></h5>
                                                </th>
                                                <th>
                                                    <h5><span class="float-left badge badge-{{ $badgeClass }}">{{ $totalQualified }}</span></h5>
                                                </th>
                                                <th>
                                                    <h5><span class="float-left badge badge-{{ $badgeClass }}">{{ $totalNotQualified }}</span></h5>
                                                </th>
                                                <th>
                                                    <h5><span class="float-left badge badge-{{ $badgeClass }}">{{ $totalGeneralInquiry }}</span></h5>
                                                </th>
                                                <th>
                                                    <h5><span class="float-left badge badge-{{ $badgeClass }}">{{ $grandTotal }}</span></h5>
                                                </th>
                                                {{-- <th><h5><span style="float: left" class="badge badge-success">{{collect($crm_users_graph)->sum('inv') ?? 0}}</span></h5></th> --}}
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>

            </div>

            <div class="row gx-5 gx-xl-10 mt-5">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">CRM User Sources Graph</span>
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
                                    <table class="table table-striped gy-4 gs-7">
                                        <thead>
                                            <tr  style="background: #A0C5E8;">
                                                <th class="w-150px" colspan="2">
                                                    <h5><span style="float: left">Name</span></h5>
                                                </th>
                                                <th class="w-150px"><h5><span style="float: left">Email</span></h5></th>
                                                <th class="w-150px"><h5><span style="float: left">Whatsapp</span></h5></th>
                                                <th class="w-150px"><h5><span style="float: left">Inbound</span></h5></th>
                                                <th class="w-150px"><h5><span style="float: left">Outbound</span></h5></th>
                                                <th class="w-150px"><h5><span style="float: left">Other Sources</span></h5></th>
                                                <th class="w-150px"><h5><span style="float: left">Total</span></h5></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($crm_users_source_graph as $key => $crm_users)
                                            <tr class="cursor-pointer">
                                                @php
                                                    $email = $crm_users['email_count'] ?? 0;
                                                    $whatsapp = $crm_users['whatsapp_count'] ?? 0;
                                                    $inbound = $crm_users['inbound_count'] ?? 0;
                                                    $outbound = $crm_users['outbound_count'] ?? 0;
                                                    $other = $crm_users['other_count'] ?? 0;
                                                    $total = $email + $whatsapp + $inbound + $outbound + $other;
                                                @endphp

                                                <td colspan="2">
                                                    <span>{{ $crm_users['updatedby']['name'] ?? "" }}</span>
                                                </td>
                                                <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $email }}</span></td>
                                                <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $whatsapp }}</span></td>
                                                <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $inbound }}</span></td>
                                                <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $outbound }}</span></td>
                                                <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $other }}</span></td>
                                                <td><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $total }}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr style="background: #8FBC8F;">
                                                @php
                                                    $emailTotal = collect($crm_users_source_graph)->sum('email_count') ?? 0;
                                                    $whatsappTotal = collect($crm_users_source_graph)->sum('whatsapp_count') ?? 0;
                                                    $inboundTotal = collect($crm_users_source_graph)->sum('inbound_count') ?? 0;
                                                    $outboundTotal = collect($crm_users_source_graph)->sum('outbound_count') ?? 0;
                                                    $otherTotal = collect($crm_users_source_graph)->sum('other_count') ?? 0;
                                                    $grandTotal = $emailTotal + $whatsappTotal + $inboundTotal + $outboundTotal + $otherTotal;
                                                @endphp

                                                <th colspan="2">
                                                    <h5><span>Total Count</span></h5>
                                                </th>
                                                <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $emailTotal }}</span></h5></th>
                                                <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $whatsappTotal }}</span></h5></th>
                                                <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $inboundTotal }}</span></h5></th>
                                                <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $outboundTotal }}</span></h5></th>
                                                <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $otherTotal }}</span></h5></th>
                                                <th><h5><span class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $grandTotal }}</span></h5></th>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 31-->
                </div>

            </div>



        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection


@section('js')

    <script src="{{ asset('ajx_files/ajx.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}

    <script>
        // Define colors
        var primaryColor = KTUtil.getCssVariableValue('--kt-primary');
        var dangerColor = KTUtil.getCssVariableValue('--kt-danger');
        var successColor = KTUtil.getCssVariableValue('--kt-success');
        var warningColor = KTUtil.getCssVariableValue('--kt-warning');
        var defaultColor = KTUtil.getCssVariableValue('--kt-default');
        var infoColor = KTUtil.getCssVariableValue('--kt-info');
        var dangerLightColor = '#1E1E2D';

        // Define fonts
        var fontFamily = KTUtil.getCssVariableValue('--bs-font-sans-serif');



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
                height: 600
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
            },
            legend: {
            show: false // Hides the legend below the graph
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


        // $('#printButton').click(function() {
        //     // Open the print dialog
        //     window.print();
        // });


        var xData6 = @json($category_graph['category_names']);
        var yData6 = @json($category_graph['category_count']);

        // Generate random fill colors
        var fillColors = Array.from({
            length: xData6.length
        }, () => getRandomColor());

        // Create series data
        var seriesData6 = xData6.map((x, index) => ({
            x: x,
            y: yData6[index],
            fill: fillColors[index]
        }));


        // // Function to generate a random color
        // function getRandomColor() {
        // var letters = '0123456789ABCDEF';
        // var color = '#';
        // for (var i = 0; i < 6; i++) {
        //     color += letters[Math.floor(Math.random() * 16)];
        // }
        // return color;
        // }

        // Chart options
        var options6 = {
            series: [{
                data: seriesData6
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
                categories: xData6.map((x, index) => `${x} (${yData6[index]})`),
                labels: {
                    formatter: function(val) {
                        return val;
                    }
                }
            }
        };

        // Render the chart
        var chart6 = new ApexCharts(document.querySelector("#graph_6"), options6);
        chart6.render();


        var ctx = document.getElementById('1st_graph');


        // Chart labels
     // Chart labels
        const labels = @json($months);
        // Chart data
        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'MQLs ('+ @json($second_graph_data[2]) +')',
                    data: @json($third_count),
                    fill: false,
                    borderColor: primaryColor,
                    tension: 0.6
                },
                {
                    label: 'Qualified ('+ @json($second_graph_data[0]) +')',
                    data: @json($first_count),
                    fill: false,
                    borderColor: successColor,
                    tension: 0.6
                },
                {
                    label: 'Target ('+ @json(array_sum($second_count)) +')',
                    data: @json($second_count),
                    fill: false,
                    borderColor: infoColor,
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
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(tooltipItem) {
                                // Build the label string by iterating over each dataset
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
                },
                defaults: {
                    global: {
                        defaultFont: fontFamily
                    }
                }
            }
        };

        // Init ChartJS -- for more info, please visit: https://www.chartjs.org/docs/latest/
        var myChart = new Chart(ctx, config);

        $('.toggle-sources').on('click', function () {
        var campaignId = $(this).data('campaign-id');

        var childName = $(this).data('child-name');

        var sourceRows;
        if (childName) {
            sourceRows = $('.' + childName + '[data-campaign-id="' + campaignId + '"]');
            // sourceRows = $('.source-row[data-"'+childName+'"="' + campaignId + '"]');
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

    $('.toggle-child-sources').on('click', function () {
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




    // var ctx = $("#vehicleAnalysisChart");

    // var dataa = {
    //     labels: @json($vehcile_all_graph['vehicle_names']),
    //     datasets: [
    //         {
    //             label: 'Total MQL ('+ @json(array_sum($vehcile_all_graph['mql'])) +')',
    //             data: @json($vehcile_all_graph['mql']),
    //             backgroundColor: "#F97316"
    //         },
    //         {
    //             label: 'Qualified ('+ @json(array_sum($vehcile_all_graph['cql'])) +')',
    //             data: @json($vehcile_all_graph['cql']),
    //             backgroundColor: "#9CA3AF"
    //         },
    //         {
    //             label:'Not Qualified ('+ @json(array_sum($vehcile_all_graph['cnq'])) +')',
    //             data: @json($vehcile_all_graph['cnq']),
    //             backgroundColor: "#FACC15"
    //         },
    //         {
    //             label: 'General Inquiry ('+ @json(array_sum($vehcile_all_graph['cgi'])) +')',
    //             data: @json($vehcile_all_graph['cgi']),
    //             backgroundColor: "#2563EB"
    //         },
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

    </script>

@endsection
