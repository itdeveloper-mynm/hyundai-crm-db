<?php
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;

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

function formateDate($date) {
    return Carbon::parse($date)->format('Y-m-d');
}

function formateDateTime($date) {
    return Carbon::parse($date)->format('Y-m-d h:i:s');
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
        $customer->save();
    }

    return $customer;
}

function checkApplicationType($type) {

    switch ($type) {
        case 'Leads':
            return 'leads';
        case 'Request a Quote':
            return 'request_a_quote';
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
