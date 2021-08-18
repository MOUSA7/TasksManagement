<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[\App\Http\Controllers\HomeController::class,'dashboard'])->name('dashboard');

Auth::routes();

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (){

    Route::get('/',[\App\Http\Controllers\HomeController::class,'dashboard'])->name('dashboard');

    Route::get('categories',[\App\Http\Controllers\CategoryController::class,'index'])->name('categories.index');
    Route::get('categories/create',[\App\Http\Controllers\CategoryController::class,'store'])->name('categories.create');
    Route::post('categories/create',[\App\Http\Controllers\CategoryController::class,'store'])->name('categories.store');

    Route::get('categories/{id}/edit',[\App\Http\Controllers\CategoryController::class,'edit'])->name('categories.edit');
    Route::PUT('categories/{id}',[\App\Http\Controllers\CategoryController::class,'update'])->name('categories.edit');

    Route::get('categories/delete/{id}', [\App\Http\Controllers\CategoryController::class,'destroy']);
    Route::POST('categories/delete/{id}', [\App\Http\Controllers\CategoryController::class,'destroy']);

    Route::get('/categories/{slug}',[\App\Http\Controllers\CategoryController::class,'show'])->name('categories.show');

    Route::get('tasks',[\App\Http\Controllers\TaskController::class,'index'])->name('tasks.index');
    Route::get('tasks/{task}',[\App\Http\Controllers\TaskController::class,'create'])->name('tasks.create');
    Route::post('tasks/{task}',[\App\Http\Controllers\TaskController::class,'store'])->name('tasks.store');
    Route::get('tasks/{id}/edit',[\App\Http\Controllers\TaskController::class,'edit'])->name('tasks.edit');
    Route::PUT('tasks/{id}',[\App\Http\Controllers\TaskController::class,'update'])->name('tasks.update');
    Route::get('tasks/{id}/delete',[\App\Http\Controllers\TaskController::class,'destroy'])->name('tasks.destroy');
    Route::get('tasks/export/create',[\App\Http\Controllers\TaskController::class,'ExportStore'])->name('tasks.export');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::resource('users',\App\Http\Controllers\UserController::class);
    Route::get('users/{id}/delete',[\App\Http\Controllers\UserController::class,'destroy']);
});
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

