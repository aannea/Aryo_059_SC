<?php

use App\Http\Controllers\StudentApiController;
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

Route::post('student', [StudentApiController::class, 'store']);

Route::get('student', [StudentApiController::class, 'index']);
Route::put('student/{id}', [StudentApiController::class, 'update']);
Route::delete('student/{id}', [StudentApiController::class, 'destroy']);