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

function activeRoute($route): string
{

    $requestUrl = request()->fullUrl() === $route ? true : false;

    if($requestUrl == true) {
        return 'active';
    } else {
        return  '';
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
    $customer->bank_id = $request->input('bank_id') ?? null;
    $customer->gender = $request->input('gender') ?? null;
    $customer->national_id = $request->input('national_id') ?? null;
    $customer->save();

    return $customer;
}

function checkApplicationType($type) {

    switch ($type) {
        case 'Leads':
            return 'leads';
        case 'Request a Quote':
            return 'request_a_quote';
        case 'Request a Test Quote':
            return 'request_a_test_quote';
        case 'Online Service Booking':
            return 'online_service_booking';
        case 'Special Offers':
            return 'special_offers';
        case 'Service Offers':
            return 'service_offers';
        case 'Fleet Sales':
            return 'fleet_sales';
        case 'Request a Test Drive':
            return 'request_a_test_drive';
        case 'Used Cars':
            return 'used_cars';
        case 'Old Leads':
            return 'old_leads';
        case 'Events':
            return 'events';
        case 'Contact Us':
            return 'contact_us';
        case 'Sales Maketing':
            return 'sales_marketing';
        case 'After sales':
            return 'after_sales';
        case 'Smo Leads':
            return 'smo_leads';
        default:
            return 'leads';
    }
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
    $commonData = [
        'cities' => City::whereStatus(1)->get(),
        'vehicles' => Vehicle::whereStatus(1)->get(),
        'sources' => Source::whereStatus(1)->get(),
        'campaigns' => Campaign::whereStatus(1)->get(),
        'banks' => Bank::whereStatus(1)->get(),
    ];

    if ($cityId !== null) {
        $commonData['branches'] = Branch::where('city_id', $cityId)->whereStatus(1)->get();
    } else {
        $commonData['branches'] = Branch::whereStatus(1)->get();
    }

    return $commonData;
}

