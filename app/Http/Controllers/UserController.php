<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function useradd(){
        return view('useradd');
    }
    function useredit(){
        return view('useredit');
    }
    function userarchive(){
        return view('userarchive');
    }
    function user(){
        return view('userview');
    }
}
