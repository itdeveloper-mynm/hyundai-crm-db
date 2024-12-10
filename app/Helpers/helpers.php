<?php
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Source;
use App\Models\Campaign;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


function getMonthNameAndYear($date)
{
    return Carbon::parse($date)->format('F Y');
}

function currdate()
{
    return Carbon::today()->format('Y-m-d');
    //return date('Y-m-d');
}

function currdateTime()
{
    return Carbon::today()->format('Y-m-d h:i:s');
    //return date('Y-m-d');
}

function dateBeforeTenDays()
{
    // return Carbon::today()->subDays(10)->format('Y-m-d');
    return Carbon::now()->startOfMonth()->format('Y-m-d');
}

function dateTimeformat($date)
{
    return Carbon::parse($date)->format('d-m-Y h:i:s');
}

function arraycheck($value) {
    if (is_array($value)) {
        return $value;
    }else{
        return [$value];
    }
}

function is_selected($value, $inputName)
{
    return in_array($value, request()->input($inputName, [])) ? 'selected' : '';
}


function mergeAndUniqueValues($data) {
    // Step 1: Use array_map to apply explode to each element
    $explodedArrays = array_map(function($item) {
        return explode(',', $item);
    }, $data);

    // Step 2: Use array_merge to flatten the array of arrays into a single array
    $mergedArray = array_merge(...$explodedArrays);

    // Step 3: Use array_unique to remove duplicate values
    $uniqueArray = array_unique($mergedArray);

    return $uniqueArray;
}


function activeRoute($route): string
{

    $requestUrl = request()->fullUrl() === $route ? true : false;

    if($requestUrl == true) {
        return 'active';
    } else {
        return  '';
    }
}

function newactiveRoute($route): string
{

    $urlToCheck = request()->fullUrl();
    if (in_array($urlToCheck, $route)) {
        return 'active';
    } else {
        return '';
    }
}


function activeMenuRoute($submenus): string
{
    $urlToCheck = request()->fullUrl();
    if (in_array($urlToCheck, $submenus)) {
        return 'hover show';
    } else {
        return '';
    }

}

function AllLeadsMenuPermissionArr()
{
    return [
        'all-leads-list',
        'test-drive-request-list',
        'quote-request-list',
        'campaign-leads-list',
        'after-sale-leads-list',
        'used-car-leads-list',
        'smo-leads-list',
        'google-business-list',
        'old-leads-list',
        'sales-data-list',
        'social-data-list',
    ];
}

function AllCrmLeadsMenuPermissionArr()
{
    return [
        'crm-leads-list',
    ];
}



function GraphMenuPermissionArr()
{
    return [
        'sale-graph-list',
        'crm-leads-graph-list',
        'sale-graph-comparison-list',
        'after-sale-graph-list',
        'after-sale-graph-comparison-list',
        'test-drive-list',
        'online-service-booking-list',
        'service-offers-graph-list',
        'contact-us-graph-list',
        'used-cars-graph-list',
        'hr-graph-list',
        'smo-graph-list',
        'events-graph-list',
        'actualsales-graph-list',
    ];
}

function formDataPermissionArr()
{
    return [
        'city-list',
        'branch-list',
        'vehicle-list',
        'source-list',
        'campaign-list',
        'bank-list',
        // 'sales-data-list',
        'social-data-list',
        //'crm-leads-list'
    ];
}

function CRMLeadsDataAllMenuArr()
{
    $array = [
        route('crm-leads.index'),route('crm-leads.create'),request()->is('crm-leads/*/edit'),request()->is('crm-leads*'),
        route('qualified-crm-leads.index'),request()->is('qualified-crm-leads*'),
        route('non-qualified-crm-leads.index'),request()->is('non-qualified-crm-leads*'),
        route('general-inquiry-crm-leads.index'),request()->is('general-inquiry-crm-leads*'),
    ];
    return $array;
}

function AllLeadsMenuArr()
{
    $array =[
        route('allleads.index'),
        route('test-drive-request.index'),
        route('quote-request.index'),
        route('lead.index'),route('lead.create'),request()->is('lead/*/edit'),
        route('after-sale.index'),route('after-sale.create'),request()->is('after-sale/*/edit'),
        route('used-car.index'),route('used-car.create'),request()->is('used-car/*/edit'),
        route('smo-lead.index'),route('smo-lead.create'),request()->is('smo-lead/*/edit'),
        route('google-business.index'),request()->is('google-business/*/edit'),
        route('old-leads.index'),route('old-leads.create'),request()->is('old-leads/*/edit'),
        // route('sales-data.index'),request()->is('sales-data/*/edit'),
        route('social-data.index'),route('social-data.create'),request()->is('social-data/*/edit'),
    ];
    return $array;
}

