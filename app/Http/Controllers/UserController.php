<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function login(Request $request){
        if($request->isMethod('POST')){
            $email = $request->input('email');
            $password = $request->input('password');

            return redirect('/dashboard');
        }
        else {
            return view('login');
        }
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
