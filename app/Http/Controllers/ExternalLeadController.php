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

class ExternalLeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        //dd($request->all());
        \Log::info('customer api hit');

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

        $customer = Customer::firstOrCreate(
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
                'data'=> [ $existingApplication ],
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
            'data'=> [ $lead ],
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

        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'page' => 'nullable|string|max:255',
        ]);

        \Log::info('saveformjson api hit');


        $bank = null;
        $city = null;
        $branch = null;
        $vehicle = null;
        $sourcee = null;
        $campaign = null;

        // Collect data that can be null safely
        $optionalData = [
            'bank' => $request->input('customerBank') ?? null,
            'dealer_city' => $request->input('dealerCity') ?? null,
            'dealer_branch' => $request->input('branch') ?? null,
            'vehicle' => $request->input('vehicle') ?? null,
            'channel' => $request->input('sourcee') ?? null,
            'campaign' => $request->input('pagesub') ?? null,
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

        $customer = Customer::firstOrCreate(
            ['mobile' => $mobile],
            [
                'first_name' => $request->input('firstName'),
                'last_name' => $request->input('lastName'),
                'email' => $request->input('email') ?? null,
                'city_id' => $city->id ?? null,
                'bank_id' => $bank->id ?? null,
                'national_id' => $request->input('nationalId') ?? null,
            ]
        );

        $type= checkApplicationType($request->input('page')) ?? 'leads';

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
                'data'=> [ $existingApplication ],
            ], 200);
            // return $existingApplication;
        }


        $apply_for = $request->input('applyFor');
        $booking_reason = $request->input('bookingreason');
        $booking_category = $request->input('bookingcategory');
        $department = $request->input('department');
        $title = $request->input('salutation');
        $second_surname = $request->input('middleName');
        // $nationalid = $request->input('nationalId');
        $zip_code = $request->input('zipCode');
        $vin = $request->input('vin');
        $yearr = $request->input('manufacturingYear');
        $plateno = $request->input('plateNumbers');
        $plate_alphabets = $request->input('plateAlphabets');
        $klmm = $request->input('mileage');
        $intention = $request->input('purchasePlan');
        $monthly_salary = $request->input('monthlySalary');
        $request_date = $request->input('date');
        $preferred_time = $request->input('preferredTime');
        $comments = $request->input('comments');
        $sharingcv = $request->input('sharingCv');
        $privacy_check = $request->input('privacyCheck');
        $marketingagreement = $request->input('marketingAgreement');
        $language = $request->input('language');
        $company = $request->input('companyName');
        $customers_type = $request->input('customers_type');
        $number_of_vehicles = $request->input('number_of_vehicles');
        $fleet_range = $request->input('fleet_range');

        $lead = new Application();
        $lead->type = $type;
        $lead->city_id = $city->id;
        $lead->branch_id = $branch->id;
        $lead->vehicle_id = $vehicle->id;
        $lead->source_id = $sourcee->id;
        $lead->campaign_id = $campaign->id;
        $lead->monthly_salary = $monthly_salary ?? null;
        $lead->customer_id= $customer->id;
        $lead->apply_for = $apply_for ?? null;
        $lead->booking_reason = $booking_reason ?? null;
        $lead->booking_category = $booking_category ?? null;
        $lead->department = $department ?? null;
        $lead->title = $title ?? null;
        $lead->second_surname = $second_surname ?? null;
        $lead->zip_code = $zip_code ?? null;
        $lead->vin = $vin ?? null;
        $lead->yearr = $yearr ?? null;
        $lead->plateno = $plateno ?? null;
        $lead->plate_alphabets = $plate_alphabets ?? null;
        $lead->klmm = $klmm ?? null;
        $lead->intention = $intention ?? null;
        $lead->request_date = $request_date ?? null;
        $lead->preferred_time = $preferred_time ?? null;
        $lead->comments = $comments ?? null;
        $lead->sharingcv = $sharingcv ?? null;
        $lead->privacy_check = $privacy_check ?? null;
        $lead->marketingagreement = $marketingagreement ?? null;
        $lead->language = $language ?? null;
        $lead->company = $company ?? null;
        $lead->customers_type = $customers_type ?? null;
        $lead->number_of_vehicles = $number_of_vehicles ?? null;
        $lead->fleet_range = $fleet_range ?? null;

        $lead->save();

        if ($lead) {

            $code = $lead->id."-".$lead->branch->name ?? "";
            $msg=$code;
            $msgar=$code;
            // Prepare email body
                $body = "
                <table width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                    <td valign='top' width='50%'>
                        Dear  {$request->input('firstName')}<br><br>
                        Thanks for your submission. Our customer care team will confirm it to you soon. Meanwhile, you can call us any time for further information on 920028008 and by email customer.care@Hyundai.mynaghi.com
                    </td>
                    <td valign='top' width='50%'>
                        <div style='direction:rtl'>
                        العميل عزيزي  {$request->input('firstName')}<br><br>
                        شكراً للحجز. سيتم تأكيد الحجز وإبلاغكم عن طريق مركز خدمة العملاء <br>
                        920028008 <br>
                        customer.care@Hyundai.mynaghi.com<br>
                        </div>
                    </td>
                </tr>
                </table>";

        }else {
            $msg = "failed";
        }

        return response()->json([
            'success' => true,'message' => 'Added Successfully',
            'data'=> [ $lead ],
        ], 200);

        // return response()->json(['message' => $msg]);

        \Log::info('saveformjson api hit end');

        // return response()->json([
        //     'success' => true,'message' => 'Added Successfully',
        //     'data'=> [],
        // ], 200);

    }
}
