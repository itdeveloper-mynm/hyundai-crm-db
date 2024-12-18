<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\SocialData;
use App\Models\Application;
use App\Models\SalesData;


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
        $this->middleware('permission:crm-leads-graph-list', ['only' => ['crmLeadsGraphIndex']]);
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

        // comments

        // $sale_types = ['request_a_test_quote','request_a_quote','special_offers','leads','events','request_a_test_drive];
        // Vehicles Interested graph make like cities and bank and Vehicles Interested graph set in single row
        // CRM Data, PDPL Graph on last page


        // $filters = [
        //     'city_id' => request('city_id'),
        //     'branch_id' => request('branch_id'),
        //     'vehicle_id' => request('vehicle_id'),
        //     'source_id' => request('source_id'),
        //     'campaign_id' => request('campaign_id')
        // ];

        $filters = $request->all();

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
        // $data['dropdown'] = getCommonFilterData();
        //dd($data);

       return view('admin.sale_graph.index' , $data , getCommonFilterData());
    }

    public function comparisonIndex(Request $request)
    {
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
        $dates = Application::getPerformanceLabel($startDate,$endDate);
        // dd( $dates);
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
            'campaign_id' => request('campaign_id'),
            'purchase_plan' => request('purchase_plan'),
            'monthly_salary' => request('monthly_salary'),
            'preferred_appointment_time' => request('preferred_appointment_time'),
            'kyc' => request('kyc'),
            'category' => request('category'),
            'created_by' => request('created_by'),
            'updated_by' => request('updated_by'),
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
        $data['dropdown'] = getCommonFilterData();
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
            'campaign_id' => request('campaign_id_comp'),
            'purchase_plan' => request('purchase_plan_comp'),
            'monthly_salary' => request('monthly_salary_comp'),
            'preferred_appointment_time' => request('preferred_appointment_time_comp'),
            'kyc' => request('kyc_comp'),
            'category' => request('category_comp'),
            'created_by' => request('created_by_comp'),
            'updated_by' => request('updated_by_comp'),
        ];

        $opt_filters_comp = [
            'department' => 'sales_maketing',
        ];


        //dd($first_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp);
        $data['first_count_comp'] = Application::getPerformanceMonthWise($first_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp);
        $data['second_count_comp'] = Application::getPerformanceMonthWise($second_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp);
        $data['third_count_comp'] = Application::getPerformanceMonthWise($third_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp);
        $data['fourth_count_comp'] = Application::getPerformanceMonthWise($fourth_types_comp,$startDate_comp,$endDate_comp,$months_diff_comp,$filters_comp,$opt_filters_comp);
        // dd($data);
        $data['second_graph_data_comp'] = [array_sum($data['first_count_comp']), array_sum($data['second_count_comp']), array_sum($data['third_count_comp']),  array_sum($data['fourth_count_comp'])];
        $data['total_performance_count_comp'] = array_sum($data['first_count_comp']) + array_sum($data['second_count_comp']) + array_sum($data['third_count_comp']) + array_sum($data['fourth_count_comp']);

        $all_types_comp = ['request_a_quote', 'special_offers', 'smo_leads', 'contact_us'];
        $data['countsByCampaign_comp'] = Application::getCampaignWiseData($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);

        $data['vehcile_graph_comp'] = Application::getVechileGraph($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);
        $data['citygraph_comp'] = Application::getCityWiseData($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);
        $data['salary_graph_comp'] = Application::countBySalaryGroup($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);
        $data['purchase_plan_graph_comp'] = Application::countByPurchasePlanGroup($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);
        $data['banks_graph_comp'] = Application::countByBank($startDate_comp, $endDate_comp, $all_types_comp, $filters_comp);

        //dd($data);
       return view('admin.sale_graph.comparison-index' , $data ,getCommonFilterData());
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

        // $filters = [
        //     'city_id' => request('city_id'),
        //     'branch_id' => request('branch_id'),
        //     'vehicle_id' => request('vehicle_id')
        // ];

        // comment
        // vehcile graph addition below Campaign Performance


        $filters = $request->all();

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
        // $data['dropdown'] = getCommonFilterData();
        //dd($data);

       return view('admin.after_sale_graph.index' , $data, getCommonFilterData());
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
            'vehicle_id' => request('vehicle_id'),
            'source_id' => request('source_id'),
            'campaign_id' => request('campaign_id'),
            'purchase_plan' => request('purchase_plan'),
            'monthly_salary' => request('monthly_salary'),
            'preferred_appointment_time' => request('preferred_appointment_time'),
            'kyc' => request('kyc'),
            'category' => request('category'),
            'created_by' => request('created_by'),
            'updated_by' => request('updated_by'),
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
            'vehicle_id' => request('vehicle_id_comp'),
            'source_id' => request('source_id_comp'),
            'campaign_id' => request('campaign_id_comp'),
            'purchase_plan' => request('purchase_plan_comp'),
            'monthly_salary' => request('monthly_salary_comp'),
            'preferred_appointment_time' => request('preferred_appointment_time_comp'),
            'kyc' => request('kyc_comp'),
            'category' => request('category_comp'),
            'created_by' => request('created_by_comp'),
            'updated_by' => request('updated_by_comp'),
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

        $data['dropdown'] = getCommonFilterData();

       return view('admin.after_sale_graph.comparison-index' , $data, getCommonFilterData());
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

        // $filters = [
        //     'city_id' => request('city_id'),
        //     'branch_id' => request('branch_id'),
        //     'vehicle_id' => request('vehicle_id')
        // ];

        $filters = $request->all();

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['second_graph_data'] = [array_sum($data['first_count'])];
        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['preferred_time_graph'] = Application::countByPreferredAppointmentTime($startDate, $endDate,$first_types, $filters);
        $data['city_graph'] = Application::countByCity($startDate, $endDate, $first_types, $filters);
        // $data['dropdown'] = getCommonFilterData();

       return view('admin.test_drive.index' , $data, getCommonFilterData());
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

        // $filters = [
        //     'city_id' => request('city_id'),
        //     'branch_id' => request('branch_id'),
        //     'vehicle_id' => request('vehicle_id')
        // ];

        $filters = $request->all();

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $first_types, $filters);
        // $data['dropdown'] = getCommonFilterData();

       return view('admin.service_booking.index' , $data, getCommonFilterData());
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

        // $filters = [
        //     'city_id' => request('city_id'),
        //     'branch_id' => request('branch_id'),
        //     'vehicle_id' => request('vehicle_id')
        // ];

        $filters = $request->all();

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['countsByCampaign'] = Application::getCampaignWiseData($startDate, $endDate, $first_types, $filters);
        // $data['dropdown'] = getCommonFilterData();

       return view('admin.service_offers.index' , $data, getCommonFilterData());
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

        // $filters = [
        //     'city_id' => request('city_id'),
        //     'branch_id' => request('branch_id'),
        //     'vehicle_id' => request('vehicle_id')
        // ];

        $filters = $request->all();

        $opt_filters = [
            'department' => 'after_sales',
        ];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters,$opt_filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $first_types, $filters);
        // $data['dropdown'] = getCommonFilterData();

       return view('admin.contact_us.index' , $data, getCommonFilterData());
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

        // $filters = [
        // ];

        $filters = $request->all();

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['preferred_time_graph'] = Application::countByPreferredAppointmentTime($startDate, $endDate,$first_types, $filters);
        // $data['dropdown'] = getCommonFilterData();

       return view('admin.used_car.graph_index' , $data, getCommonFilterData());
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

        // $filters = [
        //     'city_id' => request('city_id'),
        //     'branch_id' => request('branch_id')
        // ];

        $filters = $request->all();


        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['preferred_time_graph'] = Application::countByPreferredAppointmentTime($startDate, $endDate,$first_types, $filters);
        // $data['dropdown'] = getCommonFilterData();

       return view('admin.hr.index' , $data, getCommonFilterData());
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

        // $filters = [
        //     'city_id' => request('city_id'),
        //     'branch_id' => request('branch_id'),
        //     'vehicle_id' => request('vehicle_id'),
        //     'source_id' => request('source_id')
        // ];

        $filters = $request->all();

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $first_types, $filters);
        // $data['dropdown'] = getCommonFilterData();

       return view('admin.smo_lead.graph_index' , $data, getCommonFilterData());
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

        // $filters = [
        //     'city_id' => request('city_id'),
        //     'branch_id' => request('branch_id'),
        //     'vehicle_id' => request('vehicle_id'),
        //     'source_id' => request('source_id'),
        //     'campaign_id' => request('campaign_id')
        // ];

        $filters = $request->all();

        $opt_filters = [];


        $data['first_count'] = Application::getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff,$filters);

        $data['total_performance_count'] = array_sum($data['first_count']);

        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate, $first_types, $filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate, $first_types, $filters);
        // $data['dropdown'] = getCommonFilterData();

       return view('admin.events.graph_index' , $data, getCommonFilterData());
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

        // $filters = [
        //     'department' => request('department'),
        //     'vehicle_id' => request('vehicle_id'),
        // ];

        $filters = $request->all();

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
            $customer_ids = mergeAndUniqueValues($data['second_count']['customerIds']);
            // dd(array_unique($uniqueArray));
            // $customer_ids = explode(',',$data['second_count']['customerIds'][0]);
            // $customer_ids = array_unique($customer_ids);
        }else{
            $customer_ids = [];
        }

        // dd(count($customer_ids));

        $data['getLeadsConversions'] = SalesData::getLeadsConversions($startDate,$endDate,$filters,$customer_ids);
        //dd($getLeadsConversions);
        //dd(array_sum($getLeadsConversions));

        if(array_sum($data['second_count']['counts'])){
            $percent = array_sum($data['first_count']) / array_sum($data['second_count']['counts']);
            $data['percent_friendly'] = number_format( $percent * 100, 2 ) . '%';
        }else{
            $data['percent_friendly'] = 0;
        }
        $data['dropdown'] = getCommonFilterData();

       return view('admin.actual_sales.graph_index' , $data , getCommonFilterData());
    }

    public function crmLeadsGraphIndex(Request $request)
    {
        //dd($request->all());
        $startDate = request('start_date') ?? startDate();
        $endDate = request('end_date') ?? endDate();
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


        $data['vehcile_graph'] = Application::getVechileGraph($startDate, $endDate,$first_types,$filters);
        $data['citygraph'] = Application::getCityWiseData($startDate, $endDate,$first_types, $filters);
        $data['salary_graph'] = Application::countBySalaryGroup($startDate, $endDate,$first_types,$filters);
        $data['purchase_plan_graph'] = Application::countByPurchasePlanGroup($startDate, $endDate,$first_types,$filters);
        $data['category_graph'] = Application::countByCategoryGroup($startDate, $endDate,$first_types,$filters);
        // dd($data['category_graph']);
        //dd($data);
       return view('admin.crn_lead.graph_index' , $data ,getCommonFilterData());
    }

}
