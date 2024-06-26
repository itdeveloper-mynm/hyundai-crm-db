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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous">


</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true"
    class="app-default">
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

                                <div class="row gx-5 gx-xl-10" id="campaign">
                                    <!--begin::Col-->
                                    <div class="col-xxl-12 mb-5 mb-xl-10">
                                        <!--begin::Chart widget 8-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-5">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-dark">Campaign Performance</span>
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
                                                    <span class="card-label fw-bold text-dark">City</span>
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
                                    <div class="col-xl-4">
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
                                    <div class="col-xl-4">
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

                                    <div class="col-xl-4">
                                        <!--begin::Chart widget 31-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-7">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bold text-gray-800">Banks</span>
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
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->

                    </div>

                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <div id="kt_app_footer" class="app-footer">
                        <!--begin::Footer container-->
                        @include('layouts.footer')
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
                                        label: 'Smo Leads ('+ @json($second_graph_data[2]) +')',
                                        data: @json($third_count),
                                        fill: false,
                                        borderColor: successColor,
                                        tension: 0.6
                                    },
                                    {
                                        label: 'Contact Us (Sales & Marketing) ('+ @json($second_graph_data[3]) +')',
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


                            ////second chart

                            var options = {
                                series: [{
                                    name: 'Count',
                                    data:  @json($second_graph_data)
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
                                categories: xData,
                            }
                            };

                            // Render the chart
                            var chart = new ApexCharts(document.querySelector("#graph_3"), options);
                            chart.render();


                            var ctx1 = document.getElementById('graph_4');

                            const data1 = {
                            labels: @json($salary_graph['monthly_salary']) ,
                            datasets: [
                                {
                                label: 'Dataset',
                                data: @json($salary_graph['monthly_salary_count']) ,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    ],
                                }
                            ]
                            };


                            const config1 = {
                            type: 'doughnut',
                            data: data1,
                            options: {
                                    responsive: true,
                                    plugins: {
                                    legend: {
                                        position: 'top',
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
                        labels: @json($purchase_plan_graph['purchase_plan']) ,
                        datasets: [
                            {
                            label: 'Dataset',
                            data: @json($purchase_plan_graph['purchase_plan_count']) ,
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)',
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                ],
                            }
                        ]
                        };


                        const config2 = {
                        type: 'pie',
                        data: data2,
                        options: {
                                responsive: true,
                                plugins: {
                                legend: {
                                    position: 'top',
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
                    </div>
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
