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
    return redirect('/dashboard');
});

Route::controller(PatientController::class)->group(function(){
    Route::get("/patient", 'view');
    Route::get("/patientedit",'edit');
    Route::get("/patientarchive",'archive');
    Route::get("/patientadd",'add');
});
Route::controller(AfspraakController::class)->group(function(){
    Route::get("/afspraak", 'view');
    Route::get("/afspraakedit",'edit');
    Route::get("/afspraakarchive",'archive');
    Route::get("/afspraakadd",'add');
});
Route::controller(UserController::class)->group(function(){
    Route::get("/user", 'view');
    Route::get("/useredit",'edit');
    Route::get("/userarchive",'archive');
    Route::get("/useradd",'add');
});

