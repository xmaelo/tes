<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StarController;
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

Route::get('/', [StarController::class, 'index']);

Route::resource('star', StarController::class);

Route::post('star/store', [StarController::class, 'store']);
Route::post('/star/{id}', [StarController::class, 'update']);

