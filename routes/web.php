<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ExternalLeadController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\AfterSaleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UsedCarController;
use App\Http\Controllers\SmoLeadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('login');
});

Auth::routes();


Route::controller(HomeController::class)->group(function(){
    Route::get('dashboard',  'index')->name('dashboard');
    Route::get('leads', 'leads_index')->name('leads.index');
});


Route::resource('city', CityController::class);
Route::controller(CityController::class)->group(function(){
    Route::get('city-pagination',  'cityPagination')->name('city.pagination');
    Route::get('change-status',  'changeStatus')->name('change.status');
    Route::get('check-name-exist',  'checkNameExist')->name('check.name.exist');
});

Route::resource('branch', BranchController::class);
Route::controller(BranchController::class)->group(function(){
    Route::get('branch-pagination',  'branchPagination')->name('branch.pagination');
});

Route::resource('vehicle', VehicleController::class);
Route::controller(VehicleController::class)->group(function(){
    Route::get('vehicle-pagination',  'vehiclePagination')->name('vehicle.pagination');
});

Route::resource('source', SourceController::class);
Route::controller(SourceController::class)->group(function(){
    Route::get('source-pagination',  'sourcePagination')->name('source.pagination');
});

Route::resource('campaign', CampaignController::class);
Route::controller(CampaignController::class)->group(function(){
    Route::get('campaign-pagination',  'campaignPagination')->name('campaign.pagination');
});

Route::resource('lead', LeadController::class);
Route::controller(LeadController::class)->group(function(){
    Route::get('leads-pagination',  'leadsPagination')->name('leads.pagination');
    Route::post('leads-import',  'leadsImport')->name('leads.import');
});

Route::resource('after-sale', AfterSaleController::class);
Route::controller(AfterSaleController::class)->group(function(){
    Route::get('after-sale-pagination',  'afterSalePagination')->name('afterSale.pagination');
    Route::post('after-sale-import',  'afterSaleImport')->name('after-sale.import');
});

Route::resource('used-car', UsedCarController::class);
Route::controller(UsedCarController::class)->group(function(){
    Route::get('used-car-pagination',  'usedCarPagination')->name('usedCar.pagination');
    Route::post('used-car-import',  'usedCarImport')->name('used-car.import');
});

Route::resource('smo-lead', SmoLeadController::class);
Route::controller(SmoLeadController::class)->group(function(){
    Route::get('smo-lead-pagination',  'smoLeadPagination')->name('smoLead.pagination');
    Route::post('smo-lead-import',  'smoLeadImport')->name('smo-lead.import');
});


Route::resource('bank', BankController::class);
Route::controller(BankController::class)->group(function(){
    Route::get('bank-pagination',  'banksPagination')->name('bank.pagination');
});


Route::resource('contact', CustomerController::class);
Route::controller(CustomerController::class)->group(function(){
    Route::get('customer-pagination',  'customerPagination')->name('contact.pagination');
});

Route::controller(ExternalLeadController::class)->group(function(){
    Route::post('addleads',  'store')->name('addleads.store');
    Route::get('addleads/create',  'create');
    Route::get('saveformjson/create',  'saveformjson');
});