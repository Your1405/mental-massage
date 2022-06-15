<?php

use App\Http\Controllers\AfspraakController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;

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

Route::controller(ClientController::class)->group(function(){
    Route::get("/clienten", 'view');
    Route::get("/clienten/edit",'edit');
    Route::get("/clienten/archive",'archive');
    Route::get("/clienten/add",'add');
    Route::post("/clienten/add",'add');
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
    Route::get('/logout', 'logout');
    Route::get('/user/view/{id}', 'view');
    Route::get('/users', 'overzicht');
    Route::get('/user/edit','edit');
    Route::get('/user/archive','archive');
    Route::get('/user/add','add');

    Route::get('/user/edit/{id}', 'edit');
    Route::get('/user/profile', 'view');

    Route::post('/user/add', 'add');
});