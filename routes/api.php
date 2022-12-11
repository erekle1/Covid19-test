<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\PersonalAccessTokensController;
use App\Http\Controllers\API\StatisticController;
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

Route::post('/tokens/create', [PersonalAccessTokensController::class, 'store'])->middleware('auth');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'me']);
    Route::get('access_tokens', [PersonalAccessTokensController::class, 'index']);
    Route::get('countries', [CountryController::class, 'index']);
    Route::get('statistics', [StatisticController::class, 'index']);
    Route::get('get-stats/{country_code}', [CountryController::class, 'getStatsByCountryCode'])->where('country_code', '[A-Z]{2}$')->name('stats_by_country');
});
