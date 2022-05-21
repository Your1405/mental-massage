<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function login(){
        return view('login');
    }

    function useradd(){
        return view('user.add');
    }

    function useredit(){
        return view('user.edit');
    }

    function userarchive(){
        return view('user.archive');
    }

    function user(){
        return view('user.view');
    }
}