function GraphAllMenuArr()
{
    $array =[
        route('sale-graph.index'),request()->is('sale-graph*'),
        route('crm-leads-graph.index'),request()->is('crm-leads-graph*'),
        route('sale-graph-comparison.index'),request()->is('sale-graph-comparison*'),
        route('after-sale-graph.index'),request()->is('after-sale-graph*'),
        route('after-sale-graph-comparison.index'),request()->is('after-sale-graph-comparison*'),
        route('test-drive-graph.index'),request()->is('test-drive-graph*'),
        route('online-service-booking-graph.index'),request()->is('online-service-booking-graph*'),
        route('service-offers-graph.index'),request()->is('service-offers-graph*'),
        route('contact-us-graph.index'),request()->is('contact-us-graph*'),
        route('used-cars-graph.index'),request()->is('used-cars-graph*'),
        route('hr-graph.index'),request()->is('hr-graph*'),
        route('smo-graph.index'),request()->is('smo-graph*'),
        route('events-graph.index'),request()->is('events-graph*'),
        route('actualsales-graph.index'),request()->is('actualsales-graph*'),
    ];
    return $array;
}

function FormDataAllMenuArr()
{
    $array =[
        route('city.index'),route('city.create'),request()->is('city/*/edit'),
        route('branch.index'),route('branch.create'),request()->is('branch/*/edit'),
        route('vehicle.index'),route('vehicle.create'),request()->is('vehicle/*/edit'),
        route('source.index'),route('source.create'),request()->is('source/*/edit'),
        route('campaign.index'),route('campaign.create'),request()->is('campaign/*/edit'),
        route('bank.index'),route('bank.create'),request()->is('bank/*/edit'),
    ];
    return $array;
}


function currentDate() {
    return formateDate(now());
    //return formateDate(now()->endOfMonth());
}

function formateDate($date) {
    return Carbon::parse($date)->format('Y-m-d');
}

function formateDateTime($date) {
    return Carbon::parse($date)->format('Y-m-d h:i:s');
}

function startDate() {
    return formateDate(now()->subMonths(3)->startOfMonth());
}

function endDate() {
    return formateDate(now());
    //return formateDate(now()->endOfMonth());
}

function setDateRange($chk)
{
    if ($chk == 'daily') {
        $startDate = formateDate(now());
        $endDate = formateDate(now());
    } elseif ($chk == 'weekly') {
        // $startDate = formateDate(Carbon::now()->startOfWeek());
        // $endDate = formateDate(Carbon::now()->endOfWeek());
        $startDate = formateDate(Carbon::now()->startOfWeek()->subWeek());
        $endDate = formateDate(Carbon::now()->endOfWeek()->subWeek());

    } elseif ($chk == 'monthly') {
        $startDate = formateDate(Carbon::now()->startOfMonth());
        $endDate = formateDate(Carbon::now()->endOfMonth());
    } else {
        $startDate = formateDate(now());
        $endDate = formateDate(now());
    }

    return response()->json([
        'startDate' => $startDate,
        'endDate' => $endDate
    ]);
}

function addCustomer(Request $request) {

    $mobile = $request->input('mobile');

    $mobile =formatInputNumber($mobile);

    $customer = Customer::whereMobile($mobile)->first();
    if(is_null($customer)){
        $customer =new Customer();
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->mobile = $mobile;
        $customer->email = $request->input('email') ?? null;
        $customer->bank_id = $request->input('bank_id') ?? null;
        $customer->city_id = $request->input('city_id') ?? null;
        $customer->gender = $request->input('gender') ?? null;
        $customer->national_id = $request->input('national_id') ?? null;
        $customer->save();
    }

    return $customer;
}

function updCustomer(Request $request,$id) {

    $mobile = $request->input('mobile');

    $mobile =formatInputNumber($mobile);

    $customer = Customer::whereId($id)->first();
    $customer->mobile = $mobile;
    $customer->bank_id = $request->input('bank_id') ?? $customer->bank_id;
    $customer->gender = $request->input('gender') ?? $customer->gender;
    $customer->national_id = $request->input('national_id') ?? $customer->national_id;
    $customer->save();

    return $customer;
}

