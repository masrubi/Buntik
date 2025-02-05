<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlamatCustomerController;

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
Route::prefix('api')->middleware('api')->group(function () {
    Route::get('/kabupaten/{provinsiId}', [AlamatCustomerController::class, 'getKabupaten']);
    Route::get('/kecamatan/{kabupatenId}', [AlamatCustomerController::class, 'getKecamatan']);
    Route::get('/desa/{kecamatanId}', [AlamatCustomerController::class, 'getDesa']);
});

     

