<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Log;

class GraphController extends Controller
{

    public function indexPdf(Request $request)
    {

        $datecheck = $request->chk;
        $response=setDateRange($datecheck);
        $startDate =$response->original['startDate'];
        $endDate =$response->original['endDate'];
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

    public function indexAfterSalePdf(Request $request)
    {
        $datecheck = $request->chk;
        $response=setDateRange($datecheck);
        $startDate =$response->original['startDate'];
        $endDate =$response->original['endDate'];
        // $startDate = request('start_date') ?? '2024-06-01';
        //$startDate = request('start_date') ?? startDate();
        //$endDate = request('end_date') ?? endDate();
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

        return view('admin.after_sale_graph.index-pdf' , $data);
    }

    public function crmleadsPdf(Request $request)
    {
        //dd($request->all());
        $datecheck = $request->chk;
        $response=setDateRange($datecheck);
        $startDate =$response->original['startDate'];
        $endDate =$response->original['endDate'];
        // $startDate = request('start_date') ?? '2024-06-01';

        // $startDate = request('start_date') ?? startDate();
        // $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        //dd($dates);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;


        $first_types = ['crm_leads'];

        $filters = $request->all();
        // dd($filters);

        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);
        $data['total_performance_count'] = array_sum($data['first_count']);
        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate,$first_types,$filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate,$first_types, $filters);
        $data['salary_graph'] = Application::countBySalaryGroup($startDate, $endDate,$first_types,$filters);
        $data['purchase_plan_graph'] = Application::countByPurchasePlanGroup($startDate, $endDate,$first_types,$filters);
        //dd($data);
       return view('admin.crn_lead.index-pdf' , $data);
    }


}
