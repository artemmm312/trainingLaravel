<?php

use App\Http\Controllers\TestController;
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

Route::get('/', function ()
{
    return view('welcome');
});

Route::get('/1', [TestController::class, 'one'])->name('one');
Route::get('/2', [TestController::class, 'two'])->name('two');
Route::get('/3', [TestController::class, 'three'])->name('three');
Route::get('/4', [TestController::class, 'four'])->name('four');
Route::get('/5', [TestController::class, 'five'])->name('five');
Route::get('/6', [TestController::class, 'six'])->name('six');