function checkApplicationType($type) {
    switch (strtolower($type)) {
        case 'leads':
            return 'leads';
        case 'request a quote':
            return 'request_a_quote';
        case 'request a test quote':
            return 'request_a_test_quote';
        case 'online service booking':
            return 'online_service_booking';
        case 'special offers':
            return 'special_offers';
        case 'service offers':
            return 'service_offers';
        case 'fleet sales':
            return 'fleet_sales';
        case 'request a test drive':
            return 'request_a_test_drive';
        case 'request a brochure':
            return 'request_a_brochure';
        case 'employees program':
            return 'employees_program';
        case 'used cars':
            return 'used_cars';
        case 'old leads':
            return 'old_leads';
        case 'events':
            return 'events';
        case 'contact us':
            return 'contact_us';
        case 'sales marketing':
            return 'sales_marketing';
        case 'after sales':
            return 'after_sales';
        case 'smo leads':
            return 'smo_leads';
        case 'career':
            return 'career';
        case 'crm leads':
            return 'crm_leads';
        default:
            return 'leads';
    }
}


function reverseCheckApplicationType($value) {
    switch ($value) {
        case 'leads':
            return 'Leads';
        case 'request_a_quote':
            return 'Request a Quote';
        case 'request_a_test_quote':
            return 'Request a Test Quote';
        case 'online_service_booking':
            return 'Online Service Booking';
        case 'special_offers':
            return 'Special Offers';
        case 'service_offers':
            return 'Service Offers';
        case 'fleet_sales':
            return 'Fleet Sales';
        case 'request_a_test_drive':
            return 'Request a Test Drive';
        case 'request_a_brochure':
            return 'Request a Brochure';
        case 'employees_program':
            return 'Employees Program';
        case 'used_cars':
            return 'Used Cars';
        case 'old_leads':
            return 'Old Leads';
        case 'events':
            return 'Events';
        case 'contact_us':
            return 'Contact Us';
        case 'sales_marketing':
            return 'Sales Maketing';
        case 'after_sales':
            return 'After sales';
        case 'smo_leads':
            return 'Smo Leads';
        case 'career':
            return 'Career';
        case 'crm_leads':
            return 'Crm Leads';
        default:
            return 'Leads'; // Default to 'Leads' if no match found
    }
}

function getApplicationTypeTitles() {
    return [
        'leads' => 'Leads',
        'request_a_quote' => 'Request a Quote',
        'request_a_test_quote' => 'Request a Test Quote',
        'online_service_booking' => 'Online Service Booking',
        'special_offers' => 'Special Offers',
        'service_offers' => 'Service Offers',
        'fleet_sales' => 'Fleet Sales',
        'request_a_test_drive' => 'Request a Test Drive',
        'used_cars' => 'Used Cars',
        'old_leads' => 'Old Leads',
        'events' => 'Events',
        'contact_us' => 'Contact Us',
        'sales_marketing' => 'Sales Marketing',
        'after_sales' => 'After Sales',
        'smo_leads' => 'Smo Leads',
        'career' => 'Career',
        'crm_leads' => 'Crm Leads',
    ];
}


function formatInputNumber($mobile) {

    $length = strlen($mobile);

    if (substr($mobile, 0, 4) === '+966' && strlen($mobile) === 14) {
        $mobile = '+966' . ltrim(substr($mobile, 4), '0');
    }

    if(substr($mobile, 0, strlen(966)) === '966'  && $length == '12') {
       $mobile = '+'.$mobile;
    }

    if (substr($mobile, 0, 1) !== '0' && $length == '9') {
        $mobile = '+966'.$mobile;
    }

    if (substr($mobile, 0, 1) === '0' && $length == '10') {
        $mobile = ltrim($mobile, '0');
        $mobile = '+966'.$mobile;
    }

    return $mobile;
}

