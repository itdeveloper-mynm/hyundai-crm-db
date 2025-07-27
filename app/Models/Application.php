<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\{Campaign,City,Branch};



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
        'is_sms_send',
        'sync_genesys',
        'category',
        'sub_category',
        'kyc',
        'crm_lead_status',
        'created_by',
        'updated_by',
        'deleted_by',
        'qualified_date',
        'lead_id',
        'submit_count',
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
                            ->orWhere('mobile', 'like', '%' . ltrim($search, '0') . '%')
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
                // $query->where(function ($query) use ($conditions) {
                //         $query->whereIn('applications.category', arraycheck($conditions['category']));
                // });

                $query->where(function ($query) use ($conditions) {
                    $categories = arraycheck($conditions['category']);
                    $hasPCL = in_array('PCL', $categories);

                    $filteredCategories = array_filter($categories, function ($item) {
                        return $item !== 'PCL';
                    });

                    $query->where(function ($q) use ($filteredCategories, $hasPCL) {
                        if (!empty($filteredCategories)) {
                            $q->whereIn('applications.category', $filteredCategories);
                        }

                        if ($hasPCL) {
                            if (!empty($filteredCategories)) {
                                $q->orWhereNull('applications.category');
                            } else {
                                $q->whereNull('applications.category');
                            }
                        }
                    });
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

            if (isset($conditions['department_types'])) {
                $query->where(function ($query) use ($conditions) {
                    // Define sales and after-sales types
                    $sale_types = ['request_a_test_quote','request_a_quote','special_offers','leads','events','request_a_test_drive','used_cars','smo_leads','crm_leads'];
                    $after_sales_types = ['online_service_booking', 'service_offers', 'contact_us','after_sales'];
                    $types = [];
                    if (in_array('sales', $conditions['department_types'])) {
                        $types = array_merge($types, $sale_types);
                    }
                    if (in_array('after_sales', $conditions['department_types'])) {
                        $types = array_merge($types, $after_sales_types);
                    }
                    if (!empty($types)) {
                        $query->whereIn('applications.type', $types);
                    }
                });
            }


            if (isset($conditions['from']) &&  isset($conditions['to'])) {
                $query->where(function ($query) use ($conditions) {
                    $startDate = $conditions['from'].' 00:00:00';
                    $endDate = $conditions['to'].' 23:59:59';
                    $query->whereBetween('applications.created_at', [$startDate, $endDate]);
                });
            }

            // if (isset($conditions['upd_from']) && isset($conditions['upd_to'])) {
            //     // dd(1);
            //     $startDate = $conditions['upd_from'] . ' 00:00:00';
            //     $endDate = $conditions['upd_to'] . ' 23:59:59';
            //     $query->where(function ($query) use ($startDate, $endDate) {
            //         $query->whereNotNull('applications.updated_by')
            //               ->whereBetween('applications.updated_at', [$startDate, $endDate]);
            //     });
            // }

            if (isset($conditions['upd_from']) &&  isset($conditions['upd_to'])) {

                $startDate = $conditions['upd_from'] . ' 00:00:00';
                $endDate = $conditions['upd_to'] . ' 23:59:59';

                $query->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('applications.updated_at', [$startDate, $endDate]);
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

            if (isset($conditions['category_chk'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereNotNull('applications.category')
                          ->where('applications.category', '!=', '');
                });
            }

            if (isset($conditions['category_chk_others'])) {
                $query->where(function ($query) use ($conditions) {
                    $query->whereNull('applications.category')->orwhere('applications.category', '');
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
                    $query->whereBetween('applications.updated_at', [$startDate, $endDate]);
                        //   ->where('applications.updated_by','!=',null);
                });
                if (!isset($conditions['upd_graph'])) {
                    $query->where('applications.updated_by', '!=', null);
                }
            }

            $query->whereNull('deleted_at');
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
            ->orderby('count','DESC')
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
            // ->whereNotNull(['campaign_id', 'source_id'])
            ->whereIn('type', $all_types)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy(['campaign_id', 'source_id'])
            ->orderby('count','DESC')
            ->get();
        // Transform the result into the desired pattern
        $result = [];

        foreach ($allrecords as $count) {
            $campaignId = $count->campaign_id;

            // Use the null coalescing operator to set default values
            $result[$campaignId] ??= [
                'campaign_id' => $campaignId,
                'name' => optional($count->campaign)->name ?? 'Others',
                'count' => 0,
                'source' => [],
            ];

            $result[$campaignId]['count'] += $count->count;

            $result[$campaignId]['source'][] = [
                'name' => optional($count->source)->name ?? 'Others',
                'count' => $count->count,
            ];
        }
        // $result = array_reverse($result); // Reverse the array
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
        $dateInfo = getDateRangeAndColumn();
        $dateColumn = $dateInfo['date_column'];

        $alldata = self::join('vehicles', 'applications.vehicle_id', '=', 'vehicles.id')
        ->select('vehicles.name as vehicle_name', DB::raw('COUNT(*) as count'))
        ->whereBetween('applications.' .$dateColumn, [$startDate, $endDate])
        ->whereIn('applications.type', $all_types)
        ->graphsearch($filters)
        ->groupBy('applications.vehicle_id', 'vehicles.name')
        ->orderBy('count', 'desc')
        // ->orderBy('applications.vehicle_id', 'asc') // You can change the order based on your preference
        ->get();

        $data['vehicle_names'] = $alldata->pluck('vehicle_name')->toArray();
        $data['vehicle_count'] = $alldata->pluck('count')->toArray();

        return $data;

    }

    public static function getVechileAnalysisGraph($startDate, $endDate, $all_types, $filters) {
        $alldata = self::join('vehicles', 'applications.vehicle_id', '=', 'vehicles.id')
            ->select(
                'vehicles.name as vehicle_name',
                // DB::raw('COALESCE(vehicles.name, "Not Added") as vehicle_name'),
                DB::raw('COUNT(*) as mql'),
                DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
                DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
                DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi')
            )
            ->whereBetween('applications.created_at', [$startDate, $endDate])
            ->whereIn('applications.type', $all_types)
            ->graphsearch($filters)
            ->groupBy('applications.vehicle_id', 'vehicles.name')
            ->orderBy('mql', 'desc')
            ->get();

        return [
            'vehicle_names' => $alldata->pluck('vehicle_name')->toArray(),
            'mql' => $alldata->pluck('mql')->toArray(),
            'cql' => $alldata->pluck('cql')->toArray(),
            'cnq' => $alldata->pluck('cnq')->toArray(),
            'cgi' => $alldata->pluck('cgi')->toArray(),
        ];
    }



    public static function countByCategoryGroup($startDate, $endDate, $all_types, $filters) {

        $dateInfo = getDateRangeAndColumn();
        $dateColumn = $dateInfo['date_column'];

        $alldata = self::select(
            DB::raw("IFNULL(applications.category, 'Pending CRM LEADS') as category_name"),
            // DB::raw('COUNT(DISTINCT applications.customer_id) as count')
            DB::raw('COUNT(*) as count')
        )
        ->whereBetween('applications.' .$dateColumn, [$startDate, $endDate])
        ->whereIn('applications.type', $all_types)
        ->graphsearch($filters)
        ->groupBy(DB::raw("IFNULL(applications.category, 'Pending CRM LEADS')"))
        ->orderByRaw("FIELD(category_name, 'Qualified', 'Not Qualified', 'General Inquiry', 'Callback', 'Unreachable','Pending CRM LEADS') ASC")
        ->orderBy('category_name', 'asc')
        ->get();

        $data['category_names'] = $alldata->pluck('category_name')->toArray();
        $data['category_count'] = $alldata->pluck('count')->toArray();

        return $data;
    }

    public static function countByAcceptance($startDate, $endDate, $all_types, $filters) {
        $alldata = self::select(
            DB::raw("SUM(CASE WHEN read_accept = 1 THEN 1 ELSE 0 END) as read_accept_true"),
            DB::raw("SUM(CASE WHEN read_accept = 0 THEN 1 ELSE 0 END) as read_accept_false"),
            // DB::raw("SUM(CASE WHEN letter_accept = 1 THEN 1 ELSE 0 END) as letter_accept_true"),
            // DB::raw("SUM(CASE WHEN letter_accept = 0 THEN 1 ELSE 0 END) as letter_accept_false")
        )
        ->whereBetween('applications.created_at', [$startDate, $endDate])
        ->whereIn('applications.type', $all_types)
        ->graphsearch($filters)
        ->get();

        // $data = [
        //     'read_accept_true' => $alldata->pluck('read_accept_true')->first(),
        //     'read_accept_false' => $alldata->pluck('read_accept_false')->first(),
        //     'letter_accept_true' => $alldata->pluck('letter_accept_true')->first(),
        //     'letter_accept_false' => $alldata->pluck('letter_accept_false')->first(),
        // ];

        $data['names'] =[
            'Accepted',
            'Rejected',
            // 'Letter Accept True',
            // 'Letter Accept False',
        ];

        $data['counts'] = [
            $alldata->pluck('read_accept_true')->first(),
            $alldata->pluck('read_accept_false')->first(),
            // $alldata->pluck('letter_accept_true')->first(),
            // $alldata->pluck('letter_accept_false')->first(),
        ];

        return $data;
    }


    public static function getCampaignWiseDetialData($startDate, $endDate, $all_types, $filters)
    {
        $dateInfo = getDateRangeAndColumn();
        $dateColumn = $dateInfo['date_column'];
        // Query for campaigns
        $campaigns = Application::select(
                'campaign_id',
                DB::raw('COUNT(*) as mql'),
                DB::raw('SUM(category = "Qualified") as cql'),
                DB::raw('SUM(category = "Not Qualified") as cnq'),
                DB::raw('SUM(category = "General Inquiry") as cgi'),
                DB::raw('SUM(category = "Unreachable") as unreach'),
                DB::raw('SUM(customer_id IN (SELECT customer_id FROM sales_data)) as inv')
            )
            ->whereIn('type', $all_types)
            ->whereBetween($dateColumn, [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('campaign_id')
            ->orderby('mql','DESC')
            ->get();

        // Query for sources grouped by campaign
        $sources = Application::select(
                'campaign_id',
                'source_id',
                DB::raw('COUNT(*) as mql'),
                DB::raw('SUM(category = "Qualified") as cql'),
                DB::raw('SUM(category = "Not Qualified") as cnq'),
                DB::raw('SUM(category = "General Inquiry") as cgi'),
                DB::raw('SUM(category = "Unreachable") as unreach'),
                DB::raw('SUM(customer_id IN (SELECT customer_id FROM sales_data)) as inv')
            )
            ->whereIn('type', $all_types)
            ->whereBetween($dateColumn, [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('campaign_id', 'source_id')
            ->with('source:id,name')
            ->get();

        // Group sources by campaign_id
        $sourcesGrouped = $sources->groupBy('campaign_id');

        // Load campaign data in one go
        $campaignData = Campaign::whereIn('id', $campaigns->pluck('campaign_id')->toArray())
            ->pluck('name', 'id');
        $campaignPercentage = Campaign::whereIn('id', $campaigns->pluck('campaign_id')->toArray())
            ->pluck('percentage', 'id');

        return $campaigns->map(function ($campaign) use ($sourcesGrouped, $campaignData, $campaignPercentage) {
            $campaignSources = $sourcesGrouped[$campaign->campaign_id] ?? collect();

            return [
                'campaign_id' => $campaign->campaign_id,
                'percentage' => $campaignPercentage[$campaign->campaign_id] ?? 30,
                'campaign_name' => $campaignData[$campaign->campaign_id] ?? 'Others',
                'mql' => $campaign->mql,
                'cql' => $campaign->cql,
                'cnq' => $campaign->cnq,
                'cgi' => $campaign->cgi,
                'unreach' => $campaign->unreach,
                'inv' => $campaign->inv,
                'sources' => $campaignSources->map(function ($src) {
                    return [
                        'source_id' => $src->source_id,
                        'source_name' => $src->source->name ?? 'Others',
                        'mql' => $src->mql,
                        'cql' => $src->cql,
                        'cnq' => $src->cnq,
                        'cgi' => $src->cgi,
                        'unreach' => $src->unreach,
                        'inv' => $src->inv,
                    ];
                })->values()
            ];
        });
    }

    public static function getCampaignVehcileWiseDetialData($startDate, $endDate, $all_types, $filters)
    {
        $dateInfo = getDateRangeAndColumn();
        $dateColumn = $dateInfo['date_column'];
        // Step 1: Get campaign-level aggregates
        $campaigns = Application::select(
                'campaign_id',
                DB::raw('COUNT(*) as mql'),
                DB::raw('SUM(category = "Qualified") as cql'),
                DB::raw('SUM(category = "Not Qualified") as cnq'),
                DB::raw('SUM(category = "General Inquiry") as cgi'),
                DB::raw('SUM(category = "Unreachable") as unreach'),
                DB::raw('SUM(customer_id IN (SELECT customer_id FROM sales_data)) as inv')
            )
            ->whereIn('type', $all_types)
            ->whereBetween($dateColumn, [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('campaign_id')
            ->get();

        // Step 2: Get vehicle-level aggregates for all campaigns
        $vehicles = Application::select(
                'campaign_id',
                'vehicle_id',
                DB::raw('COUNT(*) as mql'),
                DB::raw('SUM(category = "Qualified") as cql'),
                DB::raw('SUM(category = "Not Qualified") as cnq'),
                DB::raw('SUM(category = "General Inquiry") as cgi'),
                DB::raw('SUM(category = "Unreachable") as unreach'),
                DB::raw('SUM(customer_id IN (SELECT customer_id FROM sales_data)) as inv')
            )
            ->whereIn('type', $all_types)
            ->whereBetween($dateColumn, [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('campaign_id', 'vehicle_id')
            ->with('vehicle:id,name')
            ->get();

        // Step 3: Group vehicle results by campaign_id
        $vehiclesGrouped = $vehicles->groupBy('campaign_id');

        // Step 4: Get campaign info in bulk
        $campaignData = Campaign::whereIn('id', $campaigns->pluck('campaign_id'))
            ->pluck('name', 'id');
        $campaignPercentages = Campaign::whereIn('id', $campaigns->pluck('campaign_id'))
            ->pluck('percentage', 'id');

        // Step 5: Assemble the result
        return $campaigns->map(function ($campaign) use ($vehiclesGrouped, $campaignData, $campaignPercentages) {
            $campaignVehicles = $vehiclesGrouped[$campaign->campaign_id] ?? collect();

            return [
                'campaign_id' => $campaign->campaign_id,
                'percentage' => $campaignPercentages[$campaign->campaign_id] ?? 30,
                'campaign_name' => $campaignData[$campaign->campaign_id] ?? 'Others',
                'mql' => $campaign->mql,
                'cql' => $campaign->cql,
                'cnq' => $campaign->cnq,
                'cgi' => $campaign->cgi,
                'unreach' => $campaign->unreach,
                'inv' => $campaign->inv,
                'vehicles' => $campaignVehicles->map(function ($v) {
                    return [
                        'vehicle_id' => $v->vehicle_id,
                        'vehicle_name' => $v->vehicle->name ?? 'Others',
                        'mql' => $v->mql,
                        'cql' => $v->cql,
                        'cnq' => $v->cnq,
                        'cgi' => $v->cgi,
                        'unreach' => $v->unreach,
                        'inv' => $v->inv,
                    ];
                })->values()
            ];
        })->sortByDesc('mql')->values(); // Sort after mapping
    }

    // public static function getCampaignCityWiseDetailData($startDate, $endDate, $all_types, $filters)
    // {
    //     // Preload all names to avoid N+1 queries
    //     $campaignsList = Campaign::pluck('name', 'id');
    //     $campaignPercentages = Campaign::pluck('percentage', 'id');
    //     $citiesList = City::pluck('name', 'id');
    //     $branchesList = Branch::pluck('name', 'id');

    //     // Apply filters manually if needed, assuming graphsearch() is a macro
    //     $baseQuery = DB::table('applications')
    //         ->leftJoin('sales_data', 'applications.customer_id', '=', 'sales_data.customer_id')
    //         ->whereIn('applications.type', $all_types)
    //         ->whereBetween('applications.created_at', [$startDate, $endDate]);

    //     // If graphsearch is a macro or scope
    //     if (method_exists(Application::class, 'graphsearch')) {
    //         $baseQuery = Application::graphsearch($filters)->getQuery(); // Extract query builder
    //     }

    //     // Step 1: Get campaign-level aggregates
    //     $campaigns = clone $baseQuery;
    //     $campaignData = $campaigns
    //         ->select(
    //             'applications.campaign_id',
    //             DB::raw('COUNT(applications.id) as mql'),
    //             DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
    //             DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
    //             DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
    //             DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
    //             DB::raw('COUNT(sales_data.customer_id) as inv')
    //         )
    //         ->groupBy('applications.campaign_id')
    //         ->orderByDesc('mql')
    //         ->get();

    //     // Step 2: Get city-level aggregates per campaign
    //     $cityData = (clone $baseQuery)
    //         ->select(
    //             'applications.campaign_id',
    //             'applications.city_id',
    //             DB::raw('COUNT(applications.id) as mql'),
    //             DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
    //             DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
    //             DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
    //             DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
    //             DB::raw('COUNT(sales_data.customer_id) as inv')
    //         )
    //         ->groupBy('applications.campaign_id', 'applications.city_id')
    //         ->get()
    //         ->groupBy('campaign_id');

    //     // Step 3: Get branch-level aggregates per city per campaign
    //     $branchData = (clone $baseQuery)
    //         ->select(
    //             'applications.campaign_id',
    //             'applications.city_id',
    //             'applications.branch_id',
    //             DB::raw('COUNT(applications.id) as mql'),
    //             DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
    //             DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
    //             DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
    //             DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
    //             DB::raw('COUNT(sales_data.customer_id) as inv')
    //         )
    //         ->groupBy('applications.campaign_id', 'applications.city_id', 'applications.branch_id')
    //         ->get()
    //         ->groupBy(fn($item) => $item->campaign_id . '-' . $item->city_id);

    //     // Build final structured result
    //     $result = $campaignData->map(function ($campaign) use ($cityData, $branchData, $campaignsList, $campaignPercentages, $citiesList, $branchesList) {
    //         $cities = $cityData[$campaign->campaign_id] ?? collect();

    //         $cityResults = $cities->map(function ($city) use ($campaign, $branchData, $citiesList, $branchesList) {
    //             $key = $city->campaign_id . '-' . $city->city_id;
    //             $branches = $branchData[$key] ?? collect();

    //             return [
    //                 'city_id' => $city->city_id,
    //                 'city_name' => $citiesList[$city->city_id] ?? 'Others',
    //                 'mql' => $city->mql,
    //                 'cql' => $city->cql,
    //                 'cnq' => $city->cnq,
    //                 'cgi' => $city->cgi,
    //                 'unreach' => $city->unreach,
    //                 'inv' => $city->inv,
    //                 'branches' => $branches->map(function ($branch) use ($branchesList) {
    //                     return [
    //                         'branch_id' => $branch->branch_id,
    //                         'branch_name' => $branchesList[$branch->branch_id] ?? 'Others',
    //                         'mql' => $branch->mql,
    //                         'cql' => $branch->cql,
    //                         'cnq' => $branch->cnq,
    //                         'cgi' => $branch->cgi,
    //                         'unreach' => $branch->unreach,
    //                         'inv' => $branch->inv,
    //                     ];
    //                 })->values(),
    //             ];
    //         });

    //         return [
    //             'campaign_id' => $campaign->campaign_id,
    //             'campaign_name' => $campaignsList[$campaign->campaign_id] ?? 'Others',
    //             'percentage' => $campaignPercentages[$campaign->campaign_id] ?? 30,
    //             'mql' => $campaign->mql,
    //             'cql' => $campaign->cql,
    //             'cnq' => $campaign->cnq,
    //             'cgi' => $campaign->cgi,
    //             'unreach' => $campaign->unreach,
    //             'inv' => $campaign->inv,
    //             'cities' => $cityResults->values(),
    //         ];
    //     });

    //     return $result;
    // }

    public static function getCampaignCityWiseDetailData($startDate, $endDate, $all_types, $filters)
    {
        $dateInfo = getDateRangeAndColumn();
        $dateColumn = $dateInfo['date_column'];
        // 1. Campaign-level Aggregation
        $campaigns = Application::select(
                'campaign_id',
                DB::raw('COUNT(*) as mql'),
                DB::raw('SUM(category = "Qualified") as cql'),
                DB::raw('SUM(category = "Not Qualified") as cnq'),
                DB::raw('SUM(category = "General Inquiry") as cgi'),
                DB::raw('SUM(category = "Unreachable") as unreach'),
                DB::raw('SUM(customer_id IN (SELECT customer_id FROM sales_data)) as inv')
            )
            ->whereIn('type', $all_types)
            ->whereBetween($dateColumn, [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('campaign_id')
            ->get();

        // 2. City-level Aggregation
        $cities = Application::select(
                'campaign_id',
                'city_id',
                DB::raw('COUNT(*) as mql'),
                DB::raw('SUM(category = "Qualified") as cql'),
                DB::raw('SUM(category = "Not Qualified") as cnq'),
                DB::raw('SUM(category = "General Inquiry") as cgi'),
                DB::raw('SUM(category = "Unreachable") as unreach'),
                DB::raw('SUM(customer_id IN (SELECT customer_id FROM sales_data)) as inv')
            )
            ->whereIn('type', $all_types)
            ->whereBetween($dateColumn, [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('campaign_id', 'city_id')
            ->with('city:id,name')
            ->get();

        // 3. Branch-level Aggregation
        $branches = Application::select(
                'campaign_id',
                'city_id',
                'branch_id',
                DB::raw('COUNT(*) as mql'),
                DB::raw('SUM(category = "Qualified") as cql'),
                DB::raw('SUM(category = "Not Qualified") as cnq'),
                DB::raw('SUM(category = "General Inquiry") as cgi'),
                DB::raw('SUM(category = "Unreachable") as unreach'),
                DB::raw('SUM(customer_id IN (SELECT customer_id FROM sales_data)) as inv')
            )
            ->whereIn('type', $all_types)
            ->whereBetween($dateColumn, [$startDate, $endDate])
            ->graphsearch($filters)
            ->groupBy('campaign_id', 'city_id', 'branch_id')
            ->with('branch:id,name')
            ->get();

        // Grouping data
        $citiesGrouped = $cities->groupBy('campaign_id');
        $branchesGrouped = $branches->groupBy(fn($b) => $b->campaign_id . '_' . $b->city_id);

        // Fetch campaign metadata
        $campaignIds = $campaigns->pluck('campaign_id')->unique();
        $campaignData = Campaign::whereIn('id', $campaignIds)->pluck('name', 'id');
        $campaignPercentages = Campaign::whereIn('id', $campaignIds)->pluck('percentage', 'id');

        // Final structured result
        return $campaigns->map(function ($campaign) use ($citiesGrouped, $branchesGrouped, $campaignData, $campaignPercentages) {
            $cityData = $citiesGrouped[$campaign->campaign_id] ?? collect();

            $cities = $cityData->map(function ($city) use ($branchesGrouped) {
                $branchKey = $city->campaign_id . '_' . $city->city_id;
                $branchData = $branchesGrouped[$branchKey] ?? collect();

                return [
                    'city_id' => $city->city_id,
                    'city_name' => $city->city->name ?? 'Others',
                    'mql' => $city->mql,
                    'cql' => $city->cql,
                    'cnq' => $city->cnq,
                    'cgi' => $city->cgi,
                    'unreach' => $city->unreach,
                    'inv' => $city->inv,
                    'branches' => $branchData->map(function ($branch) {
                        return [
                            'branch_id' => $branch->branch_id,
                            'branch_name' => $branch->branch->name ?? 'Others',
                            'mql' => $branch->mql,
                            'cql' => $branch->cql,
                            'cnq' => $branch->cnq,
                            'cgi' => $branch->cgi,
                            'unreach' => $branch->unreach,
                            'inv' => $branch->inv,
                        ];
                    })->values(),
                ];
            });

            return [
                'campaign_id' => $campaign->campaign_id,
                'percentage' => $campaignPercentages[$campaign->campaign_id] ?? 30,
                'campaign_name' => $campaignData[$campaign->campaign_id] ?? 'Others',
                'mql' => $campaign->mql,
                'cql' => $campaign->cql,
                'cnq' => $campaign->cnq,
                'cgi' => $campaign->cgi,
                'unreach' => $campaign->unreach,
                'inv' => $campaign->inv,
                'cities' => $cities->values(),
            ];
        })->sortByDesc('mql')->values();
    }


    // ECWD
    // public static function getCampaignWiseDetialData($startDate, $endDate, $all_types, $filters)
    // {
    //     $campaigns = Application::select(
    //             'campaign_id',
    //             DB::raw('COUNT(*) as mql'),
    //             DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
    //             DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
    //             DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
    //             DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
    //             // DB::raw('SUM(CASE WHEN customer_id IN (
    //             //     SELECT customer_id FROM sales_data
    //             //     WHERE inv_date BETWEEN "' . $startDate . '" AND "' . $endDate . '"
    //             // ) THEN 1 ELSE 0 END) as inv')
    //             DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
    //             // DB::raw('SUM(CASE WHEN EXISTS (SELECT 1 FROM sales_data WHERE sales_data.customer_id = applications.customer_id) THEN 1 ELSE 0 END) as inv')

    //         )
    //         ->whereIn('type', $all_types)
    //         ->whereBetween('created_at', [$startDate, $endDate])
    //         ->graphsearch($filters)
    //         ->with(['campaign:id,name,percentage', 'source:id,name'])
    //         ->groupBy('campaign_id')
    //         ->orderby('mql','DESC')
    //         ->get()
    //         ->map(function ($application) use ($all_types, $startDate, $endDate,$filters) {
    //                 $application->sources = Application::select(
    //                     'source_id',
    //                     DB::raw('COUNT(*) as mql'),
    //                     DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
    //                     DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
    //                     DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
    //                     DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
    //                     // DB::raw('SUM(CASE WHEN customer_id IN (
    //                     //     SELECT customer_id FROM sales_data
    //                     //     WHERE inv_date BETWEEN "' . $startDate . '" AND "' . $endDate . '"
    //                     // ) THEN 1 ELSE 0 END) as inv')
    //                     DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
    //                     // DB::raw('SUM(CASE WHEN EXISTS (SELECT 1 FROM sales_data WHERE sales_data.customer_id = applications.customer_id) THEN 1 ELSE 0 END) as inv')

    //                 )
    //                 ->whereIn('type', $all_types)
    //                 ->whereBetween('created_at', [$startDate, $endDate])
    //                 ->graphsearch($filters)
    //                 ->with('source:id,name')
    //                 ->where('campaign_id', $application->campaign_id)
    //                 ->groupBy('source_id')
    //                 ->orderby('mql','DESC')
    //                 ->get()
    //                 ->map(function ($sourceApplication) {
    //                     return [
    //                         'source_id' => $sourceApplication->source_id,
    //                         'source_name' => $sourceApplication->source->name ?? 'Others',
    //                         'mql' => $sourceApplication->mql,
    //                         'cql' => $sourceApplication->cql,
    //                         'cnq' => $sourceApplication->cnq,
    //                         'cgi' => $sourceApplication->cgi,
    //                         'unreach' => $sourceApplication->unreach,
    //                         'inv' => $sourceApplication->inv,
    //                     ];
    //                 });

    //             return [
    //                 'campaign_id' => $application->campaign_id,
    //                 'percentage' => $application->campaign->percentage ?? 30,
    //                 'campaign_name' => $application->campaign->name ?? 'Others',
    //                 'mql' => $application->mql,
    //                 'cql' => $application->cql,
    //                 'cnq' => $application->cnq,
    //                 'cgi' => $application->cgi,
    //                 'unreach' => $application->unreach,
    //                 'inv' => $application->inv,
    //                 'sources' => $application->sources,
    //             ];
    //         });

    //     return $campaigns;

    // }

    // public static function getCampaignVehcileWiseDetialData($startDate, $endDate, $all_types, $filters)
    // {
    //     $campaigns = Application::select(
    //             'campaign_id',
    //             DB::raw('COUNT(*) as mql'),
    //             DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
    //             DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
    //             DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
    //             DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
    //             DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
    //         )
    //         ->whereIn('type', $all_types)
    //         ->whereBetween('created_at', [$startDate, $endDate])
    //         ->graphsearch($filters)
    //         ->with(['campaign:id,name,percentage', 'vehicle:id,name'])
    //         ->groupBy('campaign_id')
    //         ->orderby('mql','DESC')
    //         ->get()
    //         ->map(function ($application) use ($all_types, $startDate, $endDate, $filters) {
    //                 $application->vehicles = Application::select(
    //                     'vehicle_id',
    //                     DB::raw('COUNT(*) as mql'),
    //                     DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
    //                     DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
    //                     DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
    //                     DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
    //                     DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
    //                 )
    //                 ->whereIn('type', $all_types)
    //                 ->whereBetween('created_at', [$startDate, $endDate])
    //                 ->graphsearch($filters)
    //                 ->with('vehicle:id,name')
    //                 ->where('campaign_id', $application->campaign_id)
    //                 ->groupBy('vehicle_id')
    //                 ->orderby('mql','DESC')
    //                 ->get()
    //                 ->map(function ($vehicleApplication) {
    //                     return [
    //                         'vehicle_id' => $vehicleApplication->vehicle_id,
    //                         'vehicle_name' => $vehicleApplication->vehicle->name ?? 'Others',
    //                         'mql' => $vehicleApplication->mql,
    //                         'cql' => $vehicleApplication->cql,
    //                         'cnq' => $vehicleApplication->cnq,
    //                         'cgi' => $vehicleApplication->cgi,
    //                         'unreach' => $vehicleApplication->unreach,
    //                         'inv' => $vehicleApplication->inv,
    //                     ];
    //                 });

    //             return [
    //                 'campaign_id' => $application->campaign_id,
    //                 'percentage' => $application->campaign->percentage ?? 30,
    //                 'campaign_name' => $application->campaign->name ?? 'Others',
    //                 'mql' => $application->mql,
    //                 'cql' => $application->cql,
    //                 'cnq' => $application->cnq,
    //                 'cgi' => $application->cgi,
    //                 'unreach' => $application->unreach,
    //                 'inv' => $application->inv,
    //                 'vehicles' => $application->vehicles,
    //             ];
    //         });

    //     return $campaigns;
    // }
    // public static function getCampaignCityWiseDetailData($startDate, $endDate, $all_types, $filters)
    // {
    //     $campaigns = Application::select(
    //             'campaign_id',
    //             DB::raw('COUNT(*) as mql'),
    //             DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
    //             DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
    //             DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
    //             DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
    //             DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
    //         )
    //         ->whereIn('type', $all_types)
    //         ->whereBetween('created_at', [$startDate, $endDate])
    //         ->graphsearch($filters)
    //         ->with(['campaign:id,name,percentage', 'city:id,name'])
    //         ->groupBy('campaign_id')
    //         ->orderby('mql', 'DESC')
    //         ->get()
    //         ->map(function ($application) use ($all_types, $startDate, $endDate, $filters) {
    //             $application->cities = Application::select(
    //                 'city_id',
    //                 DB::raw('COUNT(*) as mql'),
    //                 DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
    //                 DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
    //                 DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
    //                 DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
    //                 DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
    //             )
    //             ->whereIn('type', $all_types)
    //             ->whereBetween('created_at', [$startDate, $endDate])
    //             ->graphsearch($filters)
    //             ->with('city:id,name')
    //             ->where('campaign_id', $application->campaign_id)
    //             ->groupBy('city_id')
    //             ->orderby('mql', 'DESC')
    //             ->get()
    //             ->map(function ($cityApplication) use ($all_types, $startDate, $endDate, $filters, $application) {
    //                 $cityApplication->branches = Application::select(
    //                     'branch_id',
    //                     DB::raw('COUNT(*) as mql'),
    //                     DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
    //                     DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
    //                     DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
    //                     DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
    //                     DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
    //                 )
    //                 ->whereIn('type', $all_types)
    //                 ->whereBetween('created_at', [$startDate, $endDate])
    //                 ->graphsearch($filters)
    //                 ->with('branch:id,name')
    //                 ->where('campaign_id', $application->campaign_id)
    //                 ->where('city_id', $cityApplication->city_id)
    //                 ->groupBy('branch_id')
    //                 ->orderby('mql', 'DESC')
    //                 ->get()
    //                 ->map(function ($branchApplication) {
    //                     return [
    //                         'branch_id' => $branchApplication->branch_id,
    //                         'branch_name' => $branchApplication->branch->name ?? 'Others',
    //                         'mql' => $branchApplication->mql,
    //                         'cql' => $branchApplication->cql,
    //                         'cnq' => $branchApplication->cnq,
    //                         'cgi' => $branchApplication->cgi,
    //                         'unreach' => $branchApplication->unreach,
    //                         'inv' => $branchApplication->inv,
    //                     ];
    //                 });

    //                 return [
    //                     'city_id' => $cityApplication->city_id,
    //                     'city_name' => $cityApplication->city->name ?? 'Others',
    //                     'mql' => $cityApplication->mql,
    //                     'cql' => $cityApplication->cql,
    //                     'cnq' => $cityApplication->cnq,
    //                     'cgi' => $cityApplication->cgi,
    //                     'unreach' => $cityApplication->unreach,
    //                     'inv' => $cityApplication->inv,
    //                     'branches' => $cityApplication->branches,
    //                 ];
    //             });

    //             return [
    //                 'campaign_id' => $application->campaign_id,
    //                 'percentage' => $application->campaign->percentage ?? 30,
    //                 'campaign_name' => $application->campaign->name ?? 'Others',
    //                 'mql' => $application->mql,
    //                 'cql' => $application->cql,
    //                 'cnq' => $application->cnq,
    //                 'cgi' => $application->cgi,
    //                 'unreach' => $application->unreach,
    //                 'inv' => $application->inv,
    //                 'cities' => $application->cities,
    //             ];
    //         });

    //     return $campaigns;
    // }
    // ECWD end

    public static function getCityBranchCampaignData($startDate, $endDate, $all_types, $filters)
    {
        $dateInfo = getDateRangeAndColumn();
        $dateColumn = $dateInfo['date_column'];
        $cities = Application::select(
                'city_id',
                DB::raw('COUNT(*) as mql'),
                DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
                DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
                DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
                DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
                DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
            )
            ->whereIn('type', $all_types)
            ->whereBetween($dateColumn, [$startDate, $endDate])
            ->graphsearch($filters)
            ->with('city:id,name')
            ->groupBy('city_id')
            ->orderBy('mql', 'DESC')
            ->get()
            ->map(function ($cityApp) use ($all_types, $startDate, $endDate, $filters,$dateColumn) {
                $cityApp->branches = Application::select(
                        'branch_id',
                        DB::raw('COUNT(*) as mql'),
                        DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
                        DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
                        DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
                        DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
                        DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
                    )
                    ->whereIn('type', $all_types)
                    ->whereBetween($dateColumn, [$startDate, $endDate])
                    ->graphsearch($filters)
                    ->with('branch:id,name')
                    ->where('city_id', $cityApp->city_id)
                    ->groupBy('branch_id')
                    ->orderBy('mql', 'DESC')
                    ->get()
                    ->map(function ($branchApp) use ($all_types, $startDate, $endDate, $filters, $cityApp,$dateColumn) {
                        $branchApp->campaigns = Application::select(
                                'campaign_id',
                                DB::raw('COUNT(*) as mql'),
                                DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
                                DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
                                DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
                                DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
                                DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
                            )
                            ->whereIn('type', $all_types)
                            ->whereBetween($dateColumn, [$startDate, $endDate])
                            ->graphsearch($filters)
                            ->with('campaign:id,name,percentage')
                            ->where('city_id', $cityApp->city_id)
                            ->where('branch_id', $branchApp->branch_id)
                            ->groupBy('campaign_id')
                            ->orderBy('mql', 'DESC')
                            ->get()
                            ->map(function ($campApp) {
                                return [
                                    'campaign_id' => $campApp->campaign_id,
                                    'campaign_name' => $campApp->campaign->name ?? 'Others',
                                    'percentage' => $campApp->campaign->percentage ?? 30,
                                    'mql' => $campApp->mql,
                                    'cql' => $campApp->cql,
                                    'cnq' => $campApp->cnq,
                                    'cgi' => $campApp->cgi,
                                    'unreach' => $campApp->unreach,
                                    'inv' => $campApp->inv,
                                ];
                            });

                        return [
                            'branch_id' => $branchApp->branch_id,
                            'branch_name' => $branchApp->branch->name ?? 'Others',
                            'mql' => $branchApp->mql,
                            'cql' => $branchApp->cql,
                            'cnq' => $branchApp->cnq,
                            'cgi' => $branchApp->cgi,
                            'unreach' => $branchApp->unreach,
                            'inv' => $branchApp->inv,
                            'campaigns' => $branchApp->campaigns,
                        ];
                    });

                return [
                    'city_id' => $cityApp->city_id,
                    'city_name' => $cityApp->city->name ?? 'Others',
                    'mql' => $cityApp->mql,
                    'cql' => $cityApp->cql,
                    'cnq' => $cityApp->cnq,
                    'cgi' => $cityApp->cgi,
                    'unreach' => $cityApp->unreach,
                    'inv' => $cityApp->inv,
                    'branches' => $cityApp->branches,
                ];
            });

        return $cities;
    }


    public static function getVehcileDetialData($startDate, $endDate, $all_types, $filters)
    {
        $dateInfo = getDateRangeAndColumn();
        $dateColumn = $dateInfo['date_column'];
        $vehicles = Application::select(
            'vehicle_id',
            DB::raw('COUNT(*) as mql'),
            DB::raw('SUM(CASE WHEN category = "Qualified" THEN 1 ELSE 0 END) as cql'),
            DB::raw('SUM(CASE WHEN category = "Not Qualified" THEN 1 ELSE 0 END) as cnq'),
            DB::raw('SUM(CASE WHEN category = "General Inquiry" THEN 1 ELSE 0 END) as cgi'),
            DB::raw('SUM(CASE WHEN category = "Unreachable" THEN 1 ELSE 0 END) as unreach'),
            DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
        )
        ->whereIn('type', $all_types)
        ->whereBetween($dateColumn, [$startDate, $endDate])
        ->graphsearch($filters)
        ->with('vehicle:id,name')
        ->groupBy('vehicle_id')
        ->orderBy('mql', 'DESC')
        ->get()
        ->map(function ($vehicleApplication) {
            return [
                'vehicle_id' => $vehicleApplication->vehicle_id,
                'vehicle_name' => $vehicleApplication->vehicle->name ?? 'Others',
                'mql' => $vehicleApplication->mql,
                'cql' => $vehicleApplication->cql,
                'cnq' => $vehicleApplication->cnq,
                'cgi' => $vehicleApplication->cgi,
                'unreach' => $vehicleApplication->unreach,
                'inv' => $vehicleApplication->inv,
            ];
        });

        return $vehicles;


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

        // if ($months_diff >= 12) {
        //     // Generate an array of years between start and end dates
        //     $yearsArray = [];
        //     $currentYear = $startDate->copy()->startOfYear();
        //     while ($currentYear->lte($endDate)) {
        //         $yearsArray[] = $currentYear->format('Y'); // Format as "Year"
        //         $currentYear->addYear(); // Move to the next year
        //     }

        //     $data['months'] = $yearsArray;

        // }
        // else
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
        // $dateFormat = ($months_diff > 12) ? '%Y' : (($months_diff > 3) ? '%M %Y' : '%Y-%m-%d');
        // Adjust the end date to include the full day
        //$endDate = Carbon::parse($endDate)->endOfDay();
        // Generate the date range sequence
        $dateInfo = getDateRangeAndColumn();
        $dateColumn = $dateInfo['date_column'];
        $dates = self::generateDateRange($startDate, $endDate, $dateFormat);

        $maincounts = self::select(
                DB::raw("DATE_FORMAT($dateColumn, '$dateFormat') as month_year"),
               DB::raw('COUNT(*) as count'),
                // DB::raw('COUNT(DISTINCT customer_id) as count')
                //DB::raw('GROUP_CONCAT(DISTINCT customer_id ORDER BY customer_id ASC) as customer_ids')
            )
            ->whereBetween($dateColumn, [$startDate, $endDate])
            ->whereIn('type', $types)
            // ->whereNotNull(['campaign_id', 'source_id'])
            ->groupBy(DB::raw("DATE_FORMAT($dateColumn, '$dateFormat')"))
            ->orderBy(DB::raw("MIN($dateColumn)"), 'asc')
            ->graphsearch($filters)
            ->when(isset($opt_filters['department']), function ($query) use ($opt_filters) {
                return $query->where('department', $opt_filters['department']);
            })
            ->get()
            ->pluck('count', 'month_year');
            // dd($maincounts);
            $results = [];
            foreach ($dates as $date) {
                // $results[$date] = $maincounts->get($date, 0);
                $results[$date] = $maincounts->get($date, 0);
            }

            return array_values($results);

    }


    public static function getTargetMonthWise($startDate, $endDate, $months_diff) {

        $dateFormat = ($months_diff > 3) ? '%M %Y' : '%Y-%m-%d';
        $dates = self::generateDateRange($startDate, $endDate, $dateFormat);
        $data = Target::selectRaw('date, SUM(count) as total_count')
        ->whereBetween('date', [dateformat($startDate), dateformat($endDate)])
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->pluck('total_count', 'date');

        $results = [];
        foreach ($dates as $date) {
            // $results[$date] = $maincounts->get($date, 0);
            $results[$date] = $data->get($date, 0);
        }
        return array_values($results);
        // dd($data,array_values($results));

    }

    public static function getCrmUserGraph($startDate,$endDate,$first_types,$filters) {

        $dateInfo = getDateRangeAndColumn();
        $dateColumn = $dateInfo['date_column'];
        return self::with('updatedby')
            ->select(
                'updated_by',
                DB::raw('COUNT(*) as mql'),
                DB::raw("SUM(CASE WHEN category = 'Qualified' THEN 1 ELSE 0 END) as qualified_count"),
                DB::raw("SUM(CASE WHEN category = 'Not Qualified' THEN 1 ELSE 0 END) as not_qualified_count"),
                DB::raw("SUM(CASE WHEN category = 'General Inquiry' THEN 1 ELSE 0 END) as general_inquiry_count"),
                DB::raw('SUM(CASE WHEN customer_id IN (SELECT customer_id FROM sales_data) THEN 1 ELSE 0 END) as inv')
            )
            ->whereIn('type', $first_types)
            ->whereBetween($dateColumn, [$startDate, $endDate])
            ->graphsearch($filters)
            ->whereNotNull('updated_by')
            ->whereHas('updatedby', function ($query) {
                $query->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'Crm Lead User');
                });
            })
            ->groupBy('updated_by')
            ->get()->toArray();

    }

    public static function getCrmUserSourcesGraph($startDate,$endDate,$first_types,$filters) {

        $dateInfo = getDateRangeAndColumn();
        $dateColumn = $dateInfo['date_column'];
        return self::with('updatedby')
        ->select(
            'updated_by',
            DB::raw("SUM(CASE WHEN sources.name = 'Email' THEN 1 ELSE 0 END) as email_count"),
            DB::raw("SUM(CASE WHEN sources.name = 'Whatsapp' THEN 1 ELSE 0 END) as whatsapp_count"),
            DB::raw("SUM(CASE WHEN sources.name = 'Inbound' THEN 1 ELSE 0 END) as inbound_count"),
            DB::raw("SUM(CASE WHEN sources.name = 'Outbound' THEN 1 ELSE 0 END) as outbound_count"),
            // DB::raw("SUM(CASE WHEN sources.name NOT IN ('Email', 'Whatsapp', 'Inbound', 'Outbound') OR sources.name IS NULL THEN 1 ELSE 0 END) as other_count"),
            // DB::raw("SUM(CASE WHEN sources.name NOT IN ('Email', 'Whatsapp', 'Inbound', 'Outbound') THEN 1 ELSE 0 END) as other_count")
            DB::raw("SUM(CASE WHEN sources.name NOT IN ('Email', 'Whatsapp', 'Inbound', 'Outbound') OR sources.name IS NULL THEN 1 ELSE 0 END) as other_count")
        )
        // ->join('sources', 'applications.source_id', '=', 'sources.id')
        ->leftjoin('sources', 'applications.source_id', '=', 'sources.id')
        ->whereIn('type', $first_types)
        ->whereBetween('applications.' .$dateColumn, [$startDate, $endDate])
        ->graphsearch($filters)
        ->whereNotNull('updated_by')
        ->whereHas('updatedby', function ($query) {
            $query->whereHas('roles', function ($roleQuery) {
                $roleQuery->where('name', 'Crm Lead User');
            });
        })
        ->groupBy('updated_by')
        ->get()->toArray();

    }

      // Helper function to generate the date range
    //   public static function generateDateRange($startDate, $endDate, $dateFormat) {
    //     $start = new \DateTime($startDate);
    //     $end = new \DateTime($endDate);
    //     $end->modify('+1 day'); // to include end date in the range

    //     // Determine the interval based on the date format
    //     if ($dateFormat == '%Y') {
    //         $interval = new \DateInterval('P1Y'); // Interval of 1 year
    //     } elseif ($dateFormat == '%M %Y') {
    //         $interval = new \DateInterval('P1M'); // Interval of 1 month
    //     } else {
    //         $interval = new \DateInterval('P1D'); // Interval of 1 day
    //     }

    //     $period = new \DatePeriod($start, $interval, $end);

    //     $dates = [];
    //     foreach ($period as $date) {
    //         if ($dateFormat == '%Y') {
    //             $dates[] = $date->format('Y'); // Add only the year
    //         } elseif ($dateFormat == '%M %Y') {
    //             $dates[] = $date->format('F Y'); // Add month and year
    //         } else {
    //             $dates[] = $date->format('Y-m-d'); // Add full date
    //         }
    //     }

    //     return $dates;
    // }

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

    protected static bool $skipTracking = false;

    public static function skipTracking(bool $skip = true)
    {
        static::$skipTracking = $skip;
    }

    protected static function booted()
    {
        static::creating(function ($application) {
            if (self::$skipTracking) {
                return;
            }

            if (Auth::check() && !Auth::user()->hasRole('Super Admin')) {
                $application->created_by = Auth::check() ? Auth::id() : null;
            }
            if (Auth::check() && Auth::user()->hasRole('Crm Lead User')) {
                $application->updated_by = Auth::id();
            }
        });

        static::updating(function ($application) {
            if (self::$skipTracking) {
                return;
            }

            if (Auth::check() && !Auth::user()->hasRole('Super Admin')) {
                $application->updated_by = Auth::id();
            }
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
        // if($application->category == 'Qualified'){
        //     return redirect()->back()->with('error','You cannnot update this lead');
        // }
        // if ($request->has('mobile')) {
            $customer = updCustomer($request,$application->customer_id);
        // }

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
