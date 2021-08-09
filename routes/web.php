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

Route::get('/', function () {
    return view('admin.index');
});

Auth::routes();


Route::get('categories',[\App\Http\Controllers\CategoryController::class,'index'])->name('admin.categories.index');
Route::get('categories/create',[\App\Http\Controllers\CategoryController::class,'store'])->name('admin.categories.create');
Route::post('categories/create',[\App\Http\Controllers\CategoryController::class,'store'])->name('admin.categories.store');

Route::get('categories/{id}/edit',[\App\Http\Controllers\CategoryController::class,'edit'])->name('admin.categories.edit');
Route::PUT('categories/{id}',[\App\Http\Controllers\CategoryController::class,'update'])->name('admin.categories.edit');

Route::get('categories/delete/{id}', [\App\Http\Controllers\CategoryController::class,'destroy']);
Route::POST('categories/delete/{id}', [\App\Http\Controllers\CategoryController::class,'destroy']);

Route::get('/categories/{slug}',[\App\Http\Controllers\CategoryController::class,'show'])->name('admin.categories.show');

Route::get('admin/tasks',[\App\Http\Controllers\TaskController::class,'index'])->name('admin.tasks.index');
Route::get('admin/tasks/{task}',[\App\Http\Controllers\TaskController::class,'create'])->name('admin.tasks.create');
Route::post('admin/tasks/{task}',[\App\Http\Controllers\TaskController::class,'store'])->name('admin.tasks.store');
Route::get('admin/tasks/{id}/edit',[\App\Http\Controllers\TaskController::class,'edit'])->name('admin.tasks.edit');
Route::PUT('admin/tasks/{id}',[\App\Http\Controllers\TaskController::class,'update'])->name('admin.tasks.update');
Route::get('admin/tasks/{id}/delete',[\App\Http\Controllers\TaskController::class,'destroy'])->name('admin.tasks.destroy');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
