<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SocialData;
use App\Models\Application;

class SaleGraphController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $startDate = request('start_date');
        $endDate = request('end_date');
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

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $filters);
        $data['salary_graph'] = Application::countBySalaryGroup($startDate, $endDate, $filters);
        $data['purchase_plan_graph'] = Application::countByPurchasePlanGroup($startDate, $endDate, $filters);
        $data['banks_graph'] = Application::countByBank($startDate, $endDate, $filters);
        $data['dropdown'] = getCommonData();
        //dd($data);

       return view('sale_graph.index' , $data);
    }

    public function comparisonIndex(Request $request)
    {
        $startDate = request('start_date');
        $endDate = request('end_date');
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

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $filters);
        $data['salary_graph'] = Application::countBySalaryGroup($startDate, $endDate, $filters);
        $data['purchase_plan_graph'] = Application::countByPurchasePlanGroup($startDate, $endDate, $filters);
        $data['banks_graph'] = Application::countByBank($startDate, $endDate, $filters);
        $data['dropdown'] = getCommonData();
        //dd($data);

        // for right side
        $startDate_comp = request('start_date_comp');
        $endDate_comp = request('end_date_comp');
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

        $data['vehcile_graph_comp'] = Application::getVechileGraph($startDate_comp, $endDate_comp, $filters_comp);
        $data['citygraph_comp'] = Application::getCityWiseData($startDate_comp, $endDate_comp, $filters_comp);
        $data['salary_graph_comp'] = Application::countBySalaryGroup($startDate_comp, $endDate_comp, $filters_comp);
        $data['purchase_plan_graph_comp'] = Application::countByPurchasePlanGroup($startDate_comp, $endDate_comp, $filters_comp);
        $data['banks_graph_comp'] = Application::countByBank($startDate_comp, $endDate_comp, $filters_comp);

        //dd($data);
       return view('sale_graph.comparison-index' , $data);
    }


}
