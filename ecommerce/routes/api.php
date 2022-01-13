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

//------------------------------ Customer Api ---------------------------------//
Route::get('/customers', 'App\Http\Controllers\CustomerController@displayAllcustomer');
Route::get('/customer/{customer_id}', 'App\Http\Controllers\CustomerController@displayOnecustomer');
Route::post('/customer', 'App\Http\Controllers\CustomerController@addNewCustomer');
Route::patch('/customer/{customer_id}', 'App\Http\Controllers\CustomerController@updateCustomer');
Route::patch('/customerDetail/{customer_id}', 'App\Http\Controllers\CustomerController@updateCustomerDetails');
Route::patch('/customerAddress/{customer_id}', 'App\Http\Controllers\CustomerController@updateCustomerAddress');
Route::patch('/customers/{customer_id}', 'App\Http\Controllers\CustomerController@deleteCustomer');
//------------------------------- products api -----------------------------------//

Route::get('/products', 'App\Http\Controllers\ProductController@displayAllProducts');
Route::get('/product/{product_id}', 'App\Http\Controllers\ProductController@displayOneProduct');
Route::post('/product', 'App\Http\Controllers\ProductController@addNewProduct');
Route::patch('/product/{product_id}', 'App\Http\Controllers\ProductController@updateProduct');
Route::patch('/products/{product_id}', 'App\Http\Controllers\ProductController@deleteProduct');

//-----------------------------Employee----------------------------------------------//
Route::get('/employee', 'App\Http\Controllers\EmployeeController@displayAllEmployee');
Route::get('/employee/{employee_id}', 'App\Http\Controllers\EmployeeController@displayOneEmployee');


//-------------------------------Orders Details-------------------------------------------//

Route::get('/orders', 'App\Http\Controllers\OrderController@displayAllOrders');
Route::get('/order/{order_id}', 'App\Http\Controllers\OrderController@displayOneOrder');
Route::post('/order', 'App\Http\Controllers\OrderController@addNewOrder');
Route::patch('/orders/{order_id}', 'App\Http\Controllers\OrderController@updateOrder');
Route::patch('/order/{order_id}', 'App\Http\Controllers\OrderController@deleteOrder');