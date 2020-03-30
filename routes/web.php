<?php

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
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// About
Route::get('table', function(){
    $data['heading'] = "Table";
	
	return view('layouts.app')->nest('table', 'table');
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
