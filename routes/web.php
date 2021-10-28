<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OnboardingController;


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


Route::get('/start', [OnboardingController::class, 'start']);
Route::get('/goals', [OnboardingController::class, 'goals']);
Route::get('/approaches', [OnboardingController::class, 'approaches']);
Route::get('/plan', [OnboardingController::class, 'plan']);
