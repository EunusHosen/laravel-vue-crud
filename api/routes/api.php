<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api;
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

Route::get('/tasks', [Api\TaskController::class, 'index']);
Route::post('/tasks', [Api\TaskController::class, 'store']);
Route::get('/tasks/{task}', [Api\TaskController::class, 'show']);
Route::put('/tasks/{task}', [Api\TaskController::class, 'update']);
Route::delete('/tasks/{task}', [Api\TaskController::class, 'destroy']);

Route::put('/tasks/{task}/complete', [Api\TaskCompleteController::class, 'update']);
