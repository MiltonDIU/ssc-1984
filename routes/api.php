<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Admin\PaymentApiController;
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

//Route::apiResource('payment', PaymentApiController::class);

Route::post('success-payment', [PaymentApiController::class,'successPayment'])->name('success-payment');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
