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
use App\Http\Controllers\EmailSendingCriteriaController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\TestDriveRequestContoller;
use App\Http\Controllers\QuoteRequestContoller;
use App\Http\Controllers\HrLeadController;
use App\Http\Controllers\TargetController;

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

Route::group(['middleware' => ['auth'] ], function () {

    Route::controller(HomeController::class)->group(function(){
        Route::any('dashboard',  'index')->name('dashboard');
        Route::get('leads', 'leads_index')->name('leads.index');
    });

    Route::resource('city', CityController::class);
    Route::controller(CityController::class)->group(function(){
        Route::get('city-pagination',  'cityPagination')->name('city.pagination');
        Route::get('change-status',  'changeStatus')->name('change.status');
        Route::get('check-name-exist',  'checkNameExist')->name('check.name.exist');
        Route::get('check-name-exist-chk',  'checkNameExistchk')->name('check.name.exist-chk');
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
        Route::post('campaign/updatePageType','updatePageType')->name('campaign.updatePageType');

    });

    Route::resource('lead', LeadController::class);
    Route::controller(LeadController::class)->group(function(){
        Route::get('leads-pagination',  'leadsPagination')->name('leads.pagination');
        Route::post('leads-import',  'leadsImport')->name('leads.import');
        Route::post('leads-export',  'leadsExport')->name('leads.export');
        Route::get('all-leads',  'allleads_index')->name('allleads.index');
        Route::get('all-leads-pagination',  'allleadsPagination')->name('all-leads.pagination');
        Route::post('all-leads-export',  'allleadsExport')->name('all-leads.export');
        Route::post('delete-bulk-records',  'deletebulkRecords')->name('delete-bulk-records');
        Route::post('leads/update-column',  'updateColumn')->name('leads.updateColumn');
        Route::post('upd-all-data',  'updateAllData')->name('leads.updateAllData');
    });

    Route::resource('test-drive-request', TestDriveRequestContoller::class);
    Route::controller(TestDriveRequestContoller::class)->group(function(){
        Route::get('test-drive-request-pagination',  'testDrivePagination')->name('test-drive-request.pagination');
        Route::post('test-drive-request-export',  'testdriveExport')->name('test-drive-request.export');
    });

    Route::resource('quote-request', QuoteRequestContoller::class);
    Route::controller(QuoteRequestContoller::class)->group(function(){
        Route::get('quote-request-pagination',  'testDrivePagination')->name('quote-request.pagination');
        Route::post('quote-request-export',  'testdriveExport')->name('quote-request.export');
    });

    Route::resource('hr', HrLeadController::class);
    Route::controller(HrLeadController::class)->group(function(){
        Route::get('hr-pagination',  'hrPagination')->name('hr.pagination');
        Route::post('hr-export',  'hrExport')->name('hr.export');
    });

    Route::resource('after-sale', AfterSaleController::class);
    Route::controller(AfterSaleController::class)->group(function(){
        Route::get('after-sale-pagination',  'afterSalePagination')->name('afterSale.pagination');
        Route::post('after-sale-import',  'afterSaleImport')->name('after-sale.import');
        Route::post('after-sale-export',  'afterSaleExport')->name('after-sale.export');
    });

    Route::resource('used-car', UsedCarController::class);
    Route::controller(UsedCarController::class)->group(function(){
        Route::get('used-car-pagination',  'usedCarPagination')->name('usedCar.pagination');
        Route::post('used-car-import',  'usedCarImport')->name('used-car.import');
        Route::post('used-car-export',  'usedCarExport')->name('used-car.export');
    });

    Route::resource('smo-lead', SmoLeadController::class);
    Route::controller(SmoLeadController::class)->group(function(){
        Route::get('smo-lead-pagination',  'smoLeadPagination')->name('smoLead.pagination');
        Route::post('smo-lead-import',  'smoLeadImport')->name('smo-lead.import');
        Route::post('smo-lead-export',  'smoLeadExport')->name('smo-lead.export');
    });

    Route::resource('google-business', GoogleBusinessController::class);
    Route::controller(GoogleBusinessController::class)->group(function(){
        Route::get('google-business-pagination',  'googleBusinessPagination')->name('google-business.pagination');
        Route::post('google-business-import',  'googleBusinessImport')->name('google-business.import');
        Route::get('get-branches/{city}/{page_type?}',  'getCityBranches')->name('get-city-branches.ajx');
    });

    Route::resource('bank', BankController::class);
    Route::controller(BankController::class)->group(function(){
        Route::get('bank-pagination',  'banksPagination')->name('bank.pagination');
    });

    Route::resource('contact', CustomerController::class);
    Route::controller(CustomerController::class)->group(function(){
        Route::get('customer-pagination',  'customerPagination')->name('contact.pagination');
    });

    Route::resource('old-leads', OldLeadController::class);
    Route::controller(OldLeadController::class)->group(function(){
        Route::get('old-leads-pagination',  'leadsPagination')->name('old-leads.pagination');
        Route::post('old-leads-export',  'oldLeadsExport')->name('old-leads.export');
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

    Route::resource('email-sending-criteria', EmailSendingCriteriaController::class);
    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);
    Route::controller(UserController::class)->group(function(){
        Route::get('users-pagination',  'usersPagination')->name('users.pagination');
    });

    Route::controller(SaleGraphController::class)->group(function(){
        Route::any('sale-graph',  'index')->name('sale-graph.index');
        Route::any('sale-graph-comparison',  'comparisonIndex')->name('sale-graph-comparison.index');
        Route::any('after-sale-graph',  'indexAfterSale')->name('after-sale-graph.index');
        Route::any('after-sale-graph-comparison',  'comparisonIndexAfterSale')->name('after-sale-graph-comparison.index');
        Route::any('test-drive-graph',  'testDriveIndex')->name('test-drive-graph.index');
        Route::any('online-service-booking-graph',  'serviceBookingIndex')->name('online-service-booking-graph.index');
        Route::any('service-offers-graph',  'serviceOffersIndex')->name('service-offers-graph.index');
        Route::any('contact-us-graph',  'contactUsIndex')->name('contact-us-graph.index');
        Route::any('used-cars-graph',  'usedCarsIndex')->name('used-cars-graph.index');
        Route::any('hr-graph',  'hrIndex')->name('hr-graph.index');
        Route::any('smo-graph',  'smoIndex')->name('smo-graph.index');
        Route::any('events-graph',  'eventsIndex')->name('events-graph.index');
        Route::any('actualsales-graph',  'actualsalesGraphIndex')->name('actualsales-graph.index');
        Route::any('crm-leads-graph',  'crmLeadsGraphIndex')->name('crm-leads-graph.index');
    });

    Route::controller(GraphController::class)->group(function(){
        Route::get('sale-graph-pdf',  'indexPdf')->name('sale-graph-pdf.index');
        Route::get('after-sale-graph-pdf',  'indexAfterSalePdf')->name('after-sale-graph-pdf.index');
        Route::get('crm-leads-graph-pdf',  'crmleadsPdf')->name('crm-leads-graph-pdf.index');
    });


    Route::resource('crm-leads', CrmLeadController::class);
    Route::controller(CrmLeadController::class)->group(function(){
        Route::get('crm-leads-pagination',  'crmLeadPagination')->name('crm-leads.pagination');
        Route::post('crm-leads-import',  'crmleadsImport')->name('crm-leads.import');
        Route::post('crm-leads-export',  'crmLeadsExport')->name('crm-leads.export');
        Route::post('sub-category-update',  'subCategoryUpdate')->name('sub-category.update');
        Route::get('qualified-crm-leads',  'qualifiedCrmLeads')->name('qualified-crm-leads.index');
        Route::get('non-qualified-crm-leads',  'nonQualifiedCrmLeads')->name('non-qualified-crm-leads.index');
        Route::get('general-inquiry-crm-leads',  'generalCrmLeads')->name('general-inquiry-crm-leads.index');
    });

    Route::resource('targets', TargetController::class);
    Route::controller(TargetController::class)->group(function(){
        Route::get('targets-pagination',  'targetsPagination')->name('targets.pagination');
        Route::post('import-targets',  'importTargets')->name('targets.import');
        Route::post('crm-leads-export',  'crmLeadsExport')->name('crm-leads.export');
    });

});

Route::controller(ExternalLeadController::class)->group(function(){
    // Route::post('addleads',  'store')->name('addleads.store');
    // Route::get('addleads/create',  'create');
    // Route::any('saveform/store',  'saveformstore');
    Route::get('pdpl-form',  'pdplForm')->withoutMiddleware('auth');
    Route::post('pdpl-form-submit',  'pdplFormSubmit')->name('pdplFormSubmit');
    Route::any('saveformjson',  'saveformjson')->withoutMiddleware('auth');
    // Route::any('saveformjson',  'saveformjson')->middleware('basic.auth');
    Route::any('campaign_leads',  'store')->middleware('basic.auth');
    // Route::any('qualified-crmleads-listing',  'crmLeadsListing')->withoutMiddleware('auth');
    Route::any('qualified-crmleads-listing', 'crmLeadsListing')->middleware('basic.auth');

});
