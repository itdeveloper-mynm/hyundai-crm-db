<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class GraphController extends Controller
{

    public function indexPdf(Request $request)
    {

        // $startDate = request('start_date') ?? startDate();
        $startDate = request('start_date') ?? '2024-06-01';
        $endDate = request('end_date') ?? '2024-06-25';
        // $endDate = request('end_date') ?? endDate();
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

       // dd($data);

       return view('admin.sale_graph.index-pdf' , $data);
    }

    // public function indexPdf(Request $request)
    // {
    //     $data = [
    //         "months" => [
    //             "2024-06-01", "2024-06-02", "2024-06-03", "2024-06-04", "2024-06-05",
    //             "2024-06-06", "2024-06-07", "2024-06-08", "2024-06-09", "2024-06-10",
    //             "2024-06-11", "2024-06-12", "2024-06-13", "2024-06-14", "2024-06-15",
    //             "2024-06-16", "2024-06-17", "2024-06-18", "2024-06-19", "2024-06-20",
    //             "2024-06-21", "2024-06-22", "2024-06-23", "2024-06-24", "2024-06-25"
    //         ],
    //         "startDate" => '2024-06-01',
    //         "endDate" => '2024-06-25',
    //         "first_count" => [
    //             15, 40, 26, 36, 35,
    //             35, 26, 22, 46, 34,
    //             28, 33, 18, 8, 6,
    //             3, null, null, null, null,
    //             null, null, 7, 24, null
    //         ],
    //         "second_count" => [
    //             223, 331, 270, 249, 227,
    //             213, 220, 381, 374, 274,
    //             343, 313, 238, 212, 24,
    //             22, null, null, null, null,
    //             null, null, 20, 270, null
    //         ],
    //         "third_count" => array_fill(0, 32, null),
    //         "fourth_count" => array_fill(0, 32, null),
    //         "second_graph_data" => [55687, 77588, 0, 0],
    //         "total_performance_count" => 0,
    //         "countsByCampaign" =>   [
    //          0=> [
    //             "campaign_id" => 5,
    //         "name" => "End-Of-Year23",
    //         "count" => 133275,
    //         "source" => [
    //           0 => [
    //             "name" => "Other",
    //             "count" => 133275,
    //           ]
    //         ]
    //          ]
    //       ],
    //         "vehcile_graph" => [
    //             "vehicle_names" => [ 0 => "Sanata"],
    //             "vehicle_count" => [ 0 => 133275]
    //         ],
    //         "citygraph" => [],
    //         "salary_graph" => [
    //             "monthly_salary" => [],
    //             "monthly_salary_count" => []
    //         ],
    //         "purchase_plan_graph" => [
    //             "purchase_plan" => [],
    //             "purchase_plan_count" => []
    //         ],
    //         "banks_graph" =>  [
    //             0 =>[
    //                 "bank_id" => 2,
    //                 "bank_name" => "National Commercial Bank",
    //                 "count" => 133275,
    //             ]
    //         ]
    //     ];

    //     return view('admin.sale_graph.index-pdf' , $data);

    // }

}
