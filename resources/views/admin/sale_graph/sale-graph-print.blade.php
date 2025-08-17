<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hyundai MYNM-Marketing Performance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #FFFFFF;
            font-family: 'Inter', sans-serif;
        }

        .header {
            background-color: #97C7FF;
            color: white;
            padding: 1rem 1.5rem;
            /* position: sticky; */
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .kpi-card {
            background-color: #F7F9FB;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 1.2rem;
            flex-grow: 1;
        }

        .kpi-title {
            font-size: 0.85rem;
            color: #007fa8;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .kpi-value {
            font-size: 1.6rem;
            font-weight: 600;
        }

        .change-up {
            color: blue;
            font-size: 0.85rem;
        }

        .change-down {
            color: red;
            font-size: 0.85rem;
        }

        .no-data {
            color: #999;
            font-style: italic;
        }

        .border-right {
            border-right: 1px solid #dee2e6;
        }

        .label-box {
            width: 100px;
            background-color: #f1f3f5;
            font-weight: 600;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            height: 100%;
        }

        /* Region Cards */
        .region-card {
            background: linear-gradient(to right, #f7f9fb, #ffffff);
            border-left: 5px solid #007fa8;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            transition: all 0.3s ease-in-out;
            height: 100%;
        }

        .region-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.08);
        }

        .region-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #007fa8;
            margin-bottom: 1rem;
            border-bottom: 1px solid #e2e6ea;
            padding-bottom: 0.5rem;
        }

        .metric-box {
            padding: 0.5rem 0;
            text-align: center;
            border-right: 1px solid #dee2e6;
        }

        .metric-box:last-child {
            border-right: none;
        }

        .metric-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: #6c757d;
            margin-bottom: 0.3rem;
            font-weight: 500;
        }

        .metric-value {
            font-size: 1rem;
            font-weight: 600;
            background-color: #eaf4ff;
            border-radius: 12px;
            display: inline-block;
            padding: 4px 10px;
            min-width: 60px;
            color: #0d1b2a;
        }

        .metric-value.campaign {
            background-color: #6473AC;
            color: #fff;
            font-weight: 600;
            border-radius: 12px;
            padding: 4px 10px;
            display: inline-block;
            min-width: 60px;
            box-shadow: 0 1px 3px rgba(47, 70, 156, 0.2);
        }

        .chart-container {
            position: relative;
            width: 100%;
            min-height: 300px;
            /* ensures some height */
            height: auto;
            /* grows with content */
        }

        .chart-wrapper {
            position: relative;
            width: 100%;
            background: #ebedf7;
            border-top: 5px solid #2F469C;
            border-radius: 10px;
            padding: 0.1rem;
        }

        canvas {
            width: 100% !important;
            display: block;
        }

        .bank-section {
            page-break-inside: avoid;

        }


        .sales-leads-card {
            background-color: #FF6F91;
            /* Pink color */
            color: white;
            padding: 10px;
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

        @media print {
            @page {
                size: A4 portrait;
                margin: 10mm;
            }

            body {
                margin: 0 !important;
                padding: 0 !important;
                font-size: 10px !important;
                /* transform: scale(0.75); */
                /* transform-origin: top left; */
            }

            .kpi-card .row {
                display: flex !important;
                flex-wrap: nowrap !important;
                margin: 0 !important;
            }

            .kpi-card .col-md {
                flex: 1 1 0% !important;
                /* Each column takes equal space */
                border-right: 1px solid #ccc;
                padding: 6px 8px !important;
                text-align: center;
            }

            .kpi-card .col-md:last-child {
                border-right: none !important;
            }

            .kpi-title,
            .kpi-value,
            .change-down {
                font-size: 9px !important;
                line-height: 1.2;
                margin: 0;
            }

            .mb-4 {
                margin-bottom: 0 !important;
            }

            .row.align-items-stretch {
                margin: 0 !important;
            }

            .label-box {
                font-size: 10px !important;
                padding: 6px !important;
                margin-right: 6px !important;
                border: 1px solid #ccc;
                white-space: nowrap;
            }

            .col-auto {
                display: flex !important;
                align-items: center !important;
                justify-content: center;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* make only that row a flex container */
            .campaign-overview {
                display: flex !important;
                flex-wrap: nowrap !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* ANY column inside it becomes exactly 25% wide */
            .campaign-overview>[class*="col-"] {
                flex: 0 0 25% !important;
                max-width: 25% !important;
                padding: 0 4px !important;
                /* small gutter */
                box-sizing: border-box;
            }

            /* stretch each card fully into its 25% slot */
            .campaign-overview .sales-leads-card {
                width: 100% !important;
                margin: 0 !important;
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }

            /* ensure your vibrant backgrounds print */
            *,
            *::before,
            *::after {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }



            .kpi-card .kpi-title,
            .kpi-card .kpi-value,
            .label-box,
            .sales-leads-card .value,
            .sales-leads-card .label {
                font-size: 12px !important;
            }

            .kpi-card .row {
                flex-wrap: nowrap !important;
            }

            .kpi-card .col-md {
                padding: 6px !important;
            }

            .sales-leads-card {
                padding: 8px !important;
            }

            .sales-leads-card .value {
                font-size: 16px !important;
            }

            .sales-leads-card .label {
                font-size: 9px !important;
            }

            canvas.default {
                max-height: 100px !important;
            }

            canvas.default2 {
                max-height: 250px !important;
            }

            canvas {
                max-height: 350px !important;
            }

            .hide-for-print {
                display: none !important;
            }

            /* .bank-section,
            .row,
            .kpi-card,
            .sales-leads-card {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            } */

            .campaign-block-for-print {
                page-break-before: always;
                break-before: page;
            }

            .campaign-block-for-print:first-child {
                page-break-before: auto;
                break-before: auto;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header d-flex justify-content-between align-items-center">
        <h4 class="m-0">Hyundai MYNM-Marketing Performance</h4>
    </div>

    <div class="container-fluid mt-4">
        <h5 style="font-weight: 600; color: #333;">YTD Performance</h5>

        <!-- KPI Overview Section -->
        <div class="row align-items-stretch mb-4">
            <div class="col-auto d-flex align-items-center">
                <div class="label-box h-100">Total</div>
            </div>
            <div class="col">
                <!-- <h5 style="font-weight: 600; color: #333;">KPI Overview</h5> -->
                <div class="kpi-card">
                    <div class="row text-center">
                        <div class="col-md border-right">
                            <div class="kpi-title">MQL</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['yearly_ytd_count']['mql'] }}</div>
                            {{-- <div class="change-down">▼ 3.6%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">SQL</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['yearly_ytd_count']['cql'] }}</div>
                            {{-- <div class="change-down">▼ 3.1%p</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">SGI</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['yearly_ytd_count']['cgi'] }}</div>
                            {{-- <div class="change-down">▼ 1.6%p</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">SNQ</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['yearly_ytd_count']['cnq'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">Unreach</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['yearly_ytd_count']['unreach'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">PCL</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['yearly_ytd_count']['pcl'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">Inv</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['yearly_ytd_count']['inv'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">CRM(%)</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['yearly_ytd_count']['conversion'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">Sale(%)</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['yearly_ytd_count']['sale_conversion'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="mt-3" style="font-weight: 600; color: #333;">MTD Performance</h5>

        <!-- KPI Overview Section -->
        <div class="row align-items-stretch mb-4">
            <div class="col-auto d-flex align-items-center">
                <div class="label-box h-100">Total</div>
            </div>
            <div class="col">
                <!-- <h5 style="font-weight: 600; color: #333;">KPI Overview</h5> -->
                <div class="kpi-card">
                    <div class="row text-center">
                        <div class="col-md border-right">
                            <div class="kpi-title">MQL</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['filter_mtd_count']['mql'] }}</div>
                            {{-- <div class="change-down">▼ 3.6%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">SQL</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['filter_mtd_count']['cql'] }}</div>
                            {{-- <div class="change-down">▼ 3.1%p</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">SGI</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['filter_mtd_count']['cgi'] }}</div>
                            {{-- <div class="change-down">▼ 1.6%p</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">SNQ</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['filter_mtd_count']['cnq'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">Unreach</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['filter_mtd_count']['unreach'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">PCL</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['filter_mtd_count']['pcl'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">Inv</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['filter_mtd_count']['inv'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">CRM(%)</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['filter_mtd_count']['conversion'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                        <div class="col-md border-right">
                            <div class="kpi-title">Sale(%)</div>
                            <div class="my-2" style="border-bottom: 1px solid black"></div>
                            <div class="kpi-value">{{ $data['filter_mtd_count']['sale_conversion'] }}</div>
                            {{-- <div class="change-down">▼ 16.2%</div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Compact KPI Definitions -->
        <div class="kpi-definitions small text-muted my-3 text-center">
            <span><strong>MQL</strong> = Marketing Qualified Leads</span> |
            <span><strong>SQL</strong> = Sales Qualified Leads</span> |
            <span><strong>SGI</strong> = Sales General Enquiry</span> |
            <span><strong>SNQ</strong> = Sales Not Qualified</span> |
            <span><strong>PCL</strong> = Pending CRM Lead</span>
        </div>


        <h5 class="mt-3" style="font-weight: 700; color: #2F469C;">Overview</h5>

        <div class="row">
            <div class="col-sm-2 col-xl-2 mb-xl-10">
                <div class="sales-leads-card" style="background: #009EF7">
                    <div>
                        <p class="value">{{ array_sum($data['first_count']) }}</p>
                        <p class="label">Request a Quote</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-xl-2 mb-xl-10">
                <div class="sales-leads-card" style="background: #F1416C">
                    <div>
                        <p class="value">{{ array_sum($data['second_count']) }}</p>
                        <p class="label">Special Offers</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xl-2 mb-xl-10">
                <div class="sales-leads-card" style="background: #50CD89">
                    <div>
                        <p class="value">{{ array_sum($data['third_count']) }}</p>
                        <p class="label">Request a Test Drive</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-xl-2 mb-xl-10">
                <div class="sales-leads-card" style="background: #666666">
                    <div>
                        <p class="value">{{ array_sum($data['fifth_count']) }}</p>
                        <p class="label">Leads</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 col-xl-2 mb-xl-10">
                <div class="sales-leads-card" style="background: #2A3F87">
                    <div>
                        <p class="value">{{ array_sum($data['other_count']) }}</p>
                        <p class="label">Others</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 mt-4 mb-4 bank-section g-4 d-flex align-items-stretch">
            <div class="col d-flex">
                <div class="chart-wrapper p-3 w-100 border-end">
                    <h6
                        style="color: #2F469C; font-weight: 700; border-bottom: 1px dashed #6473AC; padding-bottom: 0.5rem;">
                        Marketing Campaign</h6>
                    <canvas class="default" id="graph_6" style="max-height: 250px;"></canvas>
                </div>
            </div>
            <div class="col d-flex">
                <div class="chart-wrapper p-3 w-100">
                    <h6
                        style="color: #2F469C; font-weight: 700; border-bottom: 1px dashed #6473AC; padding-bottom: 0.5rem;">
                        Performance by City</h6>
                    <canvas class="default" id="graph_7" style="max-height: 250px;"></canvas>
                </div>
            </div>

            {{-- <div class="d-flex">
                <div class="col d-flex">
                    <div class="chart-wrapper p-3 w-100 border-end">
                        <h6
                            style="color: #2F469C; font-weight: 700; border-bottom: 1px dashed #6473AC; padding-bottom: 0.5rem;">
                            Monthly Salary</h6>
                        <canvas class="default" id="graph_10" style="max-height: 250px;"></canvas>
                    </div>
                </div>

                <div class="col d-flex">
                    <div class="chart-wrapper p-3 w-100">
                        <h6
                            style="color: #2F469C; font-weight: 700; border-bottom: 1px dashed #6473AC; padding-bottom: 0.5rem;">
                            Purchased Plan</h6>
                        <canvas class="default" id="graph_11" style="max-height: 250px;"></canvas>
                    </div>
                </div>
            </div> --}}

            <div class="col d-flex">
                <div class="chart-wrapper p-3 w-100">
                    <h6
                        style="color: #2F469C; font-weight: 700; border-bottom: 1px dashed #6473AC; padding-bottom: 0.5rem;">
                        Performance by Vehciles</h6>
                    <canvas class="default2" id="graph_8"></canvas>
                </div>
            </div>

            <div class="col d-flex">
                <div class="chart-wrapper p-3 w-100">
                    <h6
                        style="color: #2F469C; font-weight: 700; border-bottom: 1px dashed #6473AC; padding-bottom: 0.5rem;">
                        Performance by Channels</h6>
                    <canvas class="default2" id="graph_9"></canvas>
                </div>
            </div>
        </div>

        <div
            class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mt-4 mb-4 bank-section g-4 d-flex align-items-stretch hide-for-print">


        </div>


        <!-- <h5 class="mt-3  bank-section" style="font-weight: 600; color: #333;">Cities Overview</h5>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 mb-10 bank-section">
      <div class="col mb-5">
        <div class="region-card h-100">
          <div class="region-title">Jeddah</div>
          <div class="row text-center">
            <div class="col metric-box"><div class="metric-title">MQL</div><div class="metric-value">252</div></div>
            <div class="col metric-box"><div class="metric-title">SQL</div><div class="metric-value">37</div></div>
            <div class="col metric-box"><div class="metric-title">SGI</div><div class="metric-value">0</div></div>
            <div class="col metric-box"><div class="metric-title">SNQ</div><div class="metric-value">0</div></div>
            <div class="col metric-box"><div class="metric-title">Unreach</div><div class="metric-value">0</div></div>
            <div class="col metric-box"><div class="metric-title">PCL</div><div class="metric-value">215</div></div>
            <div class="col metric-box"><div class="metric-title">CRM Conv</div><div class="metric-value">12%</div></div>
            <div class="col metric-box"><div class="metric-title">INV</div><div class="metric-value">1</div></div>
            <div class="col metric-box"><div class="metric-title">Sale Conv</div><div class="metric-value">14.68%</div></div>
          </div>
        </div>
      </div>
      <div class="col mb-5">
        <div class="region-card h-100">
          <div class="region-title">Makkah</div>
          <div class="row text-center">
            <div class="col metric-box"><div class="metric-title">MQL</div><div class="metric-value">111</div></div>
            <div class="col metric-box"><div class="metric-title">SQL</div><div class="metric-value">8</div></div>
            <div class="col metric-box"><div class="metric-title">SGI</div><div class="metric-value">0</div></div>
            <div class="col metric-box"><div class="metric-title">SNQ</div><div class="metric-value">0</div></div>
            <div class="col metric-box"><div class="metric-title">Unreach</div><div class="metric-value">103</div></div>
            <div class="col metric-box"><div class="metric-title">PCL</div><div class="metric-value">103</div></div>
            <div class="col metric-box"><div class="metric-title">CRM Conv</div><div class="metric-value">13%</div></div>
            <div class="col metric-box"><div class="metric-title">INV</div><div class="metric-value">0</div></div>
            <div class="col metric-box"><div class="metric-title">Sale Conv</div><div class="metric-value">14.68%</div></div>
          </div>
        </div>
      </div>
    </div> -->

        <h5 class="mt-3 bank-section hide-for-print" style="font-weight: 700; color: #2F469C;">Campaign Detial
            Overview</h5>

        @foreach ($allCampaignDetails as $index => $campaign)
            @php
                $graphIdPrefix = 'campaign_' . $index;
            @endphp
            <div class="campaign-block-for-print mt-2">
                <div class="row row-12 g-4 bank-section">
                    <!-- Campaign A -->
                    <div class="col">
                        <div class="p-3"
                            style="background: #ebedf7; border-top: 5px solid #2F469C; border-radius: 10px;">
                            <h6
                                style="color: #2F469C; font-weight: 700; border-bottom: 1px dashed #6473AC; padding-bottom: 0.5rem;">
                                Campaign ({{ $campaign['campaign']['campaign_name'] }})</h6>
                            <div class="row text-center">
                                <div class="col metric-box">
                                    <div class="metric-title">MQL</div>
                                    <div class="metric-value campaign">{{ $campaign['summary']['mql'] }}</div>
                                </div>
                                <div class="col metric-box">
                                    <div class="metric-title">SQL</div>
                                    <div class="metric-value campaign">{{ $campaign['summary']['cql'] }}</div>
                                </div>
                                <div class="col metric-box">
                                    <div class="metric-title">SGI</div>
                                    <div class="metric-value campaign">{{ $campaign['summary']['cgi'] }}</div>
                                </div>
                                <div class="col metric-box">
                                    <div class="metric-title">SNQ</div>
                                    <div class="metric-value campaign">{{ $campaign['summary']['cnq'] }}</div>
                                </div>
                                <div class="col metric-box">
                                    <div class="metric-title">Unreach</div>
                                    <div class="metric-value campaign">{{ $campaign['summary']['unreach'] }}</div>
                                </div>
                                <div class="col metric-box">
                                    <div class="metric-title">PCL</div>
                                    <div class="metric-value campaign">{{ $campaign['summary']['pcl'] }}</div>
                                </div>
                                <div class="col metric-box">
                                    <div class="metric-title">CRM Conv</div>
                                    <div class="metric-value campaign">{{ $campaign['summary']['conversion'] }}</div>
                                </div>
                                <div class="col metric-box">
                                    <div class="metric-title">INV</div>
                                    <div class="metric-value campaign">{{ $campaign['summary']['inv'] }}</div>
                                </div>
                                <div class="col metric-box">
                                    <div class="metric-title">Sale Conv</div>
                                    <div class="metric-value campaign">{{ $campaign['summary']['sale_conversion'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 mt-4 mb-4">
                    <div class="col">
                        <div class="chart-wrapper p-3">
                            <h6
                                style="color: #2F469C; font-weight: 700; border-bottom: 1px dashed #6473AC; padding-bottom: 0.5rem;">
                                Cities</h6>
                            <canvas id="{{ $graphIdPrefix }}_cities"></canvas>
                        </div>
                    </div>
                    <div class="col">
                        <div class="chart-wrapper p-3">
                            <h6
                                style="color: #2F469C; font-weight: 700; border-bottom: 1px dashed #6473AC; padding-bottom: 0.5rem;">
                                Branches</h6>
                            <canvas id="{{ $graphIdPrefix }}_branches"></canvas>
                        </div>
                    </div>
                    <div class="col">
                        <div class="chart-wrapper p-3">
                            <h6
                                style="color: #2F469C; font-weight: 700; border-bottom: 1px dashed #6473AC; padding-bottom: 0.5rem;">
                                Vehicles</h6>
                            <canvas id="{{ $graphIdPrefix }}_vehicles"></canvas>
                        </div>
                    </div>
                    <div class="col">
                        <div class="chart-wrapper p-3">
                            <h6
                                style="color: #2F469C; font-weight: 700; border-bottom: 1px dashed #6473AC; padding-bottom: 0.5rem;">
                                Channels</h6>
                            <canvas id="{{ $graphIdPrefix }}_channels"></canvas>
                        </div>
                    </div>
                    <div class="col">
                        <div class="chart-wrapper">
                            <canvas id="{{ $graphIdPrefix }}_salary"></canvas>
                        </div>
                    </div>
                    <div class="col">
                        <div class="chart-wrapper">
                            <canvas id="{{ $graphIdPrefix }}_plan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mt-4 mb-4">

        </div> --}}


    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>


</body>
<script>
    let vehicleAnalysisChartInstance = null; // Global chart instance for reuse/destroy
    const marketingOverview = @json($marketingOverview);
    const cityGraphData = @json($cityGraph);
    const SalaryGraphData = @json($salary_graph);
    const purchasePlanGraph = @json($purchase_plan_graph);
    const vehcileGraph = @json($vehcile_graph);
    const sourceGrapgh = @json($source_grapgh);
    const allCampaignDetails = @json($allCampaignDetails);


    allCampaignDetails.forEach((campaign, index) => {
        const graphIdPrefix = 'campaign_' + index;

        // ================= CITIES =================
        renderVehicleAnalysisChart({
            vehicle_names: campaign.cities.map(c => c.city_name),
            mql: campaign.cities.map(c => parseInt(c.mql)),
            cql: campaign.cities.map(c => parseInt(c.cql)),
            cnq: campaign.cities.map(c => parseInt(c.cnq)),
            cgi: campaign.cities.map(c => parseInt(c.cgi)),
            mql_total: campaign.summary.mql,
            cql_total: campaign.summary.cql,
            cnq_total: campaign.summary.cnq,
            cgi_total: campaign.summary.cgi,
        }, graphIdPrefix + '_cities');

        // ================= BRANCHES =================
        renderVehicleAnalysisChart({
            vehicle_names: campaign.branches.map(b => b.branch_name),
            mql: campaign.branches.map(b => parseInt(b.mql)),
            cql: campaign.branches.map(b => parseInt(b.cql)),
            cnq: campaign.branches.map(b => parseInt(b.cnq)),
            cgi: campaign.branches.map(b => parseInt(b.cgi)),
            mql_total: campaign.summary.mql,
            cql_total: campaign.summary.cql,
            cnq_total: campaign.summary.cnq,
            cgi_total: campaign.summary.cgi,
        }, graphIdPrefix + '_branches');

        // ================= VEHICLES =================
        renderVehicleAnalysisChart({
            vehicle_names: campaign.vehicles.map(v => v.vehicle_name),
            mql: campaign.vehicles.map(v => parseInt(v.mql)),
            cql: campaign.vehicles.map(v => parseInt(v.cql)),
            cnq: campaign.vehicles.map(v => parseInt(v.cnq)),
            cgi: campaign.vehicles.map(v => parseInt(v.cgi)),
            mql_total: campaign.summary.mql,
            cql_total: campaign.summary.cql,
            cnq_total: campaign.summary.cnq,
            cgi_total: campaign.summary.cgi,
        }, graphIdPrefix + '_vehicles');

        // ================= CHANNELS =================
        renderVehicleAnalysisChart({
            vehicle_names: campaign.channels.map(s => s.source_name),
            mql: campaign.channels.map(s => parseInt(s.mql)),
            cql: campaign.channels.map(s => parseInt(s.cql)),
            cnq: campaign.channels.map(s => parseInt(s.cnq)),
            cgi: campaign.channels.map(s => parseInt(s.cgi)),
            mql_total: campaign.summary.mql,
            cql_total: campaign.summary.cql,
            cnq_total: campaign.summary.cnq,
            cgi_total: campaign.summary.cgi,
        }, graphIdPrefix + '_channels');

        // ================= SALARY =================

        renderSalaryDoughnutChart(
            campaign.salaries.map(s => s.name),
            campaign.salaries.map(s => s.value),
            graphIdPrefix + '_salary'
        );

        // Render Purchase Plan
        renderPurchasePlanPieChart(
            campaign.purchase_plans.map(p => p.name),
            campaign.purchase_plans.map(p => p.value),
            graphIdPrefix + '_plan'
        );
    });

    function renderVehicleAnalysisChart(vehicle_graph_data, target) {
        var labels = vehicle_graph_data.vehicle_names;
        const data = {
            // labels: vehicle_graph_data.vehicle_names,
            labels: labels,
            datasets: [{
                    label: 'Total MQL (' + vehicle_graph_data.mql_total + ')',
                    data: vehicle_graph_data.mql,
                    backgroundColor: "#F97316",
                    barThickness: 15,
                    categoryPercentage: 15,
                    barPercentage: 0.5
                },
                {
                    label: 'Qualified (' + vehicle_graph_data.cql_total + ')',
                    data: vehicle_graph_data.cql,
                    backgroundColor: "#9CA3AF",
                    barThickness: 15,
                    categoryPercentage: 15,
                    barPercentage: 0.5
                },
                {
                    label: 'Not Qualified (' + vehicle_graph_data.cnq_total + ')',
                    data: vehicle_graph_data.cnq,
                    backgroundColor: "#FACC15",
                    barThickness: 15,
                    categoryPercentage: 15,
                    barPercentage: 0.5
                },
                {
                    label: 'General Inquiry (' + vehicle_graph_data.cgi_total + ')',
                    data: vehicle_graph_data.cgi,
                    backgroundColor: "#2563EB",
                    barThickness: 15,
                    categoryPercentage: 15,
                    barPercentage: 0.5
                }
            ]
        };

        const options = {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true
                }
            }
        };

        // Destroy previous chart instance if it exists
        // if (vehicleAnalysisChartInstance) {
        //     vehicleAnalysisChartInstance.destroy();
        // }

        // const canvas = document.getElementById('vehicleChart');
        const canvas = document.getElementById(target);

        // const ctx = document.getElementById('vehicleChart');

        // Dynamically calculate height based on number of vehicles
        // const barHeight = 35; // or adjust to 40/60 based on spacing preference
        // canvas.height = labels.length * barHeight;
        const barHeight = 45;
        const minHeight = 160; // force at least one bar to be visible
        canvas.height = Math.max(labels.length * barHeight, minHeight);


        const ctx = canvas.getContext('2d');

        vehicleAnalysisChartInstance = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });

    }


    let salaryChartInstance = null; // Global chart instance for reuse/destroy

    // function renderSalaryDoughnutChart(labels, dataValues) {
    //     const backgroundColors = [
    //         'rgb(255, 99, 132)',
    //         'rgb(54, 162, 235)',
    //         'rgb(255, 205, 86)',
    //         'rgb(255, 99, 132)',
    //         'rgb(54, 162, 235)'
    //     ];

    //     const data = {
    //         labels: labels,
    //         datasets: [{
    //             label: 'Dataset',
    //             data: dataValues,
    //             backgroundColor: backgroundColors
    //         }]
    //     };

    //     const config = {
    //         type: 'doughnut',
    //         data: data,
    //         options: {
    //             responsive: true,
    //             plugins: {
    //                 legend: {
    //                     position: 'top',
    //                     labels: {
    //                         generateLabels: function(chart) {
    //                             const chartData = chart.data;
    //                             return chartData.labels.map((label, index) => {
    //                                 const value = chartData.datasets[0].data[index];
    //                                 return {
    //                                     text: `${label} (${value})`,
    //                                     fillStyle: chartData.datasets[0].backgroundColor[index],
    //                                     index: index
    //                                 };
    //                             });
    //                         }
    //                     }
    //                 },
    //                 title: {
    //                     display: false,
    //                     text: 'Pie Chart'
    //                 }
    //             }
    //         }
    //     };

    //     // Destroy previous chart instance if it exists
    //     if (salaryChartInstance) {
    //         salaryChartInstance.destroy();
    //     }

    //     const ctx = document.getElementById('graph_4');
    //     salaryChartInstance = new Chart(ctx, config);
    // }
    function renderSalaryDoughnutChart(labels, dataValues, canvasId) {
        const backgroundColors = [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(153, 102, 255)',
            'rgb(255, 159, 64)'
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Salary Groups',
                data: dataValues,
                backgroundColor: backgroundColors
            }]
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
                            generateLabels: function(chart) {
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
                        text: 'Monthly Salary'
                    }
                }
            }
        };

        const ctx = document.getElementById(canvasId);
        if (ctx) {
            new Chart(ctx, config);
        }
    }

    let purchasePlanChartInstance = null; // Global chart instance for reuse/destroy

    // function renderPurchasePlanPieChart(labels, dataValues) {
    //     const backgroundColors = [
    //         'rgb(255, 99, 132)',
    //         'rgb(54, 162, 235)',
    //         'rgb(255, 205, 86)',
    //         'rgb(255, 99, 132)',
    //         'rgb(54, 162, 235)'
    //     ];

    //     const data = {
    //         labels: labels,
    //         datasets: [{
    //             label: 'Dataset',
    //             data: dataValues,
    //             backgroundColor: backgroundColors
    //         }]
    //     };

    //     const config = {
    //         type: 'pie',
    //         data: data,
    //         options: {
    //             responsive: true,
    //             plugins: {
    //                 legend: {
    //                     position: 'top',
    //                     labels: {
    //                         generateLabels: function(chart) {
    //                             const chartData = chart.data;
    //                             return chartData.labels.map((label, index) => {
    //                                 const value = chartData.datasets[0].data[index];
    //                                 return {
    //                                     text: `${label} (${value})`,
    //                                     fillStyle: chartData.datasets[0].backgroundColor[index],
    //                                     index: index
    //                                 };
    //                             });
    //                         }
    //                     }
    //                 },
    //                 title: {
    //                     display: false,
    //                     text: 'Pie Chart'
    //                 }
    //             }
    //         }
    //     };

    //     // Destroy previous chart instance if it exists
    //     if (purchasePlanChartInstance) {
    //         purchasePlanChartInstance.destroy();
    //     }

    //     const ctx = document.getElementById('graph_5');
    //     purchasePlanChartInstance = new Chart(ctx, config);
    // }
    function renderPurchasePlanPieChart(labels, dataValues, canvasId) {
        const backgroundColors = [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)'
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Purchase Plan',
                data: dataValues,
                backgroundColor: backgroundColors
            }]
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
                            generateLabels: function(chart) {
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
                        text: 'Purchase Plan'
                    }
                }
            }
        };

        const ctx = document.getElementById(canvasId);
        if (ctx) {
            new Chart(ctx, config);
        }
    }


    function renderCampCityPieChart(target, dataset) {
        const labels = dataset.map(item => `${item.name} (${item.value})`);
        const dataValues = dataset.map(item => parseInt(item.value));

        const data = {
            labels: labels,
            datasets: [{
                data: dataValues,
                backgroundColor: [
                    '#2A3F87', '#5B6FB4', '#A9B9EC',
                    '#E3D8CB', '#C1B5A9', '#888275',
                    '#FFB347', '#FF6961', '#77DD77', '#AEC6CF'
                ],
                hoverOffset: 30
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                cutout: '50%',
                layout: {
                    padding: 0
                },
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 25,
                            padding: 10
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value) => `${value}`
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                return `${label}: ${value}`;
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        };

        const canvas = document.getElementById(target);
        if (canvas) {
            new Chart(canvas, config);
        }
    }



    function renderVehcilePerformanceChart(labels, data, target) {

        // document.getElementById(target).height = labels.length * 40;
        const canvas = document.getElementById(target);
        const canvasHeight = labels.length * 25;
        canvas.height = canvasHeight;
        canvas.style.height = canvasHeight + 'px';

        const ctx = canvas.getContext('2d');

        // const ctx = document.getElementById(target).getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pageviews',
                    data: data,
                    backgroundColor: '#adcff1',
                    borderColor: '#7fb1e0',
                    borderWidth: 1,
                }]
            },
            options: {
                indexAxis: 'y',
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'right',
                        color: '#000',
                        font: {
                            weight: 'bold'
                        },
                        formatter: (value) => value
                    },
                    legend: {
                        display: false
                    },
                    title: {
                        display: false
                    }
                },
                layout: {
                    padding: {
                        right: 20 // Increase this if needed
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 10000 // slightly more than your largest value (8547)
                    },
                    y: {
                        ticks: {
                            autoSkip: false
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    }

    var vehicle_graph = {
        "vehicle_names": [
            "Elantra",
            "Accent",
            "Sonata",
            "Tucson",
            "Creta",
            "Azera",
            "Santa FE",
            "Kona",
            "Grand i10",
            "Venue",

        ],
        "mql": [
            2495,
            1885,
            976,
            754,
            727,
            621,
            417,
            288,
            210,
            189,
            141,

        ],
        "cql": [
            "930",
            "650",
            "392",
            "280",
            "263",
            "211",
            "136",
            "111",
            "65",
            "78",
            "58",
        ],
        "cnq": [
            "101",
            "110",
            "18",
            "16",
            "18",
            "13",
            "7",
            "11",
            "12",
            "7",
        ],
        "cgi": [
            "216",
            "143",
            "91",
            "55",
            "85",
            "66",
            "26",
            "23",
            "18",
            "18",
        ],
        "mql_total": 8992,
        "cql_total": 3309,
        "cnq_total": 326,
        "cgi_total": 772
    };


    const dataset1 = [{
            campaign_name: 'Summer 2025',
            mql: 8225
        },
        {
            campaign_name: 'Winter 2025',
            mql: 3000
        }
    ];

    const dataset2 = [{
            campaign_name: 'Spring 2025',
            mql: 5000
        },
        {
            campaign_name: 'Autumn 2025',
            mql: 4000
        }
    ];

    const dataset3 = [{
            campaign_name: 'Holiday Blast',
            mql: 7200
        },
        {
            campaign_name: 'Year End',
            mql: 6100
        }
    ];

    const dataset4 = [{
            name: 'Black Friday',
            value: 8500
        },
        {
            name: 'Cyber Monday',
            value: 7700
        }
    ];


    var monthly_salary_labels = ["Above 10,000", "Below 5,000", "Between 5,000 and 10,000", "Cash Deal"];
    var monthly_salary_dataValues = [403, 207, 1020, 78];
    var purchase_plan_labels = ["1 Month", "2 Months", "2-3 Months", "After 3 months"];
    var purchase_plan_dataValues = [999, 65, 538, 109];

    // renderVehicleAnalysisChart(vehicle_graph, 'vehicleChart');
    // renderVehicleAnalysisChart(vehicle_graph, 'vehicleChart1');
    // renderVehicleAnalysisChart(vehicle_graph, 'vehicleChart2');
    // renderVehicleAnalysisChart(vehicle_graph, 'vehicleChart3');
    // renderSalaryDoughnutChart(monthly_salary_labels, monthly_salary_dataValues);
    // renderPurchasePlanPieChart(purchase_plan_labels, purchase_plan_dataValues);

    renderVehcilePerformanceChart(vehcileGraph.vehicle_names, vehcileGraph.vehicle_count, 'graph_8');
    renderVehcilePerformanceChart(sourceGrapgh.names, sourceGrapgh.counts, 'graph_9');

    renderCampCityPieChart('graph_6', marketingOverview);
    renderCampCityPieChart('graph_7', cityGraphData);
    renderCampCityPieChart('graph_10', SalaryGraphData);
    renderCampCityPieChart('graph_11', purchasePlanGraph);
</script>

</html>
