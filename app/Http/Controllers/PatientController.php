<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    function add (){
        return view('patientadd');
    }
    function archive (){
        return view('patientarchive');
    }
    function edit (){
        return view('patientedit');
    }
    function view (){
        return view('patientview');
        
    }
}
