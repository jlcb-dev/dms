<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\LoancalcuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportsController;
//use App\Livewire\HomeLivewire;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login.index');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/postlogin', [LoginController::class, 'login'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logOut'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/leads/{lead_type}', [LeadsController::class, 'index'])->name('leads');

Route::match(['get', 'post'], '/fetch-town', [LeadsController::class, 'fetch_town'])->name('fetch_town');
Route::match(['get', 'post'], '/fetch-town-update', [LeadsController::class, 'fetch_town_update'])->name('fetch_town_update');
Route::match(['get', 'post'], '/fetch-zip', [LeadsController::class, 'fetch_zip'])->name('fetch_zip');
Route::match(['get', 'post'], '/fetch-model', [LeadsController::class, 'fetch_model'])->name('fetch_model');
Route::match(['get', 'post'], '/fetch-model-update', [LeadsController::class, 'fetch_model_update'])->name('fetch_model_update');

Route::post('/create-leads', [LeadsController::class, 'postLeads'])->name('postLeads'); //-Save-//
Route::post('/update-leads', [LeadsController::class, 'updateLeads'])->name('updateLeads'); //-Update Leads-//
Route::post('/update-leads-inquiry', [LeadsController::class, 'updateLeadsInq'])->name('updateLeadsInq'); //-Update Leads Inquiry-//
Route::post('/update-leads-new-inquiry', [LeadsController::class, 'updateLeadsNewInq'])->name('updateLeadsNewInq'); //-Update New Leads Inquiry-//
Route::get('/list-of-leads/{lead_type}', [LeadsController::class, 'leads_view'])->name('leads_view');//--//
Route::post('/update_leads', [LeadsController::class, 'fetchUpdateLeads'])->name('fetchUpdateLeads'); //-Fetch Data to Update Leads-//
Route::match(['get', 'post'], '/leads', [LeadsController::class, 'leadSearch'])->name('leadSearch');//--//
Route::post('/update_leads_inq', [LeadsController::class, 'fetchUpdateLeadsInq'])->name('fetchUpdateLeadsInq'); //-Fetch Data to Update Vehicle Inquiry-//

Route::get('/auto-loan-calculator', [LoancalcuController::class, 'index'])->name('loan_calculator');
Route::match(['get', 'post'],'/generate-pdf', [LoancalcuController::class, 'generatePdf'])->name('generatePdf');

Route::get('/reports/lead-summary', [ReportsController::class, 'index'])->name('reports');
Route::post('/reports/lead-summary', [ReportsController::class, 'fetch_leads'])->name('fetch_leads');