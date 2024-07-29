<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController ;
use App\Http\Controllers\SystemController ;
use App\Http\Controllers\DeveloperController ;
use App\Http\Controllers\AuthController;

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
Route::apiResource('/systems', SystemController::class);
Route::apiResource('/developers', DeveloperController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::get('/developers/{id}', [DeveloperController::class, 'show']);