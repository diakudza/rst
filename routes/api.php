<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\TaskController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/task/{task}', [TaskController::class, 'status']);
Route::get('/taskAll', [TaskController::class, 'statusAll']);
Route::post('/task', [TaskController::class, 'store']);
Route::post('/taskstop', [TaskController::class, 'stopTask']);
Route::post('/taskstart', [TaskController::class, 'startTask']);
Route::post('/group', [GroupController::class, 'makeGroup']);
Route::post('/groupstart', [GroupController::class, 'startGroup']);
Route::post('/groupstop', [GroupController::class, 'stopGroup']);
Route::get('/groupstatus/{group}', [GroupController::class, 'statusGroup']);
