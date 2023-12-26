<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Campaign;
use App\Models\Lead;
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

        $bank = Bank::where('name', $request->input('customersBank'))->first();
        
        if(is_null($bank)){
            $bank = Bank::create(['name' => $request->input('customersBank')]);
        }


        $mobile = $request->input('mobile');

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

        $city = City::where('name', $request->input('dealerCity'))->first();
        $branch = Branch::where('name', $request->input('branch'))->first();
        $vehicle = Vehicle::where('name', $request->input('vehicle'))->first();
        $sourcee = Source::where('name', $request->input('sourcee'))->first();
        $campaign = Campaign::where('name', $request->input('campaignName'))->first();
        if(is_null($city)){
            $city = City::create(['name' => $request->input('dealerCity')]);
        }
        if(is_null($branch)){
            $branch = Branch::create([
                'name' => $request->input('branch'),
                'city_id' => $city->id,
            ]);
        }
        if(is_null($vehicle)){
            $vehicle = Vehicle::create(['name' => $request->input('vehicle')]);
        }
        if(is_null($sourcee)){
            $sourcee = Source::create(['name' => $request->input('sourcee')]);
        }
        if(is_null($campaign)){
            $campaign = Campaign::create(['name' => $request->input('campaignName')]);
        }
        
        $lead = new Lead();
        $lead->city_id = $city->id;
        $lead->branch_id = $branch->id;
        $lead->vehicle_id = $vehicle->id;
        $lead->source_id = $sourcee->id;
        $lead->campaign_id = $campaign->id;
        $lead->purchase_plan = $request->input('purchasePlan');
        $lead->monthly_salary = $request->input('monthlySalary');
        $lead->preferred_appointment_time = $request->input('preferredTime');
        $lead->customer_id= $customer->id;
        $lead->save();

        \Log::info('customer api hit end');
    
    }

    public function saveformjson(Request $request) {
        
        
        \Log::info('saveformjson api hit');

        
        $city = City::where('name', $request->input('customerCity'))->first();
        if(is_null($city)){
            $city = City::create(['name' => $request->input('customerCity')]);
        }
        
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
            $customer->save();
        }

        $city = City::where('name', $request->input('dealerCity'))->first();
        $branch = Branch::where('name', $request->input('branch'))->first();
        $vehicle = Vehicle::where('name', $request->input('vehicle'))->first();
        $sourcee = Source::where('name', $request->input('sourcee'))->first();
        $campaign = Campaign::where('name', $request->input('pagesub'))->first();
        if(is_null($city)){
            $city = City::create(['name' => $request->input('dealerCity')]);
        }
        if(is_null($branch)){
            $branch = Branch::create([
                'name' => $request->input('branch'),
                'city_id' => $city->id,
            ]);
        }
        if(is_null($vehicle)){
            $vehicle = Vehicle::create(['name' => $request->input('vehicle')]);
        }
        if(is_null($sourcee)){
            $sourcee = Source::create(['name' => $request->input('sourcee')]);
        }
        if(is_null($campaign)){
            $campaign = Campaign::create(['name' => $request->input('pagesub')]);
        }

        $type= checkApplicationType($request->input('page')) ?? 'leads';

        $applyfor = $request->input('applyFor');
        $bookingreason = $request->input('bookingreason');
        $bookingcategory = $request->input('bookingcategory');
        $department = $request->input('department');
        $title = $request->input('salutation');
        $second_surname = $request->input('middleName');
        $nationalid = $request->input('nationalId');
        $zip_code = $request->input('zipCode');
        $vin = $request->input('vin');
        $yearr = $request->input('manufacturingYear');
        $plateno = $request->input('plateNumbers');
        $platealphabets = $request->input('plateAlphabets');
        $klmm = $request->input('mileage');
        $intention = $request->input('purchasePlan');
        $monthlysalary = $request->input('monthlySalary');
        $bankk = $request->input('customerBank');
        $requestdate = $request->input('date');
        $preferredtime = $request->input('preferredTime');
        $comments = $request->input('comments');
        $sharingcv = $request->input('sharingCv');
        $privacycheck = $request->input('privacyCheck');
        $marketingagreement = $request->input('marketingAgreement');
        $language = $request->input('language');
        $company = $request->input('companyName');
        $customers_type = $request->input('customers_type');
        $number_of_vehicles = $request->input('number_of_vehicles');
        $fleet_range = $request->input('fleet_range');

        
        \Log::info('saveformjson api hit end');
        
    }
}
