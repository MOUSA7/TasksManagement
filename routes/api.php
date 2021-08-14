<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('tasks',[\App\Http\Controllers\TaskApiController::class,'index']);
Route::get('tasks/create',[\App\Http\Controllers\TaskApiController::class,'create']);
Route::post('tasks/{slug}',[\App\Http\Controllers\TaskApiController::class,'store']);
Route::put('tasks/{id}/update',[\App\Http\Controllers\TaskApiController::class,'update']);
Route::delete('tasks/{id}/delete',[\App\Http\Controllers\TaskApiController::class,'delete']);
Route::get('tasks/{id}/show',[\App\Http\Controllers\TaskApiController::class,'show']);


Route::get('users',[\App\Http\Controllers\Api\UserApiController::class,'index']);
//Route::get('users/create',[\App\Http\Controllers\Api\UserApiController::class,'create']);
Route::post('users/create',[\App\Http\Controllers\Api\UserApiController::class,'store']);
Route::put('users/{id}/update',[\App\Http\Controllers\Api\UserApiController::class,'update']);
Route::delete('users/{id}/delete',[\App\Http\Controllers\Api\UserApiController::class,'destroy']);
Route::get('users/{id}/show',[\App\Http\Controllers\Api\UserApiController::class,'show']);


Route::get('categories',[\App\Http\Controllers\CategoryApiController::class,'index']);
Route::get('category/{slug}',[\App\Http\Controllers\CategoryApiController::class,'show']);
