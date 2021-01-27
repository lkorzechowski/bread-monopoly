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
    return view('welcome');
})->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/deleteUser', [App\Http\Controllers\HomeController::class, 'deleteUser'])->name('deleteUser');

Route::get('/farm', [App\Http\Controllers\FarmController::class, 'index'])->name('farm');

Route::get('/harvest/{tile}', [App\Http\Controllers\FarmController::class, 'harvest'])->name('harvest');

Route::get('/mill', [App\Http\Controllers\MillController::class, 'index'])->name('mill');

Route::get('/spin', [App\Http\Controllers\MillController::class, 'spin'])->name('spin');

Route::get('/bakery', [App\Http\Controllers\BakeryController::class, 'index'])->name('bakery');

Route::get('/bake', [App\Http\Controllers\BakeryController::class, 'bake'])->name('bake');

Route::get('/sell', [App\Http\Controllers\BakeryController::class, 'sell'])->name('sell');

Route::get('/scoreboard', [App\Http\Controllers\ScoreboardController::class, 'index'])->name('scoreboard');

Route::get('/store', [App\Http\Controllers\StoreController::class, 'index'])->name('store');

Route::get('/purchaseFields', [App\Http\Controllers\StoreController::class, 'purchaseFields'])->name('purchaseFields');
