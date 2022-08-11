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
Route::get('/task-all', [TaskController::class, 'statusAll']);
Route::post('/task-store', [TaskController::class, 'store']);
Route::post('/task-update', [TaskController::class, 'update']);
Route::post('/task-stop', [TaskController::class, 'stop']);
Route::post('/task-start', [TaskController::class, 'start']);

Route::post('/group-store', [GroupController::class, 'store']);
Route::post('/group-start', [GroupController::class, 'start']);
Route::post('/group-stop', [GroupController::class, 'stop']);
Route::get('/group-status/{group}', [GroupController::class, 'status']);
