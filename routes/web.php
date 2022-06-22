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
});

Auth::routes(['verify' => true]);

Route::get('auth/facebook', [App\Http\Controllers\Auth\FacebookController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [App\Http\Controllers\Auth\FacebookController::class, 'facebookCallback']);

Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'googleRedirect']);
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'googleCallback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('records', \App\Http\Controllers\RecordController::class);
Route::resource('wallets', \App\Http\Controllers\WalletController::class);


