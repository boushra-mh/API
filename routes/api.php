<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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


Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('logout', [AuthController::class,'logout']);;

Route::controller(BrandsController::class)->group(function ()
{
    Route::get('index','index');
    Route::get('show/{id}','show');
    Route::post('store','store');
    Route::put('update/{id}','update_brand');
    Route::delete('delete_brand/{id}','delete_brand');

});
Route::controller(CategoryController::class)->group(function ()
{
    Route::get('index','index');
    Route::get('show/{id}','show');
    Route::post('store','store');
    Route::put('update/{id}','update_category');
    Route::delete('delete_category/{id}','delete_category');

});

Route::controller(LocationController::class)->group(function ()
{
    Route::post('store','store');
    Route::put('update/{id}','update_location');
    Route::delete('delete_location/{id}','delete_location');
});

Route::controller(ProductController::class)->group(function (){
    Route::get('index','index');
    Route::get('show/{id}','show');
    Route::post('store','store');
    Route::put('update/{id}','update_product');
    Route::delete('delete_product/{id}','delete_product');
}); 
 Route::controller(OrderController::class)->group(function (){
    Route::get('index','index');
    Route::get('show/{id}','show');
    Route::post('store','store');
    Route::get('get_order_items/{id}','get_order_items');
    Route::get('get_user_orders/{id}','get_user_orders');
    Route::put('change_order_status/{id}','change_order_status');
 });