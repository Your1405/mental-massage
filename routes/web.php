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
| Handles different GET and POST requests 

    - A GET request is usually used when a user needs to get/retrieve files or data from a webserver

    - A POST request is usually used when a user needs to post/send files or data to a webserver
  
*/

/*
    When a user submits a http GET request to '/dashboard',
    the dashboard() function inside of the 'DashboardController' is called and returns either a view or a redirect
*/
Route::get("/dashboard", [DashboardController::class, 'dashboard']);
Route::get('/', function (){
    return redirect('/login');
});

// This defines all the routes for the ClientController class
Route::controller(ClientController::class)->group(function(){
    Route::get("/clienten", 'view');
    Route::get("/clienten/edit",'edit');
    Route::get("/clienten/archive",'archive');
    Route::get("/clienten/add",'add');
    Route::post("/clienten/add",'add');
});

// This defines all the routes for the AfspraakController class
Route::controller(AfspraakController::class)->group(function(){
    Route::get("/afspraak", 'view');
    Route::get("/afspraak/edit",'edit');
    Route::get("/afspraak/archive",'archive');
    Route::get("/afspraak/add",'add');
});

// This defines all the routes for the UserController class
Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'login');
    Route::post('/login', 'login');

    Route::get('/register', 'register');
    Route::post('/register', 'register');

    Route::get('/logout', 'logout');

    Route::get('/user/view/{id}', 'view');
    Route::get('/user/profile', 'profile');

    Route::get('/users', 'overzicht');

    Route::get('/user/edit','edit');
    Route::get('/user/edit/{id}', 'edit');

    Route::get('/user/archive','archive');

    Route::get('/user/add','add');
    Route::post('/user/add', 'add');
});