<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', 'App\Http\Controllers\Usercontroller@displayAllusers');
Route::get('/users/{user_id}', 'App\Http\Controllers\Usercontroller@displayOneuser');

Route::get('/customers', 'App\Http\Controllers\CustomerController@displayAllcustomer');
Route::get('/customer/{customer_id}', 'App\Http\Controllers\CustomerController@displayOnecustomer');
Route::post('/customer', 'App\Http\Controllers\CustomerController@addNewCustomer');
Route::patch('/customer/{customer_id}', 'App\Http\Controllers\CustomerController@updateCustomer');
Route::patch('/customerDetail/{customer_id}', 'App\Http\Controllers\CustomerController@updateCustomerDetails');