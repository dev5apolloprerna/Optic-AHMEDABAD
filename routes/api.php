<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ExhibitorAuthController;
use App\Http\Controllers\Api\ExhibitorUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return 'Cache is cleared';
});

Route::post('state/city/mapping', [ApiController::class, 'state_city_mapping']);

Route::post('visitor/registration', [ApiController::class, 'visitor_registration']);

Route::prefix('exhibitor')->group(function () {
    Route::post('login', [ExhibitorAuthController::class, 'login']);
    Route::middleware(['jwt.auth'])->group(function () {

        Route::post('/visitor-registration', [ExhibitorUserController::class, 'visitor_registration']);


        Route::post('logout', [ExhibitorAuthController::class, 'logout']);
        Route::get('profile', [ExhibitorAuthController::class, 'profile']);
    });
});
