<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard(Request $request){
        $userType = $request->session()->get('userType');
        if ($userType == 'admin'){
            return view('dashboard', ['userType'=>'admin']);
        } else if ($userType == 'specialist'){
            return view('dashboard', ['userType'=>'specialist']);
        }
    }
}
