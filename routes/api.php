<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController ;
use App\Http\Controllers\UserController ;
use App\Http\Controllers\SystemController ;

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

Route::middleware('auth:sanctum')->get('/ticket', function (Request $request) {
    return $request->ticket();
});

Route::apiResource('/tickets', TicketController::class);
Route::apiResource('/users', UserController::class);
Route::apiResource('/systems', SystemController::class);
