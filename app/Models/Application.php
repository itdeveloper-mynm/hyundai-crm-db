<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;



class Application extends Model
{
    use HasFactory , SoftDeletes;

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
        'purchase_plan',
        'monthly_salary',
        'preferred_appointment_time',
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
        'category',
        'sub_category',
        'kyc',
        'crm_lead_status',
        'created_by',
        'updated_by',
        'deleted_by',
        'qualified_date',
    ];



    // Define a scope for searching with conditions
    public function scopeSearch($query, $conditions)
    {
        // dd($conditions, isset($conditions['from']) ,isset($conditions['to']));
        return $query->where(function ($query) use ($conditions) {
            // Add your where conditions here based on $conditions array
            if (isset($conditions['search']['value'])) {
                $search = $conditions['search']['value'];
                $query->where(function ($query) use ($search) {
                    $query->whereHas('customer', function ($query) use ($search) {
                        $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                            ->orWhere('mobile', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    });
                });
            }

            if (isset($conditions['city_id'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereIn('applications.city_id', arraycheck($conditions['city_id']));
                });
            }

            if (isset($conditions['branch_id'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereIn('applications.branch_id', arraycheck($conditions['branch_id']));
                });
            }

            if (isset($conditions['vehicle_id'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereIn('applications.vehicle_id', arraycheck($conditions['vehicle_id']));
                });
            }

            if (isset($conditions['source_id'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.source_id', arraycheck($conditions['source_id']));
                });
            }

            if (isset($conditions['campaign_id'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.campaign_id', arraycheck($conditions['campaign_id']));
                });
            }

            if (isset($conditions['purchase_plan'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.purchase_plan', arraycheck($conditions['purchase_plan']));
                });
            }

            if (isset($conditions['monthly_salary'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.monthly_salary', arraycheck($conditions['monthly_salary']));
                });
            }
            if (isset($conditions['preferred_appointment_time'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.preferred_appointment_time', arraycheck($conditions['preferred_appointment_time']));
                });
            }
            if (isset($conditions['kyc'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.kyc', arraycheck($conditions['kyc']));
                });
            }
            if (isset($conditions['category'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.category', arraycheck($conditions['category']));
                });
            }

            if (isset($conditions['created_by'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.created_by', arraycheck($conditions['created_by']));
                });
            }

            if (isset($conditions['updated_by'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.updated_by', arraycheck($conditions['updated_by']));
                });
            }

            if (isset($conditions['type'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.type', arraycheck($conditions['type']));
                });
            }

            if (isset($conditions['from']) &&  isset($conditions['to'])) {
                $query->where(function ($query) use ($conditions) {
                    $startDate = $conditions['from'].' 00:00:00';
                    $endDate = $conditions['to'].' 23:59:59';
                    $query->whereBetween('applications.created_at', [$startDate, $endDate]);
                });
            }

            if (isset($conditions['upd_from']) && isset($conditions['upd_to'])) {
                dd(1);
                $startDate = $conditions['upd_from'] . ' 00:00:00';
                $endDate = $conditions['upd_to'] . ' 23:59:59';
                $query->where(function ($query) use ($startDate, $endDate) {
                    $query->whereNotNull('applications.updated_by')
                          ->whereBetween('applications.updated_at', [$startDate, $endDate]);
                });
            }

            // Add more conditions as needed...
        });
    }

    public function scopeGraphSearch($query, $conditions)
    {
        return $query->where(function ($query) use ($conditions) {

            if (isset($conditions['city_id'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereIn('applications.city_id', arraycheck($conditions['city_id']));
                });
            }

            if (isset($conditions['branch_id'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereIn('applications.branch_id', arraycheck($conditions['branch_id']));
                });
            }

            if (isset($conditions['vehicle_id'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereIn('applications.vehicle_id', arraycheck($conditions['vehicle_id']));
                });
            }

            if (isset($conditions['source_id'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.source_id', arraycheck($conditions['source_id']));
                });
            }

            if (isset($conditions['campaign_id'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.campaign_id', arraycheck($conditions['campaign_id']));
                });
            }

            if (isset($conditions['purchase_plan'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.purchase_plan', arraycheck($conditions['purchase_plan']));
                });
            }

            if (isset($conditions['monthly_salary'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.monthly_salary', arraycheck($conditions['monthly_salary']));
                });
            }
            if (isset($conditions['preferred_appointment_time'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.preferred_appointment_time', arraycheck($conditions['preferred_appointment_time']));
                });
            }
            if (isset($conditions['kyc'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.kyc', arraycheck($conditions['kyc']));
                });
            }

            if (isset($conditions['category'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.category', arraycheck($conditions['category']));
                });
            }

            if (isset($conditions['created_by'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.created_by', arraycheck($conditions['created_by']));
                });
            }

            if (isset($conditions['updated_by'])) {
                $query->where(function ($query) use ($conditions) {
                        $query->whereIn('applications.updated_by', arraycheck($conditions['updated_by']));
                });
            }

            if (isset($conditions['start_date']) &&  isset($conditions['end_date'])) {
                $query->where(function ($query) use ($conditions) {
                    $startDate = $conditions['start_date'].' 00:00:00';
                    $endDate = $conditions['end_date'].' 23:59:59';
                    $query->whereBetween('applications.created_at', [$startDate, $endDate]);
                });
            }

            if (isset($conditions['upd_from']) &&  isset($conditions['upd_to'])) {

                $startDate = $conditions['upd_from'] . ' 00:00:00';
                $endDate = $conditions['upd_to'] . ' 23:59:59';

                $query->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('applications.updated_at', [$startDate, $endDate])
                          ->where('applications.updated_by','!=',null);
                });

                // $query->where(function ($query) use ($conditions) {
                //     $startDate = $conditions['upd_from'].' 00:00:00';
                //     $endDate = $conditions['upd_to'].' 23:59:59';
                //     $query->whereBetween('applications.updated_at', [$startDate, $endDate]);
                // });
            }


            // Add more conditions as needed...
        });
    }

    // public function scopeGraphSearch($query, $filters)
    // {
    //     // Check if $filters is not empty
    //     if (!empty($filters)) {
    //         return $query
    //             ->when(isset($filters['city_id']), function ($query) use ($filters) {
    //                 return $query->where('applications.city_id', $filters['city_id']);
    //             })
    //             ->when(isset($filters['branch_id']), function ($query) use ($filters) {
    //                 return $query->where('applications.branch_id', $filters['branch_id']);
    //             })
    //             ->when(isset($filters['vehicle_id']), function ($query) use ($filters) {
    //                 return $query->where('applications.vehicle_id', $filters['vehicle_id']);
    //             })
    //             ->when(isset($filters['source_id']), function ($query) use ($filters) {
    //                 return $query->where('applications.source_id', $filters['source_id']);
    //             })
    //             ->when(isset($filters['campaign_id']), function ($query) use ($filters) {
    //                 return $query->where('applications.campaign_id', $filters['campaign_id']);
    //             });
    //     }

    //     return $query;
    // }




    public static function countBySalaryGroup($startDate, $endDate, $all_types, $filters)
    {
        $records = self::select('monthly_salary', \DB::raw('COUNT(*) as count'))
            ->whereNotNull('purchase_plan')
            ->whereIn('type', $all_types)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('monthly_salary')
            ->get();

            $data['monthly_salary'] = $records->pluck('monthly_salary')->toArray();
            $data['monthly_salary_count'] = $records->pluck('count')->toArray();

            return $data;

    }

    public static function countByPurchasePlanGroup($startDate, $endDate, $all_types, $filters)
    {
        $records = self::select('purchase_plan', \DB::raw('COUNT(*) as count'))
            ->whereNotNull('purchase_plan')
            ->whereIn('type', $all_types)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('purchase_plan')
            ->get();

            $data['purchase_plan'] = $records->pluck('purchase_plan')->toArray();
            $data['purchase_plan_count'] = $records->pluck('count')->toArray();

            return $data;

    }

    public static function countByCity($startDate, $endDate, $all_types, $filters)
    {
        $records = self::select('city_id', \DB::raw('COUNT(*) as count'))
            ->with(['city:id,name'])
            ->whereNotNull('city_id')
            ->whereIn('type', $all_types)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('city_id')
            ->get();


            return $records;

    }


    public static function countByPreferredAppointmentTime($startDate, $endDate, $all_types, $filters)
    {
        $records = self::select('preferred_appointment_time', \DB::raw('COUNT(*) as count'))
            ->whereNotNull('preferred_appointment_time')
            ->whereIn('type', $all_types)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('preferred_appointment_time')
            ->get();

            $data['preferred_appointment_time'] = $records->pluck('preferred_appointment_time')->toArray();
            $data['preferred_appointment_time_count'] = $records->pluck('count')->toArray();

            return $data;

    }

    public static function countByBank($startDate, $endDate, $all_types, $filters)
    {
        $records = self::join('customers', 'applications.customer_id', '=', 'customers.id')
            ->join('banks', 'customers.bank_id', '=', 'banks.id')
            ->select('customers.bank_id', 'banks.name as bank_name', \DB::raw('COUNT(*) as count'))
            ->whereNotNull('applications.customer_id')
            ->whereIn('type', $all_types)
            ->whereBetween('applications.created_at', [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('customers.bank_id', 'banks.name')
            ->get();

            //$data['bank_name'] = $records->pluck('bank_name')->toArray();
            //$data['bank_name_count'] = $records->pluck('count')->toArray();

            return $records;
    }

    public static function getCityWiseData($startDate, $endDate, $all_types, $filters) {

        //$all_types = ['request_a_quote', 'special_offers', 'smo_leads', 'contact_us'];

        $allrecords = self::selectRaw(
            'city_id, branch_id,
            COUNT(*) as count'
            // COUNT(DISTINCT customer_id) as count'
            )
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


    public static function getVechileGraph($startDate, $endDate, $all_types, $filters) {

        // $types = [
        //     'request_a_quote',
        //     'special_offers',
        //     'smo_leads',
        //     'contact_us'
        // ];

        $alldata = self::join('vehicles', 'applications.vehicle_id', '=', 'vehicles.id')
        ->select('vehicles.name as vehicle_name', DB::raw('COUNT(*) as count'))
        ->whereBetween('applications.created_at', [$startDate, $endDate])
        ->whereIn('applications.type', $all_types)
        ->graphsearch($filters)
        ->groupBy('applications.vehicle_id', 'vehicles.name')
        ->orderBy('applications.vehicle_id', 'asc') // You can change the order based on your preference
        ->get();

        $data['vehicle_names'] = $alldata->pluck('vehicle_name')->toArray();
        $data['vehicle_count'] = $alldata->pluck('count')->toArray();

        return $data;

    }


    public static function countByCategoryGroup($startDate, $endDate, $all_types, $filters) {

        $alldata = self::select(
            DB::raw("IFNULL(applications.category, 'Not Assigned') as category_name"),
            // DB::raw('COUNT(DISTINCT applications.customer_id) as count')
            DB::raw('COUNT(*) as count')
        )
        ->whereBetween('applications.created_at', [$startDate, $endDate])
        ->whereIn('applications.type', $all_types)
        ->graphsearch($filters)
        ->groupBy(DB::raw("IFNULL(applications.category, 'Not Assigned')")) // Use the same expression as in select
        ->orderBy('category_name', 'asc') // Ordering by alias
        ->get();

        $data['category_names'] = $alldata->pluck('category_name')->toArray();
        $data['category_count'] = $alldata->pluck('count')->toArray();

        return $data;
    }

    public static function countBySourceGroup($startDate, $endDate, $all_types, $filters)
    {
        $alldata = self::select(
            DB::raw("name as source_name"),
            DB::raw('COUNT(*) as count')
        )
        ->leftJoin('sources', 'applications.source_id', '=', 'sources.id') // Joining with the sources table
        ->whereIn('applications.source_id', [161, 163, 164, 171])
        // ->whereIn('sources.name', $sourceNames) // Filtering based on source name
        ->whereBetween('applications.created_at', [$startDate, $endDate])
        ->whereIn('applications.type', $all_types)
        ->graphsearch($filters)
        ->groupBy(DB::raw("IFNULL(applications.source_id, 'Not Assigned')"), 'sources.name') // Grouping by source_id and source_name
        ->orderBy('source_name', 'asc')
        ->get();

        $data['sources_names'] = $alldata->pluck('source_name')->toArray();
        $data['sources_count'] = $alldata->pluck('count')->toArray();

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
                //$monthsArray[] = $currentMonth->format('F Y'); // Format as "Month Year"
                // $monthsArray[] = $currentMonth->format('M Y');
                $monthsArray[] = $currentMonth->format('M y');
                $currentMonth->addMonth(); // Move to the next month
            }

            $data['months'] = $monthsArray;

        }else{
            // Generate an array of dates between start and end dates
            $datesArray = [];
            $currentDate = $startDate->copy();

            while ($currentDate->lte($endDate)) {
                //$datesArray[] = $currentDate->toDateString();
                $datesArray[] = $currentDate->format('j-M-y');
                $currentDate->addDay(); // Move to the next day
            }

            $data['months'] = $datesArray;
        }

        $data['startDate'] = $startDate;
        // $data['endDate'] = $endDate;

        // Adjust the end date to include the full day
        $data['endDate'] = Carbon::parse($endDate)->endOfDay();
        $data['months_diff'] = $months_diff;
        return $data;
    }

    // public static function getPerformanceMonthWise($types, $startDate, $endDate, $months_diff, $filters, $opt_filters = []) {
    //     $cacheKey = md5(serialize([$types, $startDate, $endDate, $months_diff, $filters, $opt_filters]));
    //     $cacheDuration = now()->addMinutes(60); // Cache for 60 minutes (adjust as needed)

    //     return Cache::remember($cacheKey, $cacheDuration, function () use ($types, $startDate, $endDate, $months_diff, $filters, $opt_filters) {
    //         $dateFormat = ($months_diff > 3) ? '%M %Y' : '%Y-%m-%d';

    //         $maincounts = self::select(DB::raw("DATE_FORMAT(created_at, '$dateFormat') as month_year"), DB::raw('COUNT(*) as count'))
    //             ->whereBetween('created_at', [$startDate, $endDate])
    //             ->whereIn('type', $types)
    //             ->groupBy(DB::raw("DATE_FORMAT(created_at, '$dateFormat')"))
    //             ->orderBy(DB::raw('MIN(created_at)'), 'asc')
    //             ->graphsearch($filters)
    //             ->when(isset($opt_filters['department']), function ($query) use ($opt_filters) {
    //                 return $query->where('department', $opt_filters['department']);
    //             });

    //         return $maincounts->pluck('count')->toArray();
    //     });
    // }

    // public static function getPerformanceMonthWise($types, $startDate, $endDate, $months_diff, $filters, $opt_filters = []) {

    //     $dateFormat = ($months_diff > 3) ? '%M %Y' : '%Y-%m-%d';

    //     $maincounts = self::select(
    //             DB::raw("DATE_FORMAT(created_at, '$dateFormat') as month_year"),
    //             DB::raw('COUNT(*) as count'),
    //             //DB::raw('GROUP_CONCAT(DISTINCT customer_id ORDER BY customer_id ASC) as customer_ids')
    //         )
    //         ->whereBetween('created_at', [$startDate, $endDate])
    //         ->whereIn('type', $types)
    //         ->groupBy(DB::raw("DATE_FORMAT(created_at, '$dateFormat')"))
    //         ->orderBy(DB::raw('MIN(created_at)'), 'asc')
    //         ->graphsearch($filters)
    //         ->when(isset($opt_filters['department']), function ($query) use ($opt_filters) {
    //             return $query->where('department', $opt_filters['department']);
    //         });

    //     $counts = $maincounts->pluck('count')->toArray();
    //    // $customerIds = $maincounts->pluck('customer_ids')->toArray();

    //     //$counts = $maincounts->get()->pluck('count')->toArray();
    //     //dd($counts);

    //     return $counts;
    // }

    public static function getPerformanceMonthWise($types, $startDate, $endDate, $months_diff, $filters, $opt_filters = []) {

        $dateFormat = ($months_diff > 3) ? '%M %Y' : '%Y-%m-%d';
        // Adjust the end date to include the full day
        //$endDate = Carbon::parse($endDate)->endOfDay();
        // Generate the date range sequence
        $dates = self::generateDateRange($startDate, $endDate, $dateFormat);

        $maincounts = self::select(
                DB::raw("DATE_FORMAT(created_at, '$dateFormat') as month_year"),
               DB::raw('COUNT(*) as count'),
                // DB::raw('COUNT(DISTINCT customer_id) as count')
                //DB::raw('GROUP_CONCAT(DISTINCT customer_id ORDER BY customer_id ASC) as customer_ids')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('type', $types)
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '$dateFormat')"))
            ->orderBy(DB::raw('MIN(created_at)'), 'asc')
            ->graphsearch($filters)
            ->when(isset($opt_filters['department']), function ($query) use ($opt_filters) {
                return $query->where('department', $opt_filters['department']);
            })
            ->get()
            ->pluck('count', 'month_year');

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

    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedby()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }


    protected static function booted()
    {
        static::creating(function ($application) {
            $application->created_by = Auth::check() ? Auth::id() : null;
        });

        static::updating(function ($application) {
            $application->updated_by = Auth::check() ? Auth::id() : null;
        });

        static::deleting(function ($application) {
            if (Auth::check()) {
                $application->deleted_by = Auth::id();
                $application->save();
            }
        });
    }


    static function storeData($request,$type) {

        $customer = addCustomer($request);

        // Get the current date and extract the year and month
        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;

        $existingApplication = self::where('customer_id', $customer->id)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->first();

        if ($existingApplication) {
            return $existingApplication;
        }

        $application = new self;
        $application->city_id = $request->input('city_id');
        $application->branch_id = $request->input('branch_id');
        $application->vehicle_id = $request->input('vehicle_id');
        $application->source_id = $request->input('source_id');
        $application->campaign_id = $request->input('campaign_id');
        $application->purchase_plan = $request->input('purchase_plan');
        $application->monthly_salary = $request->input('monthly_salary');
        $application->preferred_appointment_time = $request->input('preferred_appointment_time');
        $application->category = $request->input('category');
        $application->sub_category = $request->input('sub_category');
        $application->yearr = $request->input('yearr');
        $application->kyc = $request->input('kyc');
        $application->comments = $request->input('comments');
        $application->customer_id= $customer->id;
        $application->crm_lead_status= $request->crm_lead_status ?? 0;
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

        if ($request->has('mobile')) {
            $customer = updCustomer($request,$application->customer_id);
        }

        //$customer = Customer::findorFail($application->customer_id);

        $application->city_id = $request->input('city_id');
        $application->branch_id = $request->input('branch_id');
        $application->vehicle_id = $request->input('vehicle_id');
        $application->source_id = $request->input('source_id');
        $application->campaign_id = $request->input('campaign_id');
        $application->purchase_plan = $request->input('purchase_plan');
        $application->monthly_salary = $request->input('monthly_salary');
        $application->preferred_appointment_time = $request->input('preferred_appointment_time') ?? $application->preferred_appointment_time;
        $application->category = $request->input('category') ?? $application->category;
        $application->sub_category = $request->input('sub_category') ?? $application->sub_category;
        $application->yearr = $request->input('yearr') ?? $application->yearr;
        $application->kyc = $request->input('kyc') ?? $application->kyc;
        $application->comments = $request->input('comments');
        //$application->customer_id= $customer->id;

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
