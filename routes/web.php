<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Con

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/client',[\App\Http\Controllers\ClientController::class,'index'])->name('index');
Route::get('/listclient',[\App\Http\Controllers\ClientController::class,'clientListing'])->name('show');

Route::get('/loans',[App\Http\Controllers\LoanController::class,'index'])->name('index');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
