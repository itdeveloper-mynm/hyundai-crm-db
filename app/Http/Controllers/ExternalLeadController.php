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
        $bank_name= $request->input('customersBank');
        $city_name= $request->input('dealerCity');
        $branch_name= $request->input('branch');
        $vehicle_name= $request->input('vehicle');
        $sourcee_name= $request->input('sourcee');
        $campaign_name= $request->input('campaignName');
        $mobile = $request->input('mobile');

        $bank = Bank::where('name', $bank_name)->first();
        if(is_null($bank)){
            $bank = Bank::create(['name' => $bank_name]);
        }

        $mobile =formatInputNumber($mobile);
        $customer = Customer::whereMobile($mobile)->first();


        if(is_null($customer)){
            $customer =new Customer();
            $customer->first_name = $request->input('firstName');
            $customer->last_name = $request->input('lastName');
            $customer->mobile = $mobile;
            $customer->email = $request->input('email');
            $customer->bank_id = $bank->id;
            $customer->save();
        }

        $city = City::where('name', $city_name)->first();
        $branch = Branch::where('name', $branch_name)->first();
        $vehicle = Vehicle::where('name', $vehicle_name)->first();
        $sourcee = Source::where('name', $sourcee_name)->first();
        $campaign = Campaign::where('name', $campaign_name)->first();
        if(is_null($city)){
            $city = City::create(['name' => $city_name]);
        }
        if(is_null($branch)){
            $branch = Branch::create([
                'name' => $branch_name,
                'city_id' => $city->id,
            ]);
        }
        if(is_null($vehicle)){
            $vehicle = Vehicle::create(['name' => $vehicle_name]);
        }
        if(is_null($sourcee)){
            $sourcee = Source::create(['name' => $sourcee_name]);
        }
        if(is_null($campaign)){
            $campaign = Campaign::create(['name' => $campaign_name]);
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

    }

    public function saveformjson(Request $request) {


        \Log::info('saveformjson api hit');


        $city = City::where('name', $request->input('customerCity'))->first();
        if(is_null($city)){
            $city = City::create(['name' => $request->input('customerCity')]);
        }

        $bank = Bank::where('name', $request->input('customerBank'))->first();

        if(is_null($bank)){
            $bank = Bank::create(['name' => $request->input('customerBank')]);
        }

        $city_name= $request->input('dealerCity');
        $branch_name= $request->input('branch');
        $vehicle_name= $request->input('vehicle');
        $sourcee_name= $request->input('sourcee');
        $campaign_name= $request->input('pagesub');
        $mobile = $request->input('mobile');

        $mobile =formatInputNumber($mobile);

        $customer = Customer::whereMobile($mobile)->first();


        if(is_null($customer)){
            $customer =new Customer();
            $customer->first_name = $request->input('firstName');
            $customer->last_name = $request->input('lastName');
            $customer->mobile = $mobile;
            $customer->email = $request->input('email');
            $customer->city_id = $city->id;
            $customer->bank_id = $bank->id;
            $customer->save();
        }

        $city = City::where('name', $city_name)->first();
        $branch = Branch::where('name', $branch_name)->first();
        $vehicle = Vehicle::where('name', $vehicle_name)->first();
        $sourcee = Source::where('name', $sourcee_name)->first();
        $campaign = Campaign::where('name', $campaign_name)->first();
        if(is_null($city)){
            $city = City::create(['name' => $city_name]);
        }
        if(is_null($branch)){
            $branch = Branch::create([
                'name' => $branch_name,
                'city_id' => $city->id,
            ]);
        }
        if(is_null($vehicle)){
            $vehicle = Vehicle::create(['name' => $vehicle_name]);
        }
        if(is_null($sourcee)){
            $sourcee = Source::create(['name' => $sourcee_name]);
        }
        if(is_null($campaign)){
            $campaign = Campaign::create(['name' => $campaign_name]);
        }

        $type= checkApplicationType($request->input('page')) ?? 'leads';

        $applyfor = $request->input('applyFor');
        $booking_reason = $request->input('bookingreason');
        $booking_category = $request->input('bookingcategory');
        $department = $request->input('department');
        $title = $request->input('salutation');
        $second_surname = $request->input('middleName');
        $nationalid = $request->input('nationalId');
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
        $lead->monthly_salary = $monthly_salary;
        $lead->customer_id= $customer->id;
        $lead->apply_for = $apply_for;
        $lead->booking_reason = $booking_reason;
        $lead->booking_category = $booking_category;
        $lead->department = $department;
        $lead->title = $title;
        $lead->second_surname = $second_surname;
        $lead->nationalid = $nationalid;
        $lead->zip_code = $zip_code;
        $lead->vin = $vin;
        $lead->yearr = $yearr;
        $lead->plateno = $plateno;
        $lead->plate_alphabets = $plate_alphabets;
        $lead->klmm = $klmm;
        $lead->intention = $intention;
        $lead->request_date = $request_date;
        $lead->preferred_time = $preferred_time;
        $lead->comments = $comments;
        $lead->sharingcv = $sharingcv;
        $lead->privacy_check = $privacy_check;
        $lead->marketingagreement = $marketingagreement;
        $lead->language = $language;
        $lead->company = $company;
        $lead->customers_type = $customers_type;
        $lead->number_of_vehicles = $number_of_vehicles;
        $lead->fleet_range = $fleet_range;
        // Additional fields can be added as needed

        $lead->save();



        \Log::info('saveformjson api hit end');

    }
}
