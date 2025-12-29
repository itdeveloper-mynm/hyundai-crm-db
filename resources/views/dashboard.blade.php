@extends('layouts.master')

@section('title', 'Dashboard')

@section('css')

    <style>

.nested-sources {
            display: none;
            margin-top: 10px;
            margin-bottom: 10px;
            border-top: 1px solid #ddd;
        }
        .nested-sources table {
            width: 100%;
            border-collapse: collapse;
        }
        .nested-sources td, .nested-sources th {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .active-tr {
            background-color: #6495ED;
            color: white !important;
        }

        table tbody {
            border-bottom: 1px solid #505060 !important;
        }

        .social-card {
            border-radius: 8px;
            padding: 10px;
            color: #fff;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .social-card .icon {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .social-card .stat-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .social-card .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .social-card .stat-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            opacity: 0.8;
        }

        .facebook {
            background-color: #3b5998;
        }

        .twitter {
            background-color: #1da1f2;
        }

        .linkedin {
            background-color: #0077b5;
        }

        .youtube {
            background-color: #ff0000;
        }

        .social-card.instagram {
            background: linear-gradient(45deg, #f58529, #dd2a7b, #8134af, #515bd4);
            color: white;
        }

        i {
            line-height: 1;
            font-size: 2rem;
            color: white;
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
                    <div class="row mt-5">
                        <div class="col-lg-4">
                            <div id="kt_app_toolbar_container" class="d-flex flex-stack">

                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <h1
                                        class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                        Dashboard</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex justify-content-end">
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

                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-600px" data-kt-menu="true"
                                id="kt_menu_62fe86549b38d">
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <form method="POST" action="{{ route('dashboard') }}"
                                    class="form d-flex flex-column flex-lg-row" id="myForm">
                                    @csrf

                                    <div class="px-7 py-5">
                                        <div class="mb-3">
                                            {{-- @can('sale-graph-filters') --}}
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
                                                {{-- <div class="col-lg-4">
                                                    @include('admin.common_files_filters.created_by')
                                                </div>
                                                <div class="col-lg-4">
                                                    @include('admin.common_files_filters.updated_by')
                                                </div> --}}
                                            </div>
                                            {{-- @endcan --}}
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
                                                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary"
                                                        data-kt-menu-dismiss="true" value="reset" id="reset">Reset</a>
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

            <div class="row gx-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Leads Performance</span>
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


            <div class="row g-5 g-xl-10 mb-5">
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
                                    <div class="sales-leads-card" style="background: #009EF7">
                                        <div>
                                            <p class="value">{{ $second_graph_data[0] ?? 0 }}</p>
                                            <p class="label">Sales</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3 mb-xl-10">
                                    <div class="sales-leads-card" style="background: #F1416C">
                                        <div>
                                            <p class="value">{{ $second_graph_data[1] ?? 0 }}</p>
                                            <p class="label">Test Drive</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3 mb-xl-10">
                                    <div class="sales-leads-card" style="background: #323639">
                                        <div>
                                            <p class="value">{{ $second_graph_data[4] ?? 0 }}</p>
                                            <p class="label">Aftersales</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3 mb-xl-10">
                                    <div class="sales-leads-card" style="background: #50CD89">
                                        <div>
                                            <p class="value">{{ $second_graph_data[2] ?? 0 }}</p>
                                            <p class="label">Used Cars</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3 mb-xl-10">
                                    <div class="sales-leads-card" style="background: #4BC0C0">
                                        <div>
                                            <p class="value">{{ $second_graph_data[3] ?? 0 }}</p>
                                            <p class="label">SMO Leads</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-3 mb-xl-10">
                                    <div class="sales-leads-card" style="background: #9966FF">
                                        <div>
                                            <p class="value">{{ $second_graph_data[5] ?? 0 }}</p>
                                            <p class="label">CRM Leads</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5 g-xl-10 mb-5">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Card widget 20-->
                    <div class="card card-bordered">
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Social Media Performance</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <div class="card-body">
                            <div class="row g-5 g-xl-10">
                                <!--begin::Col-->
                                <!--end::Col-->
                                <!-- Facebook -->
                                <div class="col-sm-6 col-xl-2 mb-xl-5">
                                    <div class="social-card facebook">
                                        <div class="icon">
                                            <i class="bi bi-facebook" style="color:none"></i>
                                        </div>
                                        <div class="stat-row">
                                            <div>
                                                <p class="stat-value">{{ $socialData['Facebook'][0]['followers'] ?? 0 }}
                                                </p>
                                                <p class="stat-label">Followers</p>
                                            </div>
                                            <div>
                                                <p class="stat-value">{{ $socialData['Facebook'][0]['likes'] ?? 0 }}</p>
                                                <p class="stat-label">Likes</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Twitter -->
                                <div class="col-sm-6 col-xl-2 mb-xl-5">
                                    <div class="social-card twitter">
                                        <div class="icon">
                                            <i class="bi bi-twitter"></i>
                                        </div>
                                        <div class="stat-row">
                                            <div>
                                                <p class="stat-value">{{ $socialData['Twitter'][0]['followers'] ?? 0 }}
                                                </p>
                                                <p class="stat-label">Followers</p>
                                            </div>
                                            <div>
                                                <p class="stat-value">{{ $socialData['Twitter'][0]['tweets'] ?? 0 }}</p>
                                                <p class="stat-label">Tweets</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- LinkedIn -->
                                <div class="col-sm-6 col-xl-2 mb-xl-5">
                                    <div class="social-card linkedin">
                                        <div class="icon">
                                            <i class="bi bi-linkedin"></i>
                                        </div>
                                        <div class="stat-row d-block">
                                            <div>
                                                <p class="stat-value">{{ $socialData['Linkedin'][0]['followers'] ?? 0 }}
                                                </p>
                                                <p class="stat-label">Followers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- YouTube -->
                                <div class="col-sm-6 col-xl-2 mb-xl-5">
                                    <div class="social-card youtube">
                                        <div class="icon">
                                            <i class="bi bi-youtube"></i>
                                        </div>
                                        <div class="stat-row d-block">
                                            <div>
                                                <p class="stat-value">{{ $socialData['Youtube'][0]['followers'] ?? 0 }}
                                                </p>
                                                <p class="stat-label">Followers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Instagram -->
                                <div class="col-sm-6 col-xl-2 mb-xl-5">
                                    <!-- Instagram Card -->
                                    <div class="social-card instagram" style="background: linear-gradient(45deg, #f58529, #dd2a7b, #8134af, #515bd4); color: white;">
                                        <div class="icon">
                                            <i class="bi bi-instagram"></i>
                                        </div>
                                        <div class="stat-row d-block">
                                            <div>
                                                <p class="stat-value">{{ $socialData['Instagram'][0]['followers'] ?? 0 }}</p>
                                                <p class="stat-label">Followers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>




            {{-- <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Card widget 20-->
                    <div class="card card-bordered">
                        <div class="card-body">
                            <div id="graph_2" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Input from CRM Team</span>
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



            <div class="row gx-5 gx-xl-10 mt-5">
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
                                            @php
                                                $badgeClasses = [
                                                    'primary',
                                                    'success',
                                                    'info',
                                                    'warning',
                                                    'danger',
                                                    'dark',
                                                ];
                                            @endphp
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
                <div class="col-xxl-12 mb-5 mb-xl-5">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Sales Vehicles Interested</span>
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
                                    <div id="graph_7" style="height: 350px;"></div>
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


            <div class="row gx-5 gx-xl-10 mt-5">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Chart widget 31-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Aftersales Leads Performance
                                    ({{ collect($countsByCampaignAfterSales)->sum('count') ?? 0 }})</span>
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
                                            @php
                                                $badgeClasses = [
                                                    'primary',
                                                    'success',
                                                    'info',
                                                    'warning',
                                                    'danger',
                                                    'dark',
                                                ];
                                            @endphp
                                            @foreach ($countsByCampaignAfterSales as $key => $campaign_wise)
                                                <tr class="campaign_wise_comp_row cursor-pointer"
                                                    data-id="{{ $key }}">
                                                    <td colspan="2"><span style="float: left">
                                                            {{ $campaign_wise['name'] ?? '' }}</span>
                                                        <span style="float: right"
                                                            class="badge badge-{{ Arr::random($badgeClasses) }}">{{ $campaign_wise['count'] ?? 0 }}</span>
                                                    </td>
                                                </tr>

                                                <textarea id="campaign_wise_comp_detials_{{ $key }}" style="display: none">
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
                                    <div id="source_detials_comp_div"></div>
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
                <div class="col-xxl-12 mb-5 mb-xl-5">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">After Sales Vehicles Interested</span>
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
                                    <div id="graph_8" style="height: 350px;"></div>
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

            <div class="row gx-5 gx-xl-10 mt-5">
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
                            <canvas id="graph_5" class="mh-400px"></canvas>
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


            {{-- <div class="row g-5 g-xl-10 mb-5 mb-xl-10 mt-5">
                <!--begin::Col-->
                <div class="col-xxl-12 mb-5 mb-xl-10">
                    <!--begin::Chart widget 8-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Overview of Sources</span>
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
                                    <div id="graph_4" style="height: 350px;"></div>
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




            {{-- <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-100">
                        <!--begin::Body-->
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <!--begin::Icon-->
                            <div class="m-0">
                                <img src="{{ asset('login_asset') }}/assets/media/svg/brand-logos/facebook-3.svg"
                                    class="w-35px" alt="">
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div style="display: flex;align-items:center;justify-content:space-between; width: 100%">
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span
                                        class="fw-semibold fs-2x text-gray-800 lh-1 ls-n2">{{ $socialData['Facebook'][0]['followers'] ?? 0 }}</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-semibold fs-6 text-gray-400">Followers</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <div class="d-flex flex-column">
                                    <!--end::Follower-->
                                    <!--begin::Number-->
                                    <span
                                        class="fw-semibold fs-2x text-gray-800 lh-1 ls-n2">{{ $socialData['Facebook'][0]['likes'] ?? 0 }}</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-semibold fs-6 text-gray-400">Likes</span>
                                    </div>
                                </div>
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
                            <!--begin::Icon-->
                            <div class="m-0">
                                <img src="{{ asset('login_asset') }}/assets/media/svg/brand-logos/twitter.svg"
                                    class="w-35px" alt="">
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div style="display: flex;align-items:center;justify-content:space-between; width: 100%">
                                <div class="d-flex flex-column my-7">
                                    <!--begin::Number-->
                                    <span
                                        class="fw-semibold fs-2x text-gray-800 lh-1 ls-n2">{{ $socialData['Twitter'][0]['followers'] ?? 0 }}</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-semibold fs-6 text-gray-400">Followers</span>
                                    </div>
                                    <!--end::Follower-->
                                </div>
                                <div class="d-flex flex-column">
                                    <!--end::Follower-->
                                    <!--begin::Number-->
                                    <span
                                        class="fw-semibold fs-2x text-gray-800 lh-1 ls-n2">{{ $socialData['Twitter'][0]['tweets'] ?? 0 }}</span>
                                    <!--end::Number-->
                                    <!--begin::Follower-->
                                    <div class="m-0">
                                        <span class="fw-semibold fs-6 text-gray-400">Tweets</span>
                                    </div>
                                </div>
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
                            <!--begin::Icon-->
                            <div class="m-0">
                                <img src="{{ asset('login_asset') }}/assets/media/svg/brand-logos/linkedin-2.svg"
                                    class="w-35px" alt="">
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Number-->
                                <span
                                    class="fw-semibold fs-2x text-gray-800 lh-1 ls-n2">{{ $socialData['Linkedin'][0]['followers'] ?? 0 }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-400">Followers</span>
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
                            <!--begin::Icon-->
                            <div class="m-0">
                                <img src="{{ asset('login_asset') }}/assets/media/svg/brand-logos/youtube-3.svg"
                                    class="w-40px" alt="">
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Number-->
                                <span
                                    class="fw-semibold fs-2x text-gray-800 lh-1 ls-n2">{{ $socialData['Youtube'][0]['followers'] ?? 0 }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-400">Followers</span>
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
            </div> --}}


            {{-- orignal --}}
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

        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection


@section('js')

    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

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
        const labels = @json($months);

        // Chart data
        const data = {
            labels: labels,
            datasets: [{
                    label: 'Sales (' + @json($second_graph_data[0]) + ')',
                    data: @json($first_count),
                    fill: false,
                    borderColor: primaryColor,
                    tension: 0.6,
                },
                {
                    label: 'Test Drive (' + @json($second_graph_data[1]) + ')',
                    data: @json($second_count),
                    fill: false,
                    borderColor: dangerColor,
                    tension: 0.6
                },
                {
                    label: 'Used Cars (' + @json($second_graph_data[2]) + ')',
                    data: @json($third_count),
                    fill: false,
                    borderColor: successColor,
                    tension: 0.6
                },
                {
                    label: 'SMO (' + @json($second_graph_data[3]) + ')',
                    data: @json($fourth_count),
                    fill: false,
                    borderColor: "#4BC0C0",
                    tension: 0.6
                },
                {
                    label: 'Aftersales (' + @json($second_graph_data[4]) + ')',
                    data: @json($fifth_count),
                    fill: false,
                    borderColor: defaultColor,
                    tension: 0.6
                },
                {
                    label: 'CrmLeads (' + @json($second_graph_data[5]) + ')',
                    data: @json($sixth_count),
                    fill: false,
                    borderColor: "#9966FF",
                    tension: 0.6
                },
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
                                // const value = tooltipItem.raw;
                                // if (value === 0) {
                                //     return '';
                                // }
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
                // elements: {
                //     line: {
                //         spanGaps: true,
                //     }
                // },
                defaults: {
                    global: {
                        defaultFont: fontFamily
                    }
                }
            }
        };


        // Init ChartJS -- for more info, please visit: https://www.chartjs.org/docs/latest/
        var myChart = new Chart(ctx, config);



        ////second chart

        // var options = {
        //     series: [{
        //         name: 'Count',
        //         data: @json($second_graph_data)
        //     }],
        //     chart: {
        //         height: 350,
        //         type: 'bar',
        //     },
        //     plotOptions: {
        //         bar: {
        //             borderRadius: 10,
        //             dataLabels: {
        //                 position: 'top', // top, center, bottom
        //             },
        //         }
        //     },
        //     dataLabels: {
        //         enabled: true,
        //         formatter: function(val) {
        //             return val;
        //         },
        //         offsetY: -20,
        //         style: {
        //             fontSize: '12px',
        //             colors: ["#304758", '#546E7A']
        //         }
        //     },

        //     xaxis: {
        //         categories: ["Sales", "Test Drive", "Service Booking", "Service Offers", "Used Cars"],
        //         position: 'top',
        //         axisBorder: {
        //             show: false
        //         },
        //         axisTicks: {
        //             show: false
        //         },
        //         crosshairs: {
        //             fill: {
        //                 type: 'gradient',
        //                 gradient: {
        //                     colorFrom: '#D8E3F0',
        //                     colorTo: '#BED1E6',
        //                     stops: [0, 100],
        //                     opacityFrom: 0.4,
        //                     opacityTo: 0.5,
        //                 }
        //             }
        //         },
        //         tooltip: {
        //             enabled: true,
        //         }
        //     },
        //     yaxis: {
        //         axisBorder: {
        //             show: false
        //         },
        //         axisTicks: {
        //             show: false,
        //         },
        //         labels: {
        //             show: false,
        //             formatter: function(val) {
        //                 return val;
        //             }
        //         }

        //     },
        //     title: {
        //         text: 'Departments Overall Leads',
        //         floating: true,
        //         offsetY: 330,
        //         align: 'center',
        //         style: {
        //             color: '#444'
        //         }
        //     }
        // };

        // var chart = new ApexCharts(document.querySelector("#graph_2"), options);
        // chart.render();


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
        var chart6 = new ApexCharts(document.querySelector("#graph_3"), options6);
        chart6.render();


        var xData4 = @json($sources_graph['sources_names']);
        var yData4 = @json($sources_graph['sources_count']);

        // Generate random fill colors
        var fillColors = Array.from({
            length: xData4.length
        }, () => getRandomColor());

        // Create series data
        // var seriesData4 = xData4.map((x, index) => ({
        //     x: x,
        //     y: yData4[index],
        //     fill: fillColors[index]
        // }));

        // Chart options
        // var options4 = {
        //     series: [{
        //         data: seriesData4
        //     }],
        //     chart: {
        //         type: 'bar',
        //         height: 350
        //     },
        //     plotOptions: {
        //         bar: {
        //             horizontal: true,
        //             distributed: true
        //         }
        //     },
        //     dataLabels: {
        //         enabled: true
        //     },
        //     xaxis: {
        //         categories: xData4.map((x, index) => `${x} (${yData4[index]})`),
        //         labels: {
        //             formatter: function(val) {
        //                 return val;
        //             }
        //         }
        //     }
        // };

        // // Render the chart
        // var chart4 = new ApexCharts(document.querySelector("#graph_4"), options4);
        // chart4.render();


        var ctx1 = document.getElementById('graph_5');

        const data1 = {
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


             // Example data
        var xData7 = @json($sale_vehcile_graph['vehicle_names']) ;
        var yData7 = @json($sale_vehcile_graph['vehicle_count']) ;

        // Generate random fill colors
        var fillColors7 = Array.from({ length: xData7.length }, () => getRandomColor());

        // Create series data
        var seriesData7 = xData7.map((x, index) => ({
        x: x,
        y: yData7[index],
        fill: fillColors7[index]
        }));

        // Function to generate a random color

        // Chart options
        var options7 = {
        series: [{
            data: seriesData7
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
            categories: xData7.map((x, index) => `${x} (${yData7[index]})`),
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
        var chart7 = new ApexCharts(document.querySelector("#graph_7"), options7);
        chart7.render();


             // Example data
        var xData8 = @json($after_sale_vehcile_graph['vehicle_names']) ;
        var yData8 = @json($after_sale_vehcile_graph['vehicle_count']) ;

        // Generate random fill colors
        var fillColors8 = Array.from({ length: xData8.length }, () => getRandomColor());

        // Create series data
        var seriesData8 = xData8.map((x, index) => ({
        x: x,
        y: yData8[index],
        fill: fillColors8[index]
        }));

        // Function to generate a random color

        // Chart options
        var options8 = {
        series: [{
            data: seriesData8
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
            categories: xData8.map((x, index) => `${x} (${yData8[index]})`),
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
        var chart8 = new ApexCharts(document.querySelector("#graph_8"), options8);
        chart8.render();

        // $(document).ready(function () {
        //     $(".campaign_wise_row:first-child").click();
        // });



        // $(".campaign_wise_row").on("click", function () {
        //     // Get the value of the data-id attribute
        //     var dataId = $(this).data("id");
        //     var detials = $('#campaign_wise_detials_' +dataId).val();
        //     $('#source_detials_div').html(detials);
        //     console.log("Data ID:", dataId);
        //     // Remove the 'active-tr' class from all .campaign_wise_row elements
        //     $(".campaign_wise_row").removeClass("active-tr");

        //     // Add the 'active-tr' class to the clicked element
        //     $(this).addClass("active-tr");
        // });
    </script>

@endsection
