<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Campaign;
use App\Models\Application;
use App\Models\Customer;
use App\Models\Bank;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExternalLeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function pdplForm(Request $request)
    {
        $id =base64_decode($request->chk);
        $existchk = false;

        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:applications,id',
        ]);

        if($validator->fails()){
            $existchk = true;
        }
        // dd($existchk,$id);
        return view('pdpl-index',compact('existchk'));
    }

    public function pdplFormSubmit(Request $request) {
        dd($request->all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['cities']=City::whereStatus(1)->get();
        $data['branches']=Branch::whereStatus(1)->get();
        $data['vehicles']=Vehicle::whereStatus(1)->get();
        $data['sources']=Source::whereStatus(1)->get();
        $data['campaigns']=Campaign::whereStatus(1)->get();
        return view('admin.lead.test_lead_add' , $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            // 'mobile' => 'required|string|max:15',
            'mobile' => 'required|string|regex:/^05\d{8}$/',
            'email' => 'nullable|email'
        ],
        [
            'mobile.regex' => 'The mobile number must be exactly 10 digits and start with 05.',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        //dd($request->all());
        \Log::info('customer api hit');
        \Log::info($request->all());

        $bank = null;
        $city = null;
        $branch = null;
        $vehicle = null;
        $sourcee = null;
        $campaign = null;
        // Collect data that can be null safely
        $optionalData = [
            'bank' => $request->input('customersBank') ?? null,
            'dealer_city' => $request->input('dealerCity') ?? null,
            'dealer_branch' => $request->input('branch') ?? null,
            'vehicle' => $request->input('vehicle') ?? null,
            'channel' => $request->input('sourcee') ?? null,
            'campaign' => $request->input('campaignName') ?? null,
        ];

            // Fetch or create related models in one go
            foreach ($optionalData as $key => $value) {
                if ($value) {
                    switch ($key) {
                        case 'bank':
                            $bank = Bank::firstOrCreate(['name' => $value]);
                            break;
                        case 'dealer_city':
                            $city = City::firstOrCreate(['name' => $value]);
                            break;
                        case 'dealer_branch':
                            if ($city) {
                                $branch = Branch::firstOrCreate(['name' => $value, 'city_id' => $city->id]);
                            }
                            break;
                        case 'vehicle':
                            $vehicle = Vehicle::firstOrCreate(['name' => $value]);
                            break;
                        case 'channel':
                            $sourcee = Source::firstOrCreate(['name' => $value]);
                            break;
                        case 'campaign':
                            $campaign = Campaign::firstOrCreate(['name' => $value]);
                            break;
                    }
                }
            }

        $mobile = $request->input('mobile');
        $mobile =formatInputNumber($mobile);

        $customer = Customer::updateOrCreate(
            ['mobile' => $mobile],
            [
                'first_name' => $request->input('firstName'),
                'last_name' => $request->input('lastName'),
                'email' => $request->input('email') ?? null,
                'bank_id' => $bank->id ?? null,
            ]
        );


        // Get the current date and extract the year and month
        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;

        $existingApplication = Application::where('customer_id', $customer->id)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->first();

        if ($existingApplication) {
            return response()->json([
                'success' => true,'message' => 'Already Added Successfully',
                'data'=> [ $existingApplication->id ],
            ], 200);
            // return $existingApplication;
        }

        $lead = new Application();
        $lead->city_id = $city->id;
        $lead->branch_id = $branch->id;
        $lead->vehicle_id = $vehicle->id;
        $lead->source_id = $sourcee->id;
        $lead->campaign_id = $campaign->id;
        $lead->purchase_plan = $request->input('purchasePlan');
        $lead->monthly_salary = $request->input('monthlySalary');
        $lead->preferred_appointment_time = $request->input('preferredTime');
        $lead->customer_id= $customer->id;
        $lead->type = 'leads';
        $lead->save();

        \Log::info('customer api hit end');

        return response()->json([
            'success' => true,'message' => 'Added Successfully',
            'data'=> [ $lead->id ],
        ], 200);

    }

    // public function saveformstore(Request $request) {


    //     $mobile = $request->input('phone_num');
    //     $mobile =formatInputNumber($mobile);

    //     $customer = Customer::firstOrCreate(
    //         ['mobile' => $mobile],
    //         [
    //             'first_name' => $request->input('first_name'),
    //             'last_name' => $request->input('sur_name'),
    //             'email' => $request->input('send_email') ?? null,
    //             'city_id' =>  null,
    //             'bank_id' =>  null,
    //             'national_id' => null,
    //         ]
    //     );

    //     // Get the current date and extract the year and month
    //     $currentDate = Carbon::now();
    //     $currentYear = $currentDate->year;
    //     $currentMonth = $currentDate->month;

    //     // Check for an existing application for the current customer
    //     $existingApplication = self::where('customer_id', $customer->id)
    //         ->whereYear('created_at', $currentYear)
    //         ->whereMonth('created_at', $currentMonth)
    //         ->first();

    //     if ($existingApplication) {
    //         return $existingApplication;
    //     }

    //     $sourcee = Source::firstOrCreate([ 'name' => $request->input('sourcee') ]);
    //     $vehicle = Vehicle::firstOrCreate(['name' => $request->input('interested')]);
    //     // Create a new application
    //     $application = new self;
    //     $application->source_id = $sourcee->id ?? "";
    //     $application->vehicle_id = $vehicle ?? "";
    //     $application->title = $request->input('title');
    //     $application->second_surname = $request->input('second_surname');
    //     $application->zip_code = $request->input('zip_code');
    //     $application->year = $request->input('selYear'); // Assuming 'selYear' refers to year
    //     $application->month = $request->input('selMonth'); // Assuming 'selMonth' refers to month
    //     $application->request_date = $request->input('selDate'); // Assuming 'selDate' refers to date
    //     $application->newsletter = $request->input('newsletter');
    //     $application->comments = $request->input('comments');
    //     $application->customer_id = $customer->id;
    //     $application->type = 'online_service_booking';

    //     // Handle the 'created_at' field if 'select_date' is present
    //     if ($request->has('select_date')) {
    //         $date = Carbon::parse($request->input('select_date'));
    //         $dateWithCurrentTime = $date->format('Y-m-d') . ' ' . Carbon::now()->format('H:i:s');
    //         $application->created_at = $dateWithCurrentTime;
    //     }

    //     $application->save();

    //     return $application;


    // }

    public function saveformjson(Request $request) {

        // FIX #5: Normalise mobile before validation so all formats (+966, 966, 05) are accepted
        $normalizedMobile = formatInputNumber($request->input('mobile') ?? '');

        $validator = Validator::make(
            array_merge($request->all(), ['mobile' => $normalizedMobile]),
            [
                'firstName' => 'required|string|max:255',
                'mobile'    => 'required|string|regex:/^\+966\d{9}$/',
                'page'      => 'nullable|string|max:255',
                'email'     => 'nullable|email',
                // FIX #2 & #3: city and branch removed from validator — handled in logic with
                // case-insensitive lookup and no hard reject on mismatch
            ],
            [
                'mobile.regex' => 'The mobile number must be a valid Saudi mobile number.',
            ]
        );

        if ($validator->fails()) {
            // FIX #6: Return 422 for validation errors instead of 200
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        \Log::info('saveformjson api hit');
        \Log::info($request->all());

        $bank     = null;
        $city     = null;
        $branch   = null;
        $vehicle  = null;
        $sourcee  = null;
        $campaign = null;

        // FIX #2: Case-insensitive city lookup — no auto-create, no hard reject
        $cityInput = $request->input('dealerCity');
        if ($cityInput) {
            $city = City::whereRaw('LOWER(name) = ?', [strtolower(trim($cityInput))])->first();
            if (!$city) {
                \Log::warning('saveformjson: unmatched city "' . $cityInput . '"');
            }
        }

        // FIX #3: Case-insensitive branch lookup — no auto-create, no hard reject, log mismatches
        $branchInput = $request->input('branch');
        if ($branchInput) {
            // Strip trailing parenthetical suffixes e.g. "(Sales)", "(After Sales)" before matching
            $branchNormalised = trim(preg_replace('/\s*\([^)]*\)\s*$/', '', $branchInput));
            $branchQuery = Branch::whereRaw('LOWER(name) = ?', [strtolower($branchNormalised)]);
            if ($city) {
                $branchQuery->where('city_id', $city->id);
            }
            $branch = $branchQuery->first();
            if (!$branch) {
                \Log::warning('saveformjson: unmatched branch "' . $branchInput . '" normalised to "' . $branchNormalised . '" (city: ' . ($cityInput ?? 'none') . ')');
            }
        }

        // Lookup or create remaining optional references (vehicle, source, campaign auto-create is acceptable)
        $bankInput = $request->input('customerBank');
        if ($bankInput) {
            $bank = Bank::firstOrCreate(['name' => $bankInput]);
        }

        $vehicleInput = $request->input('vehicle');
        if ($vehicleInput) {
            $vehicle = Vehicle::firstOrCreate(['name' => $vehicleInput]);
        }

        $sourceInput = $request->input('sourcee');
        if ($sourceInput) {
            $sourcee = Source::firstOrCreate(['name' => $sourceInput]);
        }

        $campaignInput = $request->input('pagesub');
        if ($campaignInput) {
            $campaign = Campaign::firstOrCreate(['name' => $campaignInput]);
        }

        // FIX #5: Use already-normalised mobile from above
        $mobile = $normalizedMobile;

        $customer = Customer::updateOrCreate(
            ['mobile' => $mobile],
            [
                'first_name' => $request->input('firstName'),
                'last_name'  => $request->input('lastName'),
                'email'      => $request->input('email') ?? null,
                'city_id'    => $city->id ?? null,
                'bank_id'    => $bank->id ?? null,
                'national_id'=> $request->input('nationalId') ?? null,
            ]
        );

        // FIX #1: Use serviceType as fallback when page is absent or unrecognised
        $type = checkApplicationType($request->input('page'))
             ?: checkApplicationType($request->input('serviceType'))
             ?: 'leads';

        $currentDate  = Carbon::now();
        $currentYear  = $currentDate->year;
        $currentMonth = $currentDate->month;

        // FIX #4: Duplicate check is now type-aware — same customer can submit different lead types in same month
        $existingApplication = Application::where('customer_id', $customer->id)
            ->where('type', $type)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->first();

        if ($existingApplication) {
            $existingApplication->increment('submit_count');
            return response()->json([
                'success' => true,
                'message' => 'Already Added Successfully',
                'data'    => ['reference_id' => $existingApplication->id],
            ], 200);
        }

        $lead = new Application();
        $lead->type           = $type;
        $lead->city_id        = $city->id ?? null;
        $lead->branch_id      = $branch->id ?? null;
        $lead->vehicle_id     = $vehicle->id ?? null;
        $lead->source_id      = $sourcee->id ?? null;
        $lead->campaign_id    = $campaign->id ?? null;
        $lead->customer_id    = $customer->id;

        $lead->purchase_plan              = $request->input('purchasePlan');
        $lead->monthly_salary             = $request->input('monthlySalary');
        $lead->preferred_appointment_time = $request->input('preferredTime');
        $lead->apply_for                  = $request->input('applyFor');
        $lead->booking_reason             = $request->input('bookingreason');
        // FIX #1 & #8: serviceType stored in booking_category; falls back to bookingcategory for other form types
        $lead->booking_category           = $request->input('serviceType') ?? $request->input('bookingcategory');
        $lead->department                 = $request->input('department');
        $lead->title                      = $request->input('salutation');
        $lead->second_surname             = $request->input('middleName');
        $lead->zip_code                   = $request->input('zipCode');
        $lead->vin                        = $request->input('vin');
        $lead->yearr                      = $request->input('manufacturingYear');
        $lead->plateno                    = $request->input('plateNumbers');
        $lead->plate_alphabets            = $request->input('plateAlphabets');
        $lead->klmm                       = $request->input('mileage');
        $lead->intention                  = $request->input('purchasePlan');
        $lead->request_date               = $request->input('date');
        // FIX #8: preferred_time removed — preferred_appointment_time is the canonical column
        $lead->comments                   = $request->input('comments');
        $lead->sharingcv                  = $request->input('sharingCv');
        $lead->privacy_check              = $request->input('privacyCheck');
        $lead->marketingagreement         = $request->input('marketingAgreement');
        $lead->language                   = $request->input('language');
        $lead->company                    = $request->input('companyName');
        $lead->customers_type             = $request->input('customers_type');
        $lead->number_of_vehicles         = $request->input('number_of_vehicles');
        $lead->fleet_range                = $request->input('fleet_range');
        $lead->read_accept                = (bool) $request->input('read_accept', 0);
        $lead->letter_accept              = (bool) $request->input('letter_accept', 0);

        $lead->save();

        \Log::info('saveformjson api hit end — lead #' . $lead->id . ' type=' . $type);

        return response()->json([
            'success' => true,
            'message' => 'Added Successfully',
            'data'    => ['reference_id' => $lead->id],
        ], 200);
    }

    public function saveformjsonLegacy(Request $request) {

        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'mobile' => 'required|string|regex:/^05\d{8}$/',
            'page' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'dealerCity' => 'sometimes|exists:cities,name',
            'branch' => [
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value && $request->dealerCity) {
                        $city = \App\Models\City::where('name', $request->dealerCity)->first();
                        $branchExists = \App\Models\Branch::where('name', $value)
                                            ->where('city_id', $city->id ?? null)
                                            ->exists();
                        if (!$branchExists) {
                            $fail(__('The selected branch does not belong to the selected dealer city.'));
                        }
                    }
                },
            ],
        ],
        [
            'mobile.regex' => 'The mobile number must be exactly 10 digits and start with 05.',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        \Log::info('saveformjsonLegacy api hit');
        \Log::info($request->all());

        $bank = null; $city = null; $branch = null;
        $vehicle = null; $sourcee = null; $campaign = null;

        $optionalData = [
            'bank'          => $request->input('customerBank') ?? null,
            'dealer_city'   => $request->input('dealerCity') ?? null,
            'dealer_branch' => $request->input('branch') ?? null,
            'vehicle'       => $request->input('vehicle') ?? null,
            'channel'       => $request->input('sourcee') ?? null,
            'campaign'      => $request->input('pagesub') ?? null,
        ];

        foreach ($optionalData as $key => $value) {
            if ($value) {
                switch ($key) {
                    case 'bank':     $bank     = Bank::firstOrCreate(['name' => $value]); break;
                    case 'dealer_city':   $city = City::firstOrCreate(['name' => $value]); break;
                    case 'dealer_branch': if ($city) { $branch = Branch::firstOrCreate(['name' => $value, 'city_id' => $city->id]); } break;
                    case 'vehicle':  $vehicle  = Vehicle::firstOrCreate(['name' => $value]); break;
                    case 'channel':  $sourcee  = Source::firstOrCreate(['name' => $value]); break;
                    case 'campaign': $campaign = Campaign::firstOrCreate(['name' => $value]); break;
                }
            }
        }

        $mobile = formatInputNumber($request->input('mobile'));

        $customer = Customer::updateOrCreate(
            ['mobile' => $mobile],
            [
                'first_name'  => $request->input('firstName'),
                'last_name'   => $request->input('lastName'),
                'email'       => $request->input('email') ?? null,
                'city_id'     => $city->id ?? null,
                'bank_id'     => $bank->id ?? null,
                'national_id' => $request->input('nationalId') ?? null,
            ]
        );

        $type = checkApplicationType($request->input('page')) ?? 'leads';

        $currentDate  = Carbon::now();
        $currentYear  = $currentDate->year;
        $currentMonth = $currentDate->month;

        $existingApplication = Application::where('customer_id', $customer->id)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->first();

        if ($existingApplication) {
            $existingApplication->increment('submit_count');
            return response()->json([
                'success' => true, 'message' => 'Already Added Successfully',
                'data' => ['reference_id' => $existingApplication->id],
            ], 200);
        }

        $lead = new Application();
        $lead->type = $type;
        $lead->city_id = $city->id ?? null; $lead->branch_id = $branch->id ?? null;
        $lead->vehicle_id = $vehicle->id ?? null; $lead->source_id = $sourcee->id ?? null;
        $lead->campaign_id = $campaign->id ?? null;
        $lead->purchase_plan = $request->input('purchasePlan');
        $lead->monthly_salary = $request->input('monthlySalary');
        $lead->customer_id = $customer->id;
        $lead->apply_for = $request->input('applyFor');
        $lead->booking_reason = $request->input('bookingreason');
        $lead->booking_category = $request->input('bookingcategory');
        $lead->department = $request->input('department');
        $lead->title = $request->input('salutation');
        $lead->second_surname = $request->input('middleName');
        $lead->zip_code = $request->input('zipCode');
        $lead->vin = $request->input('vin');
        $lead->yearr = $request->input('manufacturingYear');
        $lead->plateno = $request->input('plateNumbers');
        $lead->plate_alphabets = $request->input('plateAlphabets');
        $lead->klmm = $request->input('mileage');
        $lead->intention = $request->input('purchasePlan');
        $lead->request_date = $request->input('date');
        $lead->preferred_appointment_time = $request->input('preferredTime');
        $lead->preferred_time = $request->input('preferredTime');
        $lead->comments = $request->input('comments');
        $lead->sharingcv = $request->input('sharingCv');
        $lead->privacy_check = $request->input('privacyCheck');
        $lead->marketingagreement = $request->input('marketingAgreement');
        $lead->language = $request->input('language');
        $lead->company = $request->input('companyName');
        $lead->customers_type = $request->input('customers_type');
        $lead->number_of_vehicles = $request->input('number_of_vehicles');
        $lead->fleet_range = $request->input('fleet_range');
        $lead->read_accept = (bool) $request->read_accept ?? 0;
        $lead->letter_accept = (bool) $request->letter_accept ?? 0;
        $lead->save();

        \Log::info('saveformjsonLegacy api hit end');

        return response()->json([
            'success' => true, 'message' => 'Added Successfully',
            'data' => ['reference_id' => $lead->id],
        ], 200);
    }

    public function crmLeadsListing(Request $request){

        $from_date_input = request('from_date');
        $datetime_pattern = '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/';
        $has_timestamp = $from_date_input && preg_match($datetime_pattern, $from_date_input);
        // dd($from_date_input, (bool) $has_timestamp);

        $from_date_str = request('from_date') ?: Carbon::now()->startOfDay()->toDateTimeString();

        $to_date_str = request('to_date') ?: Carbon::now()->endOfDay()->toDateTimeString();


        //  dd($from_date_str,$to_date_str);

        $records = DB::table('applications')
        ->select(
            'applications.id as id',
            DB::raw('COALESCE(campaigns.name, "") as Campaign'),
            DB::raw("
                CASE applications.type
                    WHEN 'leads' THEN 'Leads'
                    WHEN 'request_a_quote' THEN 'Request a Quote'
                    WHEN 'request_a_test_quote' THEN 'Request a Test Quote'
                    WHEN 'online_service_booking' THEN 'Online Service Booking'
                    WHEN 'special_offers' THEN 'Special Offers'
                    WHEN 'service_offers' THEN 'Service Offers'
                    WHEN 'fleet_sales' THEN 'Fleet Sales'
                    WHEN 'request_a_test_drive' THEN 'Request a Test Drive'
                    WHEN 'request_a_brochure' THEN 'Request a Brochure'
                    WHEN 'employees_program' THEN 'Employees Program'
                    WHEN 'used_cars' THEN 'Used Cars'
                    WHEN 'old_leads' THEN 'Old Leads'
                    WHEN 'events' THEN 'Events'
                    WHEN 'contact_us' THEN 'Contact Us'
                    WHEN 'sales_marketing' THEN 'Sales Maketing'
                    WHEN 'after_sales' THEN 'After Sales'
                    WHEN 'smo_leads' THEN 'Smo Leads'
                    WHEN 'career' THEN 'Career'
                    WHEN 'crm_leads' THEN 'Crm Leads'
                    ELSE 'Leads' -- Default value
                END as DataType
            "),
            DB::raw('COALESCE(customers.gender, "") as Gender'),
            DB::raw('COALESCE(customers.first_name, "") as FirstName'),
            DB::raw('COALESCE(customers.last_name, "") as LastName'),
            DB::raw('COALESCE(customers.national_id, "") as NationalID'),
            DB::raw('COALESCE(customers.mobile, "") as Mobile'),
            DB::raw('COALESCE(customers.email, "") as Email'),
            DB::raw('COALESCE(cities.name, "") as DealerCity'),
            DB::raw('COALESCE(branches.name, "") as DealerBranch'),
            DB::raw('COALESCE(applications.request_date, "") as RequestDate'),
            DB::raw('COALESCE(applications.preferred_appointment_time, "") as PreferredTime'),
            DB::raw('COALESCE(vehicles.name, "") as Vehicle'),
            DB::raw('COALESCE(applications.yearr, "") as Year'),
            DB::raw('COALESCE(applications.purchase_plan, "") as PurchasePlan'),
            DB::raw('COALESCE(applications.monthly_salary, "") as MonthlySalary'),
            DB::raw('COALESCE(banks.name, "") as Bank'),
            DB::raw('COALESCE(applications.comments, "") as Comments'),
            DB::raw('COALESCE(sources.name, "") as Source'),
            DB::raw('COALESCE(applications.category, "") as Category'),
            DB::raw('COALESCE(applications.sub_category, "") as SubCategory'),
            DB::raw('COALESCE(applications.qualified_date, "") as QualifiedDate')
        )
        ->join('customers', 'applications.customer_id', '=', 'customers.id')
        ->join('cities', 'applications.city_id', '=', 'cities.id')
        ->join('branches', 'applications.branch_id', '=', 'branches.id')
        ->join('vehicles', 'applications.vehicle_id', '=', 'vehicles.id')
        ->join('sources', 'applications.source_id', '=', 'sources.id')
        ->leftjoin('campaigns', 'applications.campaign_id', '=', 'campaigns.id')
        ->leftjoin('banks', 'customers.bank_id', '=', 'banks.id')
        ->where('applications.category', 'Qualified')
        ->whereBetween('applications.qualified_date', [$from_date_str,$to_date_str])
        ->get();


        return $this->sendResponse($records, 'Leads Listing');

    }

    public function allLeadsListing(Request $request){

        $validator = Validator::make($request->all(), [
            'from_date' => 'required|date|date_format:Y-m-d H:i:s',
            'to_date' => 'required|date|date_format:Y-m-d H:i:s',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $from_date_input = request('from_date');
        $datetime_pattern = '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/';
        $has_timestamp = $from_date_input && preg_match($datetime_pattern, $from_date_input);
        // dd($from_date_input, (bool) $has_timestamp);

        $from_date_str = request('from_date') ?: Carbon::now()->startOfDay()->toDateTimeString();

        $to_date_str = request('to_date') ?: Carbon::now()->endOfDay()->toDateTimeString();


        //  dd($from_date_str,$to_date_str);

        $records = DB::table('applications')
        ->select(
            'applications.id as id',
            DB::raw('COALESCE(campaigns.name, "") as Campaign'),
            DB::raw("
                CASE applications.type
                    WHEN 'leads' THEN 'Leads'
                    WHEN 'request_a_quote' THEN 'Request a Quote'
                    WHEN 'request_a_test_quote' THEN 'Request a Test Quote'
                    WHEN 'online_service_booking' THEN 'Online Service Booking'
                    WHEN 'special_offers' THEN 'Special Offers'
                    WHEN 'service_offers' THEN 'Service Offers'
                    WHEN 'fleet_sales' THEN 'Fleet Sales'
                    WHEN 'request_a_test_drive' THEN 'Request a Test Drive'
                    WHEN 'request_a_brochure' THEN 'Request a Brochure'
                    WHEN 'employees_program' THEN 'Employees Program'
                    WHEN 'used_cars' THEN 'Used Cars'
                    WHEN 'old_leads' THEN 'Old Leads'
                    WHEN 'events' THEN 'Events'
                    WHEN 'contact_us' THEN 'Contact Us'
                    WHEN 'sales_marketing' THEN 'Sales Maketing'
                    WHEN 'after_sales' THEN 'After Sales'
                    WHEN 'smo_leads' THEN 'Smo Leads'
                    WHEN 'career' THEN 'Career'
                    WHEN 'crm_leads' THEN 'Crm Leads'
                    ELSE 'Leads' -- Default value
                END as DataType
            "),
            DB::raw('COALESCE(customers.gender, "") as Gender'),
            DB::raw('COALESCE(customers.first_name, "") as FirstName'),
            DB::raw('COALESCE(customers.last_name, "") as LastName'),
            DB::raw('COALESCE(customers.national_id, "") as NationalID'),
            DB::raw('COALESCE(customers.mobile, "") as Mobile'),
            DB::raw('COALESCE(customers.email, "") as Email'),
            DB::raw('COALESCE(cities.name, "") as DealerCity'),
            DB::raw('COALESCE(branches.name, "") as DealerBranch'),
            DB::raw('COALESCE(applications.request_date, "") as RequestDate'),
            DB::raw('COALESCE(applications.preferred_appointment_time, "") as PreferredTime'),
            DB::raw('COALESCE(vehicles.name, "") as Vehicle'),
            DB::raw('COALESCE(applications.yearr, "") as Year'),
            DB::raw('COALESCE(applications.purchase_plan, "") as PurchasePlan'),
            DB::raw('COALESCE(applications.monthly_salary, "") as MonthlySalary'),
            DB::raw('COALESCE(banks.name, "") as Bank'),
            DB::raw('COALESCE(applications.comments, "") as Comments'),
            DB::raw('COALESCE(sources.name, "") as Source'),
            DB::raw('COALESCE(applications.category, "") as Category'),
            DB::raw('COALESCE(applications.sub_category, "") as SubCategory'),
            DB::raw('COALESCE(applications.qualified_date, "") as QualifiedDate')
        )
        ->join('customers', 'applications.customer_id', '=', 'customers.id')
        ->join('cities', 'applications.city_id', '=', 'cities.id')
        ->join('branches', 'applications.branch_id', '=', 'branches.id')
        ->join('vehicles', 'applications.vehicle_id', '=', 'vehicles.id')
        ->join('sources', 'applications.source_id', '=', 'sources.id')
        ->leftjoin('campaigns', 'applications.campaign_id', '=', 'campaigns.id')
        ->leftjoin('banks', 'customers.bank_id', '=', 'banks.id')
        ->whereBetween('applications.qualified_date', [$from_date_str,$to_date_str])
        ->get();


        return $this->sendResponse($records, 'All Leads Listing');

    }

    public function contactLeadsListing(Request $request){

        $mobile = $request->input('mobile');

        // Validate that the input starts with 0
        if (!preg_match('/^0\d{8,}$/', $mobile)) {
            return $this->sendError('Validation Error.', ['mobile' => ['Invalid mobile number format.']]);
        }

        // Convert mobile to database format (remove "0" and add "+966")
        $formattedMobile = '+966' . substr($mobile, 1);

        $validator = Validator::make(['mobile' => $formattedMobile], [
            'mobile' => [
                'required',
                'regex:/^\+966\d{9}$/', // Ensures correct format (+966XXXXXXXXX)
                'exists:customers,mobile', // Checks if it exists in customers table
            ],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $records = DB::table('applications')
        ->select(
            'applications.id as id',
            DB::raw('COALESCE(campaigns.name, "") as Campaign'),
            DB::raw("
                CASE applications.type
                    WHEN 'leads' THEN 'Leads'
                    WHEN 'request_a_quote' THEN 'Request a Quote'
                    WHEN 'request_a_test_quote' THEN 'Request a Test Quote'
                    WHEN 'online_service_booking' THEN 'Online Service Booking'
                    WHEN 'special_offers' THEN 'Special Offers'
                    WHEN 'service_offers' THEN 'Service Offers'
                    WHEN 'fleet_sales' THEN 'Fleet Sales'
                    WHEN 'request_a_test_drive' THEN 'Request a Test Drive'
                    WHEN 'request_a_brochure' THEN 'Request a Brochure'
                    WHEN 'employees_program' THEN 'Employees Program'
                    WHEN 'used_cars' THEN 'Used Cars'
                    WHEN 'old_leads' THEN 'Old Leads'
                    WHEN 'events' THEN 'Events'
                    WHEN 'contact_us' THEN 'Contact Us'
                    WHEN 'sales_marketing' THEN 'Sales Maketing'
                    WHEN 'after_sales' THEN 'After Sales'
                    WHEN 'smo_leads' THEN 'Smo Leads'
                    WHEN 'career' THEN 'Career'
                    WHEN 'crm_leads' THEN 'Crm Leads'
                    ELSE 'Leads' -- Default value
                END as DataType
            "),
            DB::raw('COALESCE(customers.gender, "") as Gender'),
            DB::raw('COALESCE(customers.first_name, "") as FirstName'),
            DB::raw('COALESCE(customers.last_name, "") as LastName'),
            DB::raw('COALESCE(customers.national_id, "") as NationalID'),
            DB::raw('COALESCE(customers.mobile, "") as Mobile'),
            DB::raw('COALESCE(customers.email, "") as Email'),
            DB::raw('COALESCE(cities.name, "") as DealerCity'),
            DB::raw('COALESCE(branches.name, "") as DealerBranch'),
            DB::raw('COALESCE(applications.request_date, "") as RequestDate'),
            DB::raw('COALESCE(applications.preferred_appointment_time, "") as PreferredTime'),
            DB::raw('COALESCE(vehicles.name, "") as Vehicle'),
            DB::raw('COALESCE(applications.yearr, "") as Year'),
            DB::raw('COALESCE(applications.purchase_plan, "") as PurchasePlan'),
            DB::raw('COALESCE(applications.monthly_salary, "") as MonthlySalary'),
            DB::raw('COALESCE(banks.name, "") as Bank'),
            DB::raw('COALESCE(applications.comments, "") as Comments'),
            DB::raw('COALESCE(sources.name, "") as Source'),
            DB::raw('COALESCE(applications.category, "") as Category'),
            DB::raw('COALESCE(applications.sub_category, "") as SubCategory'),
            DB::raw('COALESCE(applications.qualified_date, "") as QualifiedDate')
        )
        ->join('customers', 'applications.customer_id', '=', 'customers.id')
        ->join('cities', 'applications.city_id', '=', 'cities.id')
        ->join('branches', 'applications.branch_id', '=', 'branches.id')
        ->join('vehicles', 'applications.vehicle_id', '=', 'vehicles.id')
        ->join('sources', 'applications.source_id', '=', 'sources.id')
        ->leftjoin('campaigns', 'applications.campaign_id', '=', 'campaigns.id')
        ->leftjoin('banks', 'customers.bank_id', '=', 'banks.id')
        ->where('customers.mobile', $formattedMobile)
        ->get();


        return $this->sendResponse($records, 'Contact Leads Listing');

    }

    public function ivrCategoryUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:applications,id',
            'sub_category' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $row = Application::findorFail($request->id);
        $row->category = 'Unreachable';
        $row->sub_category = $request->sub_category;
        $row->save();

        return $this->sendResponse("", 'Updated Successfully');

    }


    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200 , [] , JSON_PRETTY_PRINT);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 200)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

}
