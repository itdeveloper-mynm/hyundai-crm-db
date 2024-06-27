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
        'campaign-leads-list',
        'after-sale-leads-list',
        'used-car-leads-list',
        'smo-leads-list',
        'google-business-list',
        'old-leads-list',
        'sales-data-list',
        'social-data-list',
        //'crm-leads-list'
    ];
}

function GraphMenuPermissionArr()
{
    return [
        'sale-graph-list',
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
        //'crm-leads-list'
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
        'sales-data-list',
        'social-data-list',
        //'crm-leads-list'
    ];
}

function AllLeadsMenuArr()
{
    $array =[
        route('lead.index'),route('lead.create'),request()->is('lead/*/edit'),
        route('after-sale.index'),route('after-sale.create'),request()->is('after-sale/*/edit'),
        route('used-car.index'),route('used-car.create'),request()->is('used-car/*/edit'),
        route('smo-lead.index'),route('smo-lead.create'),request()->is('smo-lead/*/edit'),
        route('google-business.index'),request()->is('google-business/*/edit'),
        route('old-leads.index'),route('old-leads.create'),request()->is('old-leads/*/edit'),
        route('sales-data.index'),request()->is('sales-data/*/edit'),
        route('social-data.index'),route('social-data.create'),request()->is('social-data/*/edit'),
    ];
    return $array;
}

function GraphAllMenuArr()
{
    $array =[
        route('sale-graph.index'),request()->is('sale-graph*'),
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
        case 'Career':
            return 'career';
        case 'Crm Leads':
            return 'crm_leads';
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

