<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SocialData;
use App\Models\Application;
use App\Models\SalesData;
use Dompdf\Dompdf;
use Dompdf\Options;

class SaleGraphController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:sale-graph-list', ['only' => ['index']]);
        $this->middleware('permission:sale-graph-export', ['only' => ['saleGraphExport']]);
        $this->middleware('permission:sale-graph-comparison-list', ['only' => ['comparisonIndex']]);
        $this->middleware('permission:sale-graph-comparison-export', ['only' => ['saleGraphComparisonExport']]);
        $this->middleware('permission:after-sale-graph-list', ['only' => ['indexAfterSale']]);
        $this->middleware('permission:after-sale-graph-export', ['only' => ['afterSaleGraphExport']]);
        $this->middleware('permission:after-sale-graph-comparison-list', ['only' => ['comparisonIndexAfterSale']]);
        $this->middleware('permission:after-sale-graph-comparison-export', ['only' => ['afterSaleGraphComparisonExport']]);
        $this->middleware('permission:test-drive-list', ['only' => ['testDriveIndex']]);
        $this->middleware('permission:test-drive-export', ['only' => ['testDriveGraphExport']]);
        $this->middleware('permission:online-service-booking-graph-list', ['only' => ['serviceBookingIndex']]);
        $this->middleware('permission:online-service-booking-graph-export', ['only' => ['serviceBookingGraphExport']]);
        $this->middleware('permission:service-offers-graph-list', ['only' => ['serviceOffersIndex']]);
        $this->middleware('permission:service-offers-graph-export', ['only' => ['serviceOffersGraphExport']]);
        $this->middleware('permission:contact-us-graph-list', ['only' => ['contactUsIndex']]);
        $this->middleware('permission:contact-us-graph-export', ['only' => ['contactUsGraphExport']]);
        $this->middleware('permission:used-cars-graph-list', ['only' => ['usedCarsIndex']]);
        $this->middleware('permission:used-cars-graph-export', ['only' => ['usedCarsGraphExport']]);
        $this->middleware('permission:hr-graph-list', ['only' => ['hrIndex']]);
        $this->middleware('permission:hr-graph-export', ['only' => ['hrGraphExport']]);
        $this->middleware('permission:smo-graph-list', ['only' => ['smoIndex']]);
        $this->middleware('permission:smo-graph-export', ['only' => ['smoGraphExport']]);
        $this->middleware('permission:events-graph-list', ['only' => ['eventsIndex']]);
        $this->middleware('permission:events-graph-export', ['only' => ['eventsGraphExport']]);
        $this->middleware('permission:actualsales-graph-list', ['only' => ['eventsIndex']]);
        $this->middleware('permission:actualsales-graph-export', ['only' => ['eventsGraphExport']]);
    }

    public function index(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['request_a_quote'];
        $second_types = ['special_offers'];
        $third_types = ['smo_leads'];
        $fourth_types = ['contact_us'];

        $filters = [
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'vehicle_id' => request('vehicle_id'),
            'source_id' => request('source_id'),
            'campaign_id' => request('campaign_id')
        ];

        $opt_filters = [
            'department' => 'sales_maketing',
        ];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);
        $data['second_count'] = Application::getPerformanceMonthWise($second_types,$startDate,$endDate,$months_diff,$filters);
        $data['third_count'] = Application::getPerformanceMonthWise($third_types,$startDate,$endDate,$months_diff,$filters);
        $data['fourth_count'] = Application::getPerformanceMonthWise($fourth_types,$startDate,$endDate,$months_diff,$filters,$opt_filters);

        $data['second_graph_data'] = [array_sum($data['first_count']), array_sum($data['second_count']), array_sum($data['third_count']),  array_sum($data['fourth_count'])];
        $data['total_performance_count'] = array_sum($data['first_count']) + array_sum($data['second_count']) + array_sum($data['third_count']) + array_sum($data['fourth_count']);

        $all_types = ['request_a_quote', 'special_offers', 'smo_leads', 'contact_us'];
        $data['countsByCampaign'] = Application::getCampaignWiseData($startDate, $endDate, $all_types, $filters);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $all_types, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $all_types, $filters);
        $data['salary_graph'] = Application::countBySalaryGroup($startDate, $endDate, $all_types, $filters);
        $data['purchase_plan_graph'] = Application::countByPurchasePlanGroup($startDate, $endDate, $all_types, $filters);
        $data['banks_graph'] = Application::countByBank($startDate, $endDate, $all_types, $filters);
        $data['dropdown'] = getCommonData();
        //dd($data);

       return view('admin.sale_graph.index' , $data);
    }


    public function exportPdf(Request $request){

        // Generate chart data or fetch from your data source
        $chartData = [
            'labels' => ['January', 'February', 'March', 'April', 'May'],
            'values' => [65, 59, 80, 81, 56],
        ];

        // Render chart view
        $view = view('chart')->with('chartData', $chartData)->render();

        // Create PDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true); // Enable HTML5 parsing
        $options->set('isPhpEnabled', true); // Enable PHP support
        $options->set('defaultFont', 'Arial'); // Set default font (optional)

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($view);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF (save to file or output to browser)
        $dompdf->render();

        // Output the generated PDF (download or display)
        return $dompdf->stream('chart.pdf');

        dd($request->all());
        $data['image'] = $request->page_data;

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('chart-pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // Set paper size and orientation

        $dompdf->render();

        $dompdf->stream('chart.pdf');
    }

    // public function indexPdf(Request $request)
    // {

    //     // $startDate = request('start_date') ?? startDate();
    //     $startDate = request('start_date') ?? '2024-06-01';
    //     $endDate = request('end_date') ?? '2024-06-25';
    //     // $endDate = request('end_date') ?? endDate();
    //     $dates = Application::getPerformanceLabel($startDate,$endDate);
    //     $startDate = $dates['startDate'];
    //     $endDate = $dates['endDate'];
    //     $months_diff = $dates['months_diff'];
    //     $data['months'] = $dates['months'];
    //     $data['startDate'] = $startDate;
    //     $data['endDate'] = $endDate;

    //     $first_types = ['request_a_quote'];
    //     $second_types = ['special_offers'];
    //     $third_types = ['smo_leads'];
    //     $fourth_types = ['contact_us'];

    //     $filters = [
    //         'city_id' => request('city_id'),
    //         'branch_id' => request('branch_id'),
    //         'vehicle_id' => request('vehicle_id'),
    //         'source_id' => request('source_id'),
    //         'campaign_id' => request('campaign_id')
    //     ];

    //     $opt_filters = [
    //         'department' => 'sales_maketing',
    //     ];


    //     $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);
    //     $data['second_count'] = Application::getPerformanceMonthWise($second_types,$startDate,$endDate,$months_diff,$filters);
    //     $data['third_count'] = Application::getPerformanceMonthWise($third_types,$startDate,$endDate,$months_diff,$filters);
    //     $data['fourth_count'] = Application::getPerformanceMonthWise($fourth_types,$startDate,$endDate,$months_diff,$filters,$opt_filters);

    //     $data['second_graph_data'] = [array_sum($data['first_count']), array_sum($data['second_count']), array_sum($data['third_count']),  array_sum($data['fourth_count'])];
    //     $data['total_performance_count'] = array_sum($data['first_count']) + array_sum($data['second_count']) + array_sum($data['third_count']) + array_sum($data['fourth_count']);

    //     $all_types = ['request_a_quote', 'special_offers', 'smo_leads', 'contact_us'];
    //     $data['countsByCampaign'] = Application::getCampaignWiseData($startDate, $endDate, $all_types, $filters);

    //     $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $all_types, $filters);
    //     $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $all_types, $filters);
    //     $data['salary_graph'] = Application::countBySalaryGroup($startDate, $endDate, $all_types, $filters);
    //     $data['purchase_plan_graph'] = Application::countByPurchasePlanGroup($startDate, $endDate, $all_types, $filters);
    //     $data['banks_graph'] = Application::countByBank($startDate, $endDate, $all_types, $filters);

    //    // dd($data);

    //    return view('admin.sale_graph.index-pdf' , $data);
    // }


    public function indexPdf(Request $request)
    {
        $data = [
            "months" => [
                "2024-05-01", "2024-05-02", "2024-05-03", "2024-05-04", "2024-05-05",
                "2024-05-06", "2024-05-07", "2024-05-08", "2024-05-09", "2024-05-10",
                "2024-05-11", "2024-05-12", "2024-05-13", "2024-05-14", "2024-05-15",
                "2024-05-16", "2024-05-17", "2024-05-18", "2024-05-19", "2024-05-20",
                "2024-05-21", "2024-05-22", "2024-05-23", "2024-05-24", "2024-05-25",
                "2024-05-26", "2024-05-27", "2024-05-28", "2024-05-29", "2024-05-30",
                "2024-05-31", "2024-06-01"
            ],
            "startDate" => '2024-05-01',
            "endDate" => '2024-06-01',
            "first_count" => array_fill(0, 32, null),
            "second_count" => array_fill(0, 32, null),
            "third_count" => array_fill(0, 32, null),
            "fourth_count" => array_fill(0, 32, null),
            "second_graph_data" => [55687, 77588, 0, 0],
            "total_performance_count" => 0,
            "countsByCampaign" =>   [
             0=> [
                "campaign_id" => 5,
            "name" => "End-Of-Year23",
            "count" => 133275,
            "source" => [
              0 => [
                "name" => "Other",
                "count" => 133275,
              ]
            ]
             ]
          ],
            "vehcile_graph" => [
                "vehicle_names" => [ 0 => "Sanata"],
                "vehicle_count" => [ 0 => 133275]
            ],
            "citygraph" => [],
            "salary_graph" => [
                "monthly_salary" => [],
                "monthly_salary_count" => []
            ],
            "purchase_plan_graph" => [
                "purchase_plan" => [],
                "purchase_plan_count" => []
            ],
            "banks_graph" =>  [
                0 =>[
                    "bank_id" => 2,
                    "bank_name" => "National Commercial Bank",
                    "count" => 133275,
                ]
            ]
        ];

        return view('admin.sale_graph.index-pdf' , $data);
        return view('admin.sale_graph.chart' , $data);


        $image = "data:image/png;base64,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";

        $data['image'] = $image ;

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        // $html = '<html><body>';
        // $html .= '<img style="width:100%; height:auto;" src="' . $image . '">';
        // $html .= '</body></html>';
        $html = view('chart-pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // Set paper size and orientation

        $dompdf->render();

        $dompdf->stream('chart.pdf');

        //return view('admin.sale_graph.chart' , $data);
        //return view('admin.sale_graph.index-pdf' , $data);
    }

    public function comparisonIndex(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['request_a_quote'];
        $second_types = ['special_offers'];
        $third_types = ['smo_leads'];
        $fourth_types = ['contact_us'];

        $filters = [
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'vehicle_id' => request('vehicle_id'),
            'source_id' => request('source_id'),
            'campaign_id' => request('campaign_id')
        ];

        $opt_filters = [
            'department' => 'sales_maketing',
        ];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);
        $data['second_count'] = Application::getPerformanceMonthWise($second_types,$startDate,$endDate,$months_diff,$filters);
        $data['third_count'] = Application::getPerformanceMonthWise($third_types,$startDate,$endDate,$months_diff,$filters);
        $data['fourth_count'] = Application::getPerformanceMonthWise($fourth_types,$startDate,$endDate,$months_diff,$filters,$opt_filters);

        $data['second_graph_data'] = [array_sum($data['first_count']), array_sum($data['second_count']), array_sum($data['third_count']),  array_sum($data['fourth_count'])];
        $data['total_performance_count'] = array_sum($data['first_count']) + array_sum($data['second_count']) + array_sum($data['third_count']) + array_sum($data['fourth_count']);

        $all_types = ['request_a_quote', 'special_offers', 'smo_leads', 'contact_us'];
        $data['countsByCampaign'] = Application::getCampaignWiseData($startDate, $endDate, $all_types, $filters);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $all_types, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $all_types, $filters);
        $data['salary_graph'] = Application::countBySalaryGroup($startDate, $endDate, $all_types, $filters);
        $data['purchase_plan_graph'] = Application::countByPurchasePlanGroup($startDate, $endDate, $all_types, $filters);
        $data['banks_graph'] = Application::countByBank($startDate, $endDate, $all_types, $filters);
        $data['dropdown'] = getCommonData();
        //dd($data);

        // for right side
        $startDate_comp = request('start_date_comp') ?? startDate();
        $endDate_comp = request('end_date_comp') ?? endDate();
        $dates_comp = Application::getPerformanceLabel($startDate_comp,$endDate_comp);
        $startDate_comp = $dates_comp['startDate'];
        $endDate_comp = $dates_comp['endDate'];
        $months_diff_comp = $dates_comp['months_diff'];
        $data['months_comp'] = $dates_comp['months'];
        $data['startDate_comp'] = $startDate_comp;
        $data['endDate_comp'] = $endDate_comp;

        $first_types_comp = ['request_a_quote'];
        $second_types_comp = ['special_offers'];
        $third_types_comp = ['smo_leads'];
        $fourth_types_comp = ['contact_us'];

        $filters_comp = [
            'city_id' => request('city_id_comp'),
            'branch_id' => request('branch_id_comp'),
            'vehicle_id' => request('vehicle_id_comp'),
            'source_id' => request('source_id_comp'),
            'campaign_id' => request('campaign_id_comp')
        ];

        $opt_filters_comp = [
            'department' => 'sales_maketing',
        ];


        //dd($first_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp);
        $data['first_count_comp'] = Application::getPerformanceMonthWise($first_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp);
        $data['second_count_comp'] = Application::getPerformanceMonthWise($second_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp);
        $data['third_count_comp'] = Application::getPerformanceMonthWise($third_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp);
        $data['fourth_count_comp'] = Application::getPerformanceMonthWise($fourth_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp,$opt_filters_comp);

        $data['second_graph_data_comp'] = [array_sum($data['first_count']), array_sum($data['second_count']), array_sum($data['third_count']),  array_sum($data['fourth_count'])];
        $data['total_performance_count_comp'] = array_sum($data['first_count']) + array_sum($data['second_count']) + array_sum($data['third_count']) + array_sum($data['fourth_count']);

        $all_types_comp = ['request_a_quote', 'special_offers', 'smo_leads', 'contact_us'];
        $data['countsByCampaign_comp'] = Application::getCampaignWiseData($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);

        $data['vehcile_graph_comp'] = Application::getVechileGraph($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);
        $data['citygraph_comp'] = Application::getCityWiseData($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);
        $data['salary_graph_comp'] = Application::countBySalaryGroup($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);
        $data['purchase_plan_graph_comp'] = Application::countByPurchasePlanGroup($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);
        $data['banks_graph_comp'] = Application::countByBank($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);

        //dd($data);
       return view('admin.sale_graph.comparison-index' , $data);
    }

    public function indexAfterSale(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['online_service_booking'];
        $second_types = ['service_offers'];
        $third_types = ['contact_us'];

        $filters = [
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'vehicle_id' => request('vehicle_id')
        ];

        $opt_filters = [
            'department' => 'after_sales',
        ];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);
        $data['second_count'] = Application::getPerformanceMonthWise($second_types,$startDate,$endDate,$months_diff,$filters);
        $data['third_count'] = Application::getPerformanceMonthWise($third_types,$startDate,$endDate,$months_diff,$filters,$opt_filters);

        $data['second_graph_data'] = [array_sum($data['first_count']), array_sum($data['second_count']), array_sum($data['third_count'])];
        $data['total_performance_count'] = array_sum($data['first_count']) + array_sum($data['second_count']) + array_sum($data['third_count']);

        $all_types = ['online_service_booking', 'service_offers', 'contact_us'];
        $data['countsByCampaign'] = Application::getCampaignWiseData($startDate, $endDate, $all_types, $filters);
        $data['dropdown'] = getCommonData();
        //dd($data);

       return view('admin.after_sale_graph.index' , $data);
    }

    public function comparisonIndexAfterSale(Request $request)
    {

        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['online_service_booking'];
        $second_types = ['service_offers'];
        $third_types = ['contact_us'];

        $filters = [
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'vehicle_id' => request('vehicle_id')
        ];

        $opt_filters = [
            'department' => 'after_sales',
        ];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);
        $data['second_count'] = Application::getPerformanceMonthWise($second_types,$startDate,$endDate,$months_diff,$filters);
        $data['third_count'] = Application::getPerformanceMonthWise($third_types,$startDate,$endDate,$months_diff,$filters,$opt_filters);

        $data['second_graph_data'] = [array_sum($data['first_count']), array_sum($data['second_count']), array_sum($data['third_count'])];
        $data['total_performance_count'] = array_sum($data['first_count']) + array_sum($data['second_count']) + array_sum($data['third_count']);

        $all_types = ['online_service_booking', 'service_offers', 'contact_us'];
        $data['countsByCampaign'] = Application::getCampaignWiseData($startDate, $endDate, $all_types, $filters);

        //right side
        $startDate_comp = request('start_date_comp') ?? startDate();
        $endDate_comp = request('end_date_comp') ?? endDate();
        $dates_comp = Application::getPerformanceLabel($startDate_comp,$endDate_comp);
        $startDate_comp = $dates_comp['startDate'];
        $endDate_comp = $dates_comp['endDate'];
        $months_diff_comp = $dates_comp['months_diff'];
        $data['months_comp'] = $dates_comp['months'];
        $data['startDate_comp'] = $startDate_comp;
        $data['endDate_comp'] = $endDate_comp;

        $first_types_comp = ['online_service_booking'];
        $second_types_comp = ['service_offers'];
        $third_types_comp = ['contact_us'];

        $filters_comp = [
            'city_id' => request('city_id_comp'),
            'branch_id' => request('branch_id_comp'),
            'vehicle_id' => request('vehicle_id_comp')
        ];

        $opt_filters_comp = [
            'department' => 'after_sales',
        ];


        $data['first_count_comp'] = Application::getPerformanceMonthWise($first_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp);
        $data['second_count_comp'] = Application::getPerformanceMonthWise($second_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp);
        $data['third_count_comp'] = Application::getPerformanceMonthWise($third_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp,$opt_filters_comp);

        $data['second_graph_data_comp'] = [array_sum($data['first_count_comp']), array_sum($data['second_count_comp']), array_sum($data['third_count_comp'])];
        $data['total_performance_count_comp'] = array_sum($data['first_count_comp']) + array_sum($data['second_count_comp']) + array_sum($data['third_count_comp']);

        $all_types_comp = ['online_service_booking', 'service_offers', 'contact_us'];
        $data['countsByCampaign_comp'] = Application::getCampaignWiseData($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);

        $data['dropdown'] = getCommonData();

       return view('admin.after_sale_graph.comparison-index' , $data);
    }


    public function testDriveIndex(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['request_a_test_drive'];

        $filters = [
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'vehicle_id' => request('vehicle_id')
        ];

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['second_graph_data'] = [array_sum($data['first_count'])];
        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['preferred_time_graph'] = Application::countByPreferredAppointmentTime($startDate, $endDate,$first_types, $filters);
        $data['city_graph'] = Application::countByCity($startDate, $endDate, $first_types, $filters);
        $data['dropdown'] = getCommonData();

       return view('admin.test_drive.index' , $data);
    }

    public function serviceBookingIndex(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['online_service_booking'];

        $filters = [
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'vehicle_id' => request('vehicle_id')
        ];

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $first_types, $filters);
        $data['dropdown'] = getCommonData();

       return view('admin.service_booking.index' , $data);
    }



    public function serviceOffersIndex(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['service_offers'];

        $filters = [
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'vehicle_id' => request('vehicle_id')
        ];

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['countsByCampaign'] = Application::getCampaignWiseData($startDate, $endDate, $first_types, $filters);
        $data['dropdown'] = getCommonData();

       return view('admin.service_offers.index' , $data);
    }

    public function contactUsIndex(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['contact_us'];

        $filters = [
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'vehicle_id' => request('vehicle_id')
        ];

        $opt_filters = [
            'department' => 'after_sales',
        ];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters,$opt_filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $first_types, $filters);
        $data['dropdown'] = getCommonData();

       return view('admin.contact_us.index' , $data);
    }

    public function usedCarsIndex(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['used_cars'];

        $filters = [
        ];

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['preferred_time_graph'] = Application::countByPreferredAppointmentTime($startDate, $endDate,$first_types, $filters);
        $data['dropdown'] = getCommonData();

       return view('admin.used_car.graph_index' , $data);
    }

    public function hrIndex(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['career'];

        $filters = [
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id')
        ];

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['preferred_time_graph'] = Application::countByPreferredAppointmentTime($startDate, $endDate,$first_types, $filters);
        $data['dropdown'] = getCommonData();

       return view('admin.hr.index' , $data);
    }


    public function smoIndex(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['smo_leads'];

        $filters = [
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'vehicle_id' => request('vehicle_id'),
            'source_id' => request('source_id')
        ];

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $first_types, $filters);
        $data['dropdown'] = getCommonData();

       return view('admin.smo_lead.graph_index' , $data);
    }

    public function eventsIndex(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $first_types = ['events'];

        $filters = [
            'city_id' => request('city_id'),
            'branch_id' => request('branch_id'),
            'vehicle_id' => request('vehicle_id'),
            'source_id' => request('source_id'),
            'campaign_id' => request('campaign_id')
        ];

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $first_types, $filters);
        $data['dropdown'] = getCommonData();

       return view('admin.events.graph_index' , $data);
    }

    public function actualsalesGraphIndex(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $filters = [
            'department' => request('department'),
            'vehicle_id' => request('vehicle_id'),
        ];

        $data['first_count'] = SalesData::getMonthWiseData($startDate,$endDate,$months_diff,$filters);
        $data['actual_sales_data'] = SalesData::getActualSalesData($startDate,$endDate,$filters);
        // for right side
        $startDate_comp = request('start_date_comp') ?? startDate();
        $endDate_comp = request('end_date_comp') ?? endDate();
        $dates_comp = Application::getPerformanceLabel($startDate_comp,$endDate_comp);
        $startDate_comp = $dates_comp['startDate'];
        $endDate_comp = $dates_comp['endDate'];
        $months_diff_comp = $dates_comp['months_diff'];
        $data['months_comp'] = $dates_comp['months'];
        $data['startDate_comp'] = $startDate_comp;
        $data['endDate_comp'] = $endDate_comp;


        if(request('department_2') == 'Sales'){
            $second_types = ['request_a_test_quote','request_a_quote','special_offers','leads','events'];
            $opt_filters = [ 'department' => 'sales_maketing'] ;

        }elseif(request('department_2') == 'Aftersales'){
            $second_types = ['online_service_booking','service_offers','contact_us'];
            $opt_filters = [ 'department' => 'after_sales' ];

        }else{
            $second_types = ['request_a_test_quote','request_a_quote','special_offers','leads','events','online_service_booking','service_offers','contact_us'];
            $opt_filters = [];
        }

        $filters_comp = [
            'department' => request('department_2'),
            'vehicle_id' => request('vehicle_id_comp'),
        ];

        $data['second_count'] = SalesData::getPerformanceMonthWise($second_types,$startDate_comp,$endDate_comp,$months_diff,$filters_comp,$opt_filters);
        $data['digital_compaign_Leads'] = SalesData::getDigitalCompaignVechileWise($second_types,$startDate,$endDate,$filters_comp);

        $data['total_performance_count'] = array_sum($data['first_count']) + array_sum($data['second_count']['counts']);
        if(count($data['second_count']['customerIds']) > 0){
            $customer_ids = explode(',',$data['second_count']['customerIds'][0]);
        }else{
            $customer_ids = [];
        }

        $data['getLeadsConversions'] = SalesData::getLeadsConversions($startDate,$endDate,$filters,$customer_ids);
        //dd($getLeadsConversions);
        //dd(array_sum($getLeadsConversions));

        if(array_sum($data['second_count']['counts'])){
            $percent = array_sum($data['first_count']) / array_sum($data['second_count']['counts']);
            $data['percent_friendly'] = number_format( $percent * 100, 2 ) . '%';
        }else{
            $data['percent_friendly'] = 0;
        }
        $data['dropdown'] = getCommonData();

       return view('admin.actual_sales.graph_index' , $data);
    }


}
