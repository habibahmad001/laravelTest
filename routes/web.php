<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StockController;
use App\Http\Controllers\TaskController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('/',StockController::class);
Route::any('/removeit/{id}',[StockController::class, "destroy"]);
Route::any('/ajax-stock-store', [StockController::class, "store"]);
Route::any('/review/modify', [StockController::class, 'reviewModify']);
Route::any('/exportxml', [StockController::class, 'exportXML']);
Route::any('/exportjson', [StockController::class, 'exportJSON']);


Route::resource('/task',TaskController::class);
Route::any('/loadData',[TaskController::class, 'LoadData']);


Route::get('items', [TaskController::class, 'index'])->name('items.index');
Route::get('items/data', [TaskController::class, 'getData'])->name('items.data');
Route::post('items', [TaskController::class, 'store'])->name('items.store');
Route::put('items/{id}', [TaskController::class, 'update'])->name('items.update');
Route::delete('items/{id}', [TaskController::class, 'destroy'])->name('items.destroy');

