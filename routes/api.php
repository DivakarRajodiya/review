<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiLoginUserController;
use App\Http\Controllers\API\ApiReviewController;
use App\Http\Controllers\API\ApiBannerController;
use App\Http\Controllers\API\ApiSettingController;

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

Route::post('login', [ApiLoginUserController::class, 'login']);
Route::post('user-register', [ApiLoginUserController::class, 'register']);
Route::post('logout', [ApiLoginUserController::class, 'logout']);

//Route::group(['middleware' => 'auth:api'], function () {
Route::get('getReview', [ApiReviewController::class, 'getReview']);
Route::post('store-review', [ApiReviewController::class, 'storeReview']);
Route::get('banners', [ApiBannerController::class, 'getBanners']);
Route::post('store-banner', [ApiBannerController::class, 'storeBanner']);
Route::get('get_setting', [ApiSettingController::class, 'getSetting']);
//});



