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
Route::post('logout', [AuthController::class,'logout']);


//  CRUD Brands

Route::prefix('brands')->group(function() {
    Route::get('index', [BrandsController::class, 'index']);
    Route::put('update/{id}', [BrandsController::class, 'update_brand']);
    Route::post('store', [BrandsController::class, 'store']);
    Route::delete('delete_brand/{id}', [BrandsController::class, 'delete_brand']);
});


// CRUD Category

Route::prefix('category')->group(function() {
    Route::get('index', [CategoryController::class, 'index']);
    Route::put('update/{id}', [CategoryController::class, 'update_category']);
    Route::post('store', [CategoryController::class, 'store']);
    Route::delete('delete_category/{id}', [CategoryController::class, 'delete_category']);
});

// CRUD Location

Route::prefix('location')->group(function() {
    Route::get('index', [LocationController::class, 'index']);
    Route::put('update/{id}', [LocationController::class, 'update_location']);
    Route::post('store', [LocationController::class, 'store']);
    Route::delete('delete_location/{id}', [LocationController::class, 'delete_location']);
});

Route::prefix('product')->group(function() {
    Route::get('index', [ProductController::class, 'index']);
    Route::put('update/{id}', [ProductController::class, 'update_product']);
    Route::post('store', [ProductController::class, 'store']);
    Route::delete('delete_product/{id}', [ProductController::class, 'delete_product']);
});

// CRUD Order
Route::prefix('order')->group(function() {
    Route::get('index', [OrderController::class, 'index']);
    Route::get('show/{id}', [OrderController::class, 'show']);
    Route::post('store', [OrderController::class, 'store']);
    Route::get('get_user_orders/{id}', [OrderController::class, 'get_user_orders']);
    Route::get('get_order_items/{id}', [OrderController::class, 'get_order_items/{id}']);
    Route::post('change_order_status/{id}', [OrderController::class, 'change_order_status']);
});