function getCommonData($cityId = null)
{
    $now = Carbon::now();

    $commonData = [
        'cities' => City::whereStatus(1)->get(),
        'vehicles' => Vehicle::whereStatus(1)->get(),
        // 'sources' => Source::whereStatus(1)->get(),
        'sources' => Source::whereStatus(1)->get(),
        // 'campaigns' => Campaign::whereStatus(1)->get(),
        'banks' => Bank::whereStatus(1)->get(),
        'users' => User::get(),
    ];

    if ($cityId !== null) {
        $commonData['branches'] = Branch::where('city_id', $cityId)->whereStatus(1)->get();
        $commonData['campaigns'] =  Campaign::whereStatus(1)->get();

    } else {
        $commonData['branches'] = Branch::whereStatus(1)->get();
        $commonData['campaigns'] =Campaign::whereStatus(1)->whereYear('created_at', $now->year)->whereMonth('created_at', $now->month)->get();

    }

    return $commonData;
}

function getCommonFilterData($cityId = null)
{
    $now = Carbon::now();

    $commonData = [
        'cities' => City::whereStatus(1)->get(),
        'vehicles' => Vehicle::whereStatus(1)->get(),
        'sources' => Source::whereStatus(1)->get(),
        'campaigns' => Campaign::whereStatus(1)->get(),
        'banks' => Bank::whereStatus(1)->get(),
        'users' => User::get(),
    ];

    if ($cityId !== null) {
        $commonData['branches'] = Branch::where('city_id', $cityId)->whereStatus(1)->get();
    } else {
        $commonData['branches'] = Branch::whereStatus(1)->get();
    }

    return $commonData;
}

function getCommonDataName()
{
    $commonData = [
        'cities' => City::pluck('name','id')->all(),
        'branches' => Branch::pluck('name','id')->all(),
        'vehicles' => Vehicle::pluck('name','id')->all(),
        'sources' => Source::pluck('name','id')->all(),
        'campaigns' => Campaign::pluck('name','id')->all(),
        'banks' => Bank::pluck('name','id')->all(),
    ];

    return $commonData;
}


function human_readable_number($number, $precision = 1) {
    if ($number < 900) {
        // 0 - 900
        $n_format = number_format($number, $precision);
        $suffix = '';
    } elseif ($number < 900000) {
        // 0.9k-850k
        $n_format = number_format($number / 1000, $precision);
        $suffix = 'K';
    } elseif ($number < 900000000) {
        // 0.9m-850m
        $n_format = number_format($number / 1000000, $precision);
        $suffix = 'M';
    } elseif ($number < 900000000000) {
        // 0.9b-850b
        $n_format = number_format($number / 1000000000, $precision);
        $suffix = 'B';
    } else {
        // 0.9t+
        $n_format = number_format($number / 1000000000000, $precision);
        $suffix = 'T';
    }

    if ($precision > 0) {
        $dotzero = '.' . str_repeat('0', $precision);
        $n_format = str_replace($dotzero, '', $n_format);
    }

    return $n_format . $suffix;
}


function autoLineAPI($row){

    $url = "https://leadmanagement-stage.otolink.app/api/leads";
    $data = formattedAutoLineLead($row); // Assuming this function prepares the $data
    // dd(json_encode($data));
    Log::info("formattedAutoLineLead");
    Log::info(json_encode($data));
    $headers = [
        'Authorization: bc44d7ba4bacdd1e2d5433f822f91efa',
        'Content-Type: application/json',
    ];

    // Initialize cURL
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 300,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => $headers,
    ]);

    // Execute the request
    $response = curl_exec($curl);

    // Handle errors or response
    if (curl_errno($curl)) {
        $error = curl_error($curl);
        Log::info("cURL Error: " . $error);
    } else {
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpStatus >= 200 && $httpStatus < 300) {
            $responseData = json_decode($response, true);
            Log::info($responseData);
        } else {
            Log::info("Error Response: " . $response);
        }
    }

    // Close cURL
    curl_close($curl);
    return 1;

}

function sendSmsPdPl($number) {
    $url = "https://el.cloud.unifonic.com/rest/SMS/messages";

    $postData = [
        'AppSid'        => 'gHyhjQPywqHDvbBHet1zm6efBaymj9',
        'SenderID'      => 'Hyundai-AD',
        'Body'          => 'Hello there',
        // 'Recipient'     => '+923125115216',
        'Recipient'     => $number,
        'responseType'  => 'JSON',
        'CorrelationID' => '1',
        'baseEncode'    => 'true',
        'MessageType'   => '6',
        'statusCallback'=> 'sent',
        'async'         => 'false',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Content-Type: application/x-www-form-urlencoded',
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
        curl_close($ch);
        return;
    }

    curl_close($ch);

    $responseDecoded = json_decode($response, true);

    Log::info("sendSmsPdPl");
    if ($responseDecoded) {
        // echo "Response: " . print_r($responseDecoded, true);
        Log::info($responseDecoded);
    } else {
        // echo "Raw Response: " . $response;
        Log::info($responseDecoded);
    }

    return $responseDecoded;
    // Output the response

}


