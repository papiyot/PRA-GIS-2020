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


Route::get('/home', 'MasterController@home')->name('home');
Route::post('/master/locations/store', 'MasterController@locations_store')->name('locations.store');
Route::get('/master/locations/{id?}', 'MasterController@locations_view')->name('locations.view');
Route::get('/delete/locations/{id?}', 'MasterController@locations_delete')->name('locations.delete');


// Example Routes
Route::view('/', 'landing');
Route::match(['get', 'post'], '/dashboard', function(){
    return view('dashboard');
});
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
