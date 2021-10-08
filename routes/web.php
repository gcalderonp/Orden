<?php

use App\Http\Controllers\OrdenController;
use App\Http\Controllers\OrdenDetController;
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

Route::get('/', [OrdenController::class, 'index'])->name('index');
Route::post('CrearOrden', [OrdenController::class, 'store'])->name('CrearOrden');

Route::get('ordenDet/{id}', [OrdenDetController::class, 'index'])->name('ordenDet');
Route::post('storeDet', [OrdenDetController::class, 'store']);
Route::put('updateDet', [OrdenDetController::class, 'update']);


