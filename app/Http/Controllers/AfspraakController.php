<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AfspraakController extends Controller
{
    function add (){
        return view('afspraakadd');
    }
    function archive (){
        return view('afspraakarchive');
    }
    function edit (){
        return view('afspraakedit');
    }
    function view (){
        return view('afspraakview');
    }
}
