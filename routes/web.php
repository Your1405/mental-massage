<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;

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

Route::get("/dashboard", [DashboardController::class, 'dashboard']);
Route::get('/', function (){
    return redirect('/login');
});

Route::controller(PatientController::class)->group(function(){
    Route::get("/patient", 'view');
    Route::get("/patient/edit",'edit');
    Route::get("/patient/archive",'archive');
    Route::get("/patient/add",'add');
});

Route::controller(AfspraakController::class)->group(function(){
    Route::get("/afspraak", 'view');
    Route::get("/afspraak/edit",'edit');
    Route::get("/afspraak/archive",'archive');
    Route::get("/afspraak/add",'add');
});

Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'login');
    Route::post('/login', 'login');
    Route::get("/user", 'view');
    Route::get("/user/edit",'edit');
    Route::get("/user/archive",'archive');
    Route::get("/user/add",'add');
});