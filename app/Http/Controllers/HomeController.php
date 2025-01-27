<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SocialData;
use App\Models\Application;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        // dd($dates);
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $sale_types = ['request_a_test_quote','request_a_quote','special_offers','leads','events'];
        $test_drive_types = ['request_a_test_drive'];
        $used_cars_types = ['used_cars'];
        $smo_leads_types = ['smo_leads'];
        $after_sales_types = ['online_service_booking', 'service_offers', 'contact_us'];
        $crm_leads_types = ['crm_leads'];

        // $filters = [];

        // comments
        //sales Vehicles Interested graph same used in home page overview below the section of Sales Leads Perfomance
        //afte sales Vehicles Interested graph same used in home page overview below the section of Aftersales Leads Performance
        // instagram box addition for Social Media Performance

        $filters = $request->all();

        $opt_filters = [
            // 'department' => 'aftersales',
        ];


        $data['first_count'] = Application::getPerformanceMonthWise($sale_types,$startDate,$endDate,$months_diff,$filters);
        $data['second_count'] =Application::getPerformanceMonthWise($test_drive_types,$startDate,$endDate,$months_diff,$filters);
        $data['third_count'] = Application::getPerformanceMonthWise($used_cars_types,$startDate,$endDate,$months_diff,$filters);
        $data['fourth_count'] = Application::getPerformanceMonthWise($smo_leads_types,$startDate,$endDate,$months_diff,$filters);
        $data['fifth_count'] = Application::getPerformanceMonthWise($after_sales_types,$startDate,$endDate,$months_diff,$filters);
        $data['sixth_count'] = Application::getPerformanceMonthWise($crm_leads_types,$startDate,$endDate,$months_diff,$filters);
        // $data['campaigns_detial_data'] = Application::getCampaignWiseDetialData($crm_leads_types,$startDate,$endDate,$months_diff,$filters);

        $data['second_graph_data'] = [array_sum($data['first_count']) , array_sum($data['second_count']), array_sum($data['third_count']) ,array_sum($data['fourth_count']) , array_sum($data['fifth_count']), array_sum($data['sixth_count'])];
        $data['total_performance_count'] = array_sum($data['first_count']) + array_sum($data['second_count']) + array_sum($data['third_count']) + array_sum($data['fourth_count']) +array_sum($data['fifth_count']) +  array_sum($data['sixth_count']);
       // dd($data);

       $data['socialData'] = SocialData::select('social_platform', 'followers', 'likes', 'tweets')->get()->groupBy('social_platform')->toArray();

       $all_types = [
            'request_a_test_quote','request_a_quote','special_offers','leads','events',
            'request_a_test_drive','online_service_booking','contact_us','service_offers','used_cars',
            'smo_leads','online_service_booking', 'service_offers', 'contact_us','crm_leads'
        ];

        $data['countsByCampaign'] = Application::getCampaignWiseData($startDate, $endDate, $sale_types , $filters);
        $data['countsByCampaignAfterSales'] = Application::getCampaignWiseData($startDate, $endDate, $after_sales_types , $filters);

        $crm_types = ['crm_leads'];
        $data['category_graph'] = Application::countByCategoryGroup($startDate, $endDate,$crm_types,$filters);

        $data['pdpl_graph'] = Application::countByAcceptance($startDate, $endDate,$all_types,$filters);
        // dd( $data['category_graph'],$data['pdpl_graph']);

        $data['sources_graph'] = Application::countBySourceGroup($startDate, $endDate,$all_types,$filters);
        $data['sale_vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $sale_types, $filters);
        $data['after_sale_vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $after_sales_types, $filters);
        // dd( $data);
       return view('dashboard' , $data , getCommonFilterData());
    }

}
