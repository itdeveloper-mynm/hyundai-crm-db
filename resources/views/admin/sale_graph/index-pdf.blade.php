<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic | Bootstrap HTML, VueJS, React, Angular, Asp.Net Core, Blazor, Django, Flask & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <link href="{{ asset('login_asset') }}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('login_asset') }}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous">
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

        .sales-leads-card {
            background-color: #FF6F91;
            /* Pink color */
            color: white;
            padding: 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .sales-leads-card .value {
            font-size: 2rem;
            font-weight: bold;
        }

        .sales-leads-card .label {
            font-size: 1.1rem;
            text-transform: uppercase;
            opacity: 0.8;
        }

        .sales-leads-card .icon {
            font-size: 1.5rem;
        }

    </style>


</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            <!--begin::Wrapper-->
            {{-- <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper"> --}}
            <div class="flex-column flex-row-fluid" id="kt_app_wrapper">

                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid mt-10" id="kt_app_main">
                    <!--begin::Content wrapper-->

                    <div class="d-flex flex-column flex-column-fluid">
                        {{-- @include('layouts.breadcrumb') --}}
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-fluid">
                                <!--begin::Row-->

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
                                                    <div class="tab-pane fade active show" id=""
                                                        role="tabpanel">

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
                                                <div class="row">
                                                    <div class="col-sm-6 col-xl-3 mb-xl-10">
                                                        <div class="sales-leads-card" style="background: #FF6384">
                                                            <div>
                                                                <p class="value">{{ $second_graph_data[0] ?? 0 }}</p>
                                                                <p class="label">Request a Quote</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="bi bi-geo-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-3 mb-xl-10">
                                                        <div class="sales-leads-card" style="background: #FF9F40">
                                                            <div>
                                                                <p class="value">{{ $second_graph_data[1] ?? 0 }}</p>
                                                                <p class="label">Special Offers</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="bi bi-geo-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-3 mb-xl-10">
                                                        <div class="sales-leads-card" style="background: #9966FF">
                                                            <div>
                                                                <p class="value">{{ $second_graph_data[2] ?? 0 }}</p>
                                                                <p class="label">Request a Test Drive</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="bi bi-geo-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-sm-6 col-xl-3 mb-xl-10">
                                                        <div class="sales-leads-card" style="background: #36A2EB">
                                                            <div>
                                                                <p class="value">{{ $second_graph_data[3] ?? 0 }}</p>
                                                                <p class="label fs-6">Request a Test Quote</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="bi bi-geo-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-sm-6 col-xl-3 mb-xl-10">
                                                        <div class="sales-leads-card" style="background: #4BC0C0">
                                                            <div>
                                                                <p class="value">{{ $second_graph_data[4] ?? 0 }}</p>
                                                                <p class="label">Leads</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="bi bi-geo-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-sm-6 col-xl-3 mb-xl-10">
                                                        <div class="sales-leads-card" style="background: #323639">
                                                            <div>
                                                                <p class="value">{{ $second_graph_data[5] ?? 0 }}</p>
                                                                <p class="label">Events</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="bi bi-geo-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $badgeClasses = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp

                                <div class="row gx-5 gx-xl-10 mt-5  bank-section">
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
                                                                    <th colspan="2">
                                                                        <h5><span style="float: left">Name</span></h5>
                                                                    </th>
                                                                    <th><h5><span style="float: left">MQL</span></h5></th>
                                                                    <th><h5><span style="float: left">CQL</span></h5></th>
                                                                    <th><h5><span style="float: left">CGI</span></h5></th>
                                                                    <th><h5><span style="float: left">CNQ</span></h5></th>
                                                                    <th><h5><span style="float: left">Converstion (%)</span></h5></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($campaigns_detial_data as $key => $campaign)
                                                                    <tr class="cursor-pointer campaign-row toggle-sources" data-campaign-id="{{ $campaign['campaign_id'] }}" >
                                                                        <td colspan="2">
                                                                            <span style="float: left">
                                                                                {{ $campaign['campaign_name'] }} </span>
                                                                        </td>
                                                                        <td>
                                                                            <span style="float: left"
                                                                                class="badge badge-primary">{{ $campaign['mql'] ?? 0 }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span style="float: left"
                                                                                class="badge badge-success">{{ $campaign['cql'] ?? 0 }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span style="float: left"
                                                                                class="badge badge-info">{{ $campaign['cgi'] ?? 0 }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span style="float: left"
                                                                                class="badge badge-warning">{{ $campaign['cnq'] ?? 0 }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span style="float: left;background-color: #002c5f !important;"
                                                                                class="badge">{{  calculatePercentage($campaign['mql'] ?? 0 ,$campaign['cql'] ?? 0 ) }}</span>
                                                                        </td>
                                                                    </tr>

                                                                    @foreach($campaign['sources'] as $source)
                                                                    <tr class="source-row nested-sources" data-campaign-id="{{ $campaign['campaign_id'] }}" style="display:none;
                                                                    @if ($loop->first) border-top: 2px solid black; @endif
                                                                    @if ($loop->last) border-bottom: 2px solid black; @endif">
                                                                        <td colspan="2" style="border-left: 2px solid black;">
                                                                            <span style="float: left">
                                                                                {{ $source['source_name'] }} </span>
                                                                        </td>
                                                                        <td>
                                                                            <span style="float: left"
                                                                                class="badge badge-primary">{{ $source['mql'] ?? 0 }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span style="float: left"
                                                                                class="badge badge-success">{{ $source['cql'] ?? 0 }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span style="float: left"
                                                                                class="badge badge-info">{{ $source['cgi'] ?? 0 }}</span>
                                                                        </td>
                                                                        <td>
                                                                            <span style="float: left"
                                                                                class="badge badge-warning">{{ $source['cnq'] ?? 0 }}</span>
                                                                        </td>
                                                                        <td  style="border-right: 2px solid black;">
                                                                            <span style="float: left;background-color: #002c5f !important;"
                                                                                class="badge">{{  calculatePercentage($source['mql'] ?? 0 ,$source['cql'] ?? 0 ) }}</span>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr style="background: #a36b4f">
                                                                    <th colspan="2">
                                                                        <h5><span style="float: left">Total Count</span></h5>
                                                                    </th>
                                                                    <th><h5><span style="float: left" class="badge badge-primary">{{collect($campaigns_detial_data)->sum('mql') ?? 0}}</span></h5></th>
                                                                    <th><h5><span style="float: left" class="badge badge-success">{{collect($campaigns_detial_data)->sum('cql') ?? 0}}</span></h5></th>
                                                                    <th><h5><span style="float: left" class="badge badge-info">{{collect($campaigns_detial_data)->sum('cgi') ?? 0}}</span></h5></th>
                                                                    <th><h5><span style="float: left" class="badge badge-warning">{{collect($campaigns_detial_data)->sum('cnq') ?? 0}}</span></h5></th>
                                                                    <th><h5><span style="float: left;background-color: #002c5f !important;" class="badge">{{  calculatePercentage(collect($campaigns_detial_data)->sum('mql') ?? 0 ,collect($campaigns_detial_data)->sum('cql') ?? 0 ) }}</span></h5></th>
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
                                    <div class="col-xl-6">
                                        <!--begin::Chart widget 31-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-7 mb-7">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-gray-800">Campaign Performance ({{collect($countsByCampaign)->sum('count') ?? 0}})</span>
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
                                                                                    <h5><span style="float: left">Current Campaigns</span></h5>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $badgeClasses = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                                                    @endphp
                                                                    @foreach ($countsByCampaign as $key => $campaign_wise)
                                                                        <tr class="campaign_wise_row cursor-pointer" data-id="{{ $key }}">
                                                                            <td colspan="2"><span style="float: left"> {{ $campaign_wise['name'] ?? '' }}</span>
                                                                                            <span  style="float: right" class="badge badge-{{Arr::random($badgeClasses)}}">{{ $campaign_wise['count'] ?? 0 }}</span>
                                                                            </td>
                                                                        </tr>

                                                                        <textarea id="campaign_wise_detials_{{ $key }}" style="display: none">
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
                                                                                    @foreach ($campaign_wise['source'] as $source_data)
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
                                                        <div class="tab-pane fade show active" id="content-backtoschool" role="tabpanel" aria-labelledby="tab-backtoschool">
                                                            <div id="source_detials_div"></div>
                                                        </div>
                                                    </div>
                                                <!--end::Chart-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Chart widget 31-->
                                    </div>

                                </div>

                                <div class="row gx-5 gx-xl-10 mt-10 bank-section">
                                        <!--begin::Col-->
                                        <div class="col-xl-6">
                                            <!--begin::Chart widget 31-->
                                            <div class="card card-flush h-xl-100">
                                                <!--begin::Header-->
                                                <div class="card-header pt-7 mb-7">
                                                    <!--begin::Title-->
                                                    <h3 class="card-title align-items-start flex-column">
                                                        <span class="card-label fw-bold text-gray-800">Vehicles Interested ({{collect($vehcile_graph['vehicle_count'])->sum() ?? 0}})</span>
                                                    </h3>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Body-->
                                                <div class="card-body align-items-end pt-0">
                                                    <!--begin::Chart-->
                                                        <div class="tab-content">
                                                            <!-- Backtoschool-2024 Content -->
                                                            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab-backtoschool">
                                                                <table class="table table-striped gy-4 gs-7">
                                                                    <tbody>
                                                                        @php
                                                                            $badgeClasses = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                                                        @endphp
                                                                        @foreach ($vehcile_graph['vehicle_names'] as $key => $vehcile)
                                                                        {{-- {{dd($vehcile_graph['vehicle_names'],$vehcile_graph['vehicle_count'])}} --}}
                                                                            <tr class="" data-id="{{ $key }}">
                                                                                <td colspan="2"><span style="float: left"> {{ $vehcile ?? '' }}</span>
                                                                                                <span  style="float: right" class="badge badge-{{Arr::random($badgeClasses)}}">{{ $vehcile_graph['vehicle_count'][$key] ?? 0 }}</span>
                                                                                </td>
                                                                            </tr>
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
                                                        <span class="card-label fw-bold text-gray-800">Banks  ({{collect($banks_graph)->sum('count') ?? 0}})</span>
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

                                <div class="row gx-5 gx-xl-10 mt-5 bank-section">
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
                                                                    @php
                                                                        $badgeClasses = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                                                    @endphp
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

                                <div class="row gx-5 gx-xl-10 mt-5 bank-section">
                                    <!--begin::Col-->
                                    <div class="col-xl-6">
                                        <!--begin::Chart widget 31-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-7 mb-7">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-gray-800">Monthly
                                                        Salary</span>
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

                                <div class="row gx-5 gx-xl-10 mt-5  bank-section">
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

                                </div>

                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->

                    </div>

                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    {{-- <div id="kt_app_footer" class="app-footer"> --}}
                    <!--begin::Footer container-->
                    {{-- @include('layouts.footer') --}}
                    @include('layouts.footer_scripts')
                    {{-- custom js --}}
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
                        // Chart labels
                        const labels = @json($months);

                        // Chart data
                        const data = {
                            labels: labels,
                            datasets: [{
                                    label: 'Request a Quote ('+ @json($second_graph_data[0]) +')',
                                    data: @json($first_count),
                                    fill: false,
                                    borderColor: primaryColor,
                                    tension: 0.6
                                },
                                {
                                    label: 'Special Offers ('+ @json($second_graph_data[1]) +')',
                                    data: @json($second_count),
                                    fill: false,
                                    borderColor: dangerColor,
                                    tension: 0.6
                                },
                                {
                                    label: 'Request a Test Drive ('+ @json($second_graph_data[2]) +')',
                                    data: @json($third_count),
                                    fill: false,
                                    borderColor: successColor,
                                    tension: 0.6
                                },
                                // {
                                //     label: 'Request a Test Quote ('+ @json($second_graph_data[3]) +')',
                                //     data: @json($fourth_count),
                                //     fill: false,
                                //     borderColor: defaultColor,
                                //     tension: 0.6
                                // },
                                {
                                    label: 'Leads ('+ @json($second_graph_data[4]) +')',
                                    data: @json($fifth_count),
                                    fill: false,
                                    borderColor: primaryColor,
                                    tension: 0.6
                                },
                                // {
                                //     label: 'Events ('+ @json($second_graph_data[5]) +')',
                                //     data: @json($sixth_count),
                                //     fill: false,
                                //     borderColor: successColor,
                                //     tension: 0.6
                                // }
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




                        $(document).ready(function() {
                            // Ensure the div exists before trying to get its content
                            var div = $('#kt_app_content_container');
                            if (div.length > 0) {
                                // Use html2canvas to render the div to a canvas
                                html2canvas(div[0]).then(function(canvas) {
                                    // Convert the canvas to a Base64 string with the correct prefix
                                    var base64Content = canvas.toDataURL("image/png");

                                    // Log the Base64 content to the console
                                    console.log("Base64 Content:", base64Content);
                                }).catch(function(error) {
                                    console.error("Error rendering canvas:", error);
                                });
                            } else {
                                console.warn("Div with id 'kt_app_content_container' not found");
                            }
                        });
                    </script>
                    {{--  custom js end --}}
                    <!--end::Footer container-->
                    {{-- </div> --}}
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>


</body>

</html>
