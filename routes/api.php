<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalLeadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ExternalLeadController::class)->group(function(){
    Route::any('all-leads-listing', 'allLeadsListing')->middleware('basic.auth');
    Route::any('contact-leads', 'contactLeadsListing')->middleware('basic.auth');

});
