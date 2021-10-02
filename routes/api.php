<?php

use App\Http\Controllers\Api\v1\Auth\AuthApiController;
use App\Http\Controllers\Api\v1\MoneyTrack\MoneyTrackApiController;
use App\Http\Controllers\Api\v1\TimeTrack\TimeTrackApiController;
use App\Http\Controllers\Api\v1\TimeTrack\TimeTrackTypeApiController;
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


Route::prefix('auth')->group(function () {
    Route::post('/signUp', [AuthApiController::class, 'signUp']);
    Route::post('/login', [AuthApiController::class, 'login']);
});
Route::middleware(['auth:api'])->group(function () {

    Route::apiResource('TimeTrack', TimeTrackApiController::class)->parameters([
        'TimeTrack' => 'slug',
    ])
        ->except(['edit', 'create']);

    Route::apiResource('TimeTrackType', TimeTrackTypeApiController::class)->parameters([
        'TimeTrackType' => 'slug',
    ])
        ->only(['index']);

    Route::apiResource('MoneyTrack', MoneyTrackApiController::class)->parameters([
        'MoneyTrack' => 'slug',
    ])
        ->except(['edit', 'create']);
});
