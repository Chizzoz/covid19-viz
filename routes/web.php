<?php

use App\Models\CovidCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    $latest_batch = CovidCase::orderBy('batch', 'desc')->pluck('batch')->first();
    // $data['covid_cases'] = CovidCase::orderBy('country_region', 'desc')->where('country_region', '!=', 'US')->where('batch', $latest_batch)->distinct()->get();

    $covid_cases = DB::table('covid_cases')->select(DB::raw("province_state, country_region, lastupdate, latitude, longitude, SUM(confirmed) AS confirmed, SUM(deaths) AS deaths, SUM(recovered) AS recovered, (SUM(confirmed) - SUM(recovered) - SUM(deaths)) AS active"))->where('batch', $latest_batch)->groupBy('province_state', 'country_region', 'lastupdate', 'latitude', 'longitude')->where('country_region', '!=', 'US')->where('latitude', '!=', '')->where('longitude', '!=', '')->where('active', '>=', 0)->orderBy('country_region', 'desc');

    $us_data = DB::table('covid_cases')->select(DB::raw("COUNT(province_state) AS province_state, country_region, lastupdate, COUNT(latitude) AS latitude, COUNT(longitude) AS longitude, SUM(confirmed) AS confirmed, SUM(deaths) AS deaths, SUM(recovered) AS recovered, (SUM(confirmed) - SUM(recovered) - SUM(deaths)) AS active"))->where('batch', $latest_batch)->groupBy('country_region', 'lastupdate')->where('country_region', 'US')->where('active', '>=', 0)->union($covid_cases)->get();

    $data['last_updated_on'] = CovidCase::orderBy('batch', 'desc')->pluck('lastupdate')->first();
    $data['covid_cases'] = $us_data;

    return view('welcome', $data);
})->name('welcome');

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/global/pull', [CovidCaseController::class, 'index'])->name('pull_global_covid19_data');

Route::post('/global/pull/post', [CovidCaseController::class, 'pullGlobaData'])->name('post_global_pull_request');

// About
Route::get('table', function () {
    $data['heading'] = "Table";
    
    $latest_batch = CovidCase::orderBy('batch', 'desc')->pluck('batch')->first();
    // $data['covid_cases'] = CovidCase::orderBy('country_region', 'desc')->where('country_region', '!=', 'US')->where('batch', $latest_batch)->distinct()->get();
    $data['covid_cases'] = DB::table('covid_cases')->select(DB::raw("province_state, country_region, lastupdate, latitude, longitude, SUM(confirmed) AS confirmed, SUM(deaths) AS deaths, SUM(recovered) AS recovered, (SUM(confirmed) - SUM(recovered) - SUM(deaths)) AS active"))->where('batch', $latest_batch)->groupBy('province_state', 'country_region', 'lastupdate', 'latitude', 'longitude')->where('country_region', '!=', 'US')->orderBy('country_region', 'desc')->get();

    return view('layouts.app')->nest('table', 'table', $data);
})->name('table');

// About
Route::get('about', function () {
    $data['heading'] = "About";
    
    return view('layouts.app')->nest('right_sidebar', 'layouts.right_sidebar')->nest('about', 'about');
})->name('about');

// Startup contact routes
Route::get('contact', function () {
    $data['heading'] = "Contact Us";
    
    return view('layouts.app')->nest('right_sidebar', 'layouts.right_sidebar')->nest('contact', 'contact');
})->name('contact');

Route::post('/contact/post', [HomeController::class, 'sendMessage'])->name('contact-us-post');

// Terms and Conditions
Route::get('terms', function () {
    $data['heading'] = "Terms";
    
    return view('layouts.app')->nest('right_sidebar', 'layouts.right_sidebar')->nest('terms', 'terms');
})->name('terms');

// Privacy Policy
Route::get('privacy', function () {
    $data['heading'] = "Privacy Policy";
    
    return view('layouts.app')->nest('right_sidebar', 'layouts.right_sidebar')->nest('privacy', 'privacy');
})->name('privacy');

// Credits
Route::get('credits', function () {
    $data['heading'] = "Credits";
    
    return view('layouts.app')->nest('right_sidebar', 'layouts.right_sidebar')->nest('credits', 'credits');
})->name('credits');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');