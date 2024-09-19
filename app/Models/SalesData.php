<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class SalesData extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'inv_date',
        'year',
        's',
        'chass',
        'vehicle_id',
        'department',
    ];

        // Define a scope for searching with conditions
        public function scopeSearch($query, $conditions)
        {
            return $query->where(function ($query) use ($conditions) {
                // Add your where conditions here based on $conditions array
                if (isset($conditions['search']['value'])) {
                    $search = $conditions['search']['value'];
                    $query->where(function ($query) use ($search) {
                        $query->whereHas('customer', function ($query) use ($search) {
                            $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                                ->orWhere('mobile', $search)
                                ->orWhere('email', $search);
                        })
                        // Add the condition for inv_date here
                        ->orWhere('inv_date', 'like', '%' . $search . '%')
                        ->orWhere('year', 'like', '%' . $search . '%')
                        ->orWhere('s', 'like', '%' . $search . '%')
                        ->orWhere('chass', 'like', '%' . $search . '%')
                        // ->orWhere('model', 'like', '%' . $search . '%')
                        ->orWhere('department', 'like', '%' . $search . '%');
                    });
                }

                if (isset($conditions['vehicle_id'])) {
                    $query->where(function ($query) use ($conditions) {
                        $query->whereIn('vehicle_id', arraycheck($conditions['vehicle_id']));
                    });
                }

                if (isset($conditions['department'])) {
                    $query->where(function ($query) use ($conditions) {
                        $query->where('department', $conditions['department']);
                    });
                }

                if (isset($conditions['from']) &&  isset($conditions['to'])) {
                    $query->where(function ($query) use ($conditions) {
                        $startDate = $conditions['from'].' 00:00:00';
                        $endDate = $conditions['to'].' 23:59:59';
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                    });
                }

                // Add more conditions as needed...
            });
        }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    static function updateData($request,$id) {

        $salesdata = self::findorFail($id);

        $customer = Customer::findorFail($salesdata->customer_id);

        $salesdata->update([
                'inv_date' => request('inv_date'),
                'year' => request('year'),
                's' => request('s'),
                'chass' => request('chass'),
                'vehicle_id' => request('vehicle_id'),
                'department' => request('department'),
                // Add other columns as needed
            ]);

        $customer->save();

        return $customer;
    }

    // public static function getPerformanceMonthWise($startDate, $endDate, $months_diff, $filters) {

    //     $dateFormat = ($months_diff > 3) ? '%M %Y' : '%Y-%m-%d';

    //     $maincounts = self::select(DB::raw("DATE_FORMAT(created_at, '$dateFormat') as month_year"), DB::raw('COUNT(*) as count'))
    //         ->whereBetween('created_at', [$startDate, $endDate])
    //         ->groupBy(DB::raw("DATE_FORMAT(created_at, '$dateFormat')"))
    //         ->orderBy(DB::raw('MIN(created_at)'), 'asc')
    //         ->search($filters);

    //     $counts = $maincounts->pluck('count')->toArray();
    //     //$counts = $maincounts->get()->pluck('count')->toArray();
    //     //dd($counts);

    //     return $counts;
    // }


    public static function getMonthWiseData($startDate, $endDate, $months_diff, $filters) {
        $dateFormat = ($months_diff > 3) ? '%M %Y' : '%Y-%m-%d';

        // Generate the date range sequence
        $dates = self::generateDateRange($startDate, $endDate, $dateFormat);

        // Main counts query
        $maincounts = self::select(DB::raw("DATE_FORMAT(created_at, '$dateFormat') as month_year"), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '$dateFormat')"))
            ->orderBy(DB::raw('MIN(created_at)'), 'asc')
            ->search($filters)
            ->get()
            ->pluck('count', 'month_year');
        // Merge with the date sequence
        $results = [];
        foreach ($dates as $date) {
            // $results[$date] = $maincounts->get($date, 0);
            $results[$date] = $maincounts->get($date, );
        }

        return array_values($results);
    }

    // Helper function to generate the date range
    public static function generateDateRange($startDate, $endDate, $dateFormat) {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        $end->modify('+1 day'); // to include end date in the range

        $interval = ($dateFormat == '%M %Y') ? new \DateInterval('P1M') : new \DateInterval('P1D');
        $period = new \DatePeriod($start, $interval, $end);

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->format($dateFormat == '%M %Y' ? 'F Y' : 'Y-m-d');
        }

        return $dates;
    }

    public static function getPerformanceMonthWise($types, $startDate, $endDate, $months_diff, $filters, $opt_filters = []) {

        $dateFormat = ($months_diff > 3) ? '%M %Y' : '%Y-%m-%d';

        $maincounts = Application::select(
                DB::raw("DATE_FORMAT(created_at, '$dateFormat') as month_year"),
                DB::raw('COUNT(*) as count'),
                DB::raw('GROUP_CONCAT(DISTINCT customer_id ORDER BY customer_id ASC) as customer_ids')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('type', $types)
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '$dateFormat')"))
            ->orderBy(DB::raw('MIN(created_at)'), 'asc')
            ->graphsearch($filters)
            ->when(isset($opt_filters['department']), function ($query) use ($opt_filters) {
                return $query->where('department', $opt_filters['department']);
            });

        $counts = $maincounts->pluck('count')->toArray();
        $customerIds = $maincounts->pluck('customer_ids')->toArray();

        // if(count( $customerIds) > 0){
        //     $customerIds = $customerIds[0];
        // }

        return ['counts' => $counts , 'customerIds' => $customerIds ];
    }

    public static function getDigitalCompaignVechileWise($types, $startDate, $endDate, $filters) {

        $results = Application::join('vehicles', 'vehicles.id', '=', 'applications.vehicle_id') // Replace 'your_table_name' with your actual table name
            ->select(
                'vehicles.name', // Assuming 'vehicle_name' is the column name for vehicle name in the 'vehicles' table
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('applications.created_at', [$startDate, $endDate])
            ->whereIn('applications.type', $types)
            ->groupBy('vehicles.name')
            ->orderBy(DB::raw('Max(applications.created_at)'), 'asc')
            ->graphsearch($filters)
            ->get();

            $counts = [];
            // Loop through the results and populate the counts array
            foreach ($results as $result) {
                $counts[$result->name] = $result->count;
            }

            return $counts;
    }


    public static function getActualSalesData($startDate, $endDate, $filters) {

        $results = self::join('vehicles', 'vehicles.id', '=', 'sales_data.vehicle_id')
            ->select(
                'vehicles.name',
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('sales_data.created_at', [$startDate, $endDate])
            ->groupBy('vehicles.name')
            ->orderBy(DB::raw('Max(sales_data.created_at)'), 'asc')
            ->search($filters)
            ->get();

        $counts = [];

        // Loop through the results and populate the counts array
        foreach ($results as $result) {
            $counts[$result->name] = $result->count;
        }

        return $counts;
    }


    public static function getLeadsConversions($startDate, $endDate, $filters, $customer_ids) {


        $results = self::join('vehicles', 'vehicles.id', '=', 'sales_data.vehicle_id')
            ->select(
                'vehicles.name',
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('sales_data.created_at', [$startDate, $endDate])
            ->whereIn('sales_data.customer_id', $customer_ids)
            ->groupBy('vehicles.name')
            ->orderBy(DB::raw('Max(sales_data.created_at)'), 'asc')
            ->search($filters)
            ->get();

        $counts = [];

        // Loop through the results and populate the counts array
        foreach ($results as $result) {
            $counts[$result->name] = $result->count;
        }

        return $counts;
    }

}
