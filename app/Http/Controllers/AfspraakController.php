<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AfspraakController extends Controller
{
    function add (Request $request){
        $userId= $request ->session()->get('userId');
        $userType= $request ->session()->get('userType');

        if($request ->isMethod('GET')){
            return view('afspraak.afspraakadd', [
                'userType' => $userType,
                'userId' => $userId,
            ]);
        }
        else if ($request->isMethod('POST')){
            $afspraakInfo = $request->all();
            $afspraakDatum = $afspraakInfo['afspraakDatum'];
            $afspraakBegintijd = $afspraakInfo['afspraakBegintijd'];
            $afspraakEindtijd = $afspraakInfo['afspraakEindtijd'];
            $afspraakOmschrijving = $afspraakInfo['afspraakOmschrijving'];


            DB::table('afspraken')->insert([
                'userId' => $userId,
                'afspraakDatum' => $afspraakDatum,
                'afspraakBegintijd' => $afspraakBegintijd,
                'afspraakEindtijd' => $afspraakEindtijd,
                'afspraakOmschrijving' => $afspraakOmschrijving,
            ]);
        }
    }

    function add_user(){

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

    function view_user(){

    }

    function overzicht(){

    }
}
