<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\SiteconfigController;

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

Route::get('menu', [CategoryController::class, 'menu']);
Route::get('products', [ProductController::class, 'products']);
Route::get('banners', [BannerController::class, 'banners']);
Route::get('siteconfig', [SiteconfigController::class, 'siteconfig']);
Route::get('product/{id}', [ProductController::class, 'productDetail']);
Route::get('category/{alias}', [ProductController::class, 'catProduct']);
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [CustomAuthController::class, 'login']);
    Route::post('register', [CustomAuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::get('logout', [CustomAuthController::class, 'logout']);
      Route::get('user', [CustomAuthController::class, 'user']);
      Route::post('addorder', [OrderController::class, 'addOrder']);
      Route::get('user-orders', [OrderController::class, 'userOrders']);
      Route::post('change-password', [CustomAuthController::class, 'changePassword']);
    });
});