// function autoLineAPI($row){

//     $url = "https://leadmanagement-stage.otolink.app/api/leads";
//     $data =formattedAutoLineLead($row);
//     // dd($data);
//     $response = Http::withHeaders([
//         'Authorization' => 'bc44d7ba4bacdd1e2d5433f822f91efa',
//     ])->timeout(300)->post($url, $data);

//     if ($response->successful()) {
//         $responseData = $response->json();
//         Log::info($responseData);

//     }else{
//         $error = $response->body();
//         Log::info($error);
//     }

// }

function formattedAutoLineLead($row)
{
    return [
        "submissionDate" => currdateTime(),
        "displayName" => "Lead",
        "dealerCode" => "2",
        "outlateCode" => "1600",
        "branch" => $row->branch->name ?? "",
        "department" => "Sales",
        "externalReference" => [
            "provider" => "OTOLINK",
            "application" => "OTO Leads",
            "id" => "OTO Leads",
            "url" => ""
        ],
        "leadReferenceData" => [
            "externalCampaignId" => "kcc",
            "externalDealerId" => "OTOLEAD"
        ],
        "source" => "WEBSITE",
        "contact" => [
            "contactDetails" => [
                "names" => [
                    "familyName" => $row->customer->full_name ?? "",
                    "familyName2" => $row->customer->full_name ?? "",
                    "middleName" => $row->customer->full_name ?? "",
                    "givenName" => $row->customer->full_name ?? "",
                    "preferredName" => $row->customer->full_name ?? "",
                    "initials" => $row->customer->full_name ?? "",
                    "salutation" => $row->customer->full_name ?? "",
                    "titleCommon" => "Mr."
                ],
                "addresses" => [
                    "home" => [
                        "physicalAddress" => [
                            "streetType" => "",
                            "streetName" => "",
                            "houseNumber" => "",
                            "buildingName" => "",
                            "floorNumber" => "",
                            "doorNumber" => "",
                            "blockName" => "",
                            "estate" => "",
                            "postalCode" => "",
                            "suburb" => "",
                            "city" => "",
                            "county" => "",
                            "province" => "",
                            "countryCode" => ""
                        ]
                    ]
                ],
                "communication" => [
                    "home" => [
                        "mobile" => $row->customer->mobile ?? "",
                        "email" => $row->customer->email ?? "",
                    ]
                ]
            ]
        ],
        "vehicle" => [
            "make" =>  $row->vehicle->name ?? "",
            "model" => "",
            "modelYear" => $row->yearr ?? "",
            "mileage" => ""
        ],
        "enquiry" => [
            "type" => reverseCheckApplicationType($row->type),
            "message" => "",
            "offer" => "",
            "refUrl" => ""
        ],
        "notes" => [
                [
                    "title" => "Dealer City",
                    "details" => $row->city->name ?? "",
                ],
                [
                    "title" => "Dealer Branch",
                    "details" => $row->branch->name ?? "",
                ],
                [
                    "title" => "Purchase Plan",
                    "details" => $row->purchase_plan ?? "",
                ],
                [
                    "title" => "Monthly Salary",
                    "details" => $row->monthly_salary ?? "",
                ],
                [
                    "title" => "Customers Bank",
                    "details" => $row->customer->bank->name ?? "",
                ],
                [
                    "title" => "Source Name",
                    "details" => $row->source->name ?? "",
                ],
                [
                    "title" => "Campaign Name",
                    "details" => $row->campaign->name ?? "",
                ],
                [
                    "title" => "Preferred Appointment Time",
                    "details" => $row->preferred_appointment_time ?? "",
                ],
                [
                    "title" => "Category",
                    "details" => $row->category ?? "",
                ],
                [
                    "title" => "Sub Category",
                    "details" => $row->sub_category ?? "",
                ],
                [
                    "title" => "Kyc",
                    "details" => $row->kyc ?? "",
                ]
            ]
    ];
}
