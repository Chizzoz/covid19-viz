<?php

use App\CovidCase;
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
	$latest_batch = CovidCase::orderBy('batch', 'desc')->get()->pluck('batch')->first();
	$data['covid_cases'] = CovidCase::orderBy('country_region', 'desc')->where('batch', $latest_batch)->where('province_state', '')->distinct()->get();

    return view('welcome', $data);
})->name('welcome');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/global/pull', 'CovidCaseController@index')->name('pull_global_covid19_data');

Route::post('/global/pull/post', 'CovidCaseController@pullGlobaData')->name('post_global_pull_request');

// About
Route::get('table', function(){
    $data['heading'] = "Table";
	
	$latest_batch = CovidCase::orderBy('batch', 'desc')->get()->pluck('batch')->first();
	$data['covid_cases'] = CovidCase::orderBy('country_region', 'desc')->where('batch', $latest_batch)->where('province_state','')->distinct()->get();

	return view('layouts.app')->nest('table', 'table', $data);
})->name('table');

// About
Route::get('about', function(){
    $data['heading'] = "About";
	
	return view('layouts.app')->nest('right_sidebar', 'layouts.right_sidebar')->nest('about', 'about');
})->name('about');

// Startup contact routes
Route::get('contact', function(){
	$data['heading'] = "Contact Us";
	
	return view('layouts.app')->nest('right_sidebar', 'layouts.right_sidebar')->nest('contact', 'contact');
})->name('contact');

Route::post('/contact/post', 'HomeController@sendMessage')->name('contact-us-post');

// Terms and Conditions
Route::get('terms', function(){
	$data['heading'] = "Terms";
	
	return view('layouts.app')->nest('right_sidebar', 'layouts.right_sidebar')->nest('terms', 'terms');
})->name('terms');

// Privacy Policy
Route::get('privacy', function(){
	$data['heading'] = "Privacy Policy";
	
	return view('layouts.app')->nest('right_sidebar', 'layouts.right_sidebar')->nest('privacy', 'privacy');
})->name('privacy');

// Credits
Route::get('credits', function(){
	$data['heading'] = "Credits";
	
	return view('layouts.app')->nest('right_sidebar', 'layouts.right_sidebar')->nest('credits', 'credits');
})->name('credits');
