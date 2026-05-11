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



                                <div class="row g-5 g-xl-10 mb-5 bank-section">
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
                                                    <div class="col-sm-6 col-xl-4 mb-xl-10">
                                                        <div class="sales-leads-card" style="background: #FF6384">
                                                            <div>
                                                                <p class="value">{{ $second_graph_data[0] ?? 0 }}</p>
                                                                <p class="label">Online Service Booking</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="bi bi-geo-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4 mb-xl-10">
                                                        <div class="sales-leads-card" style="background: #FF9F40">
                                                            <div>
                                                                <p class="value">{{ $second_graph_data[1] ?? 0 }}</p>
                                                                <p class="label">Service Offers</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="bi bi-geo-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4 mb-xl-10">
                                                        <div class="sales-leads-card" style="background: #9966FF">
                                                            <div>
                                                                <p class="value">{{ $second_graph_data[2] ?? 0 }}</p>
                                                                <p class="label">Contact Us </p>
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
                                                                                                    <h5><span style="float: left">Current Campaigns</span></h5>
                                                                                        </th>
                                                                                    </tr>
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

                                <div class="row gx-5 gx-xl-10 mt-5 bank-section">
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
                            const labels = @json($months) ;

                            // Chart data
                            const data = {
                                labels: labels,
                                datasets: [{
                                        label: 'Online Service Booking (' + @json($second_graph_data[0]) + ')',
                                        data: @json($first_count) ,
                                        fill: false,
                                        borderColor: primaryColor,
                                        tension: 0.6
                                    },
                                    {
                                        label: 'Service Offers (' + @json($second_graph_data[1]) + ')',
                                        data: @json($second_count) ,
                                        fill: false,
                                        borderColor: dangerColor,
                                        tension: 0.6
                                    },
                                    {
                                        label: 'Contact Us (' + @json($second_graph_data[2]) + ')',
                                        data: @json($third_count) ,
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



                        // Example data
                          // Function to generate a random color
                        function getRandomColor() {
                            var letters = '0123456789ABCDEF';
                            var color = '#';
                            for (var i = 0; i < 6; i++) {
                                color += letters[Math.floor(Math.random() * 16)];
                            }
                            return color;
                        }

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

                        // Chart options
                        var options8 = {
                        series: [{
                            data: seriesData8
                        }],
                        chart: {
                            type: 'bar',
                            height: 650
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
