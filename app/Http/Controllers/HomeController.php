<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $dates =$this->getPerformanceLabel();
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];

        $sale_types = ['request_a_test_quote','request_a_quote','special_offers','leads','events'];
        $test_drive_types = ['request_a_test_drive'];
        $service_booking_types = ['online_service_booking','contact_us'];
        $service_offers_types = ['service_offers'];
        $used_cars_types = ['used_cars'];

        $sales_data= $this->getPerformanceMonthWise($sale_types,$startDate,$endDate,$months_diff);
        $test_drive_data= $this->getPerformanceMonthWise($test_drive_types,$startDate,$endDate,$months_diff);
        $service_booking_data= $this->getPerformanceMonthWise($service_booking_types,$startDate,$endDate,$months_diff,true);
        $service_offers_data= $this->getPerformanceMonthWise($service_offers_types,$startDate,$endDate,$months_diff);
        $used_cars_data= $this->getPerformanceMonthWise($used_cars_types,$startDate,$endDate,$months_diff);


        $sale_count = $sales_data->pluck('count')->toArray();
        $test_drive_count = $test_drive_data->pluck('count')->toArray();
        $service_booking_count = $service_booking_data->pluck('count')->toArray();
        $service_offers_count = $service_offers_data->pluck('count')->toArray();
        $used_cars_count = $used_cars_data->pluck('count')->toArray();

        $data['sale_count'] = $sale_count;
        $data['test_drive_count'] = $test_drive_count;
        $data['service_booking_count'] = $service_booking_count;
        $data['service_offers_count'] = $service_offers_count;
        $data['used_cars_count'] = $used_cars_count;
        $data['second_graph_data'] = [array_sum($sale_count) , array_sum($test_drive_count) , array_sum($service_booking_count) , array_sum($service_offers_count) , array_sum($used_cars_count)];
        $data['total_performance_count'] = array_sum($sale_count) + array_sum($test_drive_count) + array_sum($service_booking_count) + array_sum($service_offers_count) + array_sum($used_cars_count);
       // dd($data);

        return view('dashboard' , $data);
    }

    function getPerformanceMonthWise($types,$startDate,$endDate,$months_diff,$deptchk=false) {

        // $currentYear = date('Y');
        if($months_diff > 3){
            $maincounts = DB::table('applications')
            ->select(DB::raw('DATE_FORMAT(created_at, "%M %Y") as month_year'), DB::raw('COUNT(*) as count'))
            //->whereYear('created_at', $currentYear)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('type', $types)
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%M %Y")'))
            ->orderBy(DB::raw('MIN(created_at)'), 'asc');

            $maincounts->when($deptchk, function ($query) {
                return $query->where('department' ,'aftersales');
            });

            $counts = $maincounts->get();

        }else{
            $maincounts = DB::table('applications')
                ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as month_year'), DB::raw('COUNT(*) as count'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->whereIn('type', $types)
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'))
                ->orderBy(DB::raw('MIN(created_at)'), 'asc');
            // Conditionally add the where clause for department
            $maincounts->when($deptchk, function ($query) {
                return $query->where('department', 'aftersales');
            });

            $counts = $maincounts->get();
        }

        return $counts;
    }

    function getPerformanceLabel() {


        $startDate = request('start_date');
        $endDate = request('end_date');

        //$startDate = Carbon::parse('2023-06-01');
        //$endDate = Carbon::parse('2024-01-17');

        if(!is_null($startDate)){
            $days_diff = $startDate->diffInDays($endDate);
            $months_diff = $days_diff / 30.44; // Approximate average days in a month
        }

        if(is_null($endDate)){
            $startDate = now()->subMonths(5)->startOfMonth(); // Start of the month 4 months ago
            $endDate = now()->endOfMonth(); // End of the current month
            $months_diff = $startDate->diffInMonths($endDate);
        }

        if($months_diff >= 3){
            // Generate an array of months between start and end dates
            $monthsArray = [];
            $currentMonth = $startDate->copy()->startOfMonth();
            while ($currentMonth->lte($endDate)) {
                $monthsArray[] = $currentMonth->format('F Y'); // Format as "Month Year"
                $currentMonth->addMonth(); // Move to the next month
            }

            $data['months'] = $monthsArray;

        }else{
            // Generate an array of dates between start and end dates
            $datesArray = [];
            $currentDate = $startDate->copy();

            while ($currentDate->lte($endDate)) {
                $datesArray[] = $currentDate->toDateString();
                $currentDate->addDay(); // Move to the next day
            }

            $data['months'] = $datesArray;
        }

        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        $data['months_diff'] = $months_diff;
        return $data;
    }

    public function leads_index()
    {
        return view('home');
    }
}
