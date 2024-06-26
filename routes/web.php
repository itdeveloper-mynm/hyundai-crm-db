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
use App\Http\Controllers\GoogleBusinessController;
use App\Http\Controllers\OldLeadController;
use App\Http\Controllers\SaleDataController;
use App\Http\Controllers\SocialDataController;
use App\Http\Controllers\SaleGraphController;
use App\Http\Controllers\CrmLeadController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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
    Route::get('leads-export',  'leadsExport')->name('leads.export');
});

Route::resource('after-sale', AfterSaleController::class);
Route::controller(AfterSaleController::class)->group(function(){
    Route::get('after-sale-pagination',  'afterSalePagination')->name('afterSale.pagination');
    Route::post('after-sale-import',  'afterSaleImport')->name('after-sale.import');
    Route::get('after-sale-export',  'afterSaleExport')->name('after-sale.export');
});

Route::resource('used-car', UsedCarController::class);
Route::controller(UsedCarController::class)->group(function(){
    Route::get('used-car-pagination',  'usedCarPagination')->name('usedCar.pagination');
    Route::post('used-car-import',  'usedCarImport')->name('used-car.import');
    Route::get('used-car-export',  'usedCarExport')->name('used-car.export');
});

Route::resource('smo-lead', SmoLeadController::class);
Route::controller(SmoLeadController::class)->group(function(){
    Route::get('smo-lead-pagination',  'smoLeadPagination')->name('smoLead.pagination');
    Route::post('smo-lead-import',  'smoLeadImport')->name('smo-lead.import');
    Route::get('smo-lead-export',  'smoLeadExport')->name('smo-lead.export');
});

Route::resource('google-business', GoogleBusinessController::class);
Route::controller(GoogleBusinessController::class)->group(function(){
    Route::get('google-business-pagination',  'googleBusinessPagination')->name('google-business.pagination');
    Route::post('google-business-import',  'googleBusinessImport')->name('google-business.import');
    Route::get('get-branches/{city}',  'getCityBranches')->name('get-city-branches.ajx');
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

Route::resource('old-leads', OldLeadController::class);
Route::controller(OldLeadController::class)->group(function(){
    Route::get('old-leads-pagination',  'leadsPagination')->name('old-leads.pagination');
    Route::get('old-leads-export',  'oldLeadsExport')->name('old-leads.export');
});

Route::resource('sales-data', SaleDataController::class);
Route::controller(SaleDataController::class)->group(function(){
    Route::get('sales-data-pagination',  'salesDataPagination')->name('sales-data.pagination');
    Route::post('sales-data-import',  'saleDataImport')->name('sales-data.import');
});

Route::resource('social-data', SocialDataController::class);
Route::controller(SocialDataController::class)->group(function(){
    Route::get('social-data-pagination',  'socialDataPagination')->name('social-data.pagination');
});

Route::resource('roles', RoleController::class);

Route::resource('users', UserController::class);
Route::controller(UserController::class)->group(function(){
    Route::get('users-pagination',  'usersPagination')->name('users.pagination');
});

Route::controller(SaleGraphController::class)->group(function(){
    Route::get('sale-graph',  'index')->name('sale-graph.index');
    Route::get('sale-graph-pdf',  'indexPdf')->name('sale-graph-pdf.index');
    Route::get('sale-graph-comparison',  'comparisonIndex')->name('sale-graph-comparison.index');
    Route::get('after-sale-graph',  'indexAfterSale')->name('after-sale-graph.index');
    Route::get('after-sale-graph-comparison',  'comparisonIndexAfterSale')->name('after-sale-graph-comparison.index');
    Route::get('test-drive-graph',  'testDriveIndex')->name('test-drive-graph.index');
    Route::get('online-service-booking-graph',  'serviceBookingIndex')->name('online-service-booking-graph.index');
    Route::get('service-offers-graph',  'serviceOffersIndex')->name('service-offers-graph.index');
    Route::get('contact-us-graph',  'contactUsIndex')->name('contact-us-graph.index');
    Route::get('used-cars-graph',  'usedCarsIndex')->name('used-cars-graph.index');
    Route::get('hr-graph',  'hrIndex')->name('hr-graph.index');
    Route::get('smo-graph',  'smoIndex')->name('smo-graph.index');
    Route::get('events-graph',  'eventsIndex')->name('events-graph.index');
    Route::get('actualsales-graph',  'actualsalesGraphIndex')->name('actualsales-graph.index');
    Route::any('export-pdf',  'exportPdf')->name('exportPdf.index');
});


Route::resource('crm-leads', CrmLeadController::class);
Route::controller(CrmLeadController::class)->group(function(){
    Route::get('crm-leads-pagination',  'crmLeadPagination')->name('crm-leads.pagination');
    Route::post('crm-leads-import',  'crmleadsImport')->name('crm-leads.import');
    Route::get('crm-leads-export',  'crmLeadsExport')->name('crm-leads.export');
});
