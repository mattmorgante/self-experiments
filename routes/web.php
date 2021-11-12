<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalsController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\ApproachesController;
use App\Http\Controllers\SMSController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/start', function () {
    return view('start');
});

Route::get('/goals', [GoalsController::class, 'index']);
Route::get('/approaches/{goal_id}', [ApproachesController::class, 'index']);
Route::get('/plan/{goal_id}/{approach_id}', [PlansController::class, 'show']);
Route::post('/plan/save', [PlansController::class, 'save']);
Route::get('/thanks', [PlansController::class, 'thanks']);

Route::post('/incoming-sms', [SMSController::class, 'incoming']);

require __DIR__.'/auth.php';
