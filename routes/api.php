<?php

use App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*==========================================
=         follows          =
==========================================*/
Route::group(['prefix' => 'games'], function () {
    Route::post('start', [GameController::class, 'start']);
    Route::post('end', [GameController::class, 'end']);
});
/*=====     End of follows       ======*/
