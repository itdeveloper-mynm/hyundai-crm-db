<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;


class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'city_id',
        'branch_id',
        'vehicle_id',
        'source_id',
        'campaign_id',
        'type',
        'created_at',
        'apply_for',
        'booking_reason',
        'booking_category',
        'department',
        'title',
        'second_surname',
        'nationalid',
        'zip_code',
        'vin',
        'yearr',
        'plateno',
        'plate_alphabets',
        'klmm',
        'intention',
        'monthly_salary',
        'request_date',
        'preferred_time',
        'comments',
        'sharingcv',
        'privacy_check',
        'marketingagreement',
        'language',
        'company',
        'customers_type',
        'number_of_vehicles',
        'fleet_range',
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
                    });
                });
            }

            if (isset($conditions['city_id'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereHas('city', function ($query) use ($conditions) {
                        $query->where('id', $conditions['city_id']);
                    });
                });
            }

            if (isset($conditions['branch_id'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereHas('branch', function ($query) use ($conditions) {
                        $query->where('id', $conditions['branch_id']);
                    });
                });
            }

            if (isset($conditions['vehicle_id'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereHas('vehicle', function ($query) use ($conditions) {
                        $query->where('id', $conditions['vehicle_id']);
                    });
                });
            }

            if (isset($conditions['source_id'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereHas('source', function ($query) use ($conditions) {
                        $query->where('id', $conditions['source_id']);
                    });
                });
            }

            if (isset($conditions['campaign_id'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereHas('campaign', function ($query) use ($conditions) {
                        $query->where('id', $conditions['campaign_id']);
                    });
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


    public function scopeGraphSearch($query, $filters)
    {
        return $query
            ->when(isset($filters['city_id']), function ($query) use ($filters) {
                return $query->where('applications.city_id', $filters['city_id']);
            })
            ->when(isset($filters['branch_id']), function ($query) use ($filters) {
                return $query->where('applications.branch_id', $filters['branch_id']);
            })
            ->when(isset($filters['vehicle_id']), function ($query) use ($filters) {
                return $query->where('applications.vehicle_id', $filters['vehicle_id']);
            })
            ->when(isset($filters['source_id']), function ($query) use ($filters) {
                return $query->where('applications.source_id', $filters['source_id']);
            })
            ->when(isset($filters['campaign_id']), function ($query) use ($filters) {
                return $query->where('applications.campaign_id', $filters['campaign_id']);
            });
    }




    public static function countBySalaryGroup($startDate, $endDate, $filters)
    {
        $records = self::select('monthly_salary', \DB::raw('COUNT(*) as count'))
            ->whereNotNull('purchase_plan')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('monthly_salary')
            ->get();

            $data['monthly_salary'] = $records->pluck('monthly_salary')->toArray();
            $data['monthly_salary_count'] = $records->pluck('count')->toArray();

            return $data;

    }

    public static function countByPurchasePlanGroup($startDate, $endDate, $filters)
    {
        $records = self::select('purchase_plan', \DB::raw('COUNT(*) as count'))
            ->whereNotNull('purchase_plan')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('purchase_plan')
            ->get();

            $data['purchase_plan'] = $records->pluck('purchase_plan')->toArray();
            $data['purchase_plan_count'] = $records->pluck('count')->toArray();

            return $data;

    }

    public static function countByBank($startDate, $endDate, $filters)
    {
        $records = self::join('customers', 'applications.customer_id', '=', 'customers.id')
            ->join('banks', 'customers.bank_id', '=', 'banks.id')
            ->select('customers.bank_id', 'banks.name as bank_name', \DB::raw('COUNT(*) as count'))
            ->whereNotNull('applications.customer_id')
            ->whereBetween('applications.created_at', [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('customers.bank_id', 'banks.name')
            ->get();

            //$data['bank_name'] = $records->pluck('bank_name')->toArray();
            //$data['bank_name_count'] = $records->pluck('count')->toArray();

            return $records;
    }

    public static function getCityWiseData($startDate, $endDate, $filters) {
        $all_types = ['request_a_quote', 'special_offers', 'smo_leads', 'contact_us'];

        $allrecords = self::selectRaw('city_id, branch_id, COUNT(*) as count')
            ->with(['city:id,name', 'branch:id,name'])
            ->whereNotNull(['city_id', 'branch_id'])
            ->whereIn('type', $all_types)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy(['city_id', 'branch_id'])
            ->get();

        $result = [];

        foreach ($allrecords as $count) {
            $cityId = $count->city_id;

            // Use the null coalescing operator to set default values
            $result[$cityId] ??= [
                'city_id' => $cityId,
                'name' => $count->city->name,
                'count' => 0,
                'branches' => [],
            ];

            $result[$cityId]['count'] += $count->count;

            $result[$cityId]['branches'][] = [
                'name' => $count->branch->name,
                'count' => $count->count,
            ];
        }

        return array_values($result);
    }


    public static function getCampaignWiseData($startDate, $endDate, $all_types, $filters) {

        $allrecords = self::selectRaw('campaign_id, source_id, COUNT(*) as count')
            ->with(['campaign:id,name', 'source:id,name'])
            ->whereNotNull(['campaign_id', 'source_id'])
            ->whereIn('type', $all_types)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy(['campaign_id', 'source_id'])
            ->get();

        // Transform the result into the desired pattern
        $result = [];

        foreach ($allrecords as $count) {
            $campaignId = $count->campaign_id;

            // Use the null coalescing operator to set default values
            $result[$campaignId] ??= [
                'campaign_id' => $campaignId,
                'name' => optional($count->campaign)->name,
                'count' => 0,
                'source' => [],
            ];

            $result[$campaignId]['count'] += $count->count;

            $result[$campaignId]['source'][] = [
                'name' => optional($count->source)->name,
                'count' => $count->count,
            ];
        }

        // Convert the associative array into indexed array
        $result = array_values($result);

        return $result;
    }


    public static function getVechileGraph($startDate, $endDate, $filters) {

        $types = [
            'request_a_quote',
            'special_offers',
            'smo_leads',
            'contact_us'
        ];

        $alldata = self::join('vehicles', 'applications.vehicle_id', '=', 'vehicles.id')
        ->select('vehicles.name as vehicle_name', DB::raw('COUNT(*) as count'))
        ->whereBetween('applications.created_at', [$startDate, $endDate])
        ->whereIn('applications.type', $types)
        ->graphsearch($filters)
        ->groupBy('applications.vehicle_id', 'vehicles.name')
        ->orderBy('applications.vehicle_id', 'asc') // You can change the order based on your preference
        ->get();

        $data['vehicle_names'] = $alldata->pluck('vehicle_name')->toArray();
        $data['vehicle_count'] = $alldata->pluck('count')->toArray();

        return $data;

    }


    public static function getPerformanceLabel($startDate,$endDate) {


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

    public static function getPerformanceMonthWise($types, $startDate, $endDate, $months_diff, $filters, $opt_filters = []) {

        $dateFormat = ($months_diff > 3) ? '%M %Y' : '%Y-%m-%d';

        $maincounts = self::select(DB::raw("DATE_FORMAT(created_at, '$dateFormat') as month_year"), DB::raw('COUNT(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('type', $types)
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '$dateFormat')"))
            ->orderBy(DB::raw('MIN(created_at)'), 'asc')
            ->graphsearch($filters)
            ->when(isset($opt_filters['department']), function ($query) use ($opt_filters) {
                return $query->where('department', $opt_filters['department']);
            });

        //$counts = $maincounts->get();
        $counts = $maincounts->get()->pluck('count')->toArray();
        //dd($counts);

        return $counts;
    }



    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function source(){
        return $this->belongsTo(Source::class);
    }
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }

    static function storeData($request,$type) {

        $customer = addCustomer($request);

        $application = new self;
        $application->city_id = $request->input('city_id');
        $application->branch_id = $request->input('branch_id');
        $application->vehicle_id = $request->input('vehicle_id');
        $application->source_id = $request->input('source_id');
        $application->campaign_id = $request->input('campaign_id');
        $application->purchase_plan = $request->input('purchase_plan');
        $application->monthly_salary = $request->input('monthly_salary');
        $application->preferred_appointment_time = $request->input('preferred_appointment_time');
        $application->customer_id= $customer->id;
        $application->type= $type;

        if ($request->has('select_date')) {
            // Assuming 'created_at' is in a format that Carbon can parse
            $date = Carbon::parse($request->input('select_date'));
            // Concatenate the current time (H:i:s) to the date
            $dateWithCurrentTime = $date->format('Y-m-d') . ' ' . Carbon::now()->format('H:i:s');
            // Set the 'created_at' field
            $application->created_at = $dateWithCurrentTime;
        }

        $application->save();

        return $application;

    }

    static function updateData($request,$id) {

        $application = self::findorFail($id);

        $customer = Customer::findorFail($application->customer_id);

        $application->city_id = $request->input('city_id');
        $application->branch_id = $request->input('branch_id');
        $application->vehicle_id = $request->input('vehicle_id');
        $application->source_id = $request->input('source_id');
        $application->campaign_id = $request->input('campaign_id');
        $application->purchase_plan = $request->input('purchase_plan');
        $application->monthly_salary = $request->input('monthly_salary');
        $application->preferred_appointment_time = $request->input('preferred_appointment_time');
        $application->customer_id= $customer->id;

        if ($request->has('select_date')) {
            // Assuming 'created_at' is in a format that Carbon can parse
            $date = Carbon::parse($request->input('select_date'));
            // Concatenate the current time (H:i:s) to the date
            $dateWithCurrentTime = $date->format('Y-m-d') . ' ' . Carbon::now()->format('H:i:s');
            // Set the 'created_at' field
            $application->created_at = $dateWithCurrentTime;
        }

        $application->save();

        return $application;
    }
}
