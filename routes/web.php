<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\GoogleController;
use App\http\Controllers\githubController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('auth/google',[GoogleController::class,'googlepage']);
Route::get('auth/google/callback',[GoogleController::class,'googlecallback']);


Route::get('auth/github',[githubController::class,'githubpage']);
Route::get('auth/github/callback',[githubController::class,'githubcallback']);