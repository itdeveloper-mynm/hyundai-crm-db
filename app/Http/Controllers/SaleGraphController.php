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
        $dates =$this->getPerformanceLabel();
        $startDate = $dates['startDate'];
        $endDate = $dates['endDate'];
        $months_diff = $dates['months_diff'];
        $data['months'] = $dates['months'];

        $first_types = ['request_a_quote'];
        $second_types = ['special_offers'];
        $third_types = ['online_service_booking','contact_us'];
        $fourth_types = ['service_offers'];

        $first_types_data= $this->getPerformanceMonthWise($first_types,$startDate,$endDate,$months_diff);
        $second_types_data= $this->getPerformanceMonthWise($second_types,$startDate,$endDate,$months_diff);
        $third_types_data= $this->getPerformanceMonthWise($third_types,$startDate,$endDate,$months_diff);
        $fourth_types_data= $this->getPerformanceMonthWise($fourth_types,$startDate,$endDate,$months_diff);


        $first_types_data_count = $first_types_data->pluck('count')->toArray();
        $second_types_data_count = $second_types_data->pluck('count')->toArray();
        $third_types_data_count = $third_types_data->pluck('count')->toArray();
        $fourth_types_data_count = $fourth_types_data->pluck('count')->toArray();

        $data['first_count'] = $first_types_data_count;
        $data['second_count'] = $second_types_data_count;
        $data['third_count'] = $second_types_data_count;
        $data['fourth_count'] = $second_types_data_count;

        $data['second_graph_data'] = [array_sum($data['first_count']), array_sum($data['second_count']), array_sum($data['third_count']),  array_sum($data['fourth_count'])];
        $data['total_performance_count'] = array_sum($data['first_count']) + array_sum($data['second_count']) + array_sum($data['third_count']) + array_sum($data['fourth_count']);

        $data['countsByCampaign'] = $this->getCampaignWiseData($startDate, $endDate);

       return view('sale_graph.index' , $data);
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


        if(!is_null($startDate)){
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate);
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

    function getCampaignWiseData($startDate, $endDate) {

        $all_types = [
            'request_a_test_quote',
            'request_a_quote',
            'special_offers',
            'leads',
            'events',
            'request_a_test_drive',
            'online_service_booking',
            'contact_us',
            'service_offers',
            'used_cars'
        ];

        $allrecords = Application::selectRaw('campaign_id, source_id, COUNT(*) as count')
        ->with(['campaign:id,name', 'source:id,name'])
        ->whereNotNull('campaign_id')
        ->whereNotNull('source_id')
        ->whereIn('type',$all_types)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy(['campaign_id', 'source_id'])
        ->get();

        // Transform the result into the desired pattern
        $result = [];
        foreach ($allrecords as $count) {
            $campaignId = $count->campaign_id;
            $sourceId = $count->source_id;
            // If the campaign doesn't exist in the result array, create it
            if (!isset($result[$campaignId])) {
                $result[$campaignId] = [
                    'campaign_id' => $campaignId,
                    'name' => $count->campaign->name,
                    'count' => 0,
                    'source' => [],
                ];
            }

            // Add the count to the campaign total
            $result[$campaignId]['count'] += $count->count;

            // Add the source information to the campaign
            $result[$campaignId]['source'][] = [
                'name' => $count->source->name,
                'count' => $count->count,
            ];
        }

            // Convert the associative array into indexed array
            $result = array_values($result);

            return $result;
        }

}
